<!DOCTYPE html>
<html lang="en">
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
      <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap-3/bootstrap.min.css"> -->
      <link rel="stylesheet" href="<?php echo e(asset('css/toastr.css')); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('css/carrusel.css')); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('css/personalizados/efectos.css')); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('css/css1/css2.css')); ?>">
    <!-- fin css -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('freelan/vendor/fontawesome-free/css/all.min.css')); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('freelan/css/freelancer.min.css')); ?>">

    <script src="<?php echo e(asset('js/vue/vue.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/vue/vue-resource.min.js')); ?>"></script>

  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
      <!-- Navigation -->
      <nav class="navbar navbar-expand-lg bg-warning text-uppercase fixed-top" id="mainNav">
        <div class="container">
          <a class="navbar-brand js-scroll-trigger" style="color: black;">Universidad Tecnológica del Centro</a>
          <ul class="navbar-nav">
            <li class="nav-item">
              <img src="<?php echo e(asset('img/utc.jpeg')); ?>" class="imagin" style="opacity: .8" width="75px" height="75px">
            </li>
          </ul>
        </div>
      </nav>
      <!-- Portfolio Section -->
      <div class="content-wrapper">
        <section class="page-section">
          <!-- <div class="container"> -->
            <?php echo $__env->yieldContent('contenido'); ?>
          <!-- </div> -->
        </section>
      </div>

      <!-- Footer -->
      <!-- <br>
      <section class="copyright py-4 text-white">
        <div class="container">
          <strong>Gestión Biblioteca <span class="fa fa-book"></span></strong>
          Todos los derechos reservados.
          <div class="float-right d-none d-sm-inline-block">
            <img src="<?php echo e(asset('adminlte/img/utc.png')); ?>" width="20px" height="20px">
            <b>Universidad Tecnológica del Centro</b>
        </div>
        </div>
      </section> -->
      <!-- Fin Footer -->
    </div>
    

    <!--este comando se utiliza para cargar todo tipo de archivo de js-->
    <?php echo $__env->yieldPushContent('scripts'); ?>

    
    <script src="<?php echo e(asset('js/toastr.js')); ?>"></script>
    <script src="<?php echo e(asset('js/sweetalert.min.js')); ?>"></script>

    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo e(asset ('freelan/vendor/jquery/jquery.min.js')); ?>"></script>

    <script src="<?php echo e(asset ('freelan/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>

    <!-- Plugin JavaScript -->
    <script src="<?php echo e(asset('freelan/vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>

    <!-- Contact Form JavaScript -->
    <script src="<?php echo e(asset('freelan/js/jqBootstrapValidation.js')); ?>"></script>
    <!-- Custom scripts for this template -->
    <script src="<?php echo e(asset('freelan/js/freelancer.min.js')); ?>"></script>

  </body>
</html><?php /**PATH C:\wamp64\www\Gestion_Biblioteca\resources\views/layouts/master.blade.php ENDPATH**/ ?>