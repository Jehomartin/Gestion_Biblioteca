<!DOCTYPE html>
<html lang="en">
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
    <!-- fin css -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('freelan/vendor/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('freelan/css/freelancer.min.css') }}">

    <script src="{{ asset('js/vue/vue.min.js') }}"></script>
    <script src="{{ asset('js/vue/vue-resource.min.js') }}"></script>

  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
      <!-- Navigation -->
      <nav class="navbar navbar-expand-lg bg-warning text-uppercase fixed-top" id="mainNav">
        <div class="container">
          <a class="navbar-brand js-scroll-trigger" style="color: black;">Universidad Tecnológica del Centro</a>
          <ul class="navbar-nav">
            <li class="nav-item">
              <img src="{{ asset('img/utc.jpeg') }}" class="imagin" style="opacity: .8" width="75px" height="75px">
            </li>
          </ul>
        </div>
      </nav>
      <!-- Portfolio Section -->
      <div class="content-wrapper">
        <section class="page-section">
          <!-- <div class="container"> -->
            @yield('contenido')
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
            <img src="{{ asset('adminlte/img/utc.png') }}" width="20px" height="20px">
            <b>Universidad Tecnológica del Centro</b>
        </div>
        </div>
      </section> -->
      <!-- Fin Footer -->
    </div>
    

    <!--este comando se utiliza para cargar todo tipo de archivo de js-->
    @stack('scripts')

    
    <script src="{{ asset('js/toastr.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset ('freelan/vendor/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset ('freelan/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Plugin JavaScript -->
    <script src="{{ asset('freelan/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Contact Form JavaScript -->
    <script src="{{ asset('freelan/js/jqBootstrapValidation.js') }}"></script>
    <!-- Custom scripts for this template -->
    <script src="{{ asset('freelan/js/freelancer.min.js') }}"></script>

  </body>
</html>