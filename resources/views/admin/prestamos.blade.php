@extends('layouts.layout')
@section('titulo','Procesando Prestamo')
@section('contenido')

<center>
  <font color="orange" face="arial black">
    <h2>PROCESANDO PRESTAMO DE LIBRO</h2>
  </font>
</center>

<div id="prestacion">
<!--  <font color="white" size="10">@{{saludo}}</font> -->
  <br>
  <div class="container">
    <font color="green" face="arial black"><h5>FOLIO : @{{folioprestamo}}</h5></font>
    <font color="green" face="arial black"><h5 v-model="fechaprestamo">FECHA PRESTAMO : @{{fechaprestamo}}</h5></font>

    <div class="row">
      <div class="col-xs-6">
        <div>
          <input type="text" class="form-control" v-model="codigo" ref="buscar" v-on:keyup.enter="getLibro()" placeholder="Ingrese el codigo del libro" style="color: #000">
          <br>
          <button class="btn btn-warning glyphicon glyphicon-ok" @click="getLibro()">
            Agregar
          </button>
        </div>
        <br>
        <button class="btn btn-primary form-control glyphicon glyphicon-save" @click="prestar()">
          GUARDAR PRESTAMO
        </button>
      </div>
      <div class="col-xs-4">
        <a href="{{url('devoluciones')}}">
          <button class="btn btn-danger glyphicon glyphicon-list" style="float: right;"> Verificar Prestamos</button>
        </a>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-xs-11">
        <table class="table table-bordered">
          <thead class="tab">
            <th width="15%">ISBN</th>
            <th width="20%">TITULO</th>
            <th width="15%">FECHA DEVOLUCIÓN</th>
            <th width="10%">MATRICULA</th>
            <!-- <th width="10%">LIBERADO</th> -->
            <!-- <th width="10%">CANTIDAD</th> -->
            <th width="7%">CONSEC</th>
            <th width="9%">ACCIONES</th>
          </thead>
          <tbody class="table table-bordered">
            <tr v-for="(p,index) in prestamos" class="colors">
              <td v-model="isbn"> @{{p.isbn}} </td>
              <td v-model="titulo"> @{{p.titulo}} </td>
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
              <td v-model="consec">@{{p.consec}}</td>
              <td>
                <span class="glyphicon glyphicon-trash btn btn-danger btn-xs" @click="cancelarPrestamo(index)"></span>
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
    <!-- <script type="text/javascript" src="js/vue.js"></script> -->
    <script src="js/moment-with-locales.min.js"></script>
@endpush