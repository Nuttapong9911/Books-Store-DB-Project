


<header class="shadow p-3  text-white" style="background-color:rgba(0, 0, 0, 0.8);">


    <style>
        .shadow {
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
<div >
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
                <!-- <li><a href="#" class="nav-link px-2 text-white font-weight-bold">Features</a></li>
                <li><a href="#" class="nav-link px-2 text-white font-weight-bold">Pricing</a></li>
                <li><a href="#" class="nav-link px-2 text-white font-weight-bold">FAQs</a></li> -->
                <li><a href="{{route('home.about') }}" class="nav-link px-2 text-white font-weight-bold">About</a></li>
            </ul>

            <!-- Search box -->
            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" type="get" action="{{ url('/search') }}">
                <div class=""><input type="search" class="form-control form-control-dark" name="query" placeholder="Search..." aria-label="Search">
                </div> 
            

            </form>
            <button class = "btn btn-outline-light  mx-1 " type="submit" >Search</button>
            
            <!-- after login, this will show logout button -->
            @auth
            {{auth()->user()->name}}
            <div type="button" class = "text end mx-3">
                <a href="{{url('cart')}}" class = "btn btn-outline-light me-1" >Cart</a>
            </div>
            <div type="button" class = "text end mr-3">
                <a href="{{url('history')}}" class = "btn btn-outline-light me-1" >History</a>
            </div>
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

</div>