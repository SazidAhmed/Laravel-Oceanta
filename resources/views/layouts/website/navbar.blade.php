<header>
    <div class="header-top-wrapper-2 border-bottom-2">
        <div class="header-info-wrapper pl-200 pr-200">
            <div class="header-contact-info header-contact-info2 ">
                <ul>
                    <li><i class="pe-7s-call"></i><a href="tel:01680800810">+880 1680800810</a> </li>
                    <li><i class="pe-7s-mail"></i> <a href="mailto:infaintmart@gmail.com">oceanta.fashion@gmail.com</a></li>
                </ul>
            </div>
            <div class="electronics-login-register">
                <ul> 
                    <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i>Home</a></li>
                    <li><a href="{{ url('/shop') }}"><i class="pe-7s-shopbag"></i>Shop</a></li>
                    <!-- order -->
                    @if(Auth::check())
                    <li><a href="{{ route('customePanel') }}"><i class="pe-7s-users"></i>My Orders</a></li>
                    @endif
                     <!-- Authentication Links -->
                    @guest
                        <li><a href="{{ route('login') }}"><i class="pe-7s-user"></i>Login</a></li>
                        @if (Route::has('register'))
                        <li><a href="{{ route('register') }}"><i class="pe-7s-ribbon"></i>Register</a></li>
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
    </div>
    <div class="header-bottom ptb-40 clearfix">
        <div class="header-bottom-wrapper pr-200 pl-200">
            <div class="logo-3">
                <a href="index.html">
                    <img src="assets/img/logo/logo-3.png" alt="">
                </a>
            </div>
            <div class="categories-search-wrapper categories-search-wrapper2">
                {{-- <div class="all-categories">
                    <div class="select-wrapper">
                        <select class="select text-info">
                            <option value="">All Categories</option>
                            <option value="">Smartphones </option>
                            <option value="">Computers</option>
                            <option value="">Laptops </option>
                            <option value="">Camerea </option>
                            <option value="">Watches</option>
                            <option value="">Lights </option>
                            <option value="">Air conditioner</option>
                        </select>
                    </div>
                </div> --}}
                <div class="categories-wrapper">
                    <form action="{{route('shop')}}" method="GET">
                        <input name="search" placeholder="Enter Your keyword" type="text">
                        <button type="submit"> Search </button>
                    </form>
                </div>
            </div>
            <div class="header-cart-3">
                <a href="{{route('cart.show')}}">
                    <i class="ti-shopping-cart"></i>My Cart
                    <span>
                        {{session()->has('cart')?session()->get('cart')->totalQty:'0'}}
                    </span>
                </a>
              
                <ul class="cart-dropdown">
                    <div class="col" id="cartItem"></div><hr>
                    <span id="noCart"></span>
                    <span class="cart-space" id="totalPrice"></span>
                    <span class="col" id="showCart"></span>
                </ul>
            </div>
            <div class="mobile-menu-area mobile-menu-none-block electro-2-menu">
                <div class="mobile-menu">
                    <nav id="mobile-menu-active">
                        <ul class="menu-overflow">
                            <li><a href="{{ url('/') }}">HOME</a></li>
                            <li><a href="{{ url('/shop') }}">shop</a></li>
                            <li><a href="{{ url('/') }}">Contact</a></li>
                            <li><a href="{{ url('/') }}">About</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
    <!-- header end -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
    $( window ).on( "load", function(){
    var myArray = []

    $.ajax({
        method: 'GET',
        url: '/navcart',
        success: (response) => {
            myArray = response.items;
            totalPrice = response.totalPrice;
            // console.log(response);
            // console.log(myArray);
            buildCart(myArray, totalPrice);
        }
    });

    function buildCart(items, price) {
        let output = '';
        let subTotal = '';
        let showCart  = '';
        let noCart ='';
       
        $.each(items, function (index, item) {

            output +=`
                <li class="single-product-cart">
                    <div class="cart-img">
                        <a href="#"><img src="/imgfiles/proImg/${item.image}" height="100px" width="90px" ></a>
                    </div>
                    <div class="cart-title">
                        <h5><a href="{{route('cart.show')}}">${item.name}</a></h5>
                        
                        <span>৳ ${item.price} x ${item.qty}</span>
                    </div>
                    <div class="cart-delete">
                        <form action="/product/${item.id}" method="POST">@csrf
                        <button class="btn btn-link text-danger" title="Remove Item"><i class="ti-trash"></i></button>
                        </form>
                    </div>
                </li>
            `;
        });

        if (price > 0){
        subTotal +=`
                <div class="cart-sub">
                    <h4><strong>TOTAL AMOUNT : </strong></h4>
                </div>
                <div class="cart-price">
                    <h4>৳ ${price}</h4>
                </div>
            `;
        }
        else{
            noCart +=`
                    <h3 class="text-center text-info">No Item In The Cart</h3>
            `;
        }
        if (price > 0){
        showCart +=`
            <li class="cart-btn-wrapper" >
                <a class="cart-btn btn-hover" href="{{route('cart.show')}}">view cart</a>
                <a class="cart-btn btn-hover" href="/checkout/${price}">checkout</a>
            </li>
        `;
        }
            
        console.log(price);
        //div id here
        $('#cartItem').append(output);
        $('#totalPrice').append(subTotal);
        $('#noCart').append(noCart);
        $('#showCart').append(showCart);
    }
    });
</script>
