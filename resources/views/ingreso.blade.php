@extends('layouts.maker')
@section('titulo','Ingreso')
@section('contenido')
<br>
<div id="newuser">
	<div class="contenedor">
		<div class="loag">
			<center>
				<img src="img/user.png" width="80px" height="80px">
			</center>
			<div class="fondo">
				<font face="Sylfaen" color="black">
					<h3>REGISTRANDO USUARIO</h3>
				</font>

				<form action="{{url('entrar')}}" method="POST">
					<div class="row">
						<div class="col-md-6">
							<div class="input-group">
								<label class="text text-center">
									<font color="white" size="4">*Nombre de usuario:</font>
								</label>
								<input type="text" placeholder="Nombre de usuario*" v-model='login' style="background-color: #0F1628" class="input100" name="usuario">		
							</div>
						</div>
						<div class="col-md-6">
							<div class="input-group">
								<label class="text text-center">
									<font color="white" size="4">*Contraseña de usuario:</font><i class="fa fa-window-close btn-danger" v-if="auxpass"></i>
								</label>
								<input type="password" placeholder="Escriba su Contraseña*" v-model="pass" style="background-color: #0F1628" class="input100" name="pass">	

							</div>
						</div>
					</div><br>
					<div class="row">
						<div class="col-md-6">
							<div class="input-group">
								<label class="text text-center">
									<font color="white" size="4">*Confirmar contraseña:</font><i class="fa fa-window-close btn-danger" v-if="auxpass"></i>
								</label>
								<input type="password" placeholder="Escriba su Nombre*" v-model="pass2" style="background-color: #0F1628" class="input100">
							</div>
						</div>
						<div class="col-md-6">
							<div class="input-group">
								<label class="text text-center">
									<font color="white" size="4">*Nombre(s):</font>
								</label>
								<input type="text" placeholder="Escriba su Nombre*" v-model="nombre" style="background-color: #0F1628" class="input100">
							</div>
						</div>
					</div><br>
					<div class="row">
						<div class="col-md-6">
							<div class="input-group">
								<label class="text text-center">
									<font color="white" size="4">*Apellidos:</font>
								</label>
								<input type="text" placeholder="Escriba sus Apellidos*" v-model="apellidos" style="background-color: #0F1628" class="input100">
							</div>
						</div>
						<div class="col-md-6">
							<div class="input-group">
								<label class="text text-center">
									<font color="white" size="4">*Sexo:</font>
								</label>
								<select v-model="sexo" style="background-color: #0F1628;" class="input100">
									<option disabled value="">Elija su sexo</option>
									<option>MASCULINO</option>
									<option>FEMENINO</option>
								</select>
								<!-- <input type="text" placeholder="Escriba sus Apellidos*" class="input100" v-model="apellidos" style="background-color: #0F1628"> -->
							</div>
						</div>
					</div><br>
					<div class="row">
						<div class="col-md-6">
							<div class="input-group">
								<label class="text text-center">
									<font color="white" size="4">*Edad:</font>
								</label>
								<input type="number" v-model="edad" placeholder="Escriba su Edad*" style="background-color: #0F1628;" class="input100" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="input-group">
								<label class="text text-center">
									<font color="white" size="4">*Telefono:</font>
								</label>
								<input type="text" v-model="telefono" placeholder="Número telefónico*" style="background-color: #0F1628;" maxlength="10" class="input100">
							</div>
						</div>
					</div><br>
				</form>
				<div class="row">
					<div class="col-md-6">
						<button class="btn btn-primary text text-center" @click="SaveUS()">
							Registrarse <i class="fa fa-save"></i>
						</button>
					</div>
					<div class="col-md-6">
						<a href="{{url('/')}}"><button class="btn btn-danger text text-center">
							Cancelar <i class="fa fa-window-close"></i>
						</button></a>
					</div>
				</div>
			</div><hr>
		</div>
	</div>
</div>

@endsection

@push('scripts')
	<script src="js/datos/newuser.js"></script>
@endpush