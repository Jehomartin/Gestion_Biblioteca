@extends('layouts.maker')
@section('titulo','Ingreso')
@section('contenido')

<div class="contenedor">
	<header class="header">
		<h1 class="text text-center">UNIVERSIDAD TECNOLÓGICA DEL CENTRO</h1>
	</header>
	<hr>	
	<div class="container">
		<div class="row">
			<font color="black" face="Sylfaen" size="">
				<h2 class="text text-center">¿USTED DESEA INGRESAR CÓMO?</h2>
			</font>

			<hr>

			<div class="col-md-6">
				<a href="{{url('buscar')}}">
					<button class="btn btn-success form-control" style="height: 100px;">
						<font color="black" face="Sylfaen" size="10px">
							ALUMNO
						</font>
					</button>
				</a>
			</div>
			<div class="col-md-6">
				<a href="{{url('/')}}">
					<button class="btn btn-primary form-control" style="height: 100px;">
						<font color="black" face="Sylfaen" size="10px">
							BIBLIOTECARIO
						</font>
					</button>
				</a>
			</div>
		</div>
	</div>
</div>

@endsection