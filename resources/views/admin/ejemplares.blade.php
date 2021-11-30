@extends('layouts.layout')
@section('titulo','Ejemplares')
@section('contenido')

<div id="ejemplar">

  	<div class="container">
    	<div class="row">
    		<div class="col-md-3"></div>
      		<div class="col-md-6">
      			<br>
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

  	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="text text-center">Listado de Ejemplares</h2>
				<table class="table table-sm table-striped table-bordered table-hover">
					<thead class="thead-dark">
						<th>FOLIO</th>
						<th>CLASIFICACION</th>
						<th>ESBASE</th>
						<th>PRESTADO</th>
						<th>CONSEC</th>
						<th>FECHA ALTA</th>
						<th>OPCIONES</th>
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
								<span class="btn btn-primary nav-icon fas fa-edit" v-on:click="editEjemplar(ejemplar.clasificacion)"></span>
								<span class="btn btn-danger fas fa-trash-alt" v-on:click="eliminarEjemplar(ejemplar.clasificacion)"></span>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<!-- inicio ventana modal -->
	  		 <div id="modal_custo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="addlibro">
			      <!--inicio modal dialog-->
			      <div class="modal-dialog" role="document">
			        <!--inicio modal content-->
			        <div class="modal-content">
				        <!-- se inicia el encabezado de la ventana modal -->
				        <div class="modal-header" style="background-color: #f39c12">
			              <h5 class="modal-title" id="exampleModalLiveLabel" v-if="editejem"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Editando Ejemplar</font></font></h5>
			              
			              <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="cancelEditj()">
			                <span aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></span>
			              </button>
			              <!-- <span aria-hidden="true">&times;</span> -->
			            </div>
		        		<!-- fin encabezado de ventana modal -->

				        <!-- inicio cuerpo modal -->
				        <div class="modal-body div1">
				        	<label for="clasificacion">Clasificación del ejemplar</label>
                			<input type="text" name="" placeholder="clasificacion del ejemplar" class="form-control" v-model='clasificacion'>

				          <label for="folio">Folio del Libro</label>
				          <input type="text" name="" placeholder="folio del libro" class="form-control" v-model="folio">

				          <label for="esbase">Identificador de base del ejemplar</label>
				          <input type="text" name="" placeholder="identificador de base" class="form-control" v-model="esbase">

				          <label for="prestado">Indicador de prestamo de ejemplar</label>
				          <input type="text" name="" placeholder="identificador de prestamo" class="form-control" v-model="prestado">

				          <label for="comentario">Comentario sobre el ejemplar</label>
				          <input type="text" placeholder="Comentario sobre el ejemplar" class="form-control" v-model="comentario">

				          <label for="consec">Consecuente del libro</label>
				          <input type="text" name="" placeholder="Consec" class="form-control" v-model="consec">

				          <label for="fecha_alta">Fecha de alta del ejemplar</label>
				          <input type="date" name="" placeholder="Fecha de Alta" class="form-control" v-model="fecha_alta">

				          <label for="solodewee">Solo dewee del ejemplar</label>
			              <input type="text" name="" placeholder="Solo Dewee" class="form-control" v-model="solodewee">

			              <label for="deweecompleto"> Dewee Completo</label>
			              <input type="text" name="" placeholder="Dewee completo" class="form-control" v-model="deweecompleto">
				        </div><!-- fin cuerpo modal -->

				        <!-- footer modal -->
				        <div class="modal-footer div1">
				        	<div class="pull-right">
				                <button style="margin-left: 10px" type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="cancelEditj()">Cancelar</button>
				            </div>
				          
				          <button type="submit" class="btn btn-primary" v-on:click="updateEjem(auxEjemplar)" v-if="editejem">Actualizar</button>
			       		</div><!-- fin footer modal -->
			    	</div> <!--fin modal content-->
				</div><!--/modal dialog-->
			</div><!--fin ventana modal-->
		</div>
	</div>
</div>

@endsection

@push('scripts')
	<script type="text/javascript" src="js/datos/ejemplares.js"></script>
@endpush