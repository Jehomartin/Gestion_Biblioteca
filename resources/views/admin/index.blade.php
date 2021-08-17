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

		<!-- <div class="wrapper"> -->
    <div class="slider" id="slider">      
        <ul class="slides">       
            <li class="slide" id="slide1">
                <a href="#">
                    <p class="texto-encima">Ingenieria en Gestiòn y desarrollo de software</p>
                    <img src="login/img/biblio.jpg" alt="photo 1">      
                </a>
            </li>
            <li class="slide" id="slide2">
                <a href="#">
                    <p class="texto-encima"></p>
                    <img src="login/img/fondo.jpeg" alt="photo 2">      
                </a>
            </li>
            <li class="slide" id="slide3">
                <a href="#">
                    <p class="texto-encima"></p>
                    <img src="login/img/libroos.jpg" alt="photo 3">      
                </a>
            </li>
            <li class="slide" id="slide4">
                <a href="#">
                    <p class="texto-encima"></p>
                    <img src="img/2019.jpg" alt="photo 4">      
                </a>
            </li>     
            <li class="slide" id="slide5">
                <a href="#">
                    <p class="texto-encima"></p>
                    <img src="" alt="photo 5">      
                </a>
            </li>             
            <li class="slide">
                <a href="#">
                    <p class="texto-encima"></p>
                    <img src="" alt="photo 1">      
                </a>
            </li>     
        </ul>
        <ul class="slider-controler a">         
            <li><a href="#slide1">&bullet;</a></li>
            <li><a href="#slide2">&bullet;</a></li>
            <li><a href="#slide3">&bullet;</a></li>
            <li><a href="#slide4">&bullet;</a></li>
            <li><a href="#slide5">&bullet;</a></li>
        </ul>
    </div>
</div>
@endsection

@push('scripts')

@endpush