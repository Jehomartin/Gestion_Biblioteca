@extends('layouts.maker')
@section('titulo','Login')
@section('contenido')

<div class="contenedor">

  <header>
    <h1 class="text text-center">BIBLIOTECA UTC</h1>
  </header>

  <div class="login">
    <article class="fondo">
      <img src="img/utc.jpeg">
      <font color="white">
        <h3>Inicio de Sesión</h3>
      </font>
      <form class="validate-form" action="{{url('entrar')}}" method="POST">

      @if($errors->any())

        <div class="alert alert-danger">
          <a class="close" data-dismiss="alert">X</a>
          <ul style="list-style: none;">
            @foreach($errors->all() as $error)
              <li>{{$error}}</li>
            @endforeach
          </ul>
        </div>

      @endif

      @csrf

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
            Entrar
          </button>
        </div>
      </form>
    </article>
  </div>
</div>
@endsection