@extends('layouts.layout')
@section('titulo','Procesando Prestamo')
@section('contenido')

<font color="black" face="times new roman">
  <h2 class="text text-center">PROCESANDO PRESTAMO DE LIBRO</h2>
</font>

<div id="prestacion">
<!--  <font color="white" size="10">@{{saludo}}</font> -->
  <br>
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <font color="green" face="times new roman"><h5>FOLIO : @{{folioprestamo}}</h5></font>
        <font color="green" face="times new roman"><h5>FECHA PRESTAMO : @{{fechaprestamo}}</h5></font>
      </div>
      <div class="col-lg-4">
        <font color="green" face="times new roman">
          <h5>Matricula del Alumno: </h5> 
          <input type="text" class="form-control" placeholder="matricula" v-model="matricula" style="border-color: #000">
        </font>
      </div>
      <div class="col-lg-4">
        <font color="green" face="times new roman">
          <h5>Fecha de devolución de los libros: </h5>
          <input type="date" class="form-control" placeholder="fecha devolucion" v-model="fechadevolucion" style="border-color: #000">
        </font>
      </div>
    </div>
    <hr style="border-color: #000">

    <div class="row">
      <div class="col-lg-6">
        <div class="input-group">
          <input type="text" class="form-control" v-model="codigo" ref="buscar" v-on:keyup.enter="getLibros()" placeholder="Ingrese el codigo del libro" style="border-color: black">
        
          <span class="input-group-btn">
            <button class="btn btn-dark fas fa-plus-square" @click="getLibros()"></button>
          </span>
        </div>
        <br>
        <button class="btn btn-warning form-control fas fa-save" @click="prestar()">
          GUARDAR PRESTAMO
        </button>
      </div>
      <div class="col-lg-4">
        <a href="{{url('devoluciones')}}">
          <button class="btn btn-dark fas fa-list-alt" style="float: right;"> Verificar Prestamos</button>
        </a>
      </div>
    </div>
    <hr style="border-color: #000;">
    <div class="row">
      <div class="col-lg-11">
        <table class="table table-bordered table-responsive">
          <thead class="thead-dark">
            <th width="10%">ISBN</th>
            <th width="20%">TITULO</th>
            <th width="9%">ACCIONES</th>
          </thead>
          <tbody class="table table-bordered">
            <tr v-for="(p,index) in prestamos">
              <td> @{{p.isbn}} </td>
              <td> @{{p.titulo}} </td>
              <td>
                <span class="fas fa-trash-alt btn btn-danger btn-xs" @click="cancelarPrestamo(index)"></span>
              </td>
            </tr>
          </tbody>          
        </table>
      </div>
      
    </div>
  </div>
</div>

@endsection

@push('scripts')
  <script src="js/admin/prestacion.js"></script>
  <!-- <script type="text/javascript" src="js/vue/vue.min.js"></script> -->
  <script src="js/moment-with-locales.min.js"></script>
@endpush