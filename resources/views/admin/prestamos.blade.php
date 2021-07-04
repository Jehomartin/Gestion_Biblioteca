@extends('layouts.layout')
@section('titulo','Procesando Prestamo')
@section('contenido')

<center>
  <font color="orange" face="Times New Roman">
    <h2>PROCESANDO PRESTAMO DE LIBRO</h2>
  </font>
</center>

<div id="prestacion">
<!--  <font color="white" size="10">@{{saludo}}</font> -->
  <br>
  <div class="container">
    <div class="row">
      <div class="col-xs-6">
        
      </div>
      <div class="col-xs-4">
        <a href="{{url('devoluciones')}}">
          <button class="btn btn-danger glyphicon glyphicon-list" style="float: right;"> Verificar Prestamos</button>
        </a>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-7">
        <font color="green" face="Times New Roman"><h4>FOLIO : @{{folioprestamo}}</h4></font>
        <font color="green" face="Times New Roman"><h4>FECHA PRESTAMO : @{{fechaprestamo}}</h4></font>
        <hr>

        
        <h4>Clave libro que desea prestar:</h4>
        <font color="orange"><input type="text" name="" placeholder="id del Libro" v-model="isbn" @change="getLibros" class="form-control"></font>

        <h4>Detalles del libro a prestar:</h4>
        <h5>Titulo del libro:</h5>
        <select class="form-control" v-model="titulo">
          <option v-for="l in libros" v-bind:value="l.titulo">@{{l.titulo}}</option>
        </select>
        <h5>Consec del libro:</h5>
        <select class="form-control" v-model="consec">
          <option v-for="l in libros" v-bind:value="l.consec">@{{l.consec}}</option>
        </select>
        <h5>Fecha de devolución:</h5>
        <input type="date" name="" v-model="fechadevolucion" class="form-control" placeholder="fecha de devolucion">
        <h5>Matricula de quien presta:</h5>
        <input type="text" name="" v-model="matricula" class="form-control" placeholder="matricula del alumno">
        <h5>Liberacion de libro:</h5>
        <input type="text" name="" v-model="liberado" class="form-control" placeholder="liberado">
        <h5>Cantidad prestada:</h5>
        <input type="text" name="" v-model="cantidad" class="form-control" placeholder="cantidad">
      </div>
      <div class="col-xs-4">
        <center><button class="btn btn-primary form-control glyphicon glyphicon-save but" @click="prestar()">
          GUARDAR
        </button></center>
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