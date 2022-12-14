@extends('layouts.auth-master')
@section('content')

<!--                submit the input request to this action -->
<form method="post" action="{{ route('register.perform') }}">

    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    
    <!-- Logo -->
    <a href="http://127.0.0.1:8000/">
    <img class="mb-4"   src="{!! url('https://cdn.pixabay.com/photo/2013/07/12/17/20/leaf-152047_960_720.png') !!}"
        alt="" width="72" height="57">
    </a>
    

    <!-- Heading -->
    <h1 class="h3 mb-3 fw-normal">Register</h1>

    <div class = 't1'>

        <!-- first box : firstname -->
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" placeholder="firstname"
                autofocus>

            <!-- label  -->
            <label for="floatingName">Firstname</label>

        </div>

        <!-- second box : lastname -->
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" placeholder="lastname"
                autofocus>

            <!-- label  -->
            <label for="floatingName">Lastname</label>

        </div>
        
        <!-- third box : Email -->
        <div class="form-group form-floating mb-3">
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="name@example.com"
                required="required" autofocus>

            <!-- label  -->
            <label for="floatingEmail">Email address</label>

            <!-- check for incorrect email format -->
            <!-- check format format RegisterRequest.php -->
            @if ($errors->has('email'))
                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
            @endif

        </div>

        <!-- forth box : Username -->
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username"
                required="required" autofocus>

            <!-- label  -->
            <label for="floatingName">Username</label>

            <!-- check for incorrect username format -->
            @if ($errors->has('username'))
                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
            @endif

        </div>

        <!-- fivth box : Password -->
        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password"
                required="required">

            <label for="floatingPassword">Password</label>


            @if ($errors->has('password'))
            <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <!-- sixth box : Confirm Password -->
        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password_confirmation"
                value="{{ old('password_confirmation') }}" placeholder="Confirm Password" required="required">

            <label for="floatingConfirmPassword">Confirm Password</label>

            @if ($errors->has('password_confirmation'))
                <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
            @endif
        </div>


        <!-- seventh box : phone -->
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="phone"
                autofocus>

            <!-- label  -->
            <label for="floatingName">Phone</label>

        </div>

        <!-- eighth box : address1 -->
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="address_line1" value="{{ old('address_line1') }}" placeholder="address line 1"
                autofocus>

            <!-- label  -->
            <label for="floatingName">Address 1</label>

        </div>

        <!-- ninth box : address2 -->
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="address_line2" value="{{ old('address_line2') }}" placeholder="address line 2"
                autofocus>

            <!-- label  -->
            <label for="floatingName">Address 2</label>

        </div>

        <!-- tenth box : country -->
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="country" value="{{ old('country') }}" placeholder="country"
                autofocus>

            <!-- label  -->
            <label for="floatingName">Country</label>

        </div>

        <!-- eleventh box : state -->
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="state" value="{{ old('state') }}" placeholder="state"
                autofocus>

            <!-- label  -->
            <label for="floatingName">State</label>

        </div>

        <!-- twelfth box : city -->
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="city" value="{{ old('city') }}" placeholder="city"
                autofocus>

            <!-- label  -->
            <label for="floatingName">City</label>

        </div>

        <!-- thirteenth box : postel_code -->
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="postel_code" value="{{ old('postel_code') }}" placeholder="postel code"
                autofocus>

            <!-- label  -->
            <label for="floatingName">Postel code</label>

        </div>


    

        <!-- submit button -->
        <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>

    </div>

    <!-- add date from copy.blade.php file -->
    @include('auth.partials.copy')

</form>
@endsection