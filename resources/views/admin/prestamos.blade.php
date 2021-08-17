@extends('layouts.layout')
@section('titulo','Procesando Prestamo')
@section('contenido')
<div id="prestacion">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h2 class="text text-center">PROCESANDO PRESTAMO DE LIBRO</h2>
        <br>
        <center>
          <p>Es importante llenar los campos índicados por el
          <strong>ASTERÍSCO</strong><sub class="asterisco">*</sub>.</p>
        </center>
        <a href="{{url('devoluciones')}}" style="float: right;">
          <button class="btn btn-danger glyphicon glyphicon-list" style="float: right;">
            Verificar Prestamos
          </button>
        </a>
      </div>
    </div>
  </div>
  <div class="container form-prestamo">
    <div>
      <div class="form-group">
        <label for="folioprestamo" class="letras">
          Folio del Prestamo: 
        </label>
        <font color="green" face="Times New Roman">
          <h5> @{{folioprestamo}}</h5>
        </font>
      </div>
      <div class="form-group">
        <label for="fechaprestamo" class="letras">
          FECHA PRESTAMO : 
        </label>
        <font color="green" face="Times New Roman">
          <h5>@{{fechaprestamo}}</h5>
        </font>
      </div>
      <div class="form-group">
          <label for="isbn" class="letras">
            Clave libro que desea prestar<sub class="asterisco">*</sub>:
          </label>
          <input type="text" name="" v-model="isbn" @change="getLibros" class="form-control">
      </div>
      <div class="form-group">
          <label for="titulo" class="letras">
            Titulo del libro<sub class="asterisco">*</sub>:
          </label>
          <select class="form-control" v-model="titulo">
            <option v-for="l in libros" v-bind:value="l.titulo">@{{l.titulo}}</option>
          </select>
      </div>
      <div class="form-group">
          <label for="consec" class="letras">
            Consec del libro<sub class="asterisco">*</sub>:
          </label>
          <select class="form-control" v-model="consec">
            <option v-for="l in libros" v-bind:value="l.consec">@{{l.consec}}</option>
          </select>
      </div>
      <div class="form-group">
          <label for="fechadevolucion" class="letras">
            Fecha de devolución<sub class="asterisco">*</sub>:
          </label>
          <input type="date" name="" v-model="fechadevolucion" class="form-control" placeholder="fecha de devolucion">
      </div>
      <div class="form-group">
          <label for="matricula" class="letras">
            Matricula de quien presta<sub class="asterisco">*</sub>:
          </label>
          <input type="text" name="" v-model="matricula" class="form-control">
      </div>
      <div class="form-group">
          <label for="liberado" class="letras">
            Liberacion de libro:
          </label>
          <input type="text" name="" v-model="liberado" class="form-control">
      </div>
      <div class="form-group">
          <label for="cantidad" class="letras">
            Cantidad prestada<sub class="asterisco">*</sub>:
          </label>
          <input type="text" name="" v-model="cantidad" class="form-control">
      </div>
      <div class="clearfix"></div>
      <center>
        <button class="btn btn-dark form-control glyphicon glyphicon-save" @click="prestar()">
          GUARDAR
        </button>
      </center>
    </div>
  </div>
  <br>
</div>

@endsection

@push('scripts')
  <link rel="stylesheet" type="text/css" href="css/form_prestamo/prestamos.css">
  <script src="js/admin/prestacion.js"></script>
    <!-- <script type="text/javascript" src="js/vue.js"></script> -->
  <script src="js/moment-with-locales.min.js"></script>
@endpush