@extends('layouts.app-master')
@section('content')

<style>
    .anime {
    background-image: url('https://scontent.fcnx3-1.fna.fbcdn.net/v/t1.15752-9/261531025_3222634841356110_721914774512938182_n.png?_nc_cat=106&ccb=1-7&_nc_sid=ae9488&_nc_eui2=AeGN9aWqT6eaK8SjSoz7cBLhrEnMG0qAGpqsScwbSoAamgvmfeaOp1Ft5qrPzXx0KO7pOV0phRqOgRAn5zBGcYef&_nc_ohc=QNacV8ez4c8AX9sEVkT&_nc_ht=scontent.fcnx3-1.fna&oh=03_AdTfOBNmoljsBs_KNXyfg4HHnykdo9PWBClbToYsrJ5ViA&oe=638F296B');
    background-size: cover;



    height: 100vh;
    padding: 0;
    margin: 0;
}
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
<div class="hp">
    <img src="https://cdn.pixabay.com/photo/2013/07/12/17/20/leaf-152047_960_720.png" width="400" height="400" id="hp"></div>
<div class="my-5 rounded-5 bg-dark text-white p-5 rounded shadow  " style="height: 400px">



    <h1>About</h1>
    
    <h1 class="">Clover Leaf Co.</h1>
    <body style="font-style:italic; font-size:larger " >OUR DEPARTMENT AT CHIANG MAI UNIVERSITY</body>
    <img src="https://upload.wikimedia.org/wikipedia/en/2/25/Chiang_mai_university_logo.png" style="width: 100px;"alt="">
    

    <div class="flex-center position-ref full-height">
        <div class="content">
            <p></p>
            <div class="row d-flex rem-4">
            </div>
        </div>
    </div>
    
    

</div>


    <!-- make pop up disappear in 3 s -->
    <script>
        $('div.alert').not('.alert-important').delay(3000).slideUp(300);
    </script>

@endsection