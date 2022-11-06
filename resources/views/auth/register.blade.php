@extends('layouts.auth-master')
@section('content')

<!--                submit the input request to this action -->
<form method="post" action="{{ route('register.perform') }}">

    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    
    <!-- Logo -->
    <img class="mb-4" src="{!! url('https://getbootstrap.com/docs/5.2/assets/brand/bootstrap-logo-shadow.png') !!}"
        alt="" width="72" height="57">
    
    <!-- Heading -->
    <h1 class="h3 mb-3 fw-normal">Register</h1>

    <!-- first box : firstname -->
    <div class="form-group form-floating mb-3">
        <input type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" placeholder="firstname"
             autofocus>

        <!-- label  -->
        <label for="floatingName">Firstname</label>

    </div>

    <!-- Second box : lastname -->
    <div class="form-group form-floating mb-3">
        <input type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" placeholder="lastname"
             autofocus>

        <!-- label  -->
        <label for="floatingName">Lastname</label>

    </div>
    
    <!-- Third box : Email -->
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

    <!-- Forth box : Username -->
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

    <!-- Fivth box : Password -->
    <div class="form-group form-floating mb-3">
        <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password"
            required="required">

        <label for="floatingPassword">Password</label>


        @if ($errors->has('password'))
        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
        @endif
    </div>

    <!-- Sixth box : Confirm Password -->
    <div class="form-group form-floating mb-3">
        <input type="password" class="form-control" name="password_confirmation"
            value="{{ old('password_confirmation') }}" placeholder="Confirm Password" required="required">

        <label for="floatingConfirmPassword">Confirm Password</label>

        @if ($errors->has('password_confirmation'))
            <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
        @endif
    </div>

    <!-- submit button -->
    <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>

    <!-- add date from copy.blade.php file -->
    @include('auth.partials.copy')

</form>
@endsection