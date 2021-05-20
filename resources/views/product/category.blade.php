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
  <!-- Category -->
  <div class="col-lg-7 col-xlg-7 col-md-12">
    <div class="ribbon-wrapper card">
      <div class="ribbon ribbon-bookmark ribbon-primary">Product Categories</div>
      <div class="card-body">
          <!-- Create modal -->
          <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#addModal">Add New</button>
        <div class="align-self-center">
          <table class="table table-responsive" id="catTable">
            <thead>
              <tr>
                <th>Index</th>
                <th>Image</th>
                <th>Name</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($categories as $key=> $category)
              <tr>
                <td>{{$key+1}}</td>
                <td><img src="imgfiles/catImg/{{$category->image}}"  height="60"></td>
                <td>{{$category->name}}</td>          
                <td>
                  <!-- View button -->
                  <a data-toggle="modal" href="#viewmodal{{$category->id}}"><i class="material-icons text-info ">visibility</i></a>
                  <!-- edit button -->
                  <a data-toggle="modal" href="#editmodal{{$category->id}}"><i class="material-icons text-success">edit</i></a>
                  <!-- Delete button -->
                  <a data-toggle="modal" href="#deletemodal{{$category->id}}"><i class="material-icons text-danger">delete</i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
   <!-- Subcategory -->
   <div class="col-lg-5 col-xlg-5 col-md-12">
    <div class="ribbon-wrapper card">
      <div class="ribbon ribbon-bookmark ribbon-primary">Sub-Categories</div>
      <div class="card-body">
          <!-- Create modal -->
          <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#subaddModal">Add New</button>
        <div class="align-self-center">
          <table class="table table-responsive" id="subcatTable">
            <thead>
              <tr>
                <th>Index</th>
                <th>SubCategory Name</th>
                <th>Category Name</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($subcategories as $key=> $subcategory)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$subcategory->name}}</td>
                <td>{{$subcategory->category->name??''  }}</td>           
                <td>
                  <!-- View button -->
                  <a data-toggle="modal" href="#subviewmodal{{$subcategory->id}}"><i class="material-icons text-info ">visibility</i></a>
                  <!-- edit button -->
                  <a data-toggle="modal" href="#subeditmodal{{$subcategory->id}}"><i class="material-icons text-success">edit</i></a>
                  <!-- Delete button -->
                  <a data-toggle="modal" href="#subdeletemodal{{$subcategory->id}}"><i class="material-icons text-danger">delete</i></a>
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

  <!--Actions Category -->

  @foreach($categories as $key=> $category)
  <!-- View Modal -->
  <div id="viewmodal{{$category->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="ribbon-wrapper">
          <div class="ribbon ribbon-bookmark ribbon-primary">Category Details</div>
        </div>
        <div class="modal-body">
            <div class="row center">
              <div class="col-lg-12 col-xlg-12 col-md-12">
                <table class="table table-responsive">
                  <tbody>
                    <tr>
                      <td class="text-info">Category ID</td>
                      <td>{{$category->id}}</td>
                    </tr>
                    <tr>
                      <td class="text-info">Name</td>
                      <td>{{$category->name}}</td>
                    </tr>
                    <tr>
                      <td class="text-info">Created On</td>
                      <td>{{$category->created_at}}</td>
                    </tr>
                    <tr>
                      <td class="text-info">Last Update</td>
                      <td>{{$category->updated_at}}</td>
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
  <!-- Edit Modal -->
  <div id="editmodal{{$category->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form class="floating-labels m-t-40" id="ecatForm" action="{{route('category.update',[$category->id])}}"  method="post" enctype="multipart/form-data">@csrf
        {{method_field('PATCH')}}
        <div class="modal-content">
          <div class="ribbon-wrapper">
            <div class="ribbon ribbon-bookmark ribbon-primary">UpdateCategory</div>
          </div>
          <div class="modal-body">
            <div class="form-group has-success m-b-40">
              <input type="text" class="form-control" id="ecatname" name="name" value="{{$category->name}}"><span class="bar"></span>
              <label for="ecatname">Name</label>
            </div>
            <div class="form-group has-success m-b-40">
              <input type="file" name="image" accept="image/*" id="ecatimage" name="description"><span class="bar"></span>
            
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
   <!-- Delete Modal -->
  <div id="deletemodal{{$category->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
    <form action="{{route('category.destroy',[$category->id])}}" method="post">@csrf
      {{method_field('DELETE')}}
        <div class="modal-content">
          <div class="ribbon-wrapper">
            <div class="ribbon ribbon-bookmark ribbon-primary">Category : {{$category->name}}</div>
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
  @endforeach

  <!--Actions SubCategory -->

  @foreach($subcategories as $key=> $subcategory)
  <!-- View Modal -->
  <div id="subviewmodal{{$subcategory->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="ribbon-wrapper">
          <div class="ribbon ribbon-bookmark ribbon-primary">Category Details</div>
        </div>
        <div class="modal-body">
            <div class="row center">
              <div class="col-lg-12 col-xlg-12 col-md-12">
                <table class="table table-responsive">
                  <tbody>
                    <tr>
                      <td class="text-info">Sub-Category ID</td>
                      <td>{{$subcategory->id}}</td>
                    </tr>
                    <tr>
                      <td class="text-info">Name</td>
                      <td>{{$subcategory->name}}</td>
                    </tr>
                    <tr>
                      <td class="text-info">Category</td>
                      <td>{{$subcategory->category->name??''  }}</td>    
                    </tr>
                    <tr>
                      <td class="text-info">Created On</td>
                      <td>{{$subcategory->created_at}}</td>
                    </tr>
                    <tr>
                      <td class="text-info">Last Update</td>
                      <td>{{$subcategory->updated_at}}</td>
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
  <!-- Edit Modal -->
  <div id="subeditmodal{{$subcategory->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form class="floating-labels m-t-40" id="esubcatForm" action="{{route('subcategory.update',[$subcategory->id])}}"  method="post" enctype="multipart/form-data">@csrf
        {{method_field('PATCH')}}
        <div class="modal-content">
          <div class="ribbon-wrapper">
            <div class="ribbon ribbon-bookmark ribbon-primary">Update Subcategory</div>
          </div>
          <div class="modal-body">
            <div class="form-group has-success m-b-40">
                <select class="form-control p-0" id="eprosubcat" name="category_id" >
                  <option></option>
                    @foreach(App\Category::all() as $category)
                    <option value="{{$category->id}}"@if($subcategory->category_id==$category->id)selected @endif>{{$category->name}}</option>
                    @endforeach
                </select><span class="bar"></span>
                <label for="eprosubcat">Category</label>
            </div>
            <div class="form-group has-success m-b-40">
              <input type="text" class="form-control" id="esubcatname" name="name" value="{{$subcategory->name}}"><span class="bar"></span>
              <label for="esubcatname">Name</label>
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
   <!-- Delete Modal -->
  <div id="subdeletemodal{{$subcategory->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
    <form action="{{route('subcategory.destroy',[$subcategory->id])}}" method="post">@csrf
      {{method_field('DELETE')}}
        <div class="modal-content">
          <div class="ribbon-wrapper">
            <div class="ribbon ribbon-bookmark ribbon-primary">Category : {{$subcategory->name}}</div>
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
  @endforeach
 
<!--Category Create Modal -->
<div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="floating-labels m-t-40" id="catForm" action="{{route('category.store')}}" method="post" enctype="multipart/form-data">@csrf
      <div class="modal-content">
        <div class="ribbon-wrapper">
          <div class="ribbon ribbon-bookmark ribbon-primary">Create New Category</div>
        </div>
        <div class="modal-body">
          <div class="form-group has-success m-b-40">
            <input type="text" class="form-control" id="catname" name="name"><span class="bar"></span>
            <label for="catname">Name</label>
          </div>
          <div class="form-group has-success m-b-40">
            <input type="file" name="image" accept="image/*" id="catimage"><span class="bar"></span>
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

<!--SubCategory Create Modal -->
<div id="subaddModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="floating-labels m-t-40" id="subcatForm" action="{{route('subcategory.store')}}" method="post" enctype="multipart/form-data">@csrf
      <div class="modal-content">
        <div class="ribbon-wrapper">
          <div class="ribbon ribbon-bookmark ribbon-primary">Create Subcategory</div>
        </div>
        <div class="modal-body">
          <div class="form-group has-success m-b-40">
              <select class="form-control p-0" id="prosubcat" name="category_id" >
                <option></option>
                  @foreach(App\Category::all() as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
              </select><span class="bar"></span>
              <label for="prosubcat">Category</label>
          </div>
          <div class="form-group has-success m-b-40">
            <input type="text" class="form-control" id="subcatname" name="name"><span class="bar"></span>
            <label for="subcatname">Name</label>
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

<script>
    $(document).ready(function() {
        $('#catTable').DataTable();
        $('#subcatTable').DataTable();
    });
    </script>
@endsection
