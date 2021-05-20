@extends('layouts.admin.app')

@section('content')

  <div class="row page-titles">
      <div class="col-md-5 col-8 align-self-center">
          <h3 class="text-themecolor">Dashboard</h3>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
          </ol>
      </div>
  </div>
  <div class="row justify-content-end">
    @if(Session::has('message'))
    <div class="alert alert-rounded alert-success">
      {{Session::get('message')}}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
    </div>
    @endif

    @if ($errors->any())
      @foreach ($errors->all() as $error) 
        <div class="alert alert-rounded alert-danger">
          {{ $error }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        </div>
      @endforeach
    @endif
  </div>
  <div class="ribbon-wrapper card">
    <div class="ribbon ribbon-bookmark ribbon-danger">Invoice</div>
    <div class="card-body">
      <div class="align-self-center">
      @foreach($carts as $cart)
        <h4>Total Payment : {{$cart->totalPrice}} Taka</h4>
        <h4>Total Quantity : {{$cart->totalQty}}</h4>
        <h4>Product Details:</h4>
            <div class="row">
              <div class="col-md-12">
                <table class="table table-responsive">
                  <thead>
                    <tr>
                      <th>Image</th><th></th>
                      <th>Name</th><th></th>
                      <th>Price</th><th></th>
                      <th>Quantity</th><th></th>
                      <th>Total Amount</th><th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($cart->items as $product)
                    <tr>
                      <td> <img src="{{ URL::asset('imgfiles/proImg/'.$product['image']) }}" height="100"></td><td></td>
                      <td>{{$product['name']}}</td><td></td>
                      <td>{{$product['price']}} taka</td><td></td>
                      <td>{{$product['qty']}}</td><td></td>
                      <td>{{$product['price']*$product['qty']}} taka</td><td></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>                          
            </div>
          </tbody>
        </table>
      @endforeach
      </div>
    </div>
  </div>


@endsection
