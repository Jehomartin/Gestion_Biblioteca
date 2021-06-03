@extends('layouts.layout')
@section('titulo','Ejemplares')
@section('contenido')

<div id="ejemplar">

  	<div class="container">
    	<div class="row">
    		<div class="col-md-3"></div>
      		<div class="col-md-6">
	        	<!-- search form (Optional) -->
	        	<div class="input-group">
	            	<input type="text" name="searchText" class="form-control" placeholder="Buscar..." style="background-color: white" v-model="buscar">
	            	<span class="input-group-btn">
	              		<button type="submit" name="search" id="search-btn" class="btn btn-flat" style="background-color: orange"><i class="fa fa-search"></i>
	              		</button>
	            	</span>
	          	</div>
	        	<!-- /.search form -->
      		</div>
      		<div class="col-md-3"></div>
    	</div>
  	</div>
  	<br>

	<div class="row">
		<div class="col-sm-12">
			<br>
			<h2 class="text text-center">Listado de Ejemplares</h2>
			<table class="table table-hover tabl-condensed table-bordered">
				<thead class="bon">
					<th>FOLIO</th>
					<th>CLASIFICACION</th>
					<th>ESBASE</th>
					<th>PRESTADO</th>
					<th>CONSEC</th>
					<th>FECHA DE ALTA</th>
				</thead>
				<tbody>
					<tr v-for="(ejemplar,index) in filtroEjemplares">
						<td>@{{ejemplar.folio}}</td>
						<td>@{{ejemplar.clasificacion}}</td>
						<td>@{{ejemplar.esbase}}</td>
						<td>@{{ejemplar.prestado}}</td>
						<td>@{{ejemplar.consec}}</td>
						<td>@{{ejemplar.fecha_alta}}</td>
					</tr>
				</tbody>
			</table>
		</div>	
	</div>
</div>

@endsection

@push('scripts')

<script type="text/javascript" src="js/admin/ejemplares.js"></script>
<script type="text/javascript" src="js/vue-resource.js"></script>
<script type="text/javascript" src="js/vue.js"></script>

@endpush