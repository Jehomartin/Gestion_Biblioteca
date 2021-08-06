@extends('layouts.layout')
@section('titulo','Inicio')
@section('contenido')
<div class="container">
	<font color="black" face="times new roman" class="text text-center">
		<h1>Gestión bibliotecaria.</h1>
		<h2>Bienvenido {{Session::get('usuario')}}</h2>
		<hr>
		<h3>
			En el lado izquierdo podra encontrar el menú, en donde se encuentran los apartados en los que <br> podra navegar para realizar la funcion deseada y observar la información deseada.
		</h3>
	</font>
	<br>

	<!-- <center><img src="img/fondos/fondo.jpeg" width="700" height="500"></center> -->
	<center>
		<div class="estado">
			<div class="carrusel">
				<div class="imagenes_efecto" >
					<figure>
						<h3>UTC</h3>
						<img src="img/fondos/fondo.jpeg">
					</figure>
					<figure>
						<h3>PASTELES DE BODA </h3>
						<img src="img/art/b.jpg">
					</figure>
					<figure>
						<h3>PASTELES DE XV AÑOS </h3>
						<img src="img/art/3.jpg">
					</figure>
					<figure>
						<h3>PASTELES PERSONALIZADOS</h3>
						<img src="img/art/IMG-20190805-WA0042.jpg">
					</figure>
					<figure>
						<h3>PASTELES DE BAUTIZO</h3>
						<img src="img/art/IMG-20190805-WA0027.jpg">
					</figure>
				</div>
			</div>
		</div>
	</center>

</div>
@endsection

@push('scripts')

@endpush