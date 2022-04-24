<?php $__env->startSection('titulo','Ajustes'); ?>
<?php $__env->startSection('contenido'); ?>

<div id="config">
	<div class="container">
		<!-- Titulo -->
		<div class="row">
			<div class="col-lg-2">
				<a href="<?php echo e(url('inicio')); ?>" class="btn btn-warning">
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
		<div class="row">
			<div class="col-md-2">
				<button class="btn btn-outline-danger" @click="close()" v-if="confmul"><i class="fas fa-window-close"></i></button>
			</div>
			<div class="col-md-4">
				<span class="btn btn-primary form-control" @click="cofigmulta()" title="Validar matricula">
					CONFIGURAR MULTAS <i class="fas fa-file-invoice-dollar"></i>
				</span>
			</div>
			<div class="col-md-4">
				<span class="btn btn-success form-control" @click="configuser()" title="Consultar libro">
					CONFIGURAR USUARIOS <i class="fas fa-user"></i>
				</span>
			</div>
			<div class="col-md-2">
				<button class="btn btn-outline-danger" @click="close()" v-if="confus"><i class="fas fa-window-close"></i></button>
			</div>
<!-- 			<div class="col-md-4" v-if="validado">
				<span class="btn btn-danger form-control" @click="cancelarP()" title="Cancelar todo">
					FINALIZAR PROCESOS <i class="fas fa-window-close"></i>
				</span>
			</div> -->
		</div>
	</div>
	<br>

	<div class="container">
		<!-- Inicio div datos1 -->
		<div class="row">
			<div class="col-md-2" v-if="confmul"></div>
			<div class="col-md-8" v-if="confmul">
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
          				<td> {{multa.id_multas}} </td>
          				<td>$ {{multa.precio}} </td>
          				<td> {{multa.vigente}} </td>
	          			<td>
	          				<span class="btn btn-outline-danger" @click="editMulta(multa.id_multas)">
	          					<i class="fas fa-skull"></i>
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
			<div class="col-md-2" v-if="confmul"></div>
			<!-- para users -->
			<div class="col-md-1" v-if="confus"></div>
			<div class="col-md-10" v-if="confus">
				<div class="row">
      		<div class="col-lg-8"></div>
      		<div class="col-md-2">
      			<button class="btn btn-primary form-control" @click="ModalUS">
      				<i class="fas fa-plus-circle"></i>
      			</button>
      		</div>
        </div>

        <div class="card direct-chat direct-chat-warning">          
          <div class="card-header" style="background-color: #28a745;">
          	<h5 class="card-title text text-center" style="color: black;">CONFIGURAR USUARIOS</h5>
          </div>
          <div class="card-body">
          	<table class="table table-sm table-striped table-bordered table-hover tamanio-font">
          		<thead class="thead-dark">
          			<th>Login</th>
          			<th>Nombres</th>
          			<th>Apellidos</th>
          			<th>Telefono</th>
          			<th>Opciones</th>
          		</thead>
          		<tbody>
          			<tr v-for="(al,index) in arrayusuarios">
          				<td> {{al.login}} </td>
	          			<td> {{al.nombre}} </td>
	          			<td> {{al.apellidos}} </td>
	          			<td> {{al.telefono}} </td>
	          			<td>
	          				<span class="btn btn-primary" @click="EditUser(al.login)">
	          					<i class="fas fa-edit"></i>
	          				</span>
	          				<span class="btn btn-outline-danger" @click="DeadUser(al.login)">
	          					<i class="fas fa-skull"></i>
	          				</span>
	          			</td>
          			</tr>
          			
          		</tbody>
          	</table>
          </div>
	      </div>
			</div>
			<div class="col-md-1" v-if="confus"></div>
		</div>
		<br>
		<!-- /div datos1 -->
		<!-- <div class="row">
			
		</div> -->
	</div>

	<!-- inicio div modal multa -->
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
								<span class="form-control" style="border-color: #000;" v-if="editmulta"> {{id_multas}} </span>
							</div>
						</div>
						<div class="form-group">
							<label>PRECIO</label>
							<div class="input-group">
								<span class="form-control" style="border-color: #000;" v-if="editmulta"> {{precio}} </span>
								<input type="text" name="" placeholder="Ingrese el precio de la multa" v-model="precio" v-if="!editmulta" style="border-color: black;" class="form-control">
							</div>
						</div>
						<div class="form-group" v-if="editmulta">
							<label>VIGENCIA</label>
							<div class="input-group">
								<span class="form-control" style="border-color: black;" > {{vigente}} </span>
							</div>
						</div>
					</font>
				</div> <!-- /body -->

				<!-- footer -->
				<div class="modal-footer" style="background-color: #f39c12;">
					<div class="pull-right">
						<button style="margin-left: 10px" type="button" class="btn btn-dark" data-dismiss="modal" v-on:click="cancelar()">CERRAR</button>
					</div>
          <div class="pull-right">
              <button style="margin-left: 10px" type="button" class="btn btn-primary" data-dismiss="modal" v-on:click="NewMulta()" v-if="!editmulta">
              	GUARDAR <span class="fas fa-save"></span>
              </button>
              <button style="margin-left: 10px;" class="btn btn-danger" data-dismiss="modal" v-on:click="DesactivarMul(auxmulta)" v-if="editmulta">
              	DESACTIVAR<i class="fas fa-skull"></i>
              </button>
          </div>
				</div> <!-- /footer -->
			</div>
		</div>
	</div>
	<!-- /modal multa-->

	<!-- modal user -->
	<div id="modal_us" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #f39c12;">
					<h5 class="modal-title" id="exampleModalLiveLabel" v-if="editus">
						<font style="vertical-align: inherit;" face="Sylfaen" color="black">EDITANDO USUARIO</font>
					</h5>
					<h5 class="modal-title" id="exampleModalLiveLabel" v-if="desacUs">
						<font style="vertical-align: inherit;" face="Sylfaen" color="black">DESACTIVANDO USUARIO</font>
					</h5>
					<h5 class="modal-title" v-if="!editus && !desacUs" id="exampleModalLiveLabel">
						<font style="vertical-align: inherit;" face="Sylfaen" color="black">NUEVO USUARIO</font>
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="cancelar()">
          	<span aria-hidden="true">
            		<font style="vertical-align: inherit;">x</font>
          	</span>
	        </button>
				</div>
				<div class="modal-body div5">
					<form>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="text text-center">
										<font face="Sylfaen" size="4">*Nombre de usuario:</font>
									</label>
									<input type="text" placeholder="Nombre de usuario*" v-model='login' style="border-color: #000;" class="form-control" name="usuario">		
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="text text-center">
										<font face="Sylfaen" size="4">*Contraseña de usuario:</font><i class="fa fa-window-close btn-danger" v-if="auxpass"></i>
									</label>
									<input type="password" placeholder="Escriba su Contraseña*" v-model="pass" style="border-color: #000;" class="form-control" name="pass">	
								</div>
							</div>
						</div>
							
						<div class="row">
							<div class="col-md-6" v-if="!editus && !desacUs">
								<div class="form-group">
									<label class="text text-center">
										<font face="Sylfaen" size="4">*Confirmar contraseña:</font><i class="fa fa-window-close btn-danger" v-if="auxpass"></i>
									</label>
									<input type="password" placeholder="Escriba su Nombre*" v-model="pass2" style="border-color: #000;" class="form-control">
								</div>
							</div>
							<div class="col-md-6" v-if="!editus && !desacUs">
								<div class="form-group">
									<label class="text text-center">
										<font face="Sylfaen" size="4">*Nombre(s):</font>
									</label>
									<input type="text" placeholder="Escriba su Nombre*" v-model="nombre" style="border-color: #000;" class="form-control">
								</div>
							</div>
							<div class="col-md-12" v-if="editus">
								<div class="form-group">
									<label class="text text-center">
										<font face="Sylfaen" size="4">*Nombre(s):</font>
									</label>
									<input type="text" placeholder="Escriba su Nombre*" v-model="nombre" style="border-color: #000;" class="form-control">
								</div>
							</div>
							<div class="col-md-12" v-if="desacUs">
								<div class="form-group">
									<label class="text text-center">
										<font face="Sylfaen" size="4">*Nombre(s):</font>
									</label>
									<input type="text" placeholder="Escriba su Nombre*" v-model="nombre" style="border-color: #000;" class="form-control">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="text text-center">
										<font face="Sylfaen" size="4">*Apellidos:</font>
									</label>
									<input type="text" placeholder="Escriba sus Apellidos*" v-model="apellidos" style="border-color: #000;" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="text text-center">
										<font face="Sylfaen" size="4">*Sexo:</font>
									</label>
									<select v-model="sexo" style="border-color: #000;" class="form-control">
										<option disabled value="">Elija su sexo</option>
										<option>MASCULINO</option>
										<option>FEMENINO</option>
									</select>
									<!-- <input type="text" placeholder="Escriba sus Apellidos*" class="input100" v-model="apellidos" style="background-color: #0F1628"> -->
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="text text-center">
										<font face="Sylfaen" size="4">*Edad:</font>
									</label>
									<input type="number" v-model="edad" placeholder="Escriba su Edad*" style="border-color: #000;" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="text text-center">
										<font face="Sylfaen" size="4">*Telefono:</font>
									</label>
									<input type="text" v-model="telefono" placeholder="Número telefónico*" style="border-color: #000;" class="form-control" maxlength="10">
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer" style="background-color: #f39c12;">
					<div class="pull-right">
						<button style="margin-left: 10px" type="button" class="btn btn-dark" data-dismiss="modal" v-on:click="cancelUs()">CERRAR</button>
					</div>
          <div class="pull-right">
              <button style="margin-left: 10px" type="button" class="btn btn-primary" data-dismiss="modal" v-on:click="SaveUS()" v-if="!editus && !desacUs">
              	GUARDAR <span class="fas fa-save"></span>
              </button>
              <button style="margin-left: 10px;" class="btn btn-danger" data-dismiss="modal" v-on:click="DesacUser(auxuser)" v-if="desacUs">
              	DESACTIVAR<i class="fas fa-skull"></i>
              </button>
              <button style="margin-left: 10px;" class="btn btn-success" data-dismiss="modal" v-on:click="UpdateUs(auxuser)" v-if="editus">
              	ACTUALIZAR<i class="fas fa-check"></i>
              </button>
          </div>
				</div>
			</div>
		</div>
	</div>
	<!--/modal user -->
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
	<script src="js/configs/configuracion.js"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Gestion_Biblioteca\resources\views/configuracion/ajustes.blade.php ENDPATH**/ ?>