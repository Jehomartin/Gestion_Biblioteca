@extends('layouts.layout')
@section('titulo','Inicio')
@section('contenido')
<div class="container">
	<font color="orange" face="times new roman" class="text text-center">
		<h1>Gestión bibliotecaria.</h1>
		<h2>Bienvenido {{Session::get('usuario')}}</h2>
		<hr>
		<h3>
			En el lado izquierdo podra encontrar el menú, en donde se encuentran los apartados en los que <br> podra navegar para realizar la funcion deseada y observar la información deseada.
		</h3>
	</font>
	<br>

	<center><img src="img/fondos/fondo.jpeg" width="700" height="500"></center>

</div>
@endsection

@push('scripts')

@endpush