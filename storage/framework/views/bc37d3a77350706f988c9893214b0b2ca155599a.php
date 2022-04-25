<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $__env->yieldContent('titulo'); ?></title>
    <meta name="token" id="token" value="<?php echo e(csrf_token()); ?>">
    <meta name="route" value="<?php echo e(url('/')); ?>" id="route">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('img/utc.jpeg')); ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?php echo e(asset('login/estilos.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('login/fonts.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/bootstrap-3/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/personalizados/color.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/personalizados/efectos.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/css1/css2.css')); ?>">

  <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('login/fonts/font-awesome-4.7.0/css/font-awesome.min.css')); ?>">
  <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('login/css/util.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('login/css/main.css')); ?>">
  <!--===============================================================================================-->

    <script src="<?php echo e(asset('js/vue/vue.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/vue/vue-resource.min.js')); ?>"></script>
  
  </head>
  <body>
    <div class="container">
      <div class="col-lg-12">
        <?php echo $__env->yieldContent('contenido'); ?>
      </div>
    </div>

    <?php echo $__env->yieldPushContent('scripts'); ?>
    <!--===============================================================================================-->
      <script src="<?php echo e(asset('login/vendor/jquery/jquery-3.2.1.min.js')); ?>"></script>
      <script src="<?php echo e(asset('js/bootstrap-3/bootstrap.min.js')); ?>"></script>
    <!--===============================================================================================-->
      <script src="<?php echo e(asset('login/js/main.js')); ?>"></script>
      <script src="<?php echo e(asset('js/toastr.js')); ?>"></script>
      <script src="<?php echo e(asset('js/sweetalert.min.js')); ?>"></script>
  </body>
</html><?php /**PATH C:\wamp64\www\Gestion_Biblioteca\resources\views/layouts/maker.blade.php ENDPATH**/ ?>