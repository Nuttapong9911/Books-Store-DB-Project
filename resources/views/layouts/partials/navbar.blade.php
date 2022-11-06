<header class="nav p-3 bg-dark text-white">


    <style>
        .nav {
  box-shadow: 0 10px 20px 0 rgba(0,0,0,.2);
}
        .right{
            position: absolute;
  right: 0px;
  width: 300px;
  border: 3px solid #73AD21;
     padding: 10px;
        }
    </style>

    <div class="container">
        <div class="d-flex justify-content-center ">

            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                    <use xlink:href="#bootstrap" />
                </svg>
            </a>

            <!-- Links to each pages -->
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="{{ route('home.index') }}" class="nav-link px-2 text-white font-weight-bold">Home</a></li>
                <li><a href="#" class="nav-link px-2 text-white font-weight-bold">Features</a></li>
                <li><a href="#" class="nav-link px-2 text-white font-weight-bold">Pricing</a></li>
                <li><a href="#" class="nav-link px-2 text-white font-weight-bold">FAQs</a></li>
                <li><a href="{{route('home.about') }}" class="nav-link px-2 text-white font-weight-bold">About</a></li>
            </ul>

            <!-- Search box -->
            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" type="get" action="{{ url('/search') }}">
                <div class=""><input type="search" class="form-control form-control-dark" name="title" placeholder="Search..." aria-label="Search">
                </div>
            </form>
            <button class = "btn btn-outline-light my-2 my-sm-0 mx-3 " type="submit" >Search</button>
            
            <!-- after login, this will show logout button -->
            @auth
            {{auth()->user()->name}}
            <button type="button" class = "btn btn-info">
                <a href="{{url('cart')}}" class = "btn btn-shopping-cart" >Cart</a>
            </button>
            <div class="text-end">
                <a href="{{ route('logout.perform') }}" class="btn btn-outline-light me-1">Logout</a>
            </div>
            @endauth

            <!-- before login, this will show login button and sign-up button -->
            @guest
            <div class="text-end">
                <a href="{{ route('login.show') }}" class="btn btn-outline-light me-2">Login</a>
                <a href="{{ route('register.show') }}" class="btn btn-warning">Sign-up</a>
            </div>
            @endguest

        </div>
    </div>
</header>