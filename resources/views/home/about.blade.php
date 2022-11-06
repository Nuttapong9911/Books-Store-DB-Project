@extends('layouts.app-master')
@section('content')

<style>
    h4{
        padding-top: 20px;
    }
    .shadow {
  box-shadow: 0 10px 20px 0 rgba(0,0,0,.2);
    }
    .hp  {
float: right;    
 margin: 0 0 0 15px;
}
</style>

<div class="my-5 rounded-5 bg-dark text-white p-5 rounded shadow ">



    <h1>About</h1>
    <h1 class="">Clover Leaf Co.</h1>
    <div class="hp">
    <img src="https://cdn.pixabay.com/photo/2013/07/12/17/20/leaf-152047_960_720.png" width="400" height="400" id="hp"></div>
    <body>OUR DEPARTMENT AT </body>


    <div class="flex-center position-ref full-height">
        <div class="content">
            <p>store</p>
            <div class="row">
            </div>
        </div>
    </div>
    
    

</div>


    <!-- make pop up disappear in 3 s -->
    <script>
        $('div.alert').not('.alert-important').delay(3000).slideUp(300);
    </script>

@endsection