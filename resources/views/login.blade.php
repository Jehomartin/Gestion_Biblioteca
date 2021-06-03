@extends('layouts.maker')
@section('titulo','Login')
@section('contenido')

<div id="validar">
  <!-- <h1 style="color: white">@{{saludo}}</h1> -->
  <div class="container">
    <div class="row">
      <center>
        <div class="login-box">
          <img src="img/logos.png" class="avatar">
          <br><br>
          <br><br>
          <h1>Inicia sesión</h1>
          <form action="{{url('entrar')}}" method="POST">
            @csrf

            <font color="gold" face="arial black">
              <p>Usuario</p>
              <input type="text" name="usuario" placeholder="Ingrese su Usuario">
              <br>
              <p>Contraseña</p>
              <input type="password" name="pass" placeholder="Ingrese su Contraseña">
              <br>
            </font>
            <br>
            
            <input type="submit" name="submit" value="Login">

          </form>
        </div>
      </center>
    </div>
  </div>
</div>

@endsection

@push('scripts')
  <!-- <script type="text/javascript" src="js/admin/login.js"></script> -->
  <script type="text/javascript" src="js/toastr.js"></script>
@endpush