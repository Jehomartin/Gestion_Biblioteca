<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>@yield('titulo')</title>
    <meta name="viewport" content="width=device-width"></meta>
    <meta name="token" id="token" value="{{ csrf_token() }}">
    <meta name="route" value="{{url('/')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
      <link rel="shortcut icon" type="image/x-icon" href="img/logos.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/color.css">
    <link rel="stylesheet" href="css/toastr.css">
    <link rel="stylesheet" type="text/css" href="css/style_login.css">
    <link rel="stylesheet" href="css/logeo.css">

    
    
    <script type="text/javascript" src="js/vue-resource.js"></script>
    
    <!-- <script type="text/javascript" src="js/bootstrap-dropdown.js"></script> -->

  </head>
  <body>
    
   <!--este comando se utiliza para cargar todo tipo de archivo de html-->
    @yield('contenido')
    


    <!--este comando se utiliza para cargar todo tipo de archivo de js-->
    @stack('scripts')
    <script src="js/toastr.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery.min.js"></script>
  </body>
</html>