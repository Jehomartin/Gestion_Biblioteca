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
        <!-- <div class="form-group">
          <div class="input-group">
              <button class="btn btn-warning form-control" @click="student()">
                ALUMNO <i class="fas fa-book"></i><i class="fas fa-pencil-alt"></i>
              </button>
              <button class="btn btn-success form-control" @click="teacher()">
                DOCENTE <i class="fas fa-briefcase"></i>
              </button>
          </div>
        </div> -->
			</div>
			<!-- inicio de los if -->
      <!-- <div class="col-lg-8">
      </div> -->
      <!-- /fin los if -->
		</div>
		<!-- /datos principales -->
		<hr style="border-color: #000">
		<!-- ingreso de folio -->
		<div class="row">
			<div class="col-lg-6">
				<div class="input-group">
          <select class="form-control" v-model="folio" ref="buscar" v-on:keyup.enter="getDetalles()" @change="details">
            <option disabled value="">Inserte el folio de prestamo</option>
            <option v-for="d in arraydetail" v-bind:value="d.foliodetalle"> @{{d.folioprestamo}} </option>
          </select>
					<!-- <input type="text" class="form-control" v-model="folio" ref="buscar" v-on:keyup.enter="getDetalles()" placeholder="Ingrese el folio de prestamo" style="border-color: black"> -->
					<span class="input-group-btn">
			      <button class="btn btn-success fas fa-plus-square" @click="getDetalles()"></button>
			    </span>
				</div>
        <!-- ingreso : @{{nomber}} -->
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
		            	<td> @{{dv.id_prestador}} </td>
		            	<td> @{{dv.correo}} </td>
		            	<td>
		            		<span class="fas fa-trash-alt btn btn-danger btn-xs" @click="cancelarDevolucion(index)"></span>
		              	</td>
		            </tr>
		          </tbody>          
		        </table>
      		</div>
      		<!-- <button class="btn btn-secondary ml-auto">Button</button> -->
	      	<button class="btn btn-primary ml-auto float-right" @click="devolver()" >
	        	<i class="fas fa-file-import"></i><font face="Sylfaen"> DEVOLVER</font>
	      	</button>
    	</div>
	</div>
</div>
@endsection

@push('scripts')
	<script src="js/datos/devoluciones.js"></script>
@endpush