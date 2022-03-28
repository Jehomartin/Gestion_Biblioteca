@extends('layouts.layout')
@section('titulo','Procesando Devolución')
@section('contenido')
<font color="black" face="Sylfaen">
  <h2 class="text text-center">PROCESANDO DEVOLUCIÓN DE LIBRO</h2>
</font>

<div id="devolucion">
	<br>
	<div class="container">
		<!-- datos principales -->
		<div class="row">
			<div class="col-lg-4">
				<font color="black" face="Sylfaen">
          <h6>FOLIO : @{{foliodevolucion}}</h6>
          <h6>FECHA DEVOLUCIÓN : @{{datedevolucion}}</h6>
        </font>
        <div class="form-group">
          <div class="input-group">
              <button class="btn btn-warning form-control" @click="student()">
                ALUMNO <i class="fas fa-book"></i><i class="fas fa-pencil-alt"></i>
              </button>
              <button class="btn btn-success form-control" @click="teacher()">
                DOCENTE <i class="fas fa-briefcase"></i>
              </button>
          </div>
        </div>
			</div>
			<!-- inicio de los if -->
      <div class="col-lg-8">
        <div class="container">
          <!-- matricula y nombre -->
          <div class="row">
            <div class="container">
              <font color="black" face="Sylfaen">
                <h5 class="text text-center" v-if="estudiante">DATOS DEL ALUMNO: </h5>
                <h5 class="text text-center" v-if="docente">DATOS DEL DOCENTE: </h5>
              </font>
            </div>
            <br>
            <div class="col-md-6" v-if="estudiante">
              <div class="form-group">
                <label >MATRICULA</label>
                <div class="input-group">
                 <input type="text" placeholder="Matrícula" class="form-control" v-model="matricula" style="border-color: #000" id="matricula" maxlength="8" v-on:keyup.enter="getAlumnos()">
                </div>
              </div>
            </div>
            <div class="col-md-6" v-for="al in arrayalumnos" v-if="estudiante">
              <div class="form-group">
                <label>NOMBRE: </label>
                <div class="input-group">
                  <span style="border-color: #000;" class="form-control"> @{{al.nombre}} </span>
                </div>
              </div>
            </div>
            <div class="col-md-6" v-if="docente">
              <div class="form-group">
                <label>CLAVE: </label>
                <div class="input-group">
                  <input type="text" placeholder="Clave de docente" class="form-control" v-model="claves" style="border-color: #000" id="maestro" maxlength="8" v-on:keyup.enter="getDocentes()">
                </div>
              </div>
            </div>
            <div class="col-md-6" v-for="(dc,index) in arraydocentes" v-if="docente">
              <div class="form-group">
                <label>NOMBRE(S): </label>
                <div class="input-group">
                  <span class="form-control" style="border-color: #000;"> @{{dc.nombres}} </span>
                </div>
              </div>
            </div>
          </div>
          <!-- /matricula y nombre -->

          <!-- apellidos y correo -->
          <div class="row" v-for="al in arrayalumnos" v-if="estudiante">
            <div class="col-md-6">
              <div class="form-group">
                <label>APELLIDOS:</label>
                <div class="input-group">
                 <span style="border-color: #000;" class="form-control"> @{{al.apellidos}} </span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>CORREO:</label>
                <div class="input-group">
                 <span style="border-color: #000;" class="form-control" v-model="correo"> @{{correo}} </span>
                </div>
              </div>
            </div>
          </div>
          <div class="row" v-for="(dc,index) in arraydocentes" v-if="docente">
            <div class="col-md-6">
              <div class="form-group">
                <label>APELLIDOS:</label>
                <div class="input-group">
                  <span class="form-control" style="border-color: #000;"> @{{dc.apellidos}} </span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>CORREO:</label>
                <div class="input-group">
                  <span class="form-control" style="border-color: #000;"> @{{dc.email}} </span>
                </div>
              </div>
            </div>
          </div>
          <!-- /apellidos y correo -->
        </div>
      </div> <!-- /fin los if -->
		</div>
		<!-- /datos principales -->
		<hr style="border-color: #000">
		<!-- ingreso de folio -->
		<div class="row">
			<div class="col-lg-6">
				<div class="input-group">
					<input type="text" class="form-control" v-model="folio" ref="buscar" v-on:keyup.enter="getDetalles()" placeholder="Ingrese el folio de prestamo" style="border-color: black">
					<span class="input-group-btn">
			      <button class="btn btn-success fas fa-plus-square" @click="getDetalles()"></button>
			    </span>
				</div>
			</div>
		</div>
		<!-- /ingreso folio -->
		<hr style="border-color: #000;">
		<div class="row">
      		<div class="col-lg-12">
		        <table class="table table-striped table-bordered table-responsive">
		          <thead class="thead-dark">
		          	<th width="10%">FOLIO PRESTAMO</th>
		            <th width="10%">ISBN</th>
		            <th width="20%">TÍTULO</th>
		            <!-- <th width="10%">CANTIDAD</th> -->
		            <th width="">ID PRESTADOR</th>
		            <th width="">CORREO</th>
		            <th width="9%">ACCIONES</th>
		          </thead>
		          <tbody class="table table-bordered">
		            <tr v-for="(dv,index) in arraydevolucion">
		            	<td> @{{dv.folioprestamo}} </td>
		            	<td> @{{dv.isbn}} </td>
		            	<td> @{{dv.titulo}} </td>
		            	<!-- <td> @{{dv.cantidad}} </td> -->
		            	<td> @{{dv.matricula}} @{{dv.claves}} </td>
		            	<td> @{{dv.correo}} </td>
		            	<td>
		            		<span class="fas fa-trash-alt btn btn-danger btn-xs" @click="cancelarDevolucion(index)"></span>
		              	</td>
		            </tr>
		          </tbody>          
		        </table>
      		</div>
      		<!-- <button class="btn btn-secondary ml-auto">Button</button> -->
	      	<button class="btn btn-primary ml-auto float-right" @click="prestar()" >
	        	<i class="fas fa-file-import"></i><font face="Sylfaen"> DEVOLVER</font>
	      	</button>
    	</div>
	</div>
</div>
@endsection

@push('scripts')
	<script src="js/datos/devoluciones.js"></script>
@endpush