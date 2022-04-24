<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $__env->yieldContent('titulo'); ?></title>
  <meta name="token" id="token" value="<?php echo e(csrf_token()); ?>">
  <meta name="route" value="<?php echo e(url('/')); ?>" id="route">
  
  <!-- icono de la pagina -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('img/utc.jpeg')); ?>">
  <!-- fin icono -->

  <!-- css colocados a parte -->
    <link rel="stylesheet" href="<?php echo e(asset('css/personalizados/logeo.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/personalizados/color.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/toastr.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/carrusel.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/personalizados/efectos.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/css1/css2.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('select2/dist/css/select2.min.css')); ?> ">
  <!-- fin css -->
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/fontawesome-free/css/all.min.css')); ?>">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')); ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/jqvmap/jqvmap.min.css')); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('adminlte/dist/css/adminlte.min.css')); ?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')); ?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/daterangepicker/daterangepicker.css')); ?>">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/summernote/summernote-bs4.css')); ?>">

  <script src="<?php echo e(asset('js/vue/vue.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/vue/vue-resource.min.js')); ?>"></script>
  
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
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo e(url('ajustes')); ?>" class="nav-link">
          <font size="5" color="black"><i class="nav-icon fas fa-cogs"></i></font>
          <!-- Ajustes -->
        </a>
      </li> 
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
         <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo e(asset('img/user.png')); ?>" width="30" height="30">
              <!-- <span class="hidden-xs"><font color="black"><?php echo e(Session::get('usuario')); ?></font></span> -->
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header" style="background-color: gray">
              <!--   <img src="img/<?php echo e(Session::get('photo')); ?>" class="img-circle" alt="User Image"> -->
              <font color="white">
                  <h1><span class="fas fa-user"></span></h1>
                  <p>
                    <?php echo e(Session::get('usuario')); ?> - <?php echo e(Session::get('puesto')); ?>

                  </p>
                </font>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer" style="background-color: black">
                <div class="pull-right">
                  <a href="<?php echo e(url('sale')); ?>" class="btn btn-danger">
                    Salir <i class="nav-icon fas fa-sign-out-alt"></i>
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
      <img src="<?php echo e(asset('img/utc.jpeg')); ?>" class="brand-image img-circle elevation-3" style="opacity: .8">
      <font face="Arial black"><span class="brand-text font-weight-light">UTC</span></font>
    </a></font>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo e(asset('img/user.png')); ?>" class="img-circle elevation-2">
        </div>
        <div class="info">
          <font size="2" color="yellow">
            <p><?php echo e(Session::get('usuario')); ?></p>
          </font>
        </div>        
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo e(url('inicio')); ?>" class="nav-link <?php echo e(Request::is('inicio') ? 'active' : ''); ?>">
              <font color="white" size="4" face="times new roman">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Inicio
                </p>
              </font>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?php echo e(Request::is('libros') ? 'active' : ''); ?>  <?php echo e(Request::is('registro') ? 'active' : ''); ?>">
              <i class="nav-icon fas fa-list"></i>
              <p>
                <font color="white" size="4" face="times new roman"> Apartado Libros </font>
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(url('libros')); ?>" class="nav-link <?php echo e(Request::is('libros') ? 'active' : ''); ?>">
                  <i class="nav-icon fas fa-book"></i>
                  <font color="orange" size="4" face="times new roman">
                    <p>
                      Libros
                    </p>
                  </font>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo e(url('registro')); ?>" class="nav-link <?php echo e(Request::is('registro') ? 'active' : ''); ?>">
                  <i class="nav-icon fas fa-pencil-alt"></i>
                  <font color="orange" size="4" face="times new roman">
                    <p>
                      Registro Libro
                    </p>
                  </font>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?php echo e(Request::is('prestamos') ? 'active' : ''); ?>  <?php echo e(Request::is('devoluciones') ? 'active' : ''); ?>">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>
                <font color="white" size="4" face="times new roman"> Procesos </font>
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(url('prestamos')); ?>" class="nav-link <?php echo e(Request::is('prestamos') ? 'active' : ''); ?>">
                  <i class="nav-icon fas fa-exchange-alt"></i>
                  <font color="orange" size="4" face="times new roman">
                    <p>
                      Proceso Préstamo
                    </p>
                  </font>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo e(url('devoluciones')); ?>" class="nav-link <?php echo e(Request::is('devoluciones') ? 'active' : ''); ?>">
                  <i class="nav-icon fas fa-file-import"></i>
                  <font color="orange" size="4" face="times new roman">
                    <p>
                      Proceso Devolución
                    </p>
                  </font>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="<?php echo e(url('historial')); ?>" class="nav-link <?php echo e(Request::is('historial') ? 'active' : ''); ?>">
              <font color="white" size="4" face="times new roman">
                <i class="nav-icon fas fa-history"></i>
                <p>
                  Libros prestados
                </p>
              </font>
            </a>
          </li>

          <!-- <li class="nav-item">
            <a href="<?php echo e(url('ajustes')); ?>" class="nav-link <?php echo e(Request::is('ajustes') ? 'active' : ''); ?>">
              <font color="white" size="4" face="times new roman">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                  Configuración
                </p>
              </font>
            </a>
          </li> -->

          <li class="nav-item">
            <a href="<?php echo e(url('adeudos')); ?>" class="nav-link <?php echo e(Request::is('adeudos') ? 'active' : ''); ?>">
              <font color="white" size="4" face="times new roman">
                <i class="nav-icon fas fa-file-invoice-dollar"></i>
                <p>
                  Adeudos
                </p>
              </font>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content container-fluid" >

      <?php echo $__env->yieldContent('contenido'); ?>

    </section>
    
  </div>
  <!-- /.content-wrapper -->

 <!-- Main Footer -->
   <footer class="main-footer">
      <strong>Gestión Biblioteca <span class="fa fa-book"></span></strong>
      Todos los derechos reservados.
      <div class="float-right d-none d-sm-inline-block">
        <img src="<?php echo e(asset('adminlte/img/utc.png')); ?>" width="20px" height="20px">
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

<?php echo $__env->yieldPushContent('scripts'); ?>

<!-- jQuery 3 -->
<script src="<?php echo e(asset('adminlte/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery/jquery-3.3.1.min.js')); ?>"></script>
<!-- Bootstrap 3.3.7 -->
<!-- <script src="adminlte/js/bootstrap.min.js"></script> -->
<!-- AdminLTE App -->
<script src="<?php echo e(asset('adminlte/js/adminlte.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/toastr.js')); ?>"></script>
<script src="<?php echo e(asset('js/sweetalert.min.js')); ?>"></script>
<script src="<?php echo e(asset('select2/dist/js/select2.min.js')); ?> "></script>

<!-- jQuery -->
<script src="<?php echo e(asset('adminlte/plugins/jquery/jquery.min.js')); ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo e(asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<!-- ChartJS -->
<script src="<?php echo e(asset('adminlte/plugins/chart.js/Chart.min.js')); ?>"></script>
<!-- daterangepicker -->
<script src="<?php echo e(asset('adminlte/plugins/moment/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/daterangepicker/daterangepicker.js')); ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo e(asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')); ?>"></script>
<!-- Summernote -->
<script src="<?php echo e(asset('adminlte/plugins/summernote/summernote-bs4.min.js')); ?>"></script>
<!-- overlayScrollbars -->
<script src="<?php echo e(asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('adminlte/dist/js/adminlte.js')); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo e(asset('adminlte/dist/js/demo.js')); ?>"></script>
</body>
</html>
<?php /**PATH C:\wamp64\www\Gestion_Biblioteca\resources\views/layouts/layout.blade.php ENDPATH**/ ?>