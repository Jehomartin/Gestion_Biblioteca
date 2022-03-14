@extends('layouts.layout')
@section('titulo','Adeudos')
@section('contenido')
<!-- Div principal -->
<div id="adeudar">
	<div class="container">
		<div class="row">
			<!-- Inicio titulo -->
			<div class="col-lg-12">
				<font color="black" face="Sylfaen">
					<h2 class="text text-center">SECCIÓN DE ADEUDOS</h2>
				</font>
			</div>
			<!-- @{{saludo}} -->
			<!-- /titulo -->
		</div>
		<br>
		<!-- Inicio search -->
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="input-group">
        			<input type="text" name="searchText" class="form-control find" placeholder="Buscar alumno..." v-model="buscar" style="border-color: black">
          			<span class="input-group-btn">
            			<button type="submit" name="search" id="search-btn" class="btn btn-flat" style="background-color: orange"><i class="fa fa-search"></i>
            			</button>
          			</span>
        		</div>
			</div>
			<div class="col-md-3"></div>
		</div>
		<!-- /search -->
	</div>
	<br>
	<!-- Div tabla -->
	<div class="row">
		<div class="col-sm-12">
        	<div class="row">
          		<div class="col-md-12">
            		<div class="table-responsive-md">
              			<table class="table table-sm table-striped table-bordered table-hover tamanio-font">
              				<thead class="thead-dark text text-center">
              					<th width="10%">Clave</th>
              					<th width="10%">Matricula</th>
              					<th width="20%">Nombre(s)</th>
              					<th width="20%">Apellidos</th>
              					<th width="20%">Carrera</th>
              					<th width="10%">Deuda</th>
              					<th>Opciones</th>
              				</thead>
              				<tbody class="text text-center">
              					<tr v-for="(adeudo,index) in filtroDeudas">
              						<td> @{{adeudo.id_adeudos}} </td>
              						<td> @{{adeudo.matricula}} </td>
              						<td> @{{adeudo.alumno.nombre}} </td>
              						<td> @{{adeudo.alumno.apellidos}} </td>
              						<td> @{{adeudo.career.nombre_carrera}} </td>
              						<td> @{{adeudo.total}} </td>
	              					<td>
	              						<span class="btn btn-danger" @click="infoAdeudo(adeudo.id_adeudos)">
	              							<i class="fas fa-eye"></i>
	              						</span>
	              					</td>
              					
              					</tr>
              				</tbody>
              			</table>
              		</div>
              	</div>
            </div>
        </div>
	</div>
	<!-- /tabla -->

	<!-- Div modal -->
	<div id="modal_adeudo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<!-- modal dialog -->
		<div class="modal-dialog" role="document">
			<!-- modal content -->
			<div class="modal-content">
				<!-- modal header -->
				<div class="modal-header" style="background-color: #f39c12">
					<h5 class="modal-title" id="exampleModalLiveLabel" v-if="editando">
	                	<font style="vertical-align: inherit;" face="Sylfaen" color="black">INFORMACIÓN DE LA DEUDA</font>
	              	</h5>
	              	<h5 class="modal-title" id="exampleModalLiveLabel" v-if="!editando">
	                	<font style="vertical-align: inherit;" face="Sylfaen" color="black">PAGANDO DEUDA</font>
	              	</h5>
	              	<button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="cancelar()">
	                	<span aria-hidden="true">
	                  		<font style="vertical-align: inherit;">x</font>
	                	</span>
	              	</button>
				</div><!-- /header -->
				<!-- modal body -->
				<div class="modal-body div5">
					<font color="black" face="Sylfaen">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>CLAVE ADEUDO</label>
									<div class="input-group">
										<span class="form-control" style="border-color: #000;"> @{{id_adeudos}} </span>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>MATRICULA</label>
									<div class="input-group">
										<span class="form-control" style="border-color: #000;"> @{{matricula}} </span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>NOMBRES</label>
							<div class="input-group">
								<span class="form-control" style="border-color: #000;"> @{{nombre}} </span>
							</div>
						</div>
						<div class="form-group">
							<label>APELLIDOS</label>
							<div class="input-group">
								<span class="form-control" style="border-color: #000;"> @{{apellidos}} </span>
							</div>
						</div>
						<div class="form-group">
							<label>CLAVE CARRERA</label>
							<div class="input-group">
								<span class="form-control" style="border-color: #000;"> @{{clave_carrera}} </span>
							</div>
						</div>
						<div class="form-group">
							<label>NOMBRE CARRERA</label>
							<div class="input-group">
								<span class="form-control" style="border-color: #000;"> @{{nombre_carrera}} </span>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>DIAS ATRASADOS</label>
									<div class="input-group">
										<span class="form-control" style="border-color: #000;"> @{{dias_atraso}} </span>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>TOTAL ADEUDO</label>
									<div class="input-group">
										<span class="form-control" style="border-color: #000;"> @{{total}} </span>
									</div>
								</div>
							</div>
						</div>
					</font>
				</div><!-- /body -->
				<!-- modal footer -->
				<div class="modal-footer" style="background-color: #f39c12;">
					<div class="pull-right">
						<button style="margin-left: 10px" type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="cancelar()" v-if="editando">ACEPTAR</button>
						<button style="margin-left: 10px" type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="cancelar()" v-if="!editando">CERRAR</button>
					</div>
		            <div class="pull-right">
		                <button style="margin-left: 10px" type="button" class="btn btn-primary" data-dismiss="modal" v-on:click="Devolver(auxDev)" v-if="!editando">
		                	PAGAR<span class="fas fa-check"></span>
		                </button>
		            </div>
				</div>
			</div>
			<!-- /content -->
		</div>
		<!-- /dialog -->
	</div>
	<!-- /modal -->
</div>
<!-- /principal -->
@endsection

@push('scripts')
	<script src="js/configs/adeudos.js"></script>
@endpush