@extends('layouts.layout')
@section('titulo','Procesando Prestamo')
@section('contenido')

<font color="black" face="Sylfaen">
  <h2 class="text text-center">PROCESANDO PRÉSTAMO DE LIBRO</h2>
</font>

<div id="prestacion">
  <br>
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <font color="black" face="Sylfaen"><h5>FOLIO : @{{folioprestamo}}</h5></font>
        <font color="black" face="Sylfaen"><h5>FECHA PRÉSTAMO : @{{fechaprestamo}}</h5></font>
      </div>
      <div class="col-lg-4">
        <font color="black" face="Sylfaen">
          <h5>MATRÍCULA DEL ALUMNO: </h5> 
          <input type="text" class="form-control" placeholder="Matrícula" v-model="matricula" style="border-color: #000" id="matricula">
          <h5>CORREO DEL ALUMNO:</h5>
          <input type="text" class="form-control" placeholder="Correo electrónico del alumno" v-model="correo" style="border-color: #000;" id="correo">
        </font>
      </div>
      <div class="col-lg-4">
        <font color="black" face="Sylfaen">
          <h5>FECHA DEVOLUCIÓN: </h5>
          <input type="date" class="form-control" placeholder="fecha devolución" v-model="fechadevolucion" style="border-color: #000">
        </font>
      </div>
    </div>
    <hr style="border-color: #000">

    <div class="row">
      <div class="col-lg-6">
        <div class="input-group">
          <input type="text" class="form-control" v-model="codigo" ref="buscar" v-on:keyup.enter="getLibros()" placeholder="Ingrese el título del libro" style="border-color: black">
        
          <span class="input-group-btn">
            <button class="btn btn-success fas fa-plus-square" @click="getLibros()"></button>
          </span>
        </div>
      </div>
      <label>usted a elegido un total de :</label> @{{permisos}}
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
    </div>
  </div>
</div>

@endsection

@push('scripts')
  <script src="js/datos/prestacion.js"></script>
  <script src="js/moment-with-locales.min.js"></script>
@endpush