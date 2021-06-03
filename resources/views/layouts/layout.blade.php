<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width"></meta>
  <title>@yield('titulo')</title>
  <meta name="token" id="token" value="{{ csrf_token() }}">
  <meta name="route" value="{{url('/')}}">

  <!-- se coloca la imagen como icono -->
    <link rel="shortcut icon" type="image/x-icon" href="img/logos.png">
  <!-- Place favicon.ico in the root directory -->

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="adminlte/css/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="adminlte/css/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="adminlte/css/AdminLTE.min.css">
  
  <!-- se define el color para la plantilla -->
  <link rel="stylesheet" href="adminlte/css/skins/skin-yellow.css">
  <!-- fin de definición de color -->

  <link rel="stylesheet" type="text/css" href="css/logeo.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/color.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/toastr.css">

  <link rel="stylesheet" type="text/css" href="css/efectos.css">
  <!-- <link rel="stylesheet" type="text/css" href="css/index3.css"> -->
  <link rel="stylesheet" type="text/css" href="css/responsive/responsive1.css">

  <link rel="stylesheet" type="text/css" href="css/css1/css2.css">

  <script src="js/vue.js"></script>
  <script src="js/vue-resource.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <!-- <href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">-->
</head>

<body class="hold-transition skin-yellow sidebar-mini" >
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b class="let">UTC</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="img/logos.png" width="120" height="60" class="let"></span> 
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <font size="5">
        <a class="sidebar-toggle" data-toggle="push-menu" role="button">
          <!-- <span class="sr-only">Toggle navigation</span> -->
        </a>
      </font>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle glyphicon glyphicon-user" data-toggle="dropdown">
              
              <!-- <span class="hidden-xs"><font color="black">{{Session::get('usuario')}}</font></span> -->
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
              <!--   <img src="img/{{Session::get('photo')}}" class="img-circle" alt="User Image"> -->
                <h1><span class="glyphicon glyphicon-user"></span></h1>
                <p>
                  {{Session::get('usuario')}} - {{Session::get('puesto')}}
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer" style="background-color: black">
                <div class="pull-right">
                  <a href="{{url('sale')}}" class="btn btn-default btn-flat">Cerrar Sesión</a>
                </div>
              </li>
            </ul>
          </li>

        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" >

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <br>
      <div class="user-panel">
        <div class="pull-left image">
          <font size="2" color="yellow">
            <center>
              <span class="glyphicon glyphicon-user"></span>
            </center>
            <p>{{Session::get('usuario')}}</p>
          </font>
        </div>
      </div>
      <hr>
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">

        <li><font size="6" color="red" face="Baskerville Old Face">Apartados</font></li>
        <!-- Optionally, you can add icons to the links -->
        <li><a href="{{url('inicio') }}"><font color="white" size="4" face="times new roman"><span class="glyphicon glyphicon-home"></span> -Inicio</font></a></li>

        <li><a href="{{url('libros') }}"><font color="white" size="4" face="times new roman"><span class="glyphicon glyphicon-book"></span> -Libros </font></a></li>

        <li><a href="{{url('prestamos') }}"><font color="white" size="4" face="times new roman"><span class="glyphicon glyphicon-transfer"></span> -Proceso Prestamo</font></a></li>

        <li><a href="{{url('devoluciones') }}"><font color="white" size="4" face="times new roman"><span class="glyphicon glyphicon-refresh "></span> -Libros Prestados</font></a></li>

        <li><a href="{{url('ejemplares') }}"><font color="white" size="4" face="times new roman"><span class="glyphicon glyphicon-list"></span> -Ejemplares</font></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content container-fluid" >

      @yield('contenido')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
   <footer class="main-footer">
      <strong>Copyright &copy; 2014-2019</strong>
      All rights reserved.
    </footer>

  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
@stack('scripts')

<!-- jQuery 3 -->
<script src="adminlte/js/jquery.min.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="adminlte/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="adminlte/js/adminlte.min.js"></script>
<script src="js/toastr.js"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>