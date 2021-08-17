@extends('layouts.layout')
@section('titulo','Libros')
@section('contenido')

<!-- El id es del identificador del js -->
<div id="libro">

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

  <div class="row">
    <div class="col-md-12">
    <div class="table-responsive-md">
      <button class="btn btn-success" v-on:click="showModal">
      <span class="fas fa-plus-circle"></span>
        Nuevo Libro
      </button>

      <!-- <button class="btn btn-warning glyphicon glyphicon-plus" v-on:click="showModals">
        Agregar Ejemplar
      </button> -->
      <!-- <a href="{{url('prestacion')}}">
        <button class="btn btn-danger glyphicon glyphicon-send" style="float: right;">
          Prestar libro
        </button>
      </a> -->
      <br>
      <font color="black" face="times new roman">
        <h1 class="text text-center">Libros Registrados</h1>
      </font>
      <table class="table table-sm table-striped table-bordered table-hover">
        <thead class="thead-dark">
          <th width="7%">ISBN</th>
          <th>TITULO</th>
          <th>AUTOR</th>
          <th>EDITORIAL</th>
          <th>CARRERA</th>
          <th width="8%">EJEMPLARES</th>
          <!-- <th width="5%">CUTTER</th> -->
          <th width="15%">OPCIONES</th>
        </thead>
        <tbody>
          <tr v-for="(libro,index) in filtroLibros">
            <td v-on:click="">@{{libro.isbn}}</td>
            <td v-on:click="">@{{libro.titulo}}</td>
            <td v-on:click="">@{{libro.autor.nombre}}</td>
            <td v-on:click="">@{{libro.editorial.editorial}}</td>
            <td v-on:click="">@{{libro.carrera.nombre}}</td>
            <td v-on:click="">@{{libro.ejemplares}}</td>
            <!-- <td v-on:click="">@{{libro.cutter}}</td> -->
            <td>
              <center>

                <span class="btn btn-primary fas fa-edit" 
                v-on:click="editLibro(libro.isbn)"></span>
               
                <span class="btn btn-danger fas fa-trash-alt" 
                v-on:click="eliminarLibro(libro.isbn)"></span>

                <span class="btn btn-success fas fa-share-square" v-on:click="showModals"></span>
                
              </center>
            </td> 
          </tr>
        </tbody>
      </table>
    </div>
    <!-- inicio ventana modal -->
    <div id="modal_custom" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="addlibro">
      <!--inicio modal dialog-->
      <div class="modal-dialog" role="document">
        <!--inicio modal content-->
        <div class="modal-content">
          <!-- se inicia el encabezado de la ventana modal -->
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLiveLabel" v-if="!editando"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Registrando Libro</font></font></h5>
            <h5 class="modal-title" id="exampleModalLiveLabel" v-if="editando"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Editando Libro</font></font></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="cancelarEdit()">
              <span aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></span>
            </button>
            <!-- <span aria-hidden="true">&times;</span> -->
          </div>

          <!-- inicio cuerpo modal -->
          <div class="modal-body div1">
            <div class="form-group">
              <label for="isbn">Isbn del libro</label>
              <input type="text" name="" placeholder="ISBN del libro" class="form-control" v-model="isbn">
            </div>
            <!-- <input type="text" name="" placeholder="ISBN del libro" class="form-control" v-model='isbn'> -->
            
            <div class="form-group">
              <label for="titulo">Titulo del libro</label>
              <input type="text" name="" placeholder="Titulo del libro" class="form-control" v-model="titulo">
            </div>
            <!-- <input type="text" name="" placeholder="Titulo del libro" class="form-control" v-model="titulo"> -->
            
            <div class="form-group">
            <label for="editorial">Elija la editorial</label>
            <div class="input-group">
              <select class="form-control" id="selectEditorial" v-model="id_editorial" @change="getEditorial">
             
                <option disabled value="">Elija la editorial del libro</option>
                <option value="">Agregar Nuevo</option>
                <!-- <option value="1">Agregar nueva editorial</option> -->
                <option v-for="e in editoriales" v-bind:value="e.id_editorial">@{{e.editorial}}</option>
              </select>
              
              
              <span class="input-group-btn">
                <button id="agregarEditorial" class="btn btn-success" type="button" v-on:click="showModalEditorial"> 
                  Agregar  <span class="fas fa-plus-circle"></span>
                </button>
              </span>
            </div>
            </div>
            <div class="form-group">
            <label for="autor">Elija el autor</label>
            <div class="input-group">
                <select class="form-control" v-model="id_autor" @change="getAutor">
                  <option disabled value="">Elija el Autor del libro</option>
                  <option v-for="a in autores" v-bind:value="a.id_autor">@{{a.nombre}}</option>
                </select>
                <span class="input-group-btn">
                    <button id="agregarEditorial" class="btn btn-success" type="button" onclick=""> 
                      Agregar  <span class="fas fa-plus-circle"></span>
                    </button>
                </span>
            </div>
            </div>

            <div class="form-group">
            <label for="carrera">Elija la carrera</label>
            <div class="input-group">
                <select class="form-control" v-model="id_carrera" @change="getCarrera">
                  <option disabled value="">Elija la carrera del libro</option>
                  <option v-for="c in carreras" v-bind:value="c.id_carrera">@{{c.nombre}}</option>
                </select>
                <span class="input-group-btn">
                  <button id="agregarEditorial" class="btn btn-success" type="button" onclick=""> 
                    Agregar  <span class="fas fa-plus-circle"></span>
                  </button>
                </span>
            </div>
            </div>
           
            <div class="form-group">
              <label for="edicion">Edicion</label>
              <input type="number" name="" placeholder="Edicion" class="form-control" min="1" v-model="edicion">
            </div>

            <div class="form-group">
            <label for="anioPub">Año de publicación</label>
            <input type="text" name="" placeholder="Año publicacion" class="form-control" v-model="anio_pub">
            </div>
            
            <div class="form-group">
            <label for="pais">Elija el pais</label>
            <div class="input-group">
                <select class="form-control" v-model="id_pais" @change="getPais">
                  <option disabled value="">Elija el pais del libro</option>
                  <option v-for="p in paises" v-bind:value="p.id_pais">@{{p.pais}}</option>
                </select>
                <span class="input-group-btn">
                  <button id="agregarEditorial" class="btn btn-success" type="button" onclick=""> 
                  Agregar  <span class="fas fa-plus-circle"></span>
                  </button>
                </span>
            </div>
            </div>

            <div class="form-group">
              <label for="fechaAlta">Fecha alta</label>
              <input type="date" name="" placeholder="Fecha alta" class="form-control" v-model="fecha_alta">
            </div>

            <div class="form-group">
              <label for="noPagina">Numero páginas</label>
              <input type="number" name="" placeholder="Paginas" class="form-control" min="1" v-model="paginas">
            </div>

            <div class="form-group">
              <label for="ejemplares">Ejemplares del libro</label>
              <input type="text" name="" placeholder="Ejemplares del libro" class="form-control" v-model="ejemplares">
            </div>

            <div class="form-group">
              <label for="clasificacion">Clasificación</label>
              <input type="text" name="" placeholder="Clasificacion" class="form-control" v-model="clasificacion">
            </div>

            <div class="form-group">
              <label for="cutter">Cutter del libro</label>
              <input type="text" name="" placeholder="Cutter del libro" class="form-control" v-model="cutter">
            </div>
          </div>
          
          <!-- fin cuerpo modal -->

          <!-- footer modal -->
          <div class="modal-footer div1">
            <div class="pull-right">
                <button style="margin-left: 10px" type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="cancelarEdit()">
                <span class="far fa-window-close"></span>
                Cancelar</button>
            </div>

            <div class="pull-right">
                <button style="margin-left: 10px" type="submit" class="btn btn-primary" v-on:click="agregarLibro()" v-if="!editando">
                <span class="fas fa-save"></span>
                Guardar</button>
            </div>
            
            <button type="submit" class="btn btn-primary" v-on:click="updateLibro(auxLibro)" v-if="editando">
           
            Actualizar</button>
          </div>
          </div>
          <!-- fin footer modal -->
        </div> <!-- fin modal content -->
      </div>  <!--/modal dialog -->
    </div> <!-- fin ventana modal -->


    <!-- declaracion de codigo para la ventana modal de ejemplares -->

    <!-- inicio ventana modal -->
      <div id="modal_customs" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="addejemplar">
        <!--inicio modal dialog-->
        <div class="modal-dialog" role="document">
          <!--inicio modal content-->
          <div class="modal-content">
            <!-- se inicia el encabezado de la ventana modal -->
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLiveLabel" v-if="!editejem"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Registro Nuevo Ejemplar</font></font></h5>
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="cancelEditj()">
                <span aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></span>
              </button>
              <!-- <span aria-hidden="true">&times;</span> -->
            </div>
            <!-- fin encabezado de ventana modal -->

            <!-- inicio cuerpo modal -->
            <div class="modal-body div1">
              <!-- <div class="form-group"> -->
                <label for="clasificacion">Clasificación del ejemplar</label>
                <input type="text" name="" placeholder="clasificacion del ejemplar" class="form-control" v-model='clasificacion'>
              <!-- </div> -->
              <!-- <div class="form-group"> -->
                <label for="folio">Folio del Libro</label>
                <input type="text" name="" placeholder="folio del libro" class="form-control" v-model="folio">
              <!-- </div> -->
              <!-- <div class="form-group"> -->
                <label for="esbase">Identificador de base del ejemplar</label>
                <input type="text" name="" placeholder="identificador de base" class="form-control" v-model="esbase">  
              <!-- </div> -->
              <!-- <div class="form-group"> -->
                <label for="prestado">Indicador de prestamo de ejemplar</label>
                <input type="text" name="" placeholder="identificador de prestamo" class="form-control" v-model="prestado">
              <!-- </div> -->
              <label for="comentario">Comentario sobre el ejemplar</label> 
              <input type="text" placeholder="Comentario sobre el ejemplar" class="form-control" v-model="comentario">

              <label for="consec">Consecuente del libro</label>
              <input type="text" name="" placeholder="Consec" class="form-control" v-model="consec">

              <label for="fecha_alta">Fecha de alta del ejemplar</label>
              <input type="date" name="" placeholder="Fecha de Alta" class="form-control" v-model="fecha_alta">

              <label for="solodewee">Solo dewee del ejemplar</label>
              <input type="text" name="" placeholder="Solo Dewee" class="form-control" v-model="solodewee">

              <label for="deweecompleto"> Dewee Completo</label>
              <input type="text" name="" placeholder="Dewee completo" class="form-control" v-model="deweecompleto">
            </div><!-- fin cuerpo modal -->

            <!-- footer modal -->
            <div class="modal-footer div1">
              <div class="pull-right">
                  <button style="margin-left: 10px" type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="cancelEditj()">Cancelar</button>
              </div>

              <div class="pull-right">
                  <button style="margin-left: 10px" type="submit" class="btn btn-primary" v-on:click="agregarEjemplar()" v-if="!editejem">Guardar</button>
              </div>
            </div><!-- fin footer modal -->
          </div> <!--fin modal content-->
        </div><!--/modal dialog-->
      </div><!--fin ventana modal-->



    <!-- CODIICACIÓN DEL MODAL EDITORIALES -->
 <!-- inicio ventana modal -->
 <div id="Editorial" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="">
      <!--inicio modal dialog-->
      <div class="modal-dialog" role="document">
        <!--inicio modal content-->
        <div class="modal-content">
          <!-- se inicia el encabezado de la ventana modal -->
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLiveLabel" v-if="!editando"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">REGISTRANDO EDITORIAL</font></font></h5>
            <h5 class="modal-title" id="exampleModalLiveLabel" v-if="editando"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Editando Editorial</font></font></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="cancelarEdit()">
              <span aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></span>
            </button>
            <!-- <span aria-hidden="true">&times;</span> -->
          </div>

          <!-- fin cuerpo modal -->
          <div class="modal-body div1">
          <div class="form-group">
                    <label for="Editoriales">Editorial del libro</label>
                    <input type="text" name="" placeholder="Editorial del libro" class="form-control" v-model="editorial">
              </div>
          </div>
          <!-- footer modal -->
          <div class="modal-footer div1">
            <div class="pull-right">
                <button style="margin-left: 10px" type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="cancelarEdit()">
                <span class="far fa-window-close"></span>
                Cancelar</button>
            </div>

            <div class="pull-right">
                <button style="margin-left: 10px" type="submit" class="btn btn-primary" v-on:click="" v-if="!editando">
                <span class="fas fa-save"></span>
                Guardar</button>
            </div>
            
            <button type="submit" class="btn btn-primary" v-on:click="" v-if="editando">
           
            Actualizar</button>
          </div>
          </div>
          <!-- fin footer modal -->
        </div> <!-- fin modal content -->
      </div>  <!--/modal dialog -->
    </div> <!-- fin ventana modal -->
  </div>
</div>

@endsection

@push('scripts')
  <script type="text/javascript" src="js/admin/libros.js"></script>

  <!-- <script type="text/javascript" src="js/admin/ejemplares.js"></script> -->
  <script type="text/javascript" src="js/vue-resource.js"></script>
  <script type="text/javascript" src="js/vue.js"></script>
@endpush