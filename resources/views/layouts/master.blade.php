<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('titulo')</title>
  <meta name="token" id="token" value="{{ csrf_token() }}">
  <meta name="route" value="{{url('/')}}" id="route">
  
  <!-- icono de la pagina -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/utc.jpeg') }}">
  <!-- fin icono -->

  <!-- css colocados a parte -->
    <link rel="stylesheet" href="{{ asset('css/personalizados/logeo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/personalizados/color.css') }}">
    <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap-3/bootstrap.min.css"> -->
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/carrusel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/personalizados/efectos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css1/css2.css') }}">
    <!-- <link rel="stylesheet" type="text/css" href="css/responsive/responsive1.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="css/diseño tabla/tabla.css"> -->
  <!-- fin css -->

  <!-- links de tabla para cargar datos por partes-->
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="{{ asset('table/datatables/datatables.min.css') }}"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <!-- <link rel="stylesheet"  type="text/css" href="table/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('table/main.css') }}">
    <!-- <link rel="stylesheet" href="table/bootstrap/css/bootstrap.min.css"> -->
  <!-- fin link tabla -->
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/summernote/summernote-bs4.css') }}">

  <script src="{{ asset('js/vue/vue.min.js') }}"></script>
  <script src="{{ asset('js/vue/vue-resource.min.js') }}"></script>
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-green navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <font size="4">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </font>
      </li>
    </ul>

    <!-- Right navbar links -->

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <font color="white"><a class="brand-link">
      <img src="{{ asset('img/utc.jpeg') }}" class="brand-image img-circle elevation-3" style="opacity: .8">
      <font face="Arial black"><span class="brand-text font-weight-light">UTC</span></font>
    </a></font>

    <!-- Sidebar -->

    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content container-fluid" >

      @yield('contenido')

    </section>
    
  </div>
  <!-- /.content-wrapper -->

 <!-- Main Footer -->
   <footer class="main-footer">
      <strong>Gestión Biblioteca <span class="fa fa-book"></span></strong>
      Todos los derechos reservados.
      <div class="float-right d-none d-sm-inline-block">
        <img src="{{ asset('adminlte/img/utc.png') }}" width="20px" height="20px">
        <b>Universidad Tecnológica del Centro</b>
    </div>
    </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-blue">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@stack('scripts')

<!-- jQuery 3 -->
<script src="{{ asset('adminlte/js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery/jquery-3.3.1.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<!-- <script src="adminlte/js/bootstrap.min.js"></script> -->
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>
<script src="{{ asset('js/toastr.js') }}"></script>
<script src="{{ asset('js/sweetalert.min.js') }}"></script>

<!-- js para la tabla -->
<!-- <script type="text/javascript" src="table/popper/popper.min.js"></script>
<script type="text/javascript" src="table/datatables/datatables.min.js"></script>
<script type="text/javascript" src="table/main.js"></script> -->
<!-- fin js tabla -->

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('adminlte/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>

</body>
</html>
