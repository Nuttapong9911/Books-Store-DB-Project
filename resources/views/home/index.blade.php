@extends('layouts.app-master')
@section('content')

<style>
            .anime{
    background-image: url('https://scontent.fcnx3-1.fna.fbcdn.net/v/t1.15752-9/261531025_3222634841356110_721914774512938182_n.png?_nc_cat=106&ccb=1-7&_nc_sid=ae9488&_nc_eui2=AeGN9aWqT6eaK8SjSoz7cBLhrEnMG0qAGpqsScwbSoAamgvmfeaOp1Ft5qrPzXx0KO7pOV0phRqOgRAn5zBGcYef&_nc_ohc=QNacV8ez4c8AX9sEVkT&_nc_ht=scontent.fcnx3-1.fna&oh=03_AdTfOBNmoljsBs_KNXyfg4HHnykdo9PWBClbToYsrJ5ViA&oe=638F296B');
    background-size: cover;
    
    
    
    height: 100vh;
    padding:0;
    margin:0;
    }
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
<div class=" p-5 rounded my-5 shadow " style="background-color:rgba(255, 255, 255, 0.5);">
    
    @auth
    
    <!-- pop up part -->
    @if (Session::has('flash_msg'))
        <div class= "alert alert-success {{ Session::has('flash_msg_impt') ? 'alert-important' : ''}}" >
            {{ Session::get('flash_msg') }}
        </div>
    @endif


    <div class="justify-content-center text-center"> <h1 class="justify-content-center book-font" ><h1>Products</h1></div>
    <p class="justify-content-center text-center lead ">Choose the product that you want to buy.</p>
    
    <div class="flex-center position-ref full-height">
        <div class="content text-center">
            <!-- <p style="book-font">What we have in stocks.</p> -->
            <div class="row center d-flex justify-content-around">
                @foreach($products as $product)
                <div class="col-sm col-md-3 bg-white shadow mx-3 my-3 rounded align-center" >
                    <!-- <div class="thumbnail mx-3 "> -->
                        <div class="center my-4 mx-4" style=""><img  src="{{ $product->image }}" width="156" height="216" alt="" ></div>
                        <div class="caption">
                            <div class=" padding 3px book-font h10 box d-flex mx-3 ">{{ $product->product_name }}</div>
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
    @endauth

    @guest
    <div class="justify-content-center text-center"> <h1 class="justify-content-center book-font" >Homepage</h1> </div>
    <p class="lead text-center" >You have to login before buy the products.</p>


    <div class="flex-center position-ref full-height">
        <div class="content text-center">
            <p style="book-font">What we have in stocks.</p>
            <div class="row center d-flex justify-content-around">
                @foreach($products as $product)
                <div class="col-sm col-md-3 bg-white shadow mx-3 my-3 rounded align-center" >
                    <!-- <div class="thumbnail mx-3 "> -->
                        <div class="center my-4 mx-4" style=""><img  src="{{ $product->image }}" width="156" height="216" alt="" ></div>
                        <div class="caption">
                            <div class=" padding 3px book-font h10 box d-flex mx-3 ">{{ $product->product_name }}</div>
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
    {!! $products -> links('pagination::bootstrap-5') !!}
</div>
</div>


    <!-- make pop up disappear in 3 s -->
    <script>
        $('div.alert').not('.alert-important').delay(3000).slideUp(300);
    </script>

@endsection