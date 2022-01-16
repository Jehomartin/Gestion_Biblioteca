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
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/carrusel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/personalizados/efectos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css1/css2.css') }}">
  <!-- fin css -->
  
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
  <nav class="main-header navbar navbar-expand navbar-orange navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <font size="4">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </font>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
         <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset('img/user.png') }}" width="30" height="30">
              <!-- <span class="hidden-xs"><font color="black">{{Session::get('usuario')}}</font></span> -->
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header" style="background-color: gray">
              <!--   <img src="img/{{Session::get('photo')}}" class="img-circle" alt="User Image"> -->
              <font color="white">
                  <h1><span class="fas fa-user"></span></h1>
                  <p>
                    {{Session::get('usuario')}} - {{Session::get('puesto')}}
                  </p>
                </font>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer" style="background-color: black">
                <div class="pull-right">
                  <a href="{{url('sale')}}" class="btn btn-danger">
                    Salir <i class="nav-icon fas fa-power-off"></i>
                  </a>
                </div>
              </li>
            </ul>
          </li>
      </li>
    </ul>
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
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('img/user.png') }}" class="img-circle elevation-2">
        </div>
        <div class="info">
          <font size="2" color="yellow">
            <p>{{Session::get('usuario')}}</p>
          </font>
        </div>        
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{url('inicio') }}" class="nav-link {{ Request::is('inicio') ? 'active' : '' }}">
              <font color="white" size="4" face="times new roman">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Inicio
                </p>
              </font>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{ Request::is('libros') ? 'active' : '' }}  {{ Request::is('registro') ? 'active' : '' }}">
              <i class="nav-icon fas fa-list"></i>
              <p>
                <font color="white" size="4" face="times new roman"> Apartado Libros </font>
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('libros') }}" class="nav-link {{ Request::is('libros') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-book"></i>
                  <font color="orange" size="4" face="times new roman"><span class="glyphicon glyphicon-book"></span> Libros </font>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('registro') }}" class="nav-link {{ Request::is('registro') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-pencil-alt"></i>
                  <font color="orange" size="4" face="times new roman">Registro Libro</font>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="{{url('prestamos') }}" class="nav-link {{ Request::is('prestamos') ? 'active' : '' }}">
              <font color="white" size="4" face="times new roman">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>
                  Proceso Préstamo
                </p>
              </font>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{url('devoluciones') }}" class="nav-link {{ Request::is('devoluciones') ? 'active' : '' }}">
              <font color="white" size="4" face="times new roman">
                <i class="nav-icon fas fa-share"></i>
                <p>
                  Libros prestados
                </p>
              </font>
            </a>
          </li>

          <!-- <li class="nav-item">
            <a href="{{url('ejemplares') }}" class="nav-link {{ Request::is('ejemplares') ? 'active' : '' }}">
              <font color="white" size="4" face="times new roman">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  Ejemplares
                </p>
              </font>
            </a>
          </li> -->

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
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
