@extends('layouts.auth-master')
@section('content')

<form method="post" action="{{ route('login.perform') }}">

    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <!-- Logo -->
    <a href="http://127.0.0.1:8000/">
    <img class="mb-4" src="{!! url('https://cdn.pixabay.com/photo/2013/07/12/17/20/leaf-152047_960_720.png') !!}"
        alt="" width="72" height="57">
    </a>
    <h1 class="h3 mb-3 fw-normal">Login</h1>


    @include('layouts.partials.messages')
    
    <div class = 't1'>
        <!-- First box : username -->
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username"
                required="required" autofocus>

            <label for="floatingName">Username</label>

            @if ($errors->has('username'))
                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
            @endif
        </div>

        <!-- Second box : password -->
        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password"
                required="required">

            <label for="floatingPassword">Password</label>

            @if ($errors->has('password'))
            <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>

    </div>
    
    @include('auth.partials.copy')
</form>
@endsection