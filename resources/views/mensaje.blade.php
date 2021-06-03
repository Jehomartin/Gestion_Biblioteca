@extends('layouts.maker')
@section('titulo','Error')
@section('contenido')
<hr>
<link rel="stylesheet" type="text/css" href="css/mensaje.css">
<div class="container">
	<div class="row fondo">
		<center>
			<font size="10" color="white" face="arial">
			<p>
				Error <span class="glyphicon glyphicon-warning-sign"></span>
			</p>
		</font>
		<font size="8" color="red" face="arial">
			<p>
				El usuario <span class="glyphicon glyphicon-user"></span> y/o <br>
				contraseña  <span class="glyphicon glyphicon-lock"></span> son
				incorrectos, ó dejo alguno de los campos vacíos
			</p>
		</font>
		</center>
		<br>
		<center>
			<a href="{{url('/')}}">
				<input type="button" value="NUEVO INTENTO" align="center">
			</a>
		</center>
		<br><br><br>
	</div>
</div>

@endsection