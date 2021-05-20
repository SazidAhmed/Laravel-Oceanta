@include('layouts.admin.header')
  
@include('layouts.admin.topnav')
  
@include('layouts.admin.sidenav')
<div class="page-wrapper">
  <div class="container-fluid">
  @yield('content')
  </div>

@include('layouts.admin.footer')