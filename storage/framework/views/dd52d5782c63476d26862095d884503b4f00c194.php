<?php $__env->startSection('titulo','Registro Libro'); ?>
<?php $__env->startSection('contenido'); ?>

<div id="registros">
  <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <br>
                <font color="black" face="Sylfaen">
                    <h2 class="text text-center">REGISTRO DE LIBROS</h2>
                </font>                
                
                <br>
                <div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <font face="Sylfaen" size="4"><label for="caratula">Imagen del libro:</label></font>
                            <input type="file" name="caratulafile[]" id="caratulafile[]" multiple @change="previewFiles" accept=".png, .jpg, .jpeg">
                        </div>
                        <div class="form-group col-md-8">
                            <!-- <img v-bind:src="previewFiles" class="img img-rounded" width="400px" height="200px" v-if="preview" name="caratulafile[]"> -->
                            <!-- <img v-bind:src="preview" class="img img-rounded" width="400px" height="200px" v-if="preview"> -->
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                          <font face="Sylfaen" size="4"><label for="isbn">Isbn del libro: <span class="asterisco">*</span></label></font>
                            <input type="text" name="isbn" placeholder="ISBN del libro" class="form-control" v-model="isbn" style="border-color:#000">
                        </div>
                        <div class="form-group col-md-6">
                           <font face="Sylfaen" size="4"><label for="titulo">Título del libro: <span class="asterisco">*</span></label></font>
                            <input type="text" name="titulo" placeholder="Título del libro" class="form-control" v-model="titulo" style="border-color:#000">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <font face="Sylfaen" size="4"><label for="editorial">Elija la editorial: <span class="asterisco">*</span></label></font>
                            <div class="input-group">
                                <select class="form-control" id="selectEditorial" v-model="id_editorial" @change="getEditorials" style="border-color:#000" name="id_editorial">
                                    <option disabled value="">Elija la editorial del libro</option>
                                    <!-- <option value="1">Agregar nueva editorial</option> -->
                                    <option v-for="e in editoriales" v-bind:value="e.id_editorial">{{e.editorial}}</option>
                                </select>
                                <span class="input-group-btn">
                                    <button id="agregarEditorial" class="btn btn-success btn-sm" type="button" v-on:click="showModalEditorial" title="Agregar Editorial"> 
                                    <span class="fas fa-plus-circle"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <font face="Sylfaen" size="4"><label for="autor">Elija el autor: <span class="asterisco">*</span></label></font>
                            <div class="input-group">
                                <select class="form-control" id="selectAutor" v-model="id_autor" @change="getAutors" style="border-color:#000" name="id_autor">
                                <option disabled value="">Elija el Autor del libro</option>
                                <option v-for="a in autores" v-bind:value="a.id_autor">{{a.nombre}}</option>
                                </select>
                                <span class="input-group-btn">
                                    <button id="agregarAutor" class="btn btn-success btn-sm" type="button" v-on:click="showModalAutor" title="Agregar Autor"> 
                                    <span class="fas fa-plus-circle"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <font face="Sylfaen" size="4"><label for="carrera">Elija la carrera: <span class="asterisco">*</span></label></font>
                        <div class="input-group">
                            <select class="form-control" v-model="id_carrera" @change="getCarreras" style="border-color:#000" name="id_carrera">
                            <option disabled value="">Elija la carrera del libro</option>
                            <option v-for="c in carreras" v-bind:value="c.id_carrera">{{c.carrera}}</option>
                            </select>
                            <span class="input-group-btn">
                            <button id="agregarCarrera" class="btn btn-success btn-sm" type="button" v-on:click="showModalCarrera" title="Agregar Carrera"> 
                            <span class="fas fa-plus-circle"></span>
                            </button>
                            </span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <font face="Sylfaen" size="4"><label for="pais">Elija el país: <span class="asterisco">*</span></label></font>
                            <div class="input-group">
                                <select class="form-control" v-model="id_pais" @change="getPaiss" style="border-color:#000" name="id_pais">
                                <option disabled value="">Elija el país del libro</option>
                                <option v-for="p in paises" v-bind:value="p.id_pais">{{p.pais}}</option>
                                </select>
                                <span class="input-group-btn">
                                <button id="agregarPais" class="btn btn-success btn-sm" type="button" v-on:click="showModalPais" title="Agregar País"> 
                                <span class="fas fa-plus-circle"></span>
                                </button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <font face="Sylfaen" size="4"><label for="edicion">Edición: <span class="asterisco">*</span></label></font>
                            <input type="number" name="edicion" placeholder="Edición" class="form-control" min="1" v-model="edicion" style="border-color:#000">
                        </div>
                        <div class="form-group col-md-2">
                            <font face="Sylfaen" size="4"><label for="anioPub">Año de publicación: <span class="asterisco">*</span></label></font>
                            <input type="text" name="anio_pub" placeholder="Año publicación" class="form-control" v-model="anio_pub" style="border-color:#000">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <font face="Sylfaen" size="4"><label for="fechaAlta">Fecha alta: <span class="asterisco">*</span></label></font>
                            <!-- <input type="date" name="fecha_alta" class="form-control" style="border-color:#000" v-model="fecha_alta"> -->
                            <span style="border-color:#000" class="form-control"> {{fecha_alta}} </span>
                        </div>
                        <div class="form-group col-md-4">
                            <font face="Sylfaen" size="4"><label for="noPagina">Número páginas: <span class="asterisco">*</span></label></font>
                            <input type="number" name="paginas" placeholder="Páginas" class="form-control" min="1" v-model="paginas" style="border-color:#000">
                        </div>
                        <div class="form-group col-md-4">
                            <font face="Sylfaen" size="4"><label for="ejemplares">Clasificación: <span class="asterisco">*</span></label></font>
                            <input type="text" name="clasificacion" placeholder="Clasificación" class="form-control" v-model="clasificacion" style="border-color:#000">
                        </div>
                    </div>

                    <div class="pull-right">
                        <button style="margin-left: 10px" type="submit" class="btn btn-primary" v-on:click="agregarLibro()" title="Guardar Libro">
                        <span class="fas fa-save"></span>
                        Guardar</button>
                    </div>  
                </div>
                <br>
            </div>
        </div>
    </div>

    <!-- inicio Modal Editorial -->
     <div id="Editorial" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <!--inicio modal dialog-->
          <div class="modal-dialog" role="document">
            <!--inicio modal content-->
            <div class="modal-content">
              <!-- se inicia el encabezado de la ventana modal -->
              <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLiveLabel">
                        <font style="vertical-align: inherit;" face="style">REGISTRANDO EDITORIAL</font>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="cancelarEdit()">
                      <span aria-hidden="true"><font style="vertical-align: inherit;">x</font></span>
                    </button>
              </div>
              <div class="modal-body div5">
                    <div class="form-group">
                        <font face="Sylfaen" size="4"><label for="Editoriales">Editorial del libro</label></font>
                        <input type="text" name="" placeholder="Editorial del libro" class="form-control" v-model="editorial">
                    </div>
              </div>
              <div class="modal-footer" style="background-color: #f39c12">
                <div class="pull-right">
                    <button style="margin-left: 10px" type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="cancelarEdit()">
                    <span class="far fa-window-close"></span>
                    Cancelar</button>
                </div>
                <div class="pull-right">
                    <button style="margin-left: 10px" type="submit" class="btn btn-primary" v-on:click="guardarEditorial()">
                    <span class="fas fa-save"></span>
                    Guardar</button>
                </div>
              </div>
          </div>
        </div>
    </div> <!-- fin Modal Editorial -->

    <!-- inicio Modal Autor -->
     <div id="Autor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <!--inicio modal dialog-->
          <div class="modal-dialog" role="document">
            <!--inicio modal content-->
            <div class="modal-content">
              <!-- se inicia el encabezado de la ventana modal -->
              <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLiveLabel">
                        <font style="vertical-align: inherit;" face="Sylfaen">REGISTRANDO AUTOR</font>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="cancelarEdit()">
                      <span aria-hidden="true"><font style="vertical-align: inherit;">x</font></span>
                    </button>
              </div>
              <div class="modal-body div5">
                    <div class="form-group">
                        <font face="Sylfaen" size="4"><label for="Autores">Autor del libro</label></font>
                        <input type="text" name="" placeholder="Autor del libro" class="form-control" v-model="nombre">
                    </div>
              </div>
              <div class="modal-footer" style="background-color: #f39c12">
                <div class="pull-right">
                    <button style="margin-left: 10px" type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="cancelarEdit()">
                    <span class="far fa-window-close"></span>
                    Cancelar</button>
                </div>
                <div class="pull-right">
                    <button style="margin-left: 10px" type="submit" class="btn btn-primary" v-on:click="guardarAutor()">
                    <span class="fas fa-save"></span>
                    Guardar</button>
                </div>
              </div>
          </div>
        </div>
    </div> <!-- fin Modal Autor -->

    <!-- inicio Modal Carrera -->
     <div id="Carrera" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <!--inicio modal dialog-->
          <div class="modal-dialog" role="document">
            <!--inicio modal content-->
            <div class="modal-content">
              <!-- se inicia el encabezado de la ventana modal -->
              <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLiveLabel">
                        <font style="vertical-align: inherit;" face="Sylfaen">REGISTRANDO CARRERA</font>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="cancelarEdit()">
                      <span aria-hidden="true"><font style="vertical-align: inherit;">x</font></span>
                    </button>
              </div>
              <div class="modal-body div5">
                    <div class="form-group">
                        <font face="Sylfaen" size="4"><label for="Carreras">Carrera del libro</label></font>
                        <input type="text" name="" placeholder="Carrera del libro" class="form-control" v-model="carrera">
                    </div>
              </div>
              <div class="modal-footer" style="background-color: #f39c12">
                <div class="pull-right">
                    <button style="margin-left: 10px" type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="cancelarEdit()">
                        <span class="far fa-window-close"></span>
                        Cancelar
                    </button>
                </div>
                <div class="pull-right">
                    <button style="margin-left: 10px" type="submit" class="btn btn-primary" v-on:click="guardarCarrera()">
                        <span class="fas fa-save"></span>
                        Guardar
                    </button>
                </div>
              </div>
          </div>
        </div>
    </div> <!-- fin Modal Carrera -->

    <!-- inicio Modal País -->
     <div id="Pais" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <!--inicio modal dialog-->
          <div class="modal-dialog" role="document">
            <!--inicio modal content-->
            <div class="modal-content">
              <!-- se inicia el encabezado de la ventana modal -->
              <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLiveLabel">
                        <font style="vertical-align: inherit;" face="Sylfaen">REGISTRANDO PAÍS</font>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="cancelarEdit()">
                        <span aria-hidden="true">
                            <font style="vertical-align: inherit;">x</font>
                        </span>
                    </button>
                <!-- <span aria-hidden="true">&times;</span> -->
              </div>
              <div class="modal-body div5">
                    <div class="form-group">
                        <font face="Sylfaen" size="4"><label for="Paises">País del libro</label></font>
                        <input type="text" name="" placeholder="País del libro" class="form-control" v-model="pais">
                    </div>
              </div>
              <div class="modal-footer" style="background-color: #f39c12">
                <div class="pull-right">
                    <button style="margin-left: 10px" type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="cancelarEdit()">
                        <span class="far fa-window-close"></span>
                        Cancelar
                    </button>
                </div>
                <div class="pull-right">
                    <button style="margin-left: 10px" type="submit" class="btn btn-primary" v-on:click="guardarPais()">
                        <span class="fas fa-save"></span>
                        Guardar
                    </button>
                </div>
              </div>
          </div>
        </div>
    </div> <!-- fin Modal País -->

</div> <!-- fin div principal -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<link rel="stylesheet" type="text/css" href="css/form_prestamo/prestamos.css">
<script type="text/javascript" src="js/datos/registroLibro.js"></script>
<!-- <script src="js/moment-with-locales.min.js"></script> -->
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Gestion_Biblioteca\resources\views/admin/registroLibro.blade.php ENDPATH**/ ?>