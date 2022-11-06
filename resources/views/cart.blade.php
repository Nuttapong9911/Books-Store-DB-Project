@extends('layouts.app-master')
@section('content')

    <!-- pop up part -->
@if (Session::has('flash_dlt_msg'))
        <div class= "mt-5 alert alert-success {{ Session::has('flash_dlt_msg_impt') ? 'alert-important' : ''}}" >
            {{ Session::get('flash_dlt_msg') }}
        </div>
@endif
<style>
.anime {
    background-image: url('https://scontent.fcnx3-1.fna.fbcdn.net/v/t1.15752-9/261531025_3222634841356110_721914774512938182_n.png?_nc_cat=106&ccb=1-7&_nc_sid=ae9488&_nc_eui2=AeGN9aWqT6eaK8SjSoz7cBLhrEnMG0qAGpqsScwbSoAamgvmfeaOp1Ft5qrPzXx0KO7pOV0phRqOgRAn5zBGcYef&_nc_ohc=QNacV8ez4c8AX9sEVkT&_nc_ht=scontent.fcnx3-1.fna&oh=03_AdTfOBNmoljsBs_KNXyfg4HHnykdo9PWBClbToYsrJ5ViA&oe=638F296B');
    background-size: cover;



    height: 100vh;
    padding: 0;
    margin: 0;
}

h4 {
    padding-top: 20px;

}

.box {
    /* position: relative; */
    box-sizing: border-box;
}

.price {
    position: relative;
    left: 0;
    bottom: 0;

}

.book-font {
    font-family: 'THSarabunNew', sans-serif;
}

.shadow {
    box-shadow: 0 10px 20px 0 rgba(0, 0, 0, .2);
}
</style>
<div class=" p-5 rounded my-5 shadow " style="background-color:rgba(255, 255, 255, 0.5);">

<table>
    @auth
    <thead>
        <tr>
            <th style="width:10%">BOOK</th>
            <th style="width:20%">NAME</th>
            <th style="width:10%">PRICE</th>
            <th style="width:8%">QUANTITY</th>
            <th style="width:22%" class="text-center">SUBTOTAL</th>
            <th style="width:10%"></th>
        </tr>
    </thead>
    <tbody>
        
        @php $total = 0 @endphp

        @foreach( $carts as $cart )
        <tr>
            @php $total += $cart['price']*$cart['quantity'] @endphp
            <td>
                <div class="row">
                    <div class="col-sm-3 hidden-xs"><img src="{{ $cart['image'] }}" width="72" height="100"
                            class="img-responsive" /></div>
                    <div class="col-sm-9">
                    </div>
                </div>
            </td>
            <td>{{ $cart['name'] }}</td>
            <td class="inner-table">{{ $cart['price'] }}</td>
            <td class="inner-table">{{ $cart['quantity'] }}
            <td data-th="Subtotal" class="text-center">{{$cart['price']*$cart['quantity']}}</td>
            <td>
                <form action="{{ url('remove-from-cart/'.$cart['id']) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" class="text-right">
                <h3><strong>Total {{ $total }}<h3><strong>
            </td>
        </tr>
        <tr>
            <td colspan="5" class="text-right">
                <a href="{{ url('/') }}" class="btn " style="background-color:#3F71A5; color:white" ><i class="fa fa-angle-left" ></i> Continue Shopping</a>
                <a href="{{ url('/purchase') }}" class="btn " style="background-color:#268643; color:white">PURCHASE</a>
            </td>
        </tr>
    </tfoot>
    @endauth
</table>

<script>
    $('div.alert').not('.alert-important').delay(3000).slideUp(300);
</script>

</div>

@endsection