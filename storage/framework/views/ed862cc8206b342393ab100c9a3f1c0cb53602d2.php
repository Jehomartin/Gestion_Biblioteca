<?php $__env->startSection('titulo','Login'); ?>
<?php $__env->startSection('contenido'); ?>

<div class="contenedor">

  <header>
    <h1 class="text text-center">BIBLIOTECA UTC</h1>
  </header>

  <div class="login">
    <article class="fondo">
      <img src="img/utc.jpeg">
      <font color="white">
        <h3>INICIO DE SESIÓN</h3>
      </font>
      <form class="validate-form" action="<?php echo e(url('entrar')); ?>" method="POST">

      <?php if($errors->any()): ?>

        <div class="alert alert-danger">
          <a class="close" data-dismiss="alert">X</a>
          <ul style="list-style: none;">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>

      <?php endif; ?>

      <?php echo csrf_field(); ?>

        <div class="wrap-input100 validate-input" data-validate = "Usuario requerido para iniciar sesion">
          <input class="input100" type="text" name="usuario" style="font-family: arial black">
          <span class="focus-input100"></span>
          <span class="label-input100" style="color: #fff">Nombre Usuario</span>
        </div>
          
          
        <div class="wrap-input100 validate-input" data-validate="Contraseña requerida para iniciar sesion">
          <input class="input100" type="password" name="pass" style="color: #fff" style="font-family: arial black">
          <span class="focus-input100"></span>
          <span class="label-input100" style="color: #fff">Contraseña</span>
        </div>
        
        <div class="container-login100-form-btn">
          <button class="login100-form-btn" type="submit" name="submit">
            ENTRAR
          </button>
        </div>
        <br>
      </form>
<!--       <div class="col-md-8">
        <a href="<?php echo e(url('ingreso')); ?>">
          <button class="btn btn-primary form-control">
            <font size="3"> REGISTRARSE <i class="glyphicon glyphicon-edit"></i> </font>
          </button>
        </a>
      </div> -->
    </article>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.maker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Gestion_Biblioteca\resources\views/login.blade.php ENDPATH**/ ?>