@extends('layouts.website.app')
@section('content')
<div class="product-details ptb-100 pb-90">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-7 col-12">
                <div class="product-details-img-content">
                    <div class="product-details-tab mr-35 product-details-tab2">
                        <div class="product-details-large tab-content">
                            @foreach($productImages as $key=>$img)
                            <div class="tab-pane {{$key == 0 ? 'active' : '' }} show fade" id="pro-details{{$key}}" role="tabpanel">
                                <div class="easyzoom easyzoom--overlay ">
                                    <a href="{{ URL::asset('imgfiles/proImgs/'.$img->image) }}">
                                        <img src="{{ URL::asset('imgfiles/proImgs/'.$img->image) }}" height="654" width="500">
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="product-details-small nav ml-10 product-details-2" role=tablist>
                            @foreach($productImages as $key=>$img)
                            <a class="{{$key == 0 ? 'active' : '' }} mb-10" href="#pro-details{{$key}}" data-toggle="tab" role="tab" aria-selected="true">
                                <img src="{{ URL::asset('imgfiles/proImgs/'.$img->image) }}" height="156" width="125">
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-5 col-12">
                <div class="product-details-content">
                    <h3>{{$product->name}}</h3>
                    <div class="rating-number">
                        <div class="quick-view-rating">
                            <i class="pe-7s-star red-star"></i>
                            <i class="pe-7s-star red-star"></i>
                            <i class="pe-7s-star"></i>
                            <i class="pe-7s-star"></i>
                            <i class="pe-7s-star"></i>
                        </div>
                        <div class="quick-view-number">
                            <span></span>
                        </div>
                    </div>
                    <div class="details-price">
                        <span>৳  {{$product->price}}</span>
                    </div>
                   
                    <div class="product-details-cati-tag mt-35">
                        <ul>
                            <li class="categories-title">Stock :</li>
                            <li>
                                @if($product->stock <= 0)
                                    <span class="badge badge-pill badge-danger">Out-Of-Stock</span>
                                @else
                                    <span class="badge badge-pill badge-success">In-Stock</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                    <div class="product-details-cati-tag mtb-10">
                        <ul>
                            <li class="categories-title">Category :</li>
                            <li><a href="{{ route('product.list',[$product->category->slug]) }}">{{$product->category->name}}</a></li>
                        </ul>
                    </div>
                    <div class="product-details-cati-tag mtb-10">
                        <ul>
                            <li class="categories-title">Tags :</li>
                            <li><a href="{{ route('product.list',[$product->category->slug]) }}">{{$product->subcategory->name}}</a></li>
                        </ul>
                    </div>
                    <div class="product-share">
                        <ul>
                            <li class="categories-title">Share :</li>
                            <li>
                                <a href="https://www.facebook.com/OceantaFashion" target="_blank">
                                    <i class="icofont icofont-social-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/oceanta_fashion" target="_blank">
                                    <i class="icofont icofont-social-twitter" ></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/oceanta_fashion" target="_blank">
                                    <i class="icofont icofont-social-instagram" target="_blank"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.youtube.com" target="_blank">
                                    <i class="icofont icofont-social-youtube" target="_blank"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <p><div class="20"></div></p>
                    <div class="quickview-plus-minus">
                        <div >
                            <a class="btn btn-info" href="{{route('add.cart',[$product->id])}}"><i class="ti-shopping-cart"></i> Add To Cart</a>
                        </div>
                    </div>
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
                <a href="#pro-addinfo" data-toggle="tab" role="tab" aria-selected="false">
                   Additional Info
                </a>
                <a href="#pro-review" data-toggle="tab" role="tab" aria-selected="false">
                    Review
                 </a>
            </div>
            <div class="description-review-text tab-content">
                <div class="tab-pane active show fade" id="pro-dec" role="tabpanel">
                    <p>{!!$product->description!!}</p>
                </div>
                <div class="tab-pane fade" id="pro-addinfo" role="tabpanel">
                    <p>{!!$product->additional_info!!}</p>
                </div>
                <div class="tab-pane fade" id="pro-review" role="tabpanel">
                    <div class="container">
                        <form  name="contact-form" action="{{route('review.store')}}" method="POST">@csrf
                        <div class="row">
                            <div class="col-md-2 offset-md-3">
                                <textarea type="text" name="name" id="name"  placeholder="Enter Your Name Here. . ."></textarea>
                            </div>
                            <div class="col-md-4">
                                <textarea name="comment"  id="comment" aria-describedby="commentHelp" placeholder="Enter Your Review Here . . ."></textarea>
                                <small id="commentHelp" class="form-text text-muted">Your review will help us to provide better service and products.</small>
                            </div>
                            <div class="col-md-6 offset-md-3">
                                <input type="hidden" value="{{$product->id}}" name="product_id">
                                <button type="submit" class="btn btn-outline-success btn-block">Submit</button>
                            </div>
                        </div>
                        </form>
                        <br>
                        <ul>
                          @foreach($reviews as $review)
                          <li>
                            <p class="text-right">Review By : {{$review->name}}</p>
                           <p class="badge-light">{{$review->comment}}</p>
                           <p class="text-right">Posted On : {{date('d-M-y', strtotime($review->created_at))}}</p>
                          </li><br>
                          @endforeach
                        </ul>
                    </div>
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
                          <img src="{{ URL::asset('imgfiles/proImg/'.$product->image) }}" alt="">
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