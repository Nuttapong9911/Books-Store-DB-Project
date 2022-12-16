<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\Producttype;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\User;
use App\Models\Customer;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * compact of product
     */
    public function index()
    {
        $product['products'] = Product::orderBy('product_name', 'asc')->paginate(15);

        return view('home.index', $product);
    }


    /**
     * Display a listing of all products in the current (unpaid) order.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function cart()
    {
        $owner_id = Auth::id();

        $customer = DB::table('customers')
            ->where('user_ID', $owner_id)
            ->select('customer_ID')
            ->first();
        
        $orders = DB::table('orders')
            ->join('orderdetails', 'orders.order_num', '=', 'orderdetails.order_num')
            ->join('products', 'orderdetails.ISBN', '=', 'products.ISBN')
            ->where('status', 'unpaid')
            ->where('customer_ID', $customer->customer_ID)
            ->get();

        $carts = array();
        foreach ($orders as $value) {
            array_push($carts, [
                'name' => $value -> product_name,
                'id' => $value -> ISBN,
                'price' => $value -> buy_price,
                'quantity' => $value -> quantity,
                'image' => $value -> image
            ]);
        }

        return view('cart',['carts'=>$carts]);
    }


    /**
     * Display a listing of purchased products.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function history()
    {
        $owner_id = Auth::id();

        $customer = DB::table('customers')
            ->where('user_ID', $owner_id)
            ->select('customer_ID')
            ->first();
        
        $orders = DB::table('orders')
            ->join('orderdetails', 'orders.order_num', '=', 'orderdetails.order_num')
            ->join('products', 'orderdetails.ISBN', '=', 'products.ISBN')
            ->where('status', 'paid')
            ->where('customer_ID', $customer->customer_ID)
            ->get();

        $carts = array();
        foreach ($orders as $value) {
            array_push($carts, [
                'name' => $value -> product_name,
                'id' => $value -> ISBN,
                'price' => $value -> buy_price,
                'quantity' => $value -> quantity,
                'image' => $value -> image,
                'order_date' => $value -> order_date
            ]);
        }

        return view('history',['carts'=>$carts]);
    }



    /**
     * Add the product to current order.
     * 
     * If user doesnt have any product in current order,
     * create new order with new order detail of this product.
     * 
     * If user has other products in current order except this product,
     *  create new order detail of this product with order number of current product.
     * 
     * If user already has this product in current order,
     *  update order detail of this product with +1 in quantity.
     *
     * @param ISBN Product ID
     * 
     * @return \Illuminate\Http\Response
     * 
     */    
    public function addToCart($ISBN)
    {
        
        if(!Auth::user()){
            return view('home.index');
        }
        
        // find product by ISBN
        $product = Product::findOrFail($ISBN);

        // find user ID and customer ID
        $owner_id = Auth::id();
        $customer_id = DB::table('customers')
            ->where('user_ID', $owner_id)
            ->pluck('customer_ID')[0];

        // find the current order (if exist)
        $order = DB::table('orders')
            ->where('customer_ID', $customer_id)
            ->where('status', 'unpaid')
            ->first();
        
            
        \DB::transaction(function () use($product, $order, $customer_id, $ISBN){

            // if unpaid current order is exist
            if($order != null) {

                // find order detail of this product (if user has ordered this product before or not)
                $order_detail = Orderdetail::
                    where('ISBN', $ISBN)
                    ->where('order_num', $order->order_num)
                    ->first();

                    // if order detail of this product is not exist (hasn't ordered this before)
                    if($order_detail == null){
                        $new_order_detail = new Orderdetail();
                        $order_detail = new Orderdetail();
                        $order_detail->ISBN = $product->ISBN;
                        $order_detail->order_num = $order->order_num;
                        $order_detail->price_each = $product->buy_price;
                        $order_detail->quantity = 1;
                        
                        $order_detail->save();
                    }
                    
                    // if order detail of this product is not exist (has ordered this before)
                    else{
                        $order_detail -> quantity = $order_detail -> quantity +1;
                        $order_detail->save();
                    }
                
            // if unpaid current order is not exist
            // create new order with new order detail of this product
            }else {
                $order = new Order();
                $order->status = 'unpaid';
                $order->order_date = date("Y/m/d");
                $order->customer_ID = $customer_id;
                $order->save();

                $order_detail = new Orderdetail();
                $order_detail->ISBN = $product->ISBN;
                $order_detail->order_num = $order->order_num;
                $order_detail->price_each = $product->buy_price;
                $order_detail->quantity = 1;
                
                $order_detail->save();
            }

            // remove one product from stock
            $product->quantity_stock = $product->quantity_stock-1 ;
            $product->save();
        });

        // flash a message popup
        session()->flash('flash_msg', 'Product added to cart successfully!');

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }


    /**
     * Remove products from its order
     *
     * @param ISBN Product ID
     * 
     * @return \Illuminate\Http\Response
     * 
     */    
    public function remove($ISBN)
    {

        // find user ID and customer ID
        $owner_id = Auth::id();
        $customer = DB::table('customers')
            ->where('user_ID', $owner_id)
            ->select('customer_ID')
            ->first();
        $customer_ID = $customer->customer_ID;

        // find the current order (must exist)
        $order = DB::table('orders')
            ->where('customer_ID', $customer_ID)
            ->where('status', 'unpaid')
            ->first();

        // find order detail of this product
        $order_detail = Orderdetail::where('ISBN', $ISBN)
            ->where('order_num', $order->order_num)
            ->first();

        // find the product user want to remove
        $product = Product::where('ISBN', '=', $ISBN)->first();


        \DB::transaction(function () use($product, $order_detail, $order){

            // return all products in the order detail to stock
            $product->quantity_stock = $product->quantity_stock + $order_detail->quantity ;
            $product->save();

            //find its order number
            $order_num = $order_detail->order_num;

            // delete order detail of this product
            $order_detail->delete();

            // if deleted product is the last product in the current order, remove the current order
            if(DB::table('orderdetails')->where('order_num', $order_num)->first() == null)
                Order::where('order_num', $order_num)->delete();
        });

        // flash a message popup
        session()->flash('flash_dlt_msg', 'Product removed successfully');

        return back()->with('success', 'Product removed successfully');
    }


    /**
     * Purchase all product of unpaid current order
     * 
     * change status of unpaid current order to paid
     * 
     * @return \Illuminate\Http\Response
     * 
     */  
    public function purchase(){
        
        // find user ID and customer ID
        $owner_id = Auth::id();
        $customer_id = DB::table('customers')
            ->where('user_ID', $owner_id)
            ->pluck('customer_ID')[0];

        // find the unpaid current order and change its status to paid
        $orders = Order::where('customer_ID', $customer_id)
            ->where('status', 'unpaid')
            ->update(['status' => 'paid']);

        // flash a message popup
        session()->flash('flash_dlt_msg', 'Product purchased successfully');

        return back()->with('success', 'Product purchased successfully');
    }


    /**
     * Display about page.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function about(){
        return view('home.about');
    }


    /**
     * Display a listing of searched products
     *
     * @return \Illuminate\Http\Response
     * compact of product
     */
    public function search(){
        $search_text = $_GET['query'];
        $products = Product::where('product_name','LIKE','%'.$search_text.'%')->get();
        return view('home.search',compact('products'));
    }



}
