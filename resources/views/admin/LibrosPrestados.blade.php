@extends('layouts.layout')
@section('titulo','Listado Prestamos')
@section('contenido')

<style type="text/css">
  
</style>

<input type="hidden" id="fechaActual" value="<?php echo date('Y-m-d'); ?>">
<div class="main-panel" id="historial">
  <div class="container">
    <!-- inicio titulo -->
    <font color="black" face="Sylfaen">
      <h2 class="text text-center">PRÉSTAMOS REALIZADOS</h2>
    </font>
    <!-- /titulo -->

    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <br>
        <!-- search form (Optional) -->
        <div class="input-group">
          <input type="text" name="searchText" class="form-control find" placeholder="Buscar..." v-model="buscar" style="border-color: black">
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
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive-md">
              <table class="table table-sm table-striped table-bordered table-hover tamanio-font">
                <thead class="thead-dark" style="text-align: center;">
                  <th class="header" scope="col" width="12%">FOLIO</th>
                  <th class="header" scope="col" width="10%">ISBN</th>
                  <th class="header" scope="col">TÍTULO</th>
                  <th class="header" scope="col" width="10%">PRESTADOR</th>
                  <!-- <th class="header" scope="col" width="">ALUMNO</th> -->
                  <th class="header" scope="col" width="15%">CORREO</th>
                  <th class="header" scope="col" width="10%">FECHA_DEV</th>
                  <th class="header" scope="col">OPCIONES</th>
                </thead>
                <tbody>
                  <tr v-for="(detalle,index) in filtroDetalles" v-if="$('#fechaActual').val() <= detalle.prestamo.fechadevolucion" style="background: #5cb85c;">
                    <td> @{{detalle.folioprestamo}} </td>
                    <td> @{{detalle.isbn}} </td>
                    <td> @{{detalle.titulo}} </td>
                    <td> @{{detalle.id_prestador}} </td>
                    <!-- <td> @{{detalle.prestamo.alumno.nombre}}, @{{detalle.prestamo.alumno.apellidos}} </td> -->
                    <td> @{{detalle.correo}} </td>
                    <td> @{{detalle.prestamo.fechadevolucion}} </td>
                    <td>
                      <!-- <span class="btn btn-success" v-on:click="Datoscargar(detalle.foliodetalle)"><i class="nav-icon fas fa-reply-all"></i></span> -->
                      <span class="btn btn-primary" v-on:click="infoPrestamo(detalle.foliodetalle)"><i class="nav-icon fas fa-info"></i></span>
                      <span class="btn btn-dark" @click="sendMail(detalle.foliodetalle)"><i class="nav-icon fas fa-envelope"></i></span>
                      <span class="btn btn-success" @click="imprimir(detalle.foliodetalle)"><i class="fas fa-print"></i></span>
                    </td>
                  </tr>
                  <tr v-else style="background: #d95;">
                    <td> @{{detalle.folioprestamo}} </td>
                    <td> @{{detalle.isbn}} </td>
                    <td> @{{detalle.titulo}} </td>
                    <td> @{{detalle.id_prestador}} </td>
                    <!-- <td> @{{detalle.prestamo.alumno.nombre}}, @{{detalle.prestamo.alumno.apellidos}} </td> -->
                    <td> @{{detalle.correo}} </td>
                    <td> @{{detalle.prestamo.fechadevolucion}} </td>
                    <td>
                      <!-- <span class="btn btn-success" v-on:click="Datoscargar(detalle.foliodetalle)"><i class="nav-icon fas fa-reply-all"></i></span> -->
                      <span class="btn btn-primary" v-on:click="infoPrestamo(detalle.foliodetalle)"><i class="nav-icon fas fa-info"></i></span>
                      <span class="btn btn-dark" @click="sendMail(detalle.foliodetalle)"><i class="nav-icon fas fa-envelope"></i></span>
                      <span class="btn btn-success" @click="imprimir(detalle.foliodetalle)"><i class="fas fa-print"></i></span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- inicio ventana modal -->
      <div id="modal_custom" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <!--inicio modal dialog-->
        <div class="modal-dialog" role="document">
          <!--inicio modal content-->
          <div class="modal-content">
            <!-- se inicia el encabezado de la ventana modal -->
            <div class="modal-header" style="background-color: #f39c12">
              <h5 class="modal-title" id="exampleModalLiveLabel" v-if="editando">
                <font style="vertical-align: inherit;" face="Sylfaen" color="black">REGISTRANDO DEVOLUCIÓN</font>
              </h5>
              <h5 class="modal-title" id="exampleModalLiveLabel" v-if="!editando">
                <font style="vertical-align: inherit;" face="Sylfaen" color="black">INFORMACIÓN DEL LIBRO PRESTADO</font>
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="cancelarEdit()">
                <span aria-hidden="true">
                  <font style="vertical-align: inherit;">x</font>
                </span>
              </button>
            </div>
            <!-- fin encabezado de ventana modal -->

            <!-- inicio cuerpo modal -->
            <div class="modal-body div5">
              <font color="black" face="Sylfaen">
                <div class="row">
                  <div class="col-md-5">
                    <div class="form-group">
                      <label >CLAVE DEL DETALLE</label>
                      <div class="input-group">
                        <span class="form-control" style="border-color:#000"> @{{foliodetalle}} </span>
                        <!-- <input type="text" class="form-control" style="border-color: #000" v-model="foliodetalle" v-if="editando"> -->
                      </div>
                    </div>
                  </div>
                  <div class="col-md-7 ml-auto">
                    <div class="form-group">
                      <label>FOLIO DEL PRÉSTAMO</label>
                      <div class="input-group">
                        <span class="form-control" style="border-color:#000"> @{{folioprestamo}} </span>
                        <!-- <input type="text" class="form-control" style="border-color: #000" v-model="folioprestamo" v-if="editando"> -->
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>FOLIO DEL LIBRO</label>
                  <div class="input-group">
                    <span class="form-control" style="border-color:#000"> @{{isbn}} </span>
                    <!-- <input type="text" class="form-control" style="border-color: #000" v-model="isbn" v-if="editando"> -->
                  </div>
                </div>
                <div class="form-group">
                  <label>TÍTULO DEL LIBRO</label>
                  <div class="input-group">
                    <span class="form-control" style="border-color:#000"> @{{titulo}} </span>
                    <!-- <input type="text" class="form-control" style="border-color: #000" v-model="titulo" v-if="editando"> -->
                  </div>
                </div>
               <!--  <div class="form-group">
                  <label>FECHA DE DEVOLUCIÓN</label>
                  <div class="input-group">
                    <span v-if="editando" class="form-control" style="border-color:#000">
                      @{{prestamos.fechadevolucion}} 
                    </span>
                  </div>
                </div> -->
                <div class="form-group">
                  <label>CANTIDAD PRESTADA</label>
                  <div class="input-group">
                    <span class="form-control" style="border-color:#000"> @{{cantidad}} </span>
                  </div>
                </div>
              </font>
            </div>
            <!-- fin cuerpo modal -->

            <!-- footer modal -->
            <div class="modal-footer div1">
              <div class="pull-right">
                <button style="margin-left: 10px" type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="cancelarEdit()" v-if="!editando">ACEPTAR</button>
                <button style="margin-left: 10px" type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="cancelarEdit()" v-if="editando">CERRAR</button>
              </div>
              <div class="pull-right">
                <button style="margin-left: 10px" type="button" class="btn btn-primary" data-dismiss="modal" v-on:click="Devolver(auxDev)" v-if="editando">
                <span class="fas fa-check"></span>
                DEVOLVER</button>
              </div>
            </div><!-- fin footer modal -->
          </div> <!--fin modal content-->
        </div><!--/modal dialog-->
      </div><!--fin ventana modal-->

    </div>
 <!--  </div>	 -->
</div>

@endsection

@push('scripts')
  <script src="js/datos/historial.js"></script>
  <script src="js/moment-with-locales.min.js"></script>
@endpush