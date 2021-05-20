<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.wrappixel.com/demos/admin-templates/material-pro/minisidebar/layout-single-column.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Feb 2019 11:15:49 GMT -->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png')}}">
  <title>Online Shop</title>
  <!-- Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Bootstrap Core CSS -->
  <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('assets/plugins/dropify/dist/css/dropify.min.css')}}">
   <!-- Editable CSS -->
   <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/jsgrid/jsgrid.min.css')}}" />
  <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/jsgrid/jsgrid-theme.min.css')}}" />
  <!-- chartist CSS -->
  <link href="{{ asset('assets/plugins/chartist-js/dist/chartist.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/plugins/chartist-js/dist/chartist-init.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css')}}" rel="stylesheet">
  <!--This page css - Morris CSS -->
  <link href="{{ asset('assets/plugins/c3-master/c3.min.css')}}" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="{{ asset('css/style.css')}}" rel="stylesheet">
  <!-- You can change the theme colors from here -->
  <link href="{{ asset('css/colors/default-dark.css')}}" id="theme" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js')}}"></script>
</head>

<body class="fix-header single-column card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    
                    <ul class="navbar-nav mr-auto mt-md-0">
                    </ul>
                    
                    <ul class="navbar-nav my-lg-0"> 
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="{{ route('shop') }}" >Shop</a>
                      </li>                   
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="{{ route('customePanel') }}" >Orders</a>
                      </li>
                      <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-user"></i> {{Auth()->user()->name}}</a>
                          <div class="dropdown-menu dropdown-menu-right scale-up">
                              <ul class="dropdown-user">
                                  <li><a><i class="ti-email"></i> {{Auth()->user()->email}}</a></li>
                                  <li role="separator" class="divider"></li>
                                  <li><a><i class="ti-mobile"></i> {{Auth()->user()->phone}}</a></li>
                                  <li role="separator" class="divider"></li>
                                  <li><a><i class="ti-home"></i> {{Auth()->user()->address}}</a></li>
                                  <li role="separator" class="divider"></li>
                                  <li><a href="{{ route('logout') }}"  
                                  onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Logout</a>

                                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                      @csrf
                                  </form>
                                  </li>
                              </ul> 
                          </div>
                      </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Customer Dashboard</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('customePanel') }}">Order List</a></li>
                        </ol>
                    </div>
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
              
            </div>
            <footer class="footer">
                © 2020 Oceanta Fashion
            </footer>
        </div>
    </div>
   
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('assets/plugins/popper/popper.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('js/jquery.slimscroll.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('js/sidebarmenu.js')}}"></script>
    <!--stickey kit -->
    <script src="{{ asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('js/custom.min.js')}}"></script>
    <script src="{{ asset('js/jasny-bootstrap.js')}}"></script>
   
    <!-- <script src="{{ asset('assets/plugins/jsgrid/db.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/jsgrid/jsgrid.min.js')}}"></script>
    <script src="{{ asset('js/jsgrid-init.js')}}"></script> -->
   
    <script src="{{ asset('assets/plugins/chartist-js/dist/chartist.min.js') }}"></script>
    <!-- <script src="{{ asset('assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js') }}"></script> -->
    
    <script src="{{ asset('assets/plugins/d3/d3.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/c3-master/c3.min.js')}}"></script>
  
    <!-- <script src="{{ asset('js/dashboard1.js') }}"></script> -->
    <!-- ============================================================== -->
   
    <script src="{{ asset('assets/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>
    <script src="{{ asset('assets/plugins/dropify/dist/js/dropify.min.js') }}"></script>
    <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();

        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });

        // Used events
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });

        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });

        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });
    </script>
</body>

</html>