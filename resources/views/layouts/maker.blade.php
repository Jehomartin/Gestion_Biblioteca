<!DOCTYPE html>
<html>
  <head>
    <title>@yield('titulo')</title>
    <meta name="token" id="token" value="{{csrf_token()}}">
    <meta name="route" value="{{url('/')}}" id="route">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/utc.jpeg') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('login/estilos.css')}}">
    <link rel="stylesheet" href="{{ asset('login/fonts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-3/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/personalizados/color.css') }}">
    <link rel="stylesheet" href="{{ asset('css/personalizados/efectos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css1/css2.css') }}">

  <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('login/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
  <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('login/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('login/css/main.css')}}">
  <!--===============================================================================================-->

    <script src="{{ asset('js/vue/vue.min.js') }}"></script>
    <script src="{{ asset('js/vue/vue-resource.min.js') }}"></script>
  
  </head>
  <body>
    <div class="container">
      <div class="col-lg-12">
        @yield('contenido')
      </div>
    </div>

    @stack('scripts')
    <!--===============================================================================================-->
      <script src="{{ asset('login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
      <script src="{{ asset('js/bootstrap-3/bootstrap.min.js')}}"></script>
    <!--===============================================================================================-->
      <script src="{{asset('login/js/main.js')}}"></script>
      <script src="{{ asset('js/toastr.js') }}"></script>
      <script src="{{ asset('js/sweetalert.min.js') }}"></script>
  </body>
</html>