@extends('layouts.maker')
@section('titulo','Login')
@section('contenido')

<div id="validar">
  <!-- <h1 style="color: white">@{{saludo}}</h1> -->
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <form class="login100-form validate-form" action="{{url('entrar')}}" method="POST">

          @if($errors->any())

            <div class="alert alert-danger">
              <ul style="list-style: none;">
                @foreach($errors->all() as $error)
                  <span class="glyphicon glyphicon-warning-sign"></span>
                  <li>{{$error}}</li>
                @endforeach
              </ul>
            </div>

          @endif
          <br>

          @csrf
           <div class="flex-c-m">
            <p class="flex-c-m m-r-5 avatar"><img src="img/logos.png" style="border-radius: 40%;"></p>
          </div>
          <br><br>
          <span class="login100-form-title p-b-43">
            INICIE SESIÓN
          </span>
          
          
          <div class="wrap-input100 validate-input" data-validate = "Usuario requerido para iniciar sesion">
            <input class="input100" type="text" name="usuario">
            <span class="focus-input100"></span>
            <span class="label-input100">Nombre Usuario</span>
          </div>
          
          
          <div class="wrap-input100 validate-input" data-validate="Contraseña requerida para iniciar sesion">
            <input class="input100" type="password" name="pass">
            <span class="focus-input100"></span>
            <span class="label-input100">Contraseña</span>
          </div>
          
          
          <div class="container-login100-form-btn">
            <button class="login100-form-btn" type="submit" name="submit">
              Entrar
            </button>
          </div>
          
          <div class="text-center p-t-46 p-b-20">
            <span class="txt2">
              Gestión Bilioteca <span class="glyphicon glyphicon-book"></span>
            </span>
          </div>

         
        </form>

        <div class="login100-more" style="background-image: url('img/fondos/fondo3.jpeg');">
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
  <!-- <script type="text/javascript" src="js/admin/login.js"></script> -->
  <script type="text/javascript" src="js/toastr.js"></script>
@endpush