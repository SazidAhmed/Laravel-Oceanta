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
    <!-- user -->
    <div class="col-lg-8 col-xlg-8 col-md-12">
      <div class="ribbon-wrapper card">
        <div class="ribbon ribbon-bookmark ribbon-danger">User List</div>
        <div class="card-body">
           <!-- Create modal -->
           <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#addModalpro">Add New</button>
          <div class="align-self-center">
            <table class="table table-responsive" id="myTable">
              <thead>
                <tr>
                  <th>Index</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Address</th>
                  <th>Role</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $key=>$user)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->phone}}</td>
                  <td>{{$user->address}}</td>
                  <td>
                  @if($user->is_admin==0)
                    <span class="badge-pill badge-warning">Customer</span>
                    @else
                    <span class="badge-pill badge-success">Admin</span>
                    @endif
                  </td>     
                 <td>
                    <!-- View button -->
                    <a data-toggle="modal" href="#viewmodaluser{{$user->id}}"><i class="material-icons text-info ">visibility</i></a>
                    <!-- edit button -->
                    <a data-toggle="modal" href="#editmodaluser{{$user->id}}"><i class="material-icons text-success">edit</i></a>
                    <!-- Delete button -->
                    <a data-toggle="modal" href="#deletemodaluser{{$user->id}}"><i class="material-icons text-danger">delete</i></a>
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

@foreach($users as $key=>$user)
<!-- View Modal -->
<div id="viewmodaluser{{$user->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="ribbon-wrapper">
        <div class="ribbon ribbon-bookmark ribbon-primary">Customer Details</div>
      </div>
      <div class="modal-body">
          <div class="row center">
            <div class="col-lg-12 col-xlg-12 col-md-12">
              <table class="table table-responsive">
                <tbody>
                  <tr>
                    <td class="text-info">Customer ID</td>
                    <td>{{$user->id}}</td>
                  </tr>
                  <tr>
                    <td class="text-info">Name</td>
                    <td>{{$user->name  }}</td>
                  </tr>
                  <tr>
                    <td class="text-info">Email</td>
                    <td>{{$user->email  }}</td>
                  </tr>
                  <tr>
                    <td class="text-info">Mobile</td>
                    <td>{{$user->phone}}</td>
                  </tr>
                  <tr>
                    <td class="text-info">Address</td>
                    <td>{{$user->address}}</td>
                  </tr>
                  <tr>
                    <td class="text-info">Registered On</td>
                    <td>{{$user->created_at}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-rounded btn-primary"
            data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div id="deletemodaluser{{$user->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <form action="{{route('users.destroy',[$user->id])}}" method="post">@csrf
    {{method_field('DELETE')}}
      <div class="modal-content">
        <div class="ribbon-wrapper">
          <div class="ribbon ribbon-bookmark ribbon-primary">Product : {{$user->name}}</div>
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
<div id="editmodaluser{{$user->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="floating-labels m-t-40" id="proForm" action="{{route('users.update',[$user->id])}}" method="post" enctype="multipart/form-data">@csrf
      {{method_field('PATCH')}}
      <div class="modal-content">
        <div class="ribbon-wrapper">
          <div class="ribbon ribbon-bookmark ribbon-primary">Update</div>
        </div>
        <div class="modal-body">
          <div class="form-group has-success m-b-40">
            <input type="text" class="form-control" id="ename" name="name"><span class="bar"></span>
            <label for="ename">Name</label>
          </div>
          <div class="form-group has-success m-b-40">
            <input type="text" class="form-control" id="eemail" name="email"><span class="bar"></span>
            <label for="eemail">Email</label>
          </div>
          <div class="form-group has-success m-b-40">
            <input type="text" class="form-control" id="epassword" name="password"><span class="bar"></span>
            <label for="epassword">Password</label>
          </div>
          <div class="form-group has-success m-b-40">
            <input type="text" class="form-control" id="ephone" name="phone"><span class="bar"></span>
            <label for="ephone">Mobile</label>
          </div>
          <div class="form-group has-success m-b-40">
            <input type="text" class="form-control" id="eaddress" name="address"><span class="bar"></span>
            <label for="eaddress">Address</label>
          </div>
          <div class="form-group has-success m-b-40">
            <input type="text" class="form-control" id="erole" name="is_admin"><span class="bar"></span>
            <label for="erole">Role</label>
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
        $('#myTable').DataTable();
    });
    </script>
@endsection
