<!DOCTYPE html>
<html lang="en">
  <head>
    <title>@yield('titulo')</title>
    <meta name="token" id="token" value="{{csrf_token()}}">
    <link rel="shortcut icon" type="image/x-icon" href="img/utc.jpeg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="login/estilos.css">
    <link rel="stylesheet" href="login/fonts.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-3/bootstrap.min.css">

  <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/css/util.css">
    <link rel="stylesheet" type="text/css" href="login/css/main.css">
  <!--===============================================================================================-->

  
  </head>
  <body>
    
    @yield('contenido')


    <!--===============================================================================================-->
      <script src="login/vendor/jquery/jquery-3.2.1.min.js"></script>
      <script src="js/bootstrap-3/bootstrap.min.js"></script>
    <!--===============================================================================================-->
      <script src="login/js/main.js"></script>
  </body>
</html>