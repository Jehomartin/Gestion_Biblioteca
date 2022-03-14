@extends('layouts.master')
@section('titulo','Ajustes')
@section('contenido')

<div id="config">
	<div class="container">
		<!-- Titulo -->
		<div class="row">
			<div class="col-lg-2">
				<a href="{{url('inicio')}}" class="btn btn-warning">
					<i class="fas fa-arrow-left"> Regresar</i>
				</a>
			</div>
			<div class="col-lg-8">
				<font face="Sylfaen" color="black">
					<h3 class="text text-center">SECCIÓN DE AJUSTES</h3>
				</font>
			</div>
		</div>
		<!-- fin titulo -->
		<hr>
	</div>

	<div class="container">
		<!-- Inicio div datos1 -->
		<div class="row">
			<div class="col-md-6">
				<!--Configurar multa-->
        <div class="card direct-chat direct-chat-warning">
        	<!-- card header -->
          <div class="card-header" style="background-color: #28a745;">
          	<h5 class="card-title text text-center" style="color: black;">CONFIGURAR MULTA</h5>
          </div>
          <!--/header-->

          <!--card body-->
          <div class="card-body">
          	<div class="row">
          		<div class="col-lg-8"></div>
          		<div class="col-md-2">
          			<button class="btn btn-primary form-control" @click="Modalmulta">
          				<i class="fas fa-plus-circle"></i>
          			</button>
          		</div>
          	</div>
          	<br>
          	
          	<table class="table table-sm table-striped table-bordered table-hover tamanio-font">
          		<thead class="thead-dark text text-center">
          			<th>CLave</th>
          			<th>Cantidad multa</th>
          			<th>Activo</th>
          			<th>Opciones</th>
          		</thead>
          		<tbody>
          			<tr v-for="multa in arraymultas" class="text text-center">
          				<td> @{{multa.id_multas}} </td>
          				<td>$ @{{multa.precio}} </td>
          				<td> @{{multa.vigente}} </td>
	          			<td>
	          				<span class="btn btn-danger" @click="editMulta(multa.id_multas)">
	          					<i class="fas fa-edit"></i>
	          				</span>
	          			</td>
          			</tr>
          		</tbody>
          	</table>
          </div>
          <!--/body-->
      	</div>
      	<!--/configurar multa-->
			</div>
			<div class="col-md-6">
				<!-- config -->
                <div class="card direct-chat direct-chat-warning">
                  <!-- card header -->
                  <div class="card-header" style="background-color: #28a745;">
                  	<h5 class="card-title text text-center" style="color: black;">CONFIGURAR</h5>
                  </div>
                  <!-- /card header -->

                  <!--card body-->
                  <div class="card-body">
                  	<table class="table table-sm table-striped table-bordered table-hover tamanio-font">
                  		<thead class="thead-dark">
                  			<th>CLave</th>
                  			<th>Cantidad multa</th>
                  			<th>Opciones</th>
                  		</thead>
                  		<tbody>
                  			<td>1</td>
                  			<td>$200.00</td>
                  			<td>
                  				<span class="btn btn-primary">
                  					<i class="fas fa-edit"></i>
                  				</span>
                  			</td>
                  		</tbody>
                  	</table>
                  </div>
                  <!--/card body-->
              </div>
			</div>
		</div>
		<!-- /div datos1 -->
	</div>

	<!-- inicio div modal -->
	<div id="modal_multa" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<!-- modal header -->
				<div class="modal-header" style="background-color: #f39c12;">
					<h5 class="modal-title" id="exampleModalLiveLabel" v-if="editmulta">
						<font style="vertical-align: inherit;" face="Sylfaen" color="black">DESACTIVANDO MULTA</font>
					</h5>
					<h5 class="modal-title" v-if="!editmulta" id="exampleModalLiveLabel">
						<font style="vertical-align: inherit;" face="Sylfaen" color="black">NUEVA MULTA</font>
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="cancelar()">
          	<span aria-hidden="true">
            		<font style="vertical-align: inherit;">x</font>
          	</span>
	        </button>
				</div>
				<!-- /modal header -->

				<!-- body -->
				<div class="modal-body div5">
					<font face="Sylfaen" color="black">
						<div class="form-group" v-if="editmulta">
							<label>CLAVE</label>
							<div class="input-group">
								<span class="form-control" style="border-color: #000;" v-if="editmulta"> @{{id_multas}} </span>
							</div>
						</div>
						<div class="form-group">
							<label>PRECIO</label>
							<div class="input-group">
								<span class="form-control" style="border-color: #000;" v-if="editmulta"> @{{precio}} </span>
								<input type="text" name="" placeholder="Ingrese el precio de la multa" v-model="precio" v-if="!editmulta" style="border-color: black;" class="form-control">
							</div>
						</div>
						<div class="form-group" v-if="editmulta">
							<label>VIGENCIA</label>
							<div class="input-group">
								<span class="form-control" style="border-color: black;" > @{{vigente}} </span>
							</div>
						</div>
					</font>
				</div> <!-- /body -->

				<!-- footer -->
				<div class="modal-footer" style="background-color: #f39c12;">
					<div class="pull-right">
						<button style="margin-left: 10px" type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="cancelar()">CERRAR</button>
					</div>
          <div class="pull-right">
              <button style="margin-left: 10px" type="button" class="btn btn-primary" data-dismiss="modal" v-on:click="NewMulta()" v-if="!editmulta">
              	GUARDAR <span class="fas fa-save"></span>
              </button>
              <button style="margin-left: 10px;" class="btn btn-warning" data-dismiss="modal" v-on:click="DesactivarMul(auxmulta)" v-if="editmulta">
              	DESACTIVAR<i class="fas fa-skull"></i>
              </button>
          </div>
				</div> <!-- /footer -->
			</div>
		</div>
	</div>
	<!-- /div modal -->
</div>
@endsection

@push('scripts')
	<script src="js/configs/configuracion.js"></script>
@endpush