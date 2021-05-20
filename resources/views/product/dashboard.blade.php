@extends('layouts.admin.app')

@section('content')

<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">Dashboard</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Website</a></li>
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


<div class="container-fluid">
    <div class="row">
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-info"><i class="mdi mdi-account-key"></i></div>
                        <div class="m-l-10 align-self-center">
                            <h3 class="m-b-0 font-light">{{$admins}}</h3>
                            <h5 class="text-muted m-b-0">Admins</h5></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-warning"><i class="mdi mdi-account-multiple"></i></div>
                        <div class="m-l-10 align-self-center">
                            <h3 class="m-b-0 font-lgiht">{{$customers}}</h3>
                            <h5 class="text-muted m-b-0">Customers</h5></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-primary"><i class="mdi mdi-timer-sand"></i></div>
                        <div class="m-l-10 align-self-center">
                            <h3 class="m-b-0 font-lgiht">{{App\Category::get()->count()}}</h3>
                            <h5 class="text-muted m-b-0">Categories</h5></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-danger"><i class="mdi mdi-tshirt-crew"></i></div>
                        <div class="m-l-10 align-self-center">
                            <h3 class="m-b-0 font-lgiht">{{App\Product::get()->count()}}</h3>
                            <h5 class="text-muted m-b-0">Products</h5></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="card card-inverse card-primary">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="m-r-20 align-self-center">
                            <h1 class="text-white"><i class="mdi mdi-cart"></i></h1></div>
                        <div>
                            <h3 class="card-title">New Orders</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 align-self-center">
                            <h2 class="font-light text-white text-center">{{$newOrders+$newGuestOrders}}</h2>
                        </div>
                        <div class="col-8 p-t-10 p-b-20 align-self-center">
                            <div class="usage chartist-chart" style="height:65px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
          <div class="card card-inverse card-success">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="m-r-20 align-self-center">
                            <h1 class="text-white"><i class="mdi mdi-checkbox-marked-circle"></i></h1></div>
                        <div>
                            <h3 class="card-title">Delivered</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 align-self-center">
                            <h2 class="font-light text-white text-center">{{$deliveredOrders+$deliveredGuestOrders}}</h2>
                        </div>
                        <div class="col-8 p-t-10 p-b-20 text-right">
                            <div class="spark-count" style="height:65px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card card-inverse card-info">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="m-r-20 align-self-center">
                            <h1 class="text-white"><i class="mdi  mdi-truck-delivery"></i></h1></div>
                        <div>
                            <h3 class="card-title">On Process</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 align-self-center">
                            <h2 class="font-light text-white text-center">{{$onProcessOrders+$onProcessGuestOrders}}</h2>
                        </div>
                        <div class="col-8 p-t-10 p-b-20 align-self-center">
                            <div class="usage chartist-chart" style="height:65px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex no-block">
                        <h4 class="card-title">Member's Orders</h4>
                    </div>
                    <div class="table-responsive m-t-20">
                        <table class="table stylish-table">
                            <thead>
                                <tr>
                                    <th colspan="2">Index</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Address</th>
                                    <th>Note</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $key=>$order)
                                <td colspan="2">{{$key+1}}</td>
                                <td>{{date('d-M-y', strtotime($order->created_at))}}</td>
                                <td>
                                    @if($order->status=="Delivered")
                                    <span class="badge-pill badge-success">Delivered</span>
                                    @elseif($order->status=="On Process")
                                    <span class="badge-pill badge-primary">On Process</span>
                                    @elseif($order->status=="Returned")
                                    <span class="badge-pill badge-danger">Returned</span>
                                    @elseif($order->status=="Canceled")
                                    <span class="badge-pill badge-danger">Canceled</span>
                                    @else
                                    <span class="badge-pill badge-warning">Pending</span>
                                    @endif
                                </td>
                                <td>{{$order->name}}</td>
                                <td>{{$order->phone}}</td>
                                <td>{{$order->address}}</td>
                                <td>{{$order->note}}</td>
                                <td>
                                    <a href="{{route('user.order',[$order->user_id,$order->id])}}"><i class="material-icons text-info ">visibility</i></a>
                                    <!-- edit button -->
                                    <a data-toggle="modal" href="#editMemberOrder{{$order->id}}"><i class="material-icons text-success">edit</i></a>
                                </td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach($orders as $key=>$order)
        <!--Edit Modal -->
        <div id="editMemberOrder{{$order->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="floating-labels m-t-40" id="Form" action="{{route('order.update',[$order->id])}}"  method="post" enctype="multipart/form-data">@csrf
            <div class="modal-content">
                <div class="ribbon-wrapper">
                <div class="ribbon ribbon-bookmark ribbon-primary">Update Status</div>
                </div>
                <div class="modal-body">
                <div class="form-group has-success m-b-40">
                    <select class="form-control p-0" id="orderStatus" name="status" required>
                    <option value=""></option>
                    <option value="Pending">Pending</option>
                    <option value="On Process">On Process</option>
                    <option value="Delivered">Delivered</option>
                    <option value="Returned">Returned</option>
                    <option value="Canceled">Canceled</option>
                    </select><span class="bar"></span>
                    <label for="orderStatus" class="text-success">Order Status</label>
                </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-rounded btn-danger"
                    data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-sm btn-rounded btn-success">Submit</button>
                </div>
            </div>
            </form>
        </div>
        </div>
    @endforeach

    <!-- Guest Order section -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex no-block">
                        <h4 class="card-title">Guest Orders</h4>
                    </div>
                    <div class="table-responsive m-t-20">
                        <table class="table stylish-table">
                            <thead>
                                <tr>
                                    <th colspan="2">Index</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Address</th>
                                    <th>Note</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($guestOrders as $key=>$order)
                                <td colspan="2">{{$key+1}}</td>
                                <td>{{date('d-M-y', strtotime($order->created_at))}}</td>
                                <td>
                                    @if($order->status=="Delivered")
                                    <span class="badge-pill badge-success">Delivered</span>
                                    @elseif($order->status=="On Process")
                                    <span class="badge-pill badge-primary">On Process</span>
                                    @elseif($order->status=="Returned")
                                    <span class="badge-pill badge-danger">Returned</span>
                                    @elseif($order->status=="Canceled")
                                    <span class="badge-pill badge-danger">Canceled</span>
                                    @else
                                    <span class="badge-pill badge-warning">Pending</span>
                                    @endif
                                </td>
                                <td>{{$order->name}}</td>
                                <td>{{$order->phone}}</td>
                                <td>{{$order->address}}</td>
                                <td>{{$order->note}}</td>
                                <td>
                                <!-- View button -->
                                <a href="{{route('guest.order',$order->id)}}"><i class="material-icons text-info ">visibility</i></a>
                                    <!-- edit button -->
                                    <a data-toggle="modal" href="#editGuestOrder{{$order->id}}"><i class="material-icons text-success">edit</i></a>
                                </td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@foreach($guestOrders as $key=>$order)
<!--Edit Modal -->
<div id="editGuestOrder{{$order->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="floating-labels m-t-40" id="Form" action="{{route('guest.orderUpdate',[$order->id])}}"  method="post" enctype="multipart/form-data">@csrf
      <div class="modal-content">
        <div class="ribbon-wrapper">
          <div class="ribbon ribbon-bookmark ribbon-primary">Update Status</div>
        </div>
        <div class="modal-body">
          <div class="form-group has-success m-b-40">
            <select class="form-control p-0" id="orderStatus" name="status" required>
              <option value=""></option>
              <option value="Pending">Pending</option>
              <option value="On Process">On Process</option>
              <option value="Delivered">Delivered</option>
              <option value="Returned">Returned</option>
              <option value="Canceled">Canceled</option>
            </select><span class="bar"></span>
            <label for="orderStatus" class="text-success">Order Status</label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-rounded btn-danger"
              data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-sm btn-rounded btn-success">Submit</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endforeach
@endsection