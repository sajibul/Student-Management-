<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Dashboard-@yield('tittle')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('public/backend')}}/plugins//fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('public/backend')}}/plugins//tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('public/backend')}}/plugins//icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('public/backend')}}/plugins//jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('public/backend')}}/dist//css/adminlte.min.css">
  <link rel="stylesheet" href="{{asset('public/backend')}}/dist//css/toastr.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('public/backend')}}/plugins//overlayScrollbars/css/OverlayScrollbars.min.css">
  @stack('css')
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('public/backend')}}/plugins//daterangepicker/daterangepicker.css">
  <script src="{{asset('public/backend')}}/dist/js/toastr.min.js"></script>
  <script src="{{asset('public/backend')}}/dist/js/sweetalert2.all.min.js"></script>
  <script type="text/javascript">
    .notifyjs-corner{
      z-index:10000 !important;
    }
  </script>
  <script src="{{asset('public/backend')}}/dist/js/notify.js"></script>
  <!-- summernote -->
  <link rel="stylesheet" href="public/backend/{{asset('public/backend')}}/plugins//summernote/summernote-bs4.min.css">
  <!-- jQuery -->
  <script src="{{asset('public/backend')}}/plugins//jquery/jquery.min.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link bg-green" data-toggle="dropdown" href="#" >
          <i class="fas fa-angle-down right"></i>
          <strong class="">{{Auth::user()->name}}</strong>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
            <a href="{{route('user-profile.index')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              {{__('User Profile')}}
            </a>
            <div class="dropdown-divider"></div>
            <a class="nav-link" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                             <i class="fa fa-power-off" aria-hidden="true"></i>
                {{ __('Logout') }}
            </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link AdminLTE Logo">
      <span class="brand-text font-weight-light">Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="  {{!empty(Auth::user()->image) ? url('public/storage/profile/'.Auth::user()->image) : asset('public/backend/dist/img/empty.jpg')}}" class="img-circle elevation-2" alt="User Image">

        </div>
        <div class="info">
          <a href="#" class="d-block">Sajib Mahmud</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      @include('layouts/sidebar')
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@yield('tittle')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Home</li>
              <li class="breadcrumb-item"><a href="#">@yield('tittle')</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020-2020 <a href="#">sajib-popularsoft</a>.</strong>
    Design and develop by Sajib
    <div class="float-right d-none d-sm-inline-block">
    </div>
  </footer>

  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('public/backend')}}/plugins//jquery-ui/jquery-ui.min.js"></script>
<!-- jquery-validation -->
<script src="{{asset('public/backend')}}/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{asset('public/backend')}}/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('public/backend')}}/plugins//bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{asset('public/backend')}}/plugins//chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{asset('public/backend')}}/plugins//sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{asset('public/backend')}}/plugins//jqvmap/jquery.vmap.min.js"></script>
<script src="{{asset('public/backend')}}/plugins//jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('public/backend')}}/plugins//jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{asset('public/backend')}}/plugins//moment/moment.min.js"></script>
<script src="{{asset('public/backend')}}/plugins//daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('public/backend')}}/plugins//tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{asset('public/backend')}}/plugins//summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{asset('public/backend')}}/plugins//overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('public/backend')}}/dist//js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('public/backend')}}/dist//js/pages/dashboard.js"></script>
<script src="{{asset('public/backend')}}/dist//js/toastr.min.js"></script>
{!! Toastr::message() !!}
  @stack('js')
<!-- AdminLTE for demo purposes -->
<script src="{{asset('public/backend')}}/{{asset('public/backend')}}/dist///js/demo.js"></script>
<script type="text/javascript">
//17 number tutorial --popularsoft
  $(function(){
    $('.singledatepicker').daterangepicker({
      singleDatePicker: true,
      showDropdowns:true,
      autoUpdateInput:false,
      autoApply:true,
      locale:{
        format:'DD-MM-YYYY',
        daysOfWeek:['Su','Mo','Tu','We','Th','Fr','Sa'],
        firstDay:0
      },
      minDate:'01/01/1930',
    },
    function(start){
      this.element.val(start.format('DD-MM-YYYY'));
      this.element.parent().parent().removeClass('has-error');
    },
    function(chosen_date){
      this.element.val(chosen_date.format('DD-MM-YYYY'));
    }),
    $('.singledatepicker').on('apply.daterangepicker',function(ev,picker){
      $(this).val(picker.startDate.format('DD-MM-YYYY'));
      $(this).trigger('change');
    });
  });
</script>
</body>
</html>
