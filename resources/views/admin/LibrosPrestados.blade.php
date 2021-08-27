@extends('layouts.layout')
@section('titulo','Listado Prestamos')
@section('contenido')

<div class="main-panel" id="devolver">
  <!-- @{{saludo}} -->
  <div class="container">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <br>
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
        <br>
        <font color="black" face="times new roman">
          <h2 class="text text-center">PRESTAMOS REALIZADOS</h2>
        </font>
        <br>

        <table class="table table-sm table-striped table-bordered table-hover">
          <thead class="thead-dark">
            <th>FOLIO</th>
            <th>ISBN</th>
            <th>TITULO</th>
            <th>FECHA PRESTAMO</th>
            <th>FECHA DEVOLUCION</th>
            <th>MATRICULA</th>
            <th>LIBERADO</th>
            <th>CANTIDAD</th>
            <!-- <th>Consec</th> -->
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
              <!-- <td v-on:click="infoPrestamo(prestamo.folioprestamo)">@{{prestamo.consec}}</td> -->
            </tr>
          </tbody>

        </table>
      </div>

      <!-- inicio ventana modal -->
      <div id="modal_custom" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="addprestamo">
        <!--inicio modal dialog-->
        <!--inicio modal dialog-->
        <div class="modal-dialog" role="document">
          <!--inicio modal content-->
          <div class="modal-content">
            <!-- se inicia el encabezado de la ventana modal -->
            <div class="modal-header" style="background-color: #f39c12">
              <!-- <h5 class="modal-title" id="exampleModalLiveLabel" v-if="!editando"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Registro Nuevo Devolucion</font></font></h5> -->
              <h5 class="modal-title" id="exampleModalLiveLabel" v-if="editando"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Informacion del prestamo</font></font></h5>
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="cancelarEdit()">
                <span aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></span>
              </button>
            </div>
            <!-- fin encabezado de ventana modal -->

            <!-- inicio cuerpo modal -->
            <div class="modal-body div1">
              <font color="black" face="arial black">
                <span v-if="editando" class="form-control">Folio de prestamo: @{{folioprestamo}} </span>
                <span v-if="editando" class="form-control">Folio del libro: @{{isbn}} </span>
                <span v-if="editando" class="form-control">Titulo del libro: @{{titulo}} </span>
                <span v-if="editando" class="form-control">Fecha del prestamo: @{{fechaprestamo}} </span>
                <span v-if="editando" class="form-control">Fecha de devolución establecida: @{{fechadevolucion}} </span>
                <span v-if="editando" class="form-control">Matricula del alumno que presto: @{{matricula}} </span>
                <span v-if="editando" class="form-control">Indicador de que se ha realizado el prestamo: @{{liberado}} </span>
                <span v-if="editando" class="form-control">Cantidad de libros prestados: @{{cantidad}} </span>
                <span v-if="editando" class="form-control">Consec: @{{consec}} </span>
              </font>
            </div>
            <!-- fin cuerpo modal -->

            <!-- footer modal -->
            <div class="modal-footer div1">
              <div class="pull-right">
                  <button style="margin-left: 10px" type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="cancelarEdit()">Aceptar</button>
              </div>

              <!-- <div class="pull-right">
                  <button style="margin-left: 10px" type="submit" class="btn btn-primary" v-on:click="cancelarEdit()">Aceptar</button>
              </div> -->
            </div><!-- fin footer modal -->
          </div> <!--fin modal content-->
        </div><!--/modal dialog-->
      </div><!--fin ventana modal-->

    </div>
 <!--  </div>	 -->
</div>

@endsection

@push('scripts')
  <script src="js/admin/devoluciones.js"></script>
  <!-- <script src="js/vue.js"></script>
  <script src="js/vue-resource.js"></script> -->
  <script src="js/moment-with-locales.min.js"></script>
@endpush