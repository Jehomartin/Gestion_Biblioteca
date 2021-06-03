@extends('layouts.layout')
@section('titulo','Listado Prestamos')
@section('contenido')

<div id="prestar">
  <!-- @{{saludo}} -->
  <div class="container">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <!-- search form (Optional) -->
        <div class="input-group">
          <input type="text" name="searchText" class="form-control" placeholder="Buscar..." style="background-color: white" v-model="buscar">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat" style="background-color: orange"><i class="fa fa-search"></i>
            </button>
          </span>
        </div>
        <!-- /.search form -->
      </div>
      <div class="col-md-3"></div>
    </div>
  </div>
  <br>

  <!-- <div class="container"> -->
    <div class="row">
      
      <div class="col-sm-12">
        <!-- <button class="btn btn-success glyphicon glyphicon-plus" v-on:click="showModal"> Nuevo Prestamo</button> -->
        <br>
      
        <h2 class="text text-center">Prestamos realizados</h2>
        <br>

        <table class="table table-hover tabl-condensed table-bordered">
          <thead class="fondo1">
            <th>Folio</th>
            <th>Isbn</th>
            <th>Titulo</th>
            <th>Fecha.Prestamo</th>
            <th>Fecha.Devolución</th>
            <th>Matricula</th>
            <th>Liberado</th>
            <th>Cantidad</th>
            <th>Consec</th>
          </thead>

          <tbody>
            <tr v-for="(prestamo,index) in filtroPrestamos">
              <td v-on:click="infoPrestamo(prestamo.folioprestamo)">@{{prestamo.folioprestamo}}</td>
              <td v-on:click="infoPrestamo(prestamo.folioprestamo)">@{{prestamo.isbn}}</td>
              <td v-on:click="infoPrestamo(prestamo.folioprestamo)">@{{prestamo.titulo}}</td>
              <td v-on:click="infoPrestamo(prestamo.folioprestamo)">@{{prestamo.fechaprestamo}}</td>
              <td v-on:click="infoPrestamo(prestamo.folioprestamo)">@{{prestamo.fechadevolucion}}</td>
              <td v-on:click="infoPrestamo(prestamo.folioprestamo)">@{{prestamo.matricula}}</td>
              <td v-on:click="infoPrestamo(prestamo.folioprestamo)">@{{prestamo.liberado}}</td>
              <td v-on:click="infoPrestamo(prestamo.folioprestamo)">@{{prestamo.cantidad}}</td>
              <td v-on:click="infoPrestamo(prestamo.folioprestamo)">@{{prestamo.consec}}</td>
            </tr>
          </tbody>

        </table>
      </div>

      <!-- inicio ventana modal -->
      <div class="modal fade" tabindex="-1" role="dialog" id="addprestamo">
        <!--inicio modal dialog-->
        <div class="modal-dialog" role="document">
          <!--inicio modal content-->
          <div class="modal-content">
            <!-- se inicia el encabezado de la ventana modal -->
            <div class="modal-header fondo1">
              <button type="button" class="close" data-dismiss="modal" aria-label="close" v-on:click="cancelarEdit()"><span aria-hidden="true">X</span></button>
              <h4 class="modal-title" v-if="!info">Nuevo Prestamo</h4>
              <h4 class="modal-title" v-if="info">Información del prestamo</h4>
            </div>
            <!-- fin encabezado de ventana modal -->

            <!-- inicio cuerpo modal -->
            <div class="modal-body fondo1">
              <span class="form-control" v-model='folioprestamo' v-if="!info">Folio de prestamo: @{{folioprestamo}}</span>              
            <!--   <input type="text" name="" placeholder="escriba el folio del libro" class="form-control" v-model="isbn"v-if="!info"> -->
              <select @change="getLibros" v-model="isbn" class="form-control" v-if="!info">
                <option disabled value="">Elija la clave del libro</option>
                <option v-for="l in libros" v-bind:value="l.isbn">@{{l.isbn}}</option>
              </select>
              <select @change="getLibros" v-model="titulo" class="form-control" v-if="!info">
                <option disabled value="">Elija el titulo</option>
                <option v-for="l in libros" v-bind:value="l.titulo">@{{l.titulo}}</option>
              </select>
              <input type="date" name="" placeholder="Fecha_Prestamo" class="form-control" v-model="fechaprestamo" v-if="!info">
              <input type="date" name="" placeholder="Fecha_devolución" class="form-control" v-model="fechadevolucion" v-if="!info">
              <input type="text" name="" placeholder="Matricula" class="form-control" v-model="matricula" v-if="!info">
              <input type="text" name="" placeholder="Liberado" class="form-control" v-model="liberado" v-if="!info">
              <input type="number" name="" placeholder="Cantidad" class="form-control" v-model="cantidad" v-if="!info">
              <input type="number" name="" placeholder="Consec" class="form-control" v-model="consec" v-if="!info">

              <font color="black" face="arial black">
                <span v-if="info" class="form-control">Folio de prestamo: @{{folioprestamo}} </span>
                <span v-if="info" class="form-control">Folio del libro: @{{isbn}} </span>
                <span v-if="info" class="form-control">Titulo del libro: @{{titulo}} </span>
                <span v-if="info" class="form-control">Fecha del prestamo: @{{fechaprestamo}} </span>
                <span v-if="info" class="form-control">Fecha de devolución establecida: @{{fechadevolucion}} </span>
                <span v-if="info" class="form-control">Matricula del alumno que realizo el prestamo: @{{matricula}} </span>
                <span v-if="info" class="form-control">Indicador de que se ha realizado el prestamo: @{{liberado}} </span>
                <span v-if="info" class="form-control">Cantidad de libros prestados: @{{cantidad}} </span>
                <span v-if="info" class="form-control">Consec: @{{consec}} </span>
              </font>
            </div>
            <!-- fin cuerpo modal -->

            <!-- footer modal -->
            <div class="modal-footer fondo1">
              <div class="input-group" v-if="!info" >
                <h6>Folio: @{{folioprestamo}}</h6>
                <h6>Folio_Libro: @{{isbn}}</h6>
                <h6>Titulo_Libro: @{{titulo}}</h6>
                <h6>Fecha_Prestamo: @{{fechaprestamo}}</h6>
                <h6>Fecha_Devolucion: @{{fechadevolucion}}</h6>
                <h6>Matricula: @{{matricula}}</h6>
                <h6>Liberado: @{{liberado}}</h6>
                <h6>Cantidad: @{{cantidad}}</h6>
                <h6>Consec: @{{consec}}</h6>
              </div>
              <button type="button" class="btn btn-default" data-dismiss="modal" v-on:click="cancelarEdit()">Cancelar</button>
              <button type="submit" class="btn btn-primary" v-on:click="agregarPrestamo()" v-if="!info">Guardar</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="cancelarEdit()" v-if="info">Aceptar</button>
            </div>
            <!-- fin footer modal -->
          </div> <!--fin modal content-->
        </div><!--/modal dialog-->
      </div><!--fin ventana modal-->

    </div>
 <!--  </div>	 -->
</div>

@endsection

@push('scripts')
  <script src="js/admin/prestamos.js"></script>
  <script src="js/vue.js"></script>
  <script src="js/vue-resource.js"></script>
  <script src="js/moment-with-locales.min.js"></script>
@endpush