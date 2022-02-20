@extends('layouts.master')
@section('titulo','Consulta')
@section('contenido')

<!-- inicio div principal -->
<div id="consultar">
	<div class="container">

		<!-- Titulo -->
		<div class="row">
			<div class="col-lg-2"></div>
			<div class="col-lg-8">
				<font face="Sylfaen" color="black">
					<h2 class="text text-center">SECCIÓN DE BUSQUEDA</h2>
				</font>
			</div>
			<div class="col-lg-2">
				<span class="btn btn-primary" @click="help()"><i class="fas fa-question-circle"></i></span>
			</div>
		</div>
		<!-- fin titulo -->

		<!-- div buscar -->
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<!-- search form (Optional) -->
	        	<div class="input-group">
	          		<input type="text" class="form-control" v-model="clave" ref="buscar" v-on:keyup.enter="getConsulta()" placeholder="Buscando título..." style="border-color: black">
	          		<span class="input-group-btn">
	                	<button type="submit" name="search" id="search-btn" class="btn btn-flat" style="background-color: orange" @click="getConsulta()"><i class="fa fa-search"></i>
	                	</button>
	          		</span>
	        	</div>
	        	<!-- /.search form -->
			</div>
			<div class="col-md-2">
				<button class="btn btn-success" @click="NewSearch()">
					<span class="nav-icon fas fa-retweet"></span>
				</button>
			</div>
		</div>
		<!-- fin buscar -->

		<hr>
		<!-- Inicio tabla -->
		<div class="row">
	      <div class="col-lg-12">
	        <table class="table table-striped table-bordered table-responsive">
	          <thead style="background-color: #007bff;">
	            <th width="7%" class="header" scope="col" style="color: #fff;">ISBN</th>
              	<th class="header" scope="col" style="color: #fff;">TÍTULO</th>
              	<th class="header" scope="col" style="color: #fff;">AUTOR</th>
              	<th class="header" scope="col" style="color: #fff;">EDITORIAL</th>
              	<th class="header" scope="col" style="color: #fff;">CARRERA</th>
              	<th width="8%" class="header" scope="col" style="color: #fff;">EJEMPLARES</th>
              	<th class="header" scope="col" style="color: #fff;">CARATULA</th>
	          </thead>
	          <tbody class="table table-bordered">
	            <tr v-for="(b,index) in consultas">
	              <td> @{{b.isbn}} </td>
	              <td> @{{b.titulo}} </td>
	              <td> @{{b.autor.nombre}} </td>
	              <td> @{{b.editorial.editorial}} </td>
	              <td> @{{b.carrera.carrera}} </td>
	              <td> @{{b.ejemplares}} </td>
	              <td>
	              	<div v-if="arraycaratulas.lenght">
	              		<div class="input-group" v-for="image in arraycaratulas">
	              			<a data-fancybox="gallery" v-bind:href="'../../storage/' + image.caratula">
	              				<img v-bind:src="'../../storage/' + image.caratula" class="img-fluid" width="80px" height="80px">
	              			</a>
	              		</div>
	              	</div>
	              </td>
	            </tr>
	          </tbody>          
	        </table>
	      </div>
    	</div>
		<!-- Fin tabla -->

	</div>
</div>
<!-- fin div principal -->

@endsection

@push('scripts')
	<script src="js/datos/busqueda.js"></script>
@endpush