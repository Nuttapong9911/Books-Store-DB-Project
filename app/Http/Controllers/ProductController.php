<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Producttype;
use App\Models\Order;
use App\Models\Orderdetail;

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
        $product['products'] = Product::orderBy('product_name', 'asc')->paginate(16);
        return view('home.index', $product);
    }
}
