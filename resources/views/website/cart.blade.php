@extends('layouts.website.app')
@section('content')
<!-- shopping-cart-area start -->
<div class="cart-main-area pt-95 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                @if($cart)
                <h1 class="cart-heading">Shopping Cart</h1>
                <div class="table-content table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>images</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>remove</th>
                            </tr>
                        </thead>
                        <tbody>
                           <!-- Cart items-->
                            @foreach($cart->items as $key=>$product)
                            <tr>
                                <td class="product-thumbnail">
                                    <a href="#"><img src="{{ URL::asset('imgfiles/proImg/'.$product['image']) }}" alt="" height="100px"></a>
                                </td>
                                <td class="product-name"><a href="#">{{$product['name']}} </a></td>
                                <td class="product-price-cart"><span class="amount">৳ {{$product['price']}}</span></td>
                                <td class="product-quantity">
                                  <form id="cartUpdateForm{{$loop->index}}" action="{{route('cart.update',$product['id'])}}" method="POST">@csrf
                                    
                                  <input id="qty{{$loop->index}}" name="qty" value="{{$product['qty']}}" type="number">
                                   
                                  </form>
                                </td>
                                <td class="product-subtotal">৳ {{$product['price']*$product['qty']}}
                                </td>
                                <td class="product-remove">
                                  <form action="{{route('cart.remove',$product['id'])}}" method="POST">@csrf
                                  <button class="btn btn-link" title="Remove Item"><i class="pe-7s-close"></i></button>
                                  </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="row">
                    <div class="col-md-5 ml-auto">
                        <div class="cart-page-total">
                            <h2>Cart totals</h2>
                            <ul>
                                <li>Subtotal<span>৳ {{$cart->totalPrice}}</span></li>
                                <li>Discount<span>৳ 0</span></li>
                                <li>Total Payment<span>৳ {{$cart->totalPrice}}</span></li>
                            </ul>
                            <a href="{{ route('cart.checkout',$cart->totalPrice)}}">Proceed to checkout</a>
                        </div>
                    </div>
                </div>
                @else
                  <h2 class="text-center text-primary">No Item In The Cart</h2>
                  <h2 class="text-center text-info">You Can Add product From The Shop</h2>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- shopping-cart-area end -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    @if($cart)
        @foreach($cart->items as $key=>$product)
            <script type="text/javascript">
                $(function(){
                        jQuery('#qty{{$loop->index}}').on('click',function(){
                        $('#cartUpdateForm{{$loop->index}}').submit();
                    });
                });

            </script>
        @endforeach
    @endif
@endsection