@extends('layouts.layout')
@section('titulo','Procesando Prestamo')
@section('contenido')

<font color="black" face="Sylfaen">
  <h2 class="text text-center">PROCESANDO PRÉSTAMO DE LIBRO</h2>
</font>

<!-- <div>
  <input type="hidden" value="<?php ?>">
</div> -->

<div id="prestacion">
  <br>
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <font color="black" face="Sylfaen">
          <h6>FOLIO : @{{folioprestamo}}</h6>
          <h6>FECHA PRÉSTAMO : @{{fechaprestamo}}</h6>
          <h6>FECHA DEVOLUCIÓN : @{{fechadevolucion}}</h6>
        </font>

        <!-- elejir alumno o docente -->
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
        <!-- /elejir alumno o docente -->
      </div>
      <!-- /folio y fechas -->

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
    <hr style="border-color: #000">

    <div class="row">
      <div class="col-lg-6">
        <div class="input-group">
          <!-- <input type="text" class="form-control" v-model="codigo" ref="buscar" v-on:keyup.enter="getLibros()" placeholder="Ingrese el título del libro" style="border-color: black"> -->
          <select class="form-control selectlib" v-model="codigo" ref="buscar" v-on:keyup.enter="getLibros()" @change="getLib" name="selectli[]" id="selectlib">
            <option disabled value="">Ingrese el titulo</option>
            <option v-for="l in arraylibros" v-bind:value="l.titulo"> @{{l.titulo}} </option>
          </select>
        
          <span class="input-group-btn">
            <button class="btn btn-success fas fa-plus-square" @click="getLibros()"></button>
          </span>
        </div>
      </div>
      <!-- <label>usted a elegido un total de :</label> @{{permisos}} -->
    </div>

    <hr style="border-color: #000;">
    <div class="row">
      <div class="col-lg-12">
        <table class="table table-striped table-bordered table-responsive">
          <thead class="thead-dark">
            <th width="10%">ISBN</th>
            <th width="20%">TÍTULO</th>
            <th width="9%">ACCIONES</th>
          </thead>
          <tbody class="table table-bordered">
            <tr v-for="(p,index) in arrayprestamos">
              <td> @{{p.isbn}} </td>
              <td> @{{p.titulo}} </td>
              <td>
                <span class="fas fa-trash-alt btn btn-danger btn-xs" @click="cancelarPrestamo(index)"></span>
              </td>
            </tr>
          </tbody>          
        </table>
      </div>
      <!-- <button class="btn btn-secondary ml-auto">Button</button> -->
      <button class="btn btn-primary ml-auto float-right fa fa-save" @click="prestar()" >
        <font face="Sylfaen"> GUARDAR</font>
      </button>
      <!-- <button class="btn btn-primary ml-auto float-right fa fa-save" @click="prestar()" >
        <font face="Sylfaen"> GUARDAR</font>
      </button> -->
    </div>
  </div>
</div>

@endsection

@push('scripts')
  <script src="js/datos/prestacion.js"></script>
  <!-- <script src="js/seleccion.js"></script> -->
  <!-- <script src="js/moment-with-locales.min.js"></script> -->
@endpush