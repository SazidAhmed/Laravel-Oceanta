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

  <div class="row">
    <!-- order -->
    <div class="col-lg-12 col-xlg-12 col-md-12">
      <div class="ribbon-wrapper card">
        <div class="ribbon ribbon-bookmark ribbon-danger">Customer & Orders</div>
        <div class="card-body">
           <!-- Create modal -->
          <div class="align-self-center">
            <table class="table table-responsive" id="allOrderTable">
              <thead>
                <tr>
                  <th>Index</th>
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
                @foreach($allOrders as $key=>$order)
                <tr>
                  <td>{{$key+1}}</td>
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
                    <a href="{{route('user.order',[$order->user_id,$order->id])}}"><i class="material-icons text-info ">visibility</i></a>
                    <!-- edit button -->
                    <a data-toggle="modal" href="#editmodaluser{{$order->id}}"><i class="material-icons text-success">edit</i></a>
                    <!-- Delete button -->
                    <a data-toggle="modal" href="#deletemodaluser{{$order->id}}"><i class="material-icons text-danger">delete</i></a>
                 </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
<!--Action Modal -->

@foreach($allOrders as $key=>$order)
<!-- View Modal -->

<!-- Delete Modal -->
<div id="deletemodaluser{{$order->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <form action="{{route('user.orderDelete',[$order->id])}}" method="post">@csrf
      {{method_field('POST')}}
      <div class="modal-content">
        <div class="ribbon-wrapper">
          <div class="ribbon ribbon-bookmark ribbon-primary">Order : {{$order->id}}</div>
        </div>
        <div class="modal-body">
          <h4 class="text-center">Confirm To Delete</h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-rounded btn-danger"
              data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-sm btn-rounded btn-success">Confirm</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!--Edit Modal -->
<div id="editmodaluser{{$order->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

<script>
    $(document).ready(function() {
        $('#allOrderTable').DataTable();
    });
    </script>
@endsection
