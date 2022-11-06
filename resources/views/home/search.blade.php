@extends('layouts.app-master')
@section('content')

<style>
    h4{
        padding-top: 20px;

    }

    .box{
        /* position: relative; */
        box-sizing: border-box;
    }
    .price{
        position: relative;
        left:0;
  bottom: 0;

    }
    .book-font { 
        font-family: 'THSarabunNew', sans-serif; 
}
    .shadow {
  box-shadow: 0 10px 20px 0 rgba(0,0,0,.2);
    }
</style>

<div class="bg-light p-5 rounded my-5 shadow ">
    
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
            <p>What we have in stocks.</p>
            <div class="row center d-flex justify-content-around">
                @foreach($products as $product)
                <div class="col-sm col-md-3 bg-white shadow mx-3 my-3 rounded align-center">
                    <!-- <div class="thumbnail mx-3 "> -->
                        <div class="center my-4 mx-4" style=""><img  src="{{ $product->image }}" width="156" height="216" alt="" ></div>
                        <div class="caption">
                            <div class=" padding 3px book-font h5 box d-flex mx-3 ">{{ $product->product_name }}</div>
                            <div>
                            <!-- <div  class = "mx-3 my-3"><p  class ="book-font">{{ $product->product_description }}</p></div> -->
                            <div class = "mx-3 my-3 "><p  class ="book-font"><strong>Stock: </strong>{{ $product->quantity_stock }}</p></div>
                            <div class = "flex-1 " stlye="min-height: 1rem;" ></div>
                            <div class ="price book-font mx-3 rounded  " style ="box-shadow: 0 2px 5px 0 rgba(0,0,0,.2);text-align:center; background-color:pink; color:white "><p><strong>Price:  {{ $product->buy_price }}฿</strong></p></div>
                            <p class="btn-holder"><a href="{{ route('add.to.cart', $product->ISBN) }}"
                                    class="btn btn-warning btn-block text-center" role="button">Add to cart</a> </p>
                            </div>
                        </div>
                    <!-- </div> -->
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endauth

    @guest
    <p class="lead">You have to login before buy the products.</p>


    <div class="flex-center position-ref full-height">
        <div class="content">
            <p>What we have in stocks.</p>
            <div class="row center d-flex justify-content-around">
                @foreach($products as $product)
                <div class="col-sm col-md-3 bg-white shadow mx-3 my-3 rounded align-center">
                    <!-- <div class="thumbnail mx-3 "> -->
                        <div class="center my-4 mx-4" style=""><img  src="{{ $product->image }}" width="156" height="216" alt="" ></div>
                        <div class="caption">
                            <div class=" padding 3px book-font h5 box d-flex mx-3 ">{{ $product->product_name }}</div>
                            <div>
                            <!-- <div  class = "mx-3 my-3"><p  class ="book-font">{{ $product->product_description }}</p></div> -->
                            <div class = "mx-3 my-3 "><p  class ="book-font"><strong>Stock: </strong>{{ $product->quantity_stock }}</p></div>
                            <div class = "flex-1 " stlye="min-height: 1rem;" ></div>
                            <div class ="price book-font mx-3 rounded  " style ="box-shadow: 0 2px 5px 0 rgba(0,0,0,.2);text-align:center; background-color:pink; color:white "><p><strong>Price:  {{ $product->buy_price }}฿</strong></p></div>
                            </div>
                        </div>
                    <!-- </div> -->
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endguest
</div>


    <!-- make pop up disappear in 3 s -->
    <script>
        $('div.alert').not('.alert-important').delay(3000).slideUp(300);
    </script>

@endsection