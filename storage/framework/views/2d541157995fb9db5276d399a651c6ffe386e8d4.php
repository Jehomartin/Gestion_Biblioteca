<?php $__env->startSection('titulo','Libros'); ?>
<?php $__env->startSection('contenido'); ?>
<!-- links para los css -->
<!-- <link rel="stylesheet" href="css/personalizados/stylo3.css"> -->
<!--  -->

<!-- El id es del identificador del js INICIO-->
<div id="libro">

    <!-- INICIO DIV DE TITULO -->
    <div class="container ">
      <div class="row">
        <div class="col-md-3"></div>
          <div class="col-md-6">
            <font color="black" face="Sylfaen">
              <h2 class="text text-center">LIBROS REGISTRADOS</h2>
            </font>
          </div>
          <div class="col-md-3"></div>
      </div>
    </div>
    <!-- FIN DIV TITULO -->

    <div class="container">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <!-- search form (Optional) -->
          <div class="input-group">
            <input type="text" name="buscarpor" class="form-control" placeholder="Buscar..." style="border-color: #000" v-model="buscar">
            <span class="input-group-btn">
              <button title="Buscar" type="submit" name="search" id="search-btn" class="btn btn-flat" style="background-color: orange"><i class="fa fa-search"></i>
              </button>
            </span>
          </div>
          <!-- /.search form -->
        </div>
        <div class="col-md-2"></div>
      </div>
    </div>
    <br>

    <div>
      <div>
        <nav>
          <ul class="pagination pull-right">
            <li class="page-item" v-if="pagination.current_page > 1">
              <a class="page-link" href="#" @click.prevent="NextPage(pagination.current_page - 1)">
                <span>Atrás</span>
              </a>
            </li>
            <li v-for="page in PagesNo" v-bind:class="[page == Activates ? 'page-item active' : 'page-item']">
              <a class="page-link" href="#" @click.prevent="NextPage(page)">
                {{ PagesNo}}
              </a>
            </li>
            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
              <a class="page-link" href="#" @click.prevent="NextPage(pagination.current_page + 1)">
                <span>Siguiente</span>
              </a>
            </li>
          </ul>
        </nav>
        <div id="table-scroll">
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive-md">
                <table style="font-size:14px" class="table table-sm table-striped table-bordered table-hover tamanio-font" id="tabLibros">
                  <thead class="thead-dark">
                    <th width="7%" class="header" scope="col">ISBN</th>
                    <th class="header" scope="col">TÍTULO</th>
                    <th class="header" scope="col">AUTOR</th>
                    <th class="header" scope="col">EDITORIAL</th>
                    <th class="header" scope="col">CARRERA</th>
                    <th width="8%" class="header" scope="col">EJEMPLARES</th>
                    <th width="15%" class="header" scope="col">OPCIONES</th>
                  </thead>
                  <tbody>
                    <tr v-for="(libro,index) in filtroLibros">
                      <td>{{libro.isbn}}</td>
                      <td>{{libro.titulo}}</td>
                      <td>{{libro.autor.nombre}}</td>
                      <td>{{libro.editorial.editorial}}</td>
                      <td>{{libro.carrera.carrera}}</td>
                      <td>{{libro.ejemplares}}</td>
                      <td>
                        <center>

                          <span class="btn btn-primary btn-sm" 
                          v-on:click="editLibro(libro.isbn)" title="Editar libro"><i class="fas fa-edit"></i></span>
                         
                          <span class="btn btn-danger btn-sm" 
                          v-on:click="eliminarLibro(libro.isbn)" title="Eliminar libro"><i class="fas fa-trash-alt"></i></span>

                          <span class="btn btn-success btn-sm" v-on:click="loadExample(libro.isbn)" title="Agregar Ejemplar"><i class="far fa-copy"></i></span>

                          <a :href="'libros/detallelibro/'+libro.isbn">
                            <span type="button" title="Ver Detalles" class="btn btn-fb btn-outline-dark btn-sm" title="Ver detalles">
                              <i class="fas fa-eye"></i>
                            </span>
                          </a>
                          
                        </center>
                      </td> 
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- INICIO MODAL lIBROS -->
    <!-- inicio ventana modal -->
    <div id="modal_custom" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <!--inicio modal dialog-->
      <div class="modal-dialog modal-lg" role="document">
        <!--inicio modal content-->
        <div class="modal-content">
          <!-- se inicia el encabezado de la ventana modal -->
          <div class="modal-header" style="background-color: #f39c12">
            <h5 class="modal-title" id="exampleModalLiveLabel">
              <font style="vertical-align: inherit;" face="Sylfaen">EDITANDO LIBRO</font>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="cancelarEdit()">
              <span aria-hidden="true"><font style="vertical-align: inherit;">x</font></span>
            </button>
          </div>
          <!-- fin encabezado modal -->

          <!-- inicio cuerpo modal -->
          <div class="modal-body div5">
            <div class="row">
              <div class="form-group col-md-6">
                <font face="Sylfaen" size="4"><label for="caratula">Imagen del libro:</label></font>
                <input type="file" name="caratulafile[]" id="caratulafile[]" multiple @change="previewFiles" accept=".png, .jpg, .jpeg">
              </div>
            </div>
            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label for="isbn">
                    <font face="Sylfaen" size="4">Isbn del libro</font>
                  </label>
                  <input type="text" name="" placeholder="ISBN del libro" class="form-control" v-model="isbn" style="border-color:#000">
                </div>
              </div>
              <div class="col-md-7 ml-auto">
                <div class="form-group">
                  <label for="titulo">
                    <font face="Sylfaen" size="4">Título del libro</font>
                  </label>
                  <input type="text" name="" placeholder="Titulo del libro" class="form-control" v-model="titulo" style="border-color:#000">
                </div>
              </div>
            </div>
            <!-- <input type="text" name="" placeholder="Titulo del libro" class="form-control" v-model="titulo"> -->
            
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="editorial">
                    <font face="Sylfaen" size="4">Elija la editorial</font>
                  </label>
                <div class="input-group">
                  <select class="form-control" id="selectEditorial" v-model="id_editorial" @change="getEditorial" style="border-color:#000">
                    <option disabled value="">Elija la editorial del libro</option>
                    <!-- <option value="1">Agregar nueva editorial</option> -->
                    <option v-for="e in editoriales" v-bind:value="e.id_editorial">{{e.editorial}}</option>
                  </select>
                </div>
                </div>
              </div>

              <div class="col-md-6 ml-auto">
                <div class="form-group">
                  <label for="autor">
                    <font face="Sylfaen" size="4">Elija el autor</font>
                  </label>
                <div class="input-group">
                  <select class="form-control" v-model="id_autor" @change="getAutor" style="border-color:#000">
                    <option disabled value="">Elija el Autor del libro</option>
                    <option v-for="a in autores" v-bind:value="a.id_autor">{{a.nombre}}</option>
                  </select>
                </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="carrera">
                    <font face="Sylfaen" size="4">Elija la carrera</font>
                  </label>
                <div class="input-group">
                  <select class="form-control" v-model="id_carrera" @change="getCarrera" style="border-color:#000">
                    <option disabled value="">Elija la carrera del libro</option>
                    <option v-for="c in carreras" v-bind:value="c.id_carrera">{{c.carrera}}</option>
                  </select>
                </div>
                </div>
              </div>

              <div class="col-md-6 ml-auto">
                <div class="form-group">
                  <label for="edicion">
                    <font face="Sylfaen" size="4">Edición</font>
                  </label>
                  <input type="number" name="" placeholder="Edicion" class="form-control" min="1" v-model="edicion" style="border-color:#000">
                </div>
              </div>
            </div>
           
            
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="anioPub">
                    <font face="Sylfaen" size="4">Año de publicación</font>
                  </label>
                <input type="text" name="" placeholder="Año publicacion" class="form-control" v-model="anio_pub" style="border-color:#000">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="pais">
                    <font face="Sylfaen" size="4">Elija el país</font>
                  </label>
                  <div class="input-group">
                    <select class="form-control" v-model="id_pais" @change="getPais" style="border-color:#000">
                      <option disabled value="">Elija el país del libro</option>
                      <option v-for="p in paises" v-bind:value="p.id_pais">{{p.pais}}</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                    <label for="pais">
                      <font face="Sylfaen" size="4">Clasificación</font>
                    </label>   
                    <input type="text" name="" placeholder="Clasificacion" class="form-control" v-model="clasificacion" style="border-color:#000">
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="fechaAlta">
                    <font face="Sylfaen" size="4">Fecha alta</font>
                  </label>
                  <input type="date" name="" placeholder="Fecha alta" class="form-control" v-model="fecha_alta"  style="border-color:#000">
                </div>
              </div>
               <div class="col-md-4">
                  <div class="form-group">
                    <label for="noPagina">
                      <font face="Sylfaen" size="4">Número de paginas</font>
                    </label>
                    <input type="number" name="" placeholder="Paginas" class="form-control" min="1" v-model="paginas" style="border-color:#000">
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                    <label for="ejemplares">
                      <font face="Sylfaen" size="4">Ejemplares del libro</font>
                    </label>
                    <input type="text" name="" placeholder="Ejemplares del libro" class="form-control" v-model="ejemplares" style="border-color:#000">
                  </div>
               </div>
            </div>
          </div>
          <!-- fin cuerpo modal -->

          <!-- footer modal -->
          <div class="modal-footer" style="background-color: #f39c12">
            <div class="pull-right">
                <button style="margin-left: 10px" type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="cancelarEdit()">
                <span class="far fa-window-close"></span>
                Cancelar</button>
            </div>

            <div class="pull-right">
                <button style="margin-left: 10px" type="button" class="btn btn-primary" data-dismiss="modal" v-on:click="updateLibro(auxLibro)">
                <span class="fas fa-check"></span>
                Actualizar</button>
            </div>
          </div><!-- fin footer modal -->
        </div> <!-- fin modal content -->
      </div>  <!--/modal dialog -->
    </div> <!-- fin ventana modal -->
    <!-- FIN MODAL LIBROS -->

    <!-- INICIO MODAL EJEMPLARES -->
    <!-- inicio ventana modal -->
    <div id="modal_ejemplar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <!--inicio modal dialog-->
        <div class="modal-dialog" role="document">
          <!--inicio modal content-->
          <div class="modal-content">
            <!-- se inicia el encabezado de la ventana modal -->
            <div class="modal-header" style="background-color:#f39c12">
              <h5 class="modal-title" id="exampleModalLiveLabel" v-if="editejem"><font color="black" style="vertical-align: inherit;" face="Sylfaen">Registro Nuevo Ejemplar</font></h5>
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="cancelEditj()">
                <span aria-hidden="true"><font style="vertical-align: inherit;">x</font></span>
              </button>
            </div>
            <!-- fin encabezado de ventana modal -->

            <!-- inicio cuerpo modal -->
            <div class="modal-body div5" >
              <!-- <div class="form-group"> -->
              <div class="form-group">
                <label for="id_ejemplar">
                <font face="Sylfaen" size="4">Clasificación:</font>
                </label>
                <span class="form-control" style="border-color:#000"> {{id_ejemplar}} </span>
              </div>
              <div class="form-group">
                <label for="folio">
                  <font face="Sylfaen" size="4">Folio del libro:</font>
                </label>
                <input type="text" name="" placeholder="folio del libro" class="form-control" style="border-color:#000" v-model="folio">
              </div>
                <!-- </div> -->
              <!-- <div class="form-group"> -->
              <div class="form-group">
                <label for="titulo">
                  <font face="Sylfaen" size="4">Título:</font>
                </label>
                <input type="text" name="" placeholder="titulo" class="form-control" style="border-color:#000" v-model="titulo">
              </div>
                <!-- </div> -->
              <div class="form-group">
                <label for="fecha_alta">
                  <font face="Sylfaen" size="4">FECHA DE ALTA:</font>
                </label>
                <span class="form-control" style="border-color:#000"> {{fechalta}} </span>
                  <!-- <input type="date" name="" class="form-control" v-model="fecha_alta" placeholder="Fecha de Alta" style="border-color: #000;" value="date"> -->
              </div>
              <!-- <div class="form-group"> -->
                <label for="ejemplares">
                  <font face="Sylfaen" size="4">No. de ejemplar</font>
                </label>
                <input type="text" name="" placeholder="No. de ejemplar" class="form-control" style="border-color:#000" v-model="ejemplares">  
              <!-- </div> -->

            </div><!-- fin cuerpo modal -->

            <!-- footer modal -->
            <div class="modal-footer" style="background-color: #f39c12">
              <div class="pull-right">
                  <button style="margin-left: 10px" type="button" class="btn btn-danger fas fa-window-close" data-dismiss="modal" v-on:click="cancelEditj()"> Cancelar</button>
              </div>

              <div class="pull-right">
                  <button style="margin-left: 10px" type="submit" class="btn btn-primary fas fa-save" v-on:click="agregarEjemplar()" v-if="editejem"> Guardar</button>
              </div>
            </div><!-- fin footer modal -->
          </div> <!--fin modal content-->
        </div><!--/modal dialog-->
    </div><!--fin ventana modal-->
      <!-- FIN MODAL EJEMPLARES -->
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  <script type="text/javascript" src="js/datos/libros.js"></script>
  <link rel="stylesheet" type="text/css" href="css/diseño tabla/header_fijo.css">
  <link rel="stylesheet" type="text/css" href="css/personalizados/info.css">
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Gestion_Biblioteca\resources\views/admin/libros.blade.php ENDPATH**/ ?>