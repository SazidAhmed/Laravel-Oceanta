@extends('layouts.admin.app')
<script src="{{asset('js/tinymce/tinymce.min.js')}}"></script>
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
    <!-- product -->
    <div class="col-lg-8 col-xlg-8 col-md-12">
      <div class="ribbon-wrapper card">
        <div class="ribbon ribbon-bookmark ribbon-danger">Product List</div>
        <div class="card-body">
           <!-- Create modal -->
           <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#addModalpro">Add New</button>
          <div class="align-self-center">
            <table class="table table-responsive" id="proTable">
              <thead>
                <tr>
                  <th>Index</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>stock</th>
                  <th>Category</th>
                  <th>SubCategory</th>
                  <th>Page Section</th>
                  <th>Images</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($products as $key=>$product)
                <tr>
                  <td>{{$key+1}}</td>
                  <td><img src="imgfiles/proImg/{{$product->image}}"  height="80"></td>
                  <td>{{$product->name}}</td>
                  <td>{{$product->price}}</td>
                  <td>{{$product->stock}}</td>
                  <td>{{$product->category->name??''  }}</td>
                  <td>{{$product->subcategory->name??''  }}</td>   
                  <td>{{$product->section}}</td>    
                  <td>
                    <a data-toggle="modal" href="#addImagepro{{$product->id}}"><i class="material-icons text-info ">add</i></a>
                  </td>      
                  <td>
                    <!-- View button -->
                    <a data-toggle="modal" href="#viewmodalpro{{$product->id}}"><i class="material-icons text-info ">visibility</i></a>
                    <!-- edit button -->
                    <a data-toggle="modal" href="#editmodalpro{{$product->id}}"><i class="material-icons text-success">edit</i></a>
                    <!-- Delete button -->
                    <a data-toggle="modal" href="#deletemodalpro{{$product->id}}"><i class="material-icons text-danger">delete</i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{$products->links()}}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-xlg-4 col-md-12">
      <div class="ribbon-wrapper card">
        <div class="ribbon ribbon-bookmark ribbon-danger">Product Images</div>
        <div class="card-body">
          <div class="align-self-center">
            <table class="table table-responsive" id="proimageTable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Image</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($image as $key=>$img)
                <tr>
                  <td>{{$img->product->id}}</td>
                  <td>{{$img->product->name??''  }}</td>
                  <td><img src="{{ URL::asset('imgfiles/proImgs/'.$img->image) }}" height="80"></td>  
                  <td>
                    <!-- edit button -->
                    <a data-toggle="modal" href="#editImagepro{{$img->id}}"><i class="material-icons text-success">edit</i></a>
                    <!-- Delete button -->
                    <a data-toggle="modal" href="#deleteImagepro{{$img->id}}"><i class="material-icons text-danger">delete</i></a>
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

<!--Product Action Modal -->
@foreach($products as $key=>$product)
<!-- View Modal -->
<div id="viewmodalpro{{$product->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="ribbon-wrapper">
        <div class="ribbon ribbon-bookmark ribbon-primary">Product Details</div>
      </div>
      <div class="modal-body">
          <div class="row center">
            <div class="col-lg-12 col-xlg-12 col-md-12">
              <table class="table table-responsive">
                <tbody>
                  <tr>
                    <td class="text-info">Product ID</td>
                    <td>{{$product->id}}</td>
                  </tr>
                  <tr>
                    <td class="text-info">Category Name</td>
                    <td>{{$product->category->name??''  }}</td>
                  </tr>
                  <tr>
                    <td class="text-info">SubCategory Name</td>
                    <td>{{$product->subcategory->name??''  }}</td>
                  </tr>
                  <tr>
                    <td class="text-info">Product Name</td>
                    <td>{{$product->name}}</td>
                  </tr>
                  <tr>
                    <td class="text-info">Price</td>
                    <td>{{$product->price}}</td>
                  </tr>
                  <tr>
                    <td class="text-info">Stock</td>
                    <td>{{$product->stock}}</td>
                  </tr>
                  <tr>
                    <td class="text-info">Description</td>
                    <td>{{$product->description}}</td>
                  </tr>
                  <tr>
                    <td class="text-info">Additional Info</td>
                    <td>{{$product->additional_info}}</td>
                  </tr>
                  <tr>
                    <td class="text-info">Created Date</td>
                    <td>{{$product->created_at}}</td>
                  </tr>
                  <tr>
                    <td class="text-info">Updated_at</td>
                    <td>{{$product->updated_at}}</td>
                  </tr>
                  <tr>
                    <td class="text-info">Image</td>
                    <td><img src="imgfiles/proImg/{{$product->image}}" height="80" width="100"></td>
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
<div id="deletemodalpro{{$product->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <form action="{{route('product.destroy',[$product->id])}}" method="post">@csrf
    {{method_field('DELETE')}}
      <div class="modal-content">
        <div class="ribbon-wrapper">
          <div class="ribbon ribbon-bookmark ribbon-primary">Product : {{$product->name}}</div>
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
<div id="editmodalpro{{$product->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="floating-labels m-t-40" id="proForm" action="{{route('product.update',[$product->id])}}" method="post" enctype="multipart/form-data">@csrf
      {{method_field('PATCH')}}
      <div class="modal-content">
        <div class="ribbon-wrapper">
          <div class="ribbon ribbon-bookmark ribbon-primary">Create New Product</div>
        </div>
        <div class="modal-body">
          <div class="form-group has-success m-b-40">
            <select class="form-control p-0" id="esection" name="section" >
              <option value="Latest" @if($product->section=="Latest")selected @endif>Latest Product</option>
              <option value="Featured" @if($product->section=="Featured")selected @endif>Featured Product</option>
              <option value="Best-Selling" @if($product->section=="Best-Selling")selected @endif>Best Selling</option>
              <option value="Best-Selling-Banner" @if($product->section=="Best-Selling-Banner")selected @endif>Best Selling Banner</option>
              <option value="Random" @if($product->section=="Random")selected @endif>Random Products</option>
            </select><span class="bar"></span>
            <label for="esection">Home Page Section</label>
          </div>
          <div class="form-group has-success m-b-40">
              <select class="form-control p-0" id="eprocat" name="category_id" >
                @foreach(App\Category::all() as $category)
                  <option value="{{$category->id}}" @if($product->category_id==$category->id)selected @endif>{{$category->name}}</option>
                @endforeach
              </select><span class="bar"></span>
              <label for="eprocat">Category</label>
          </div>
          <div class="form-group has-success m-b-40">
              <select class="form-control p-0" id="eprosubcat" name="subcategory_id" >
              @foreach(App\Subcategory::all() as $subcategory)
                <option value="{{$subcategory->id}}" @if($product->subcategory_id==$subcategory->id)selected @endif>{{$subcategory->name}}</option>
              @endforeach
              </select><span class="bar"></span>
              <label for="eprosubcat">Sub-Category</label>
          </div>
          <div class="form-group has-success m-b-40">
            <input type="text" class="form-control" id="eproname" name="name" value="{{$product->name}}"><span class="bar"></span>
            <label for="eproname">Name</label>
          </div>
          <div class="form-group has-success m-b-40">
            <input type="text" class="form-control" id="proprice" name="price" value="{{$product->price}}"><span class="bar"></span>
            <label for="proprice">Price</label>
          </div>
          <div class="form-group has-success m-b-40">
            <input type="number" class="form-control" id="eprostock" name="stock" value="{{$product->stock}}"><span class="bar"></span>
            <label for="eprostock">Stock</label>
          </div>
          <div class="form-group has-success m-b-40">
            <label for="eprodes" class="text-success">Description</label><br>
            <input type="text" class="form-control" id="eprodes" name="description" value="{{$product->description}}"><span class="bar"></span>
          </div>
          <div class="form-group has-success m-b-40">
            <label for="eproaddinfo" class="text-success">Additional Info</label><br>
            <input type="text" class="form-control" id="eproaddinfo" name="additional_info" value="{{$product->additional_info}}"><span class="bar"></span>
          </div>
          <div class="form-group has-success m-b-40">
            <input type="file" name="image" accept="image/*" id="proimage"><span class="bar"></span>
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

<!--Add Image Modal -->
<div id="addImagepro{{$product->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="floating-labels m-t-40" id="addProductImage" action="{{route('productImage.store')}}" method="post" enctype="multipart/form-data">@csrf
      <div class="modal-content">
        <div class="ribbon-wrapper">
          <div class="ribbon ribbon-bookmark ribbon-primary">New Product Image</div>
        </div>
        <div class="modal-body">
          <input type="hidden" name="product_id" value="{{$product->id}}">
          <div class="form-group has-success m-b-40">
            <input type="file" name="image" accept="image/*" id="productImage"><span class="bar"></span>
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

@foreach($image as $key=>$img)
<!--Edit Image Modal -->
<div id="editImagepro{{$img->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="floating-labels m-t-40" id="addProductImage" action="{{route('productImage.update',[$img->id])}}" method="post" enctype="multipart/form-data">@csrf
      {{method_field('PATCH')}}
      <div class="modal-content">
        <div class="ribbon-wrapper">
          <div class="ribbon ribbon-bookmark ribbon-primary">Update Product Image</div>
        </div>
        <div class="modal-body">
          <input type="hidden" name="product_id" value="{{$img->product_id}}">
          <div class="form-group has-success m-b-40">
            <input type="file" name="image" accept="image/*" id="eproductImage"><span class="bar"></span>
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
<div id="deleteImagepro{{$img->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <form action="{{route('productImage.destroy',[$img->id])}}" method="post">@csrf
    {{method_field('DELETE')}}
      <div class="modal-content">
        <div class="ribbon-wrapper">
          <div class="ribbon ribbon-bookmark ribbon-primary">Image For : {{$img->product->name??''}}</div>
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

<!--Product Create Modal -->
<div id="addModalpro" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="floating-labels m-t-40" id="proForm" action="{{route('product.store')}}" method="post" enctype="multipart/form-data">@csrf
      <div class="modal-content">
        <div class="ribbon-wrapper">
          <div class="ribbon ribbon-bookmark ribbon-primary">Create New Product</div>
        </div>
        <div class="modal-body">
          <div class="form-group has-success m-b-40">
            <select class="form-control p-0" id="section" name="section" required>
              <option value=""></option>
              <option value="Latest">Latest Product</option>
              <option value="Featured">Featured Product</option>
              <option value="Best-Selling">Best Selling</option>
              <option value="Best-Selling-Banner">Best Selling Banner</option>
              <option value="Random">Random Products</option>
            </select><span class="bar"></span>
            <label for="section" class="text-success">Home Page Section</label>
          </div>
          <div class="form-group has-success m-b-40">
              <select class="form-control p-0" id="procat" name="category_id" >
                <option></option>
                  @foreach(App\Category::all() as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
              </select><span class="bar"></span>
              <label for="procat">Select Category</label>
          </div>
          <div class="form-group has-success m-b-40">
              <select class="form-control p-0" id="procat" name="subcategory_id" >
              <option value=""></option>
              </select><span class="bar"></span>
              <label for="procat">Select Sub-Category</label>
          </div>
          <div class="form-group has-success m-b-40">
            <input type="text" class="form-control" id="proname" name="name"><span class="bar"></span>
            <label for="proname">Name</label>
          </div>
          <div class="form-group has-success m-b-40">
            <input type="number" class="form-control" id="proprice" name="price"><span class="bar"></span>
            <label for="proprice">Price</label>
          </div>
          <div class="form-group has-success m-b-40">
            <input type="number" class="form-control" id="prostock" name="stock"><span class="bar"></span>
            <label for="prostock">Stock</label>
          </div>
          <div class="form-group has-success m-b-40">
            <label for="prodes" class="text-success">Description</label><br><br>
            <input type="text" class="form-control" id="prodes" name="description"><span class="bar"></span>
          </div>
          <div class="form-group has-success m-b-40">
            <label for="proaddinfo" class="text-success">Additional Info</label><br><br>
            <input type="text" class="form-control" id="proaddinfo" name="additional_info"><span class="bar"></span>
          </div>
          <div class="form-group has-success m-b-40">
            <input type="file" name="image" accept="image/*" id="proimage"><span class="bar"></span>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">
   $(document).ready(function() {
        $('#proTable').DataTable();
        $('#proimageTable').DataTable();

        tinymce.init({
        selector: '#prodes',  // change this value according to your HTML
        setup: function(editor) {
          editor.on('click', function(e) {
            console.log('Editor was clicked');
          });
        }
      });

      tinymce.init({
        selector: '#proaddinfo',  // change this value according to your HTML
        setup: function(editor) {
          editor.on('click', function(e) {
            console.log('Editor was clicked');
          });
        }
      });
    });
  

  $("document").ready(function(){
      $('select[name="category_id"]').on('change',function(){
          var catId = $(this).val();
          // alert(catId);
          if(catId){
              $.ajax({

                  url:'/subcatories/'+catId,
                  type:"GET",
                  dataType:"json",
                  success:function(data){
                    //  alert(data);
                    $('select[name="subcategory_id"]').empty();
                      $.each(data,function(key,value){
                          $('select[name="subcategory_id"]')
                          .append('<option value=" '+key+'">'+value+'</option>');
                      })
                  }
              })
          }else{
            $('select[name="subcategory_id"]').empty();
          }
      });
  });
    
</script>
@endsection
