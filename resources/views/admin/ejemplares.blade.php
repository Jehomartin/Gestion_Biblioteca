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
					<th>Folio</th>
					<th>Clasificación</th>
					<th>Esbase</th>
					<th>Prestado</th>
					<th>Consec</th>
					<th>Fecha de alta</th>
					<th>Opciones</th>
				</thead>
				<tbody>
					<tr v-for="(ejemplar,index) in filtroEjemplares">
						<td>@{{ejemplar.folio}}</td>
						<td>@{{ejemplar.clasificacion}}</td>
						<td>@{{ejemplar.esbase}}</td>
						<td>@{{ejemplar.prestado}}</td>
						<td>@{{ejemplar.consec}}</td>
						<td>@{{ejemplar.fecha_alta}}</td>
						<td>
							<span class="btn btn-primary glyphicon glyphicon-pencil" v-on:click="editEjemplar(ejemplar.clasificacion)"></span>
							<span class="btn btn-danger glyphicon glyphicon-trash" v-on:click="eliminarEjemplar(ejemplar.clasificacion)"></span>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- inicio ventana modal -->
  		<div class="modal fade" tabindex="-1" role="dialog" id="addejemplar">
		    <!--inicio modal dialog-->
		    <div class="modal-dialog" role="document">
		      <!--inicio modal content-->
		      	<div class="modal-content">
			        <!-- se inicia el encabezado de la ventana modal -->
			        <div class="modal-header div1">
			          <button type="button" class="close" data-dismiss="modal" aria-label="close" v-on:click="cancelEditj()"><span aria-hidden="true">X</span></button>
			          <h4 class="modal-title" v-if="editejem">Editando Ejemplar</h4>
			        </div>
	        		<!-- fin encabezado de ventana modal -->

			        <!-- inicio cuerpo modal -->
			        <div class="modal-body div1">
			          <input type="text" name="" placeholder="clasificacion del ejemplar" class="form-control" v-model='clasificacion'>
			          <input type="text" name="" placeholder="folio del libro" class="form-control" v-model="folio">
			          <input type="text" name="" placeholder="identificador de base" class="form-control" v-model="esbase">
			          <input type="text" name="" placeholder="identificador de prestamo" class="form-control" v-model="prestado">
			          <input type="text" placeholder="Comentario sobre el ejemplar" class="form-control" v-model="comentario">
			          <input type="text" name="" placeholder="Consec" class="form-control" v-model="consec">
			          <input type="date" name="" placeholder="Fecha de Alta" class="form-control" v-model="fecha_alta">
			          <input type="text" name="" placeholder="Solo Dewee" class="form-control" v-model="solodewee">
			          <input type="text" name="" placeholder="Dewee completo" class="form-control" v-model="deweecompleto">
			        </div><!-- fin cuerpo modal -->

			        <!-- footer modal -->
			        <div class="modal-footer div1">
			          <font face="arial black" color="red">
			          	<h6>Clasificación : @{{clasificacion}} </h6>
			            <h6>Folio : @{{folio}} </h6>
			            <h6>Es Base : @{{esbase}} </h6>
			            <h6>Prestado : @{{prestado}} </h6>
			            <h6>Comentario : @{{comentario}} </h6>
			            <h6>Consec : @{{consec}} </h6>
			            <h6>Fecha Alta : @{{fecha_alta}} </h6>
			            <h6>Solo Dewee : @{{solodewee}} </h6>
			            <h6>Dewee completo : @{{deweecompleto}} </h6>
			          </font>
			          <button type="button" class="btn btn-default" data-dismiss="modal" v-on:click="cancelEditj()">Cancelar</button>
			          <button type="submit" class="btn btn-primary" v-on:click="updateEjem(auxEjemplar)" v-if="editejem">Actualizar</button>
		       		</div><!-- fin footer modal -->
		    	</div> <!--fin modal content-->
			</div><!--/modal dialog-->
		</div><!--fin ventana modal-->
</div>
</div>

@endsection

@push('scripts')
	<script type="text/javascript" src="js/admin/ejemplares.js"></script>
	<script type="text/javascript" src="js/vue-resource.js"></script>
	<script type="text/javascript" src="js/vue.js"></script>
@endpush