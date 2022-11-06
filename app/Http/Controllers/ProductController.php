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
     * Display a listing of all products in the cart.
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
     * Add the product from cart
     *
     * @param product id
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

        $owner_id = Auth::id();

        $customer_id = DB::table('customers')
            ->where('user_ID', $owner_id)
            ->pluck('customer_ID')[0];

        // find the order which has product that has same name with the selected product
        $order = DB::table('orders')
            ->where('customer_ID', $customer_id)
            ->where('status', 'unpaid')
            ->first();
        
            
        \DB::transaction(function () use($product, $order, $customer_id, $ISBN){

            // if the cart already has selected product
            // the cart's quantity + 1
            if($order != null) {
                // $order_detail_selected = Orderdetail::where('order_num', $order->order_num)->where('ISBN', $order_detail->ISBN)->first();
                $order_detail = Orderdetail::
                    where('ISBN', $ISBN)
                    ->where('order_num', $order->order_num)
                    ->first();

                    if($order_detail == null){
                        $new_order_detail = new Orderdetail();
                        $order_detail = new Orderdetail();
                        $order_detail->ISBN = $product->ISBN;
                        $order_detail->order_num = $order->order_num;
                        $order_detail->price_each = $product->buy_price;
                        $order_detail->quantity = 1;
                        
                        $order_detail->save();
                    }else{
                        $order_detail -> quantity = $order_detail -> quantity +1;
                        $order_detail->save();
                    }
                
            // else add new cart
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

            // for both case, remove one product from stock
            $product->quantity_stock = $product->quantity_stock-1 ;
            $product->save();
        });

        // flash a message popup
        session()->flash('flash_msg', 'Product added to cart successfully!');

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }


    /**
     * Remove the product from cart
     *
     * @param cart id
     * 
     * @return \Illuminate\Http\Response
     * 
     */    
    public function remove($ISBN)
    {

        $owner_id = Auth::id();

        $customer = DB::table('customers')
            ->where('user_ID', $owner_id)
            ->select('customer_ID')
            ->first();

        $customer_ID = $customer->customer_ID;

        $order = DB::table('orders')
            ->where('customer_ID', $customer_ID)
            ->where('status', 'unpaid')
            ->first();

        $order_detail = Orderdetail::where('ISBN', $ISBN)
            ->where('order_num', $order->order_num)
            ->first();

        // find the cart by id
        // carts have lots of (mini)cart which has one type of product

        // find the product which has same name with product in the cart
        $product = Product::where('ISBN', '=', $ISBN)->first();


        \DB::transaction(function () use($product, $order_detail, $order){

            // return products in the cart to stock
            $product->quantity_stock = $product->quantity_stock + $order_detail->quantity ;
            $product->save();

            $order_num = $order_detail->order_num;

            // delete the cart
            $order_detail->delete();

            if(DB::table('orderdetails')->where('order_num', $order_num)->first() == null)
                Order::where('order_num', $order_num)->delete();
        });

        // flash a message popup
        session()->flash('flash_dlt_msg', 'Product removed successfully');

        return back()->with('success', 'Product removed successfully');
    }

    public function about(){
        return view('home.about');
    }


}
