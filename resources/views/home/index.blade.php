@extends('layouts.app-master')
@section('content')

<style>
    h4{
        padding-top: 20px;

    }
</style>

<div class="bg-light p-5 rounded">
    
    @auth
    
    <!-- pop up part -->
    @if (Session::has('flash_msg'))
        <div class= "alert alert-success {{ Session::has('flash_msg_impt') ? 'alert-important' : ''}}" >
            {{ Session::get('flash_msg') }}
        </div>
    @endif


    <h1>Products</h1>
    <p class="lead">Choose the product that you want to buy.</p>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="row">

                @foreach($products as $product)
                <div class="col-xs-18 col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img src="{{ $product->image }}" width="156" height="216" alt="">
                        <div class="caption">
                            <h4 class="mx-auto">{{ $product->product_name }}</h4>
                            <p>{{ $product->product_description }}</p>
                            <p><strong>Stock: </strong>{{ $product->quantity_stock }}</p>
                            <p><strong>Price: </strong> {{ $product->buy_price }} ฿</p>
                            <!-- <p class="btn-holder"><a href="{{ route('add.to.cart', $product->ISBN) }}"
                                    class="btn btn-warning btn-block text-center" role="button">Add to cart</a> </p> -->
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endauth

    @guest
    <h1>Homepage</h1>
    <p class="lead">You have to login before buy the products.</p>


    <div class="flex-center position-ref full-height">
        <div class="content">
            <p>What we have in stocks.</p>
            <div class="row">
                @foreach($products as $product)
                <div class="col-xs-18 col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img class="flex-center" src="{{ $product->image }}" width="156" height="216" alt="">
                        <div class="caption">
                            <h4 class="mx-auto padding 3px">{{ $product->product_name }}</h4>
                            <p>{{ $product->product_description }}</p>
                            <p><strong>Stock: </strong>{{ $product->quantity_stock }}</p>
                            <p><strong>Price: </strong> {{ $product->buy_price }} ฿</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endguest
    {!! $products -> links('pagination::bootstrap-5') !!}
</div>


    <!-- make pop up disappear in 3 s -->
    <script>
        $('div.alert').not('.alert-important').delay(3000).slideUp(300);
    </script>

@endsection