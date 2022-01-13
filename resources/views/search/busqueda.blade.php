@extends('layouts.master')
@section('titulo','Consulta')
@section('contenido')

<!-- Titulo -->
<div class="container">
	<div class="row">
		<div class="col-lg-2"></div>
		<div class="col-lg-8">
			<font face="Sylfaen" color="black">
				<h2 class="text text-center">SECCIÓN DE BUSQUEDA</h2>
				<!-- <h5 style="font-family: Sylfaen;"><span class="asterisco">*</span> </h5> -->
			</font>
		</div>
		<div class="col-lg-2">
			<span class="btn btn-primary"><i class="nav-icon fas fa-info"></i></span>
		</div>
	</div>
</div>
<!-- fin titulo -->

<!-- inicio div principal -->
<div id="consultar">
	<!-- div buscar -->
	<div class="container">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<!-- search form (Optional) -->
            	<div class="input-group">
              		<input type="text" class="form-control" v-model="codigo" ref="buscar" v-on:keyup.enter="getLibros()" placeholder="Buscar..." style="border-color: black">
              		<span class="input-group-btn">
	                	<button type="submit" name="search" id="search-btn" class="btn btn-flat" style="background-color: orange" @click="getLibros()"><i class="fa fa-search"></i>
	                	</button>
              		</span>
            	</div>
            	<!-- /.search form -->
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
	<!-- fin buscar -->

	<hr>

	<div class="container">
		<div class="row">
			<div class="col-lg-2">
				
			</div>
		</div>
	</div>
	
</div>
<!-- fin div principal -->

@endsection

@push('scripts')

@endpush