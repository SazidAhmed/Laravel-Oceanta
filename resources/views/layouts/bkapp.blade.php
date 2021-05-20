<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
<script>
    $( window ).on( "load", function(){
     var myArray = []
   
     $.ajax({
       method: 'GET',
       url: 'http://shopcorner.saz/navcart',
       success: (response) => {
           myArray = response.items
           console.log(response);
           console.log(myArray);
           buildCart(myArray);  
       }
     });
   
     function buildCart(items) {
       // var ul = document.getElementById('cartItem')
       let output = '';
       $.each(items, function (index, item) {
           //use back tik
           output +='<li class="single-product-cart">'+
                       '<div class="cart-title">'+
                           '<h5><a href="#">'+item.name+'</a></h5>'+
                           '<h6><a href="#">Black</a></h6>'+
                           '<span>'+'‎৳ '+item.price+' x '+item.qty+'</span>'+
                       '</div>'+
                   '</li>';
       });
        //ul id here
        $('#cartItem').append(output);
        console.log(output);
        console.log(items[3]);
     }
   });
   output +=`
            <li class="single-product-cart">
                <div class="cart-img">
                    <a href="#"><img src="assets/img/cart/1.jpg" alt=""></a>
                </div>
                <div class="cart-title">
                    <h5><a href="{{route('cart.show')}}">${item.name}</a></h5>
                    <h6><a href="{{route('cart.show')}}">৳ ${item.price} x ${item.qty}</a></h6>
                    <span></span>
                </div>
                <div class="cart-delete">
                    <form action="{{route('cart.remove',$product['id'])}}" method="POST">@csrf
                    <button class="btn btn-link" title="Remove Item"><i class="pe-7s-close"></i></button>
                    </form>
                </div>
            </li>
        `;
        <a class="cart-btn btn-hover" href="{{ route('cart.checkout',$cart->totalPrice)}}">checkout</a>
   </script>
   