@extends('layouts.website.app')
@section('content')
	
<div class="product-details ptb-100 pb-90">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-7 col-12">
                <div class="product-details-img-content">
                    <div class="product-details-tab mr-70">
                        <div class="product-details-large tab-content">
                            <div class="tab-pane active show fade" role="tabpanel">
                                <div class="easyzoom easyzoom--overlay">
                                    <a >
                                        <img src="{{ URL::asset('storage/product/'.$product->image) }}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-5 col-12">
                <div class="product-details-content">
                    <h3>{{$product->name}}</h3>
                    @if($product->stock == 0)
                        <h3>Stock : Out Of Stock</h3>
                    @else
                        <h3>In-Stock : {{$product->stock}}</h3>
                    @endif
                    <div class="details-price">
                        <span>Price : ৳  {{$product->price}}</span>
                    </div>
                    <p>{!!$product->description!!}</p>
                    <div class="product-details-cati-tag mt-35">
                        <ul>
                            <li class="categories-title">Category :</li>
                            <li><a href="{{ route('product.list',[$product->category->slug]) }}">{{$product->category->name}}</a></li>
                        </ul>
                    </div>
                    <div class="product-details-cati-tag mt-35 mb-35">
                        <ul>
                            <li class="categories-title">Brand :</li>
                            <li><a href="#">{{$product->subcategory->name}}</a></li>
                        </ul>
                    </div>
                    <div class="quickview-plus-minus">
                        <div class="quickview-btn-cart">
                            <a class="btn-hover-black" href="{{route('add.cart',[$product->id])}}">add to cart</a>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- product description -->
<div class="product-description-review-area pb-90">
    <div class="container">
        <div class="product-description-review text-center">
            <div class="description-review-title nav" role=tablist>
                <a class="active" href="#pro-dec" data-toggle="tab" role="tab" aria-selected="true">
                    Description
                </a>
                <a href="#pro-review" data-toggle="tab" role="tab" aria-selected="false">
                   Additional Info
                </a>
            </div>
            <div class="description-review-text tab-content">
                <div class="tab-pane active show fade" id="pro-dec" role="tabpanel">
                    <p>{!!$product->description!!}</p>
                </div>
                <div class="tab-pane fade" id="pro-review" role="tabpanel">
                    <p>{!!$product->additional_info!!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Related product  -->
<div class="product-area pb-95">
    <div class="container">
        <div class="section-title-3 text-center mb-50">
            <h2>Related products </h2>
        </div>
        <div class="product-style">
            <div class="related-product-active owl-carousel">
              @foreach($productFromSameCategories as $product)
              <div class="product-wrapper">
                  <div class="product-img">
                      <a href="{{ route('product.view',[$product->id]) }}">
                          <img src="{{ URL::asset('storage/product/'.$product->image) }}" alt="">
                      </a>
                      <div class="product-action">
                          <a class="animate-top" title="Add To Cart" href="{{route('add.cart',[$product->id])}}">
                              <i class="pe-7s-cart"></i>
                          </a>
                          <a title="View Details" href="{{ route('product.view',[$product->id]) }}">
                              <i class="pe-7s-look"></i>
                          </a>
                      </div>
                  </div>
                  <div class="product-content">
                      <h4><a href="{{ route('product.view',[$product->id]) }}">{{$product->name}}</a></h4>
                      <span>৳ {{$product->price}}</span>
                  </div>
              </div>
              @endforeach
            </div>
        </div>
    </div>
</div>
@endsection