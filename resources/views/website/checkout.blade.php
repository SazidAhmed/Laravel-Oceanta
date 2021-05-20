@extends('layouts.website.app')
@section('content')
<!-- checkout-area start -->
<div class="checkout-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="coupon-accordion">
                    
                    {{-- <h3>Registered customer? <span id="showlogin">Click here to login</span></h3>
                    <div id="checkout-login" class="coupon-content">
                        <div class="coupon-info">
                            <form method="POST" action="{{ route('login') }}">@csrf
                                <p class="form-row-first">
                                    <label>Email <span class="required">*</span></label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </p>
                                <p class="form-row-last">
                                    <label>Password  <span class="required">*</span></label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </p>
                                <p class="form-row">					
                                    <input type="submit" value="Login" />
                                    <label>
                                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                                          Remember me 
                                    </label>
                                </p>
                                <p class="lost-password">
                                    @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    @endif
                                </p>
                            </form>
                        </div>
                    </div> --}}
                    					
                </div>
            </div>
        </div>
        @if(Auth::check())
        <div class="row">
            <div class="col-lg-6 col-md-12 col-12">
            <form  name="contact-form" action="{{route('cart.placeOrder')}}" method="POST">@csrf
                <div class="checkbox-form">						
                    <h3>customer Details</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="checkout-form-list">
                                <label>Full Name</label>
                                <input type="text" name="name" value="{{auth()->user()->name}}" required />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkout-form-list">
                                <label>Phone</label>
                                <input type="text" name="phone" value="{{auth()->user()->phone}}" required />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkout-form-list">
                                <label>Delivery Address</label>
                                <input type="text" name="address" value="{{auth()->user()->address}}" required />
                            </div>
                        </div>
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}" required />
                    </div>
                    <div class="different-address">
                        <div class="ship-different-title">
                            <h3>
                                <label>Any Special Note For Delivery?</label>
                                <input id="ship-box" type="checkbox" />
                            </h3>
                        </div>
                        <div id="ship-box-info" class="row">
                            <div class="col-md-12">
                            <div class="checkout-form-list mrg-nn">
                                <label>Order Notes</label>
                                <textarea name="note" id="checkout-mess" cols="30" rows="5" placeholder="Notes about your order, e.g. special notes for delivery." ></textarea>
                            </div>	
                            </div>							
                        </div>
                    </div>													
                </div>
            </div>	
            <div class="col-lg-6 col-md-12 col-12">
                <div class="your-order">
                    <h3>Your order</h3>
                    <div class="your-order-table table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-name">Product</th>
                                    <th class="product-total">Total</th>
                                </tr>							
                            </thead>
                            <tbody>
                              @foreach($cart->items as $product)
                                <tr class="cart_item">
                                    <td class="product-name">
                                    {{$product['name']}} <strong class="product-quantity"> × {{$product['qty']}}</strong>
                                    </td>
                                    <td class="product-total">
                                        <span class="amount">৳ {{$product['price']*$product['qty']}}</span>
                                    </td>
                                </tr>
                              @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="cart-subtotal">
                                    <th>Cart Subtotal</th>
                                    <td><span class="amount">৳ {{$cart->totalPrice}}</span></td>
                                </tr>
                                <tr class="order-total">
                                    <th>Total Payment</th>
                                    <td><strong><span class="amount">৳ {{$cart->totalPrice}}</span></strong>
                                    </td>
                                </tr>								
                            </tfoot>
                        </table>
                    </div>
                    <div class="payment-method">
                        <div class="payment-accordion">
                            <div class="panel-group" id="faq">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><a data-toggle="collapse" aria-expanded="true" data-parent="#faq" href="#payment">Cash On Dalivery</a></h5>
                                    </div>
                                    <div id="payment" class="panel-collapse collapse show">
                                        <div class="panel-body">
                                            <p>Payment method for this order is "Cash On Delivery".</p>
                                            <p>Please Check Your Name, Phone Number, Delivery Address and then place order .You Can Also Update Your Information Before Placing The Order.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="order-button-payment">
                                <input type="submit" value="Place order" />
                            </div>								
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-lg-6 col-md-12 col-12">
            <form  name="contact-form" action="{{route('cart.guestOrder')}}" method="POST">@csrf
                <div class="checkbox-form">						
                    <h3>customer Details</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="checkout-form-list">
                                <label>Full Name</label>
                                <input type="text" name="name" placeholder="Enter Your Name" required/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkout-form-list">
                                <label>Phone</label>
                                <input type="number" name="phone" placeholder="Enter Your Phone Number" required/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkout-form-list">
                                <label>Delivery Address</label>
                                <input type="text" name="address"  placeholder="Enter Your Address" required/>
                            </div>
                        </div>
                    </div>
                    <div class="different-address">
                        <div class="ship-different-title">
                            <h3>
                                <label>Any Special Note For Delivery?</label>
                                <input id="ship-box" type="checkbox" />
                            </h3>
                        </div>
                        <div id="ship-box-info" class="row">
                            <div class="col-md-12">
                            <div class="checkout-form-list mrg-nn">
                                <label>Order Notes</label>
                                <textarea name="note" id="checkout-mess" cols="30" rows="5" placeholder="Notes about your order, e.g. special notes for delivery." ></textarea>
                            </div>	
                            </div>							
                        </div>
                    </div>													
                </div>
            </div>	
            <div class="col-lg-6 col-md-12 col-12">
                <div class="your-order">
                    <h3>Your order</h3>
                    <div class="your-order-table table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-name">Product</th>
                                    <th class="product-total">Total</th>
                                </tr>							
                            </thead>
                            <tbody>
                              @foreach($cart->items as $product)
                                <tr class="cart_item">
                                    <td class="product-name">
                                    {{$product['name']}} <strong class="product-quantity"> × {{$product['qty']}}</strong>
                                    </td>
                                    <td class="product-total">
                                        <span class="amount">৳ {{$product['price']*$product['qty']}}</span>
                                    </td>
                                </tr>
                              @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="cart-subtotal">
                                    <th>Cart Subtotal</th>
                                    <td><span class="amount">৳ {{$cart->totalPrice}}</span></td>
                                </tr>
                                <tr class="order-total">
                                    <th>Total Payment</th>
                                    <td><strong><span class="amount">৳ {{$cart->totalPrice}}</span></strong>
                                    </td>
                                </tr>								
                            </tfoot>
                        </table>
                    </div>
                    <div class="payment-method">
                        <div class="payment-accordion">
                            <div class="panel-group" id="faq">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><a data-toggle="collapse" aria-expanded="true" data-parent="#faq" href="#payment">Cash On Dalivery</a></h5>
                                    </div>
                                    <div id="payment" class="panel-collapse collapse show">
                                        <div class="panel-body">
                                            <p>Payment method for this order is "Cash On Delivery".</p>
                                            <p>Please Check Your Name, Phone Number, Delivery Address and then place order .</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="order-button-payment">
                                <input type="submit" value="Place order" />
                            </div>								
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        @endif	
    </div>
</div>
<!-- checkout-area end -->	
@endsection