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
    <font color="green" face="times new roman"><h5>FOLIO : @{{folioprestamo}}</h5></font>
    <font color="green" face="times new roman"><h5>FECHA PRESTAMO : @{{fechaprestamo}}</h5></font>
    <hr>

    <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
          <input type="text" class="form-control" v-model="codigo" ref="buscar" v-on:keyup.enter="getLibros()" placeholder="Ingrese el codigo del libro" style="color: #000">
        
          <span class="btn btn-dark fas fa-edit" @click="getLibros()">
            
          </span>
        </div>
        <br>
        <button class="btn btn-primary form-control fas fa-save" @click="prestar()">
          GUARDAR PRESTAMO
        </button>
      </div>
      <div class="col-lg-4">
        <a href="{{url('devoluciones')}}">
          <button class="btn btn-danger fas fa-list-alt" style="float: right;"> Verificar Prestamos</button>
        </a>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-lg-11">
        <table class="table table-bordered table-responsive">
          <thead class="thead-dark">
            <th width="10%">ISBN</th>
            <th width="20%">TITULO</th>
            <th width="15%">FECHA DEVOLUCIÓN</th>
            <th width="10%">MATRICULA</th>
            <!-- <th width="10%">LIBERADO</th> -->
            <!-- <th width="10%">CANTIDAD</th> -->
            <th width="7%">CONSEC</th>
            <th width="9%">ACCIONES</th>
          </thead>
          <tbody class="table table-bordered">
            <tr v-for="(p,index) in prestamos">
              <td> @{{p.isbn}} </td>
              <td> @{{p.titulo}} </td>
              <td>
                <input type="date" class="form-control" placeholder="fecha devolucion" v-model="fechadevolucion">
              </td>
              <td>
                <input type="text" class="form-control" placeholder="matricula" v-model="matricula">
              </td>
              <!-- <td>
                <input type="text" class="form-control" v-model="liberado">
              </td>  -->        
              <!-- <td>
                <input type="number" class="form-control" min="1"
                v-model="cantidad">
              </td> -->
              <td>@{{p.consec}}</td>
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