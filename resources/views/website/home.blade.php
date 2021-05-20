@extends('layouts.website.app')
@section('content')

    {{-- <div class="categori-menu-wrapper2 clearfix">
        <div class="pl-200 pr-200">
            <div class="menu-style-4 menu-hover">
                <nav>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Shop </a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div> --}}
      <!--Slider section -->
    <div class="slider-area">
        <div class="slider-active owl-carousel">
            @foreach($sliders as $key=>$slider)
            <div class="single-slider-4 slider-height-4 bg-img" style="background-image: url({{ URL::asset('imgfiles/sliderImg/'.$slider->image) }})">
                <div class="container">
                    <div class="slider-content-4 fadeinup-animated">
                        <h2 class="animated">{{$slider->name}}</h2>
                        <h4 class="animated">{{$slider->tagline}} </h4>
                        <a class="electro-slider-btn btn-hover animated" href="{{ url('/shop') }}">buy now</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div> <br>

    <!--Top banner section -->
    <div class="banner-area wrapper-padding gray-bg-7 pt-60">
        <div class="container-fluid">
            <div class="row">
                @foreach($topBanners as $banner)
                <div class="col-lg-4">
                    <div class="banner-wrapper-4 mb-30">
                        <a href="{{ url('/shop') }}"><img src="{{ URL::asset('imgfiles/sliderImg/'.$banner->image) }}" height="280" width="492" alt=""></a>
                        <div class="banner-content4-style1">
                            <h4>{{$banner->name}}</h4>
                            <h4>{{$banner->tagline}}</h4>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Latest Product -->
    <div class="product-style-area gray-bg-4 pb-10">
        <div class="container-fluid">
            <div class="section-title-furits bg-shape text-center mb-40">
                <img src="assets/img/icon-img/49.png" alt="">
                <h2>Latest Products</h2>
            </div>
            <div class="product-fruit-slider owl-carousel">
                @foreach($latestproducts as $product)
                <div class="product-fruit-wrapper">
                    <div class="product-fruit-img">
                        <a href="{{ route('product.view',[$product->id]) }}">
                            <img src="{{ URL::asset('imgfiles/proImg/'.$product->image) }}" height="397" width="345" alt="">
                        </a>
                        <div class="product-furit-action">
                            <a class="furit-animate-left" title="Add To Cart" href="{{route('add.cart',[$product->id])}}">
                                <i class="pe-7s-cart"></i>
                            </a>
                            <a class="furit-animate-right" title="Details" href="{{ route('product.view',[$product->id]) }}">
                                <i class="pe-7s-look"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product-fruit-content text-center">
                        <span>‎৳ {{$product->price}}</span>
                        <h5 ><a class="text-primary" href="{{ route('product.view',[$product->id]) }}" >{{$product->name}}</a></h5>
                        <p><a class="text-info" href="{{ route('product.list',[$product->category->slug]) }}">{{$product->category->name}}</a></p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

      <!--Featured Product section -->
    <div class="product-style-area wrapper-padding-2">
        <div class="section-title-4 text-center  py-5">
            <h2>Featured Products</h2>
        </div>
        <div class="container-fluid">
            <div class="coustom-row-4">
                @foreach($featuredProducts as $product)
                <div class="custom-col-two-5 custom-col-style-4">
                    <div class="product-wrapper mb-65">
                        <div class="product-img-hanicraft">
                            <a href="{{ route('product.view',[$product->id]) }}">
                                <img src="{{ URL::asset('imgfiles/proImg/'.$product->image) }}" height="397" width="345" alt="">
                            </a>
                            <div class="hanicraft-action-position">
                                <div class="hanicraft-action">
                                    <a class="action-cart" title="Add To Cart" href="{{route('add.cart',[$product->id])}}">
                                        <i class="pe-7s-cart"></i>
                                    </a>
                                    <a title="Details" href="{{ route('product.view',[$product->id]) }}" >
                                        <i class="pe-7s-look"></i>
                                    </a>
                                </div> 
                            </div>
                        </div> 
                        <div class="product-content-hanicraft text-center">
                            <h5 class="text-success"> ‎৳ {{$product->price}}</h5>
                            <h4 ><a class="text-primary" href="{{ route('product.view',[$product->id]) }}">{{$product->name}}</a></h4>
                            <span ><a class="text-info" href="{{ route('product.list',[$product->category->slug]) }}">{{$product->category->name}}</a></span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- best selling section -->
    <div class="best-selling-area pb-95 gray-bg-7">
        <div class="section-title-4 text-center mb-60">
            <h2 class="mt-5">Best Selling</h2>
        </div>
        <div class="best-selling-product">
            <div class="row no-gutters">
                <div class="col-lg-5">
                    <div class="best-selling-left">
                        @foreach($bestbannerProducts as $product)
                        <div class="product-wrapper">
                            <div class="product-img-4">
                                <a href="{{ route('product.view',[$product->id]) }}">
                                    <img src="{{ URL::asset('imgfiles/proImg/'.$product->image) }}" height="800" width="800" alt="">
                                </a>
                                <div class="product-action-right">
                                    <a class="animate-top" title="Add To Cart" href="#">
                                        <i class="pe-7s-cart"></i>
                                    </a>
                                    <a class="animate-left" title="Wishlist" href="#">
                                        <i class="pe-7s-like"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="product-content-5 text-center">
                                <h5 class="text-success"> ‎৳ {{$product->price}}</h5>
                                <h4 ><a class="text-primary" href="{{ route('product.view',[$product->id]) }}">{{$product->name}}</a></h4>
                                <span ><a class="text-info" href="{{ route('product.list',[$product->category->slug]) }}">{{$product->category->name}}</a></span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="best-selling-right">
                        <div class="custom-container">
                            <div class="coustom-row-3">
                                @foreach($bestProducts as $product)
                                <div class="custom-col-style-3 custom-col-3">
                                    <div class="product-wrapper mb-6">
                                        <div class="product-img-4">
                                            <a href="{{ route('product.view',[$product->id]) }}">
                                                <img src="{{ URL::asset('imgfiles/proImg/'.$product->image) }}" height="397" width="345" alt="">
                                            </a>
                                            <div class="product-action-right">
                                                <a class="animate-top" title="Add To Cart" href="{{route('add.cart',[$product->id])}}">
                                                    <i class="pe-7s-cart"></i>
                                                </a>
                                                <a class="animate-left" title="Details" href="{{ route('product.view',[$product->id]) }}">
                                                    <i class="pe-7s-look"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-content-6">
                                            <h5 class="text-success"> ‎৳ {{$product->price}}</h5>
                                            <h4 ><a class="text-primary" href="{{ route('product.view',[$product->id]) }}">{{$product->name}}</a></h4>
                                            <span ><a class="text-info" href="{{ route('product.list',[$product->category->slug]) }}">{{$product->category->name}}</a></span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--Footer banner section -->
    <div class="androit-banner-wrapper wrapper-padding pt-100 pb-175">
        <div class="container-fluid">
            @foreach( $footerBanners as $banner)
            <div class="androit-banner-img bg-img" style="background-image: url({{ URL::asset('imgfiles/sliderImg/'.$banner->image) }})" height="320" width="1170">
                <div class="androit-banner-content">
                    <h3>{{$banner->name}}</h3>
                    <a href="{{ url('/shop') }}">Buy Now →</a>
                </div>
                <div class="banner-price text-center">
                    <div class="banner-price-position">
                        <span class="banner-price-new">Buy Now</span>
                        {{-- <span class="banner-price-old">$199.00</span> --}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!--footer product section -->
    <div class="product-area-2 wrapper-padding pt-100 pb-70 gray-bg-7">
        <div class="container-fluid">
            <div class="row">
                @foreach($randomProducts as $product)
                <div class="col-lg-6 col-xl-4">
                    <div class="product-wrapper product-wrapper-border mb-30">
                        <div class="product-img-5">
                            <a href="{{ route('product.view',[$product->id]) }}">
                                <img src="{{ URL::asset('imgfiles/proImg/'.$product->image) }}" height="190" width="189" alt="">
                            </a>
                        </div>
                        <div class="product-content-7">
                            <h4><a class="text-primary" href="{{ route('product.view',[$product->id]) }}">{{$product->name}}</a></h4>
                            <h4><a class="text-info" href="{{ route('product.list',[$product->category->slug]) }}">{{$product->category->name}}</a></h4>
                            <h5 class="text-success">‎৳ {{$product->price}}</h5>
                            <div class="product-action-electro">
                                <a class="animate-top" title="Add To Cart" href="{{route('add.cart',[$product->id])}}">
                                    <i class="pe-7s-cart"></i>
                                </a>
                                <a class="animate-left" title="Details" href="{{ route('product.view',[$product->id]) }}">
                                    <i class="pe-7s-look"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach 
            </div>
        </div>
    </div>
    <!--brand logo section -->

    <div class="brand-logo-area-2 wrapper-padding ptb-80 gray-bg-7">
        <div class="container-fluid">
            <div class="brand-logo-active2 owl-carousel">
                @foreach($brandLogos as $logo)
                <div class="single-brand">
                    <img src="{{ URL::asset('imgfiles/sliderImg/'.$logo->image) }}" alt="">
                </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection