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
        <br>
        <font color="black" face="times new roman">
          <h2 class="text text-center">PRESTAMOS REALIZADOS</h2>
        </font>
        <br>

        <table class="table table-sm table-striped table-bordered table-hover">
          <thead class="thead-dark">
            <th>CLAVE</th>
            <th>FOLIO</th>
            <th>ISBN</th>
            <th>TITULO</th>
            <th>DEVUELTO</th>
            <th>CANTIDAD</th>
            <!-- <th>Consec</th> -->
          </thead>

          <tbody>
            <tr v-for="(detalle,index) in filtroDetalles">
              <td v-on:click="infoPrestamo(detalle.foliodetalle)">@{{detalle.foliodetalle}}</td>
              <td v-on:click="infoPrestamo(detalle.foliodetalle)">@{{detalle.folioprestamo}}</td>
              <td v-on:click="infoPrestamo(detalle.foliodetalle)">@{{detalle.isbn}}</td>
              <td v-on:click="infoPrestamo(detalle.foliodetalle)">@{{detalle.titulo}}</td>
              <td v-on:click="infoPrestamo(detalle.foliodetalle)">@{{detalle.devuelto}}</td>
              <td v-on:click="infoPrestamo(detalle.foliodetalle)">@{{detalle.cantidad}}</td>
              <!-- <td v-on:click="infoPrestamo(prestamo.folioprestamo)">@{{prestamo.consec}}</td> -->
            </tr>
          </tbody>

        </table>
      </div>

      <!-- inicio ventana modal -->
      <div id="modal_custom" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <!--inicio modal dialog-->
        <!--inicio modal dialog-->
        <div class="modal-dialog" role="document">
          <!--inicio modal content-->
          <div class="modal-content">
            <!-- se inicia el encabezado de la ventana modal -->
            <div class="modal-header" style="background-color: #f39c12">
              <!-- <h5 class="modal-title" id="exampleModalLiveLabel" v-if="!editando"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Registro Nuevo Devolucion</font></font></h5> -->
              <h5 class="modal-title" id="exampleModalLiveLabel" v-if="editando">
                <font style="vertical-align: inherit;" face="times new roman" color="black">INFORMACION DEL LIBRO PRESTADO</font>
              </h5>
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="cancelarEdit()">
                <span aria-hidden="true">
                  <font style="vertical-align: inherit;">x</font>
                </span>
              </button>
            </div>
            <!-- fin encabezado de ventana modal -->

            <!-- inicio cuerpo modal -->
            <div class="modal-body div1">
              <font color="black" face="times new roman">
                <div class="form-group">
                  <label>Clave del detalle</label>
                  <div class="input-group">
                      <span v-if="editando" class="form-control"> @{{foliodetalle}} </span>
                  </div>
                </div>
                <div class="form-group">
                  <label>Folio del prestamo</label>
                  <div class="input-group">
                      <span v-if="editando" class="form-control"> @{{folioprestamo}} </span>
                  </div>
                </div>
                <div class="form-group">
                  <label>Folio del libro</label>
                  <div class="input-group">
                      <span v-if="editando" class="form-control"> @{{isbn}} </span>
                  </div>
                </div>
                <div class="form-group">
                  <label>Titulo del libro</label>
                  <div class="input-group">
                      <span v-if="editando" class="form-control"> @{{titulo}} </span>
                  </div>
                </div>
                <div class="form-group">
                  <label>Indicador de devolución</label>
                  <div class="input-group">
                      <span v-if="editando" class="form-control"> @{{devuelto}} </span>
                  </div>
                </div>
                <div class="form-group">
                  <label>Cantidad prestada</label>
                  <div class="input-group">
                      <span v-if="editando" class="form-control"> @{{cantidad}} </span>
                  </div>
                </div>
                <div class="form-group">
                  <label>Consecuente</label>
                  <div class="input-group">
                      <span v-if="editando" class="form-control"> @{{consec}} </span>
                  </div>
                </div>
              </font>
            </div>
            <!-- fin cuerpo modal -->

            <!-- footer modal -->
            <div class="modal-footer div1">
              <div class="pull-right">
                  <button style="margin-left: 10px" type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="cancelarEdit()">Aceptar</button>
              </div>
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
  <script src="js/admin/devoluciones.js"></script>
  <script src="js/moment-with-locales.min.js"></script>
@endpush