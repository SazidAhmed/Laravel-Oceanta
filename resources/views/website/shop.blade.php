@extends('layouts.website.app')
@section('content')

<div class="shop-page-wrapper shop-page-padding ptb-15">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3">
          <div class="shop-sidebar mr-50">
              <div class="sidebar-widget mb-50">
                  <h3 class="sidebar-title">Search Products</h3>
                  <div class="sidebar-search">
                      <form action="{{route('shop')}}" method="GET">
                          <input placeholder="Search Products..." type="text" name="search">
                          <button><i class="ti-search"></i></button>
                      </form>
                  </div>
              </div>
              <div class="sidebar-widget mb-40">
                <h3 class="sidebar-title">Filter by Price</h3>
                  <div class="sidebar-categories">
                    <form id="filterbypriceform" action="{{ route('shop') }}" method="GET">
                      <ul class="different-address">
                        <li class="ship-different-title">
                          <input id="box1" type="checkbox" class="filterbyprice" name="price_range" value="1-500" >
                          <span>৳ 1 to 500</span>
                        </li>
                        <li class="ship-different-title">
                          <input type="checkbox" class="filterbyprice" name="price_range" value="500-1000">
                          <span>৳ 500 to 1000</span>
                        </li>
                        <li class="ship-different-title">
                          <input type="checkbox" class="filterbyprice" name="price_range" value="1000-5000">
                          <span>৳ 1000 to 5000</span>
                        </li>
                        <li class="ship-different-title">
                          <input type="checkbox" class="filterbyprice" name="price_range" value="5000-10000">
                          <span>৳ 5000 to 10,000</span>
                        </li>
                        <li class="ship-different-title">
                          <input type="checkbox" class="filterbyprice" name="price_range" value="10000-100000">
                          <span>৳ 10,000 Plus</span>
                        </li>
                      </ul>
                    </form>
                  </div>
              </div>
              <div class="sidebar-widget mb-45">
                  <h3 class="sidebar-title">Filter by Category</h3>
                  <div class="sidebar-categories">
                      <ul>
                        @foreach(App\Category::all() as $cat)
                          <li><a href="{{ route('product.list',[$cat->slug]) }}">{{$cat->name}}<span></span></a></li>
                        @endforeach
                      </ul>
                  </div>
              </div>
              <div class="sidebar-widget mb-50">
                  <h3 class="sidebar-title">Top rated products</h3>
                  <div class="sidebar-top-rated-all">
                    @foreach($bestProducts as $product)
                      <div class="sidebar-top-rated mb-30">
                          <div class="single-top-rated">
                              <div class="top-rated-img">
                                  <a href="{{ route('product.view',[$product->id]) }}"><img src="{{ URL::asset('imgfiles/proImg/'.$product->image) }}" height="100" width="80" alt=""></a>
                              </div>
                              <div class="top-rated-text">
                                  <h4><a href="{{ route('product.view',[$product->id]) }}">{{$product->name}}</a></h4>
                                  <div class="top-rated-rating">
                                      <ul>
                                          <li><i class="pe-7s-star"></i></li>
                                          <li><i class="pe-7s-star"></i></li>
                                          <li><i class="pe-7s-star"></i></li>
                                          <li><i class="pe-7s-star"></i></li>
                                          <li><i class="pe-7s-star"></i></li>
                                      </ul>
                                  </div>
                                  <span> ‎৳ {{$product->price}}</span>
                              </div>
                          </div>
                      </div>
                    @endforeach
                  </div>
              </div>
          </div>
      </div>
      <div class="col-lg-9">
          <div class="shop-product-wrapper res-xl res-xl-btn">
            <div class="shop-bar-area">
                
              <div class="shop-product-content tab-content">
                  <div id="grid-sidebar1" class="tab-pane fade active show">
                    <div class="row">
                      @foreach($products as $product)
                        <div class="col-lg-6 col-md-6 col-xl-3">
                            <div class="product-wrapper mb-30">
                                <div class="product-img">
                                    <a href="{{ route('product.view',[$product->id]) }}">
                                        <img src="{{ URL::asset('imgfiles/proImg/'.$product->image) }}" height="400" width="312" alt="">
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
                                <div class="product-content-hanicraft my-4">
                                    <h5> ‎৳ {{$product->price}}</h5>
                                    <h4><a href="{{ route('product.view',[$product->id]) }}">{{$product->name}}</a></h4>
                                    <span><a href="{{ route('product.list',[$product->category->slug]) }}">{{$product->category->name}}</a></span>
                                </div>
                            </div>
                        </div>
                      @endforeach
                    </div>
                  </div>
              </div>
            </div>
          </div>
          {{$products->links('vendor.pagination.ezone')}}
      </div>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<script type="text/javascript">

    $(function(){
      $('.filterbyprice').on('change',function(){
          $('#filterbypriceform').submit();
      });
    });

</script>
@endsection

