@extends('layouts.layout')
@section('titulo','Registro Libro')
@section('contenido')

<div id="registros">
  <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <font color="black" face="times new roman">
                    <h2 class="text text-center">REGISTRO DE LIBROS</h2>
                </font>
                <br>
                <p class="text text-center">
                    Por favor llene los campos importantes marcados con el ASTERISCO <span class="asterisco">*</span>
                </p>
                <br>
                <div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="isbn">Isbn del libro <span class="asterisco">*</span></label>
                            <input type="text" name="" placeholder="ISBN del libro" class="form-control" v-model="isbn" style="border-color:#000">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="titulo">Titulo del libro <span class="asterisco">*</span></label>
                            <input type="text" name="" placeholder="Titulo del libro" class="form-control" v-model="titulo" style="border-color:#000">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editorial">Elija la editorial <span class="asterisco">*</span></label>
                            <div class="input-group">
                                <select class="form-control" id="selectEditorial" v-model="id_editorial" @change="getEditorials" style="border-color:#000">
                                
                                    <option disabled value="">Elija la editorial del libro</option>
                                    <option value="">Agregar Nuevo</option>
                                    <!-- <option value="1">Agregar nueva editorial</option> -->
                                    <option v-for="e in editoriales" v-bind:value="e.id_editorial">@{{e.editorial}}</option>
                                </select>
                                
                                
                                <span class="input-group-btn">
                                    <button id="agregarEditorial" class="btn btn-success" type="button" v-on:click="showModalEditorial"> 
                                    <span class="fas fa-plus-circle"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="autor">Elija el autor <span class="asterisco">*</span></label>
                            <div class="input-group">
                                <select class="form-control" id="selectAutor" v-model="id_autor" @change="getAutors" style="border-color:#000">
                                <option disabled value="">Elija el Autor del libro</option>
                                <option v-for="a in autores" v-bind:value="a.id_autor">@{{a.nombre}}</option>
                                </select>
                                <span class="input-group-btn">
                                    <button id="agregarAutor" class="btn btn-success" type="button" v-on:click="showModalAutor"> 
                                    <span class="fas fa-plus-circle"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="carrera">Elija la carrera <span class="asterisco">*</span></label>
                        <div class="input-group">
                            <select class="form-control" v-model="id_carrera" @change="getCarreras" style="border-color:#000">
                            <option disabled value="">Elija la carrera del libro</option>
                            <option v-for="c in carreras" v-bind:value="c.id_carrera">@{{c.carrera}}</option>
                            </select>
                            <span class="input-group-btn">
                            <button id="agregarCarrera" class="btn btn-success" type="button" v-on:click="showModalCarrera"> 
                            <span class="fas fa-plus-circle"></span>
                            </button>
                            </span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="pais">Elija el pais <span class="asterisco">*</span></label>
                            <div class="input-group">
                                <select class="form-control" v-model="id_pais" @change="getPaiss" style="border-color:#000">
                                <option disabled value="">Elija el pais del libro</option>
                                <option v-for="p in paises" v-bind:value="p.id_pais">@{{p.pais}}</option>
                                </select>
                                <span class="input-group-btn">
                                <button id="agregarPais" class="btn btn-success" type="button" v-on:click="showModalPais"> 
                                <span class="fas fa-plus-circle"></span>
                                </button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="edicion">Edicion <span class="asterisco">*</span></label>
                            <input type="number" name="" placeholder="Edicion" class="form-control" min="1" v-model="edicion" style="border-color:#000">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="anioPub">Año de publicación <span class="asterisco">*</span></label>
                            <input type="text" name="" placeholder="Año publicacion" class="form-control" v-model="anio_pub" style="border-color:#000">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="fechaAlta">Fecha alta <span class="asterisco">*</span></label>
                            <input type="date" name="" placeholder="Fecha alta" class="form-control" v-model="fecha_alta" style="border-color:#000">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="noPagina">Numero páginas <span class="asterisco">*</span></label>
                            <input type="number" name="" placeholder="Paginas" class="form-control" min="1" v-model="paginas" style="border-color:#000">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="ejemplares">Ejemplares del libro <span class="asterisco">*</span></label>
                            <input type="text" name="" placeholder="Ejemplares del libro" class="form-control" v-model="ejemplares" style="border-color:#000">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="clasificacion">Clasificación</label>
                            <input type="text" name="" placeholder="Clasificacion" class="form-control" v-model="clasificacion" style="border-color:#000">
                        </div>
                        <!-- <div class="form-group col-md-6">
                            <label for="cutter">Cutter del libro</label>
                            <input type="text" name="" placeholder="Cutter del libro" class="form-control" v-model="cutter" style="border-color:#000">
                        </div> -->
                    </div>

                    <div class="pull-right">
                        <button style="margin-left: 10px" type="submit" class="btn btn-primary" v-on:click="agregarLibro()">
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
                        <font style="vertical-align: inherit;">REGISTRANDO EDITORIAL</font>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="cancelarEdit()">
                      <span aria-hidden="true"><font style="vertical-align: inherit;">x</font></span>
                    </button>
              </div>
              <div class="modal-body div5">
                    <div class="form-group">
                        <label for="Editoriales">Editorial del libro</label>
                        <input type="text" name="" placeholder="Editorial del libro" class="form-control" v-model="editorial">
                    </div>
              </div>
              <div class="modal-footer div5">
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
                        <font style="vertical-align: inherit;">REGISTRANDO AUTOR</font>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="cancelarEdit()">
                      <span aria-hidden="true"><font style="vertical-align: inherit;">x</font></span>
                    </button>
              </div>
              <div class="modal-body div5">
                    <div class="form-group">
                        <label for="Autores">Autor del libro</label>
                        <input type="text" name="" placeholder="Autor del libro" class="form-control" v-model="nombre">
                    </div>
              </div>
              <div class="modal-footer div5">
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
                        <font style="vertical-align: inherit;">REGISTRANDO CARRERA</font>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="cancelarEdit()">
                      <span aria-hidden="true"><font style="vertical-align: inherit;">x</font></span>
                    </button>
              </div>
              <div class="modal-body div5">
                    <div class="form-group">
                        <label for="Carreras">Carrera del libro</label>
                        <input type="text" name="" placeholder="Carrera del libro" class="form-control" v-model="carrera">
                    </div>
              </div>
              <div class="modal-footer div5">
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
                        <font style="vertical-align: inherit;">REGISTRANDO PAÍS</font>
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
                        <label for="Paises">País del libro</label>
                        <input type="text" name="" placeholder="País del libro" class="form-control" v-model="pais">
                    </div>
              </div>
              <div class="modal-footer div5">
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

@endsection

@push('scripts')
<link rel="stylesheet" type="text/css" href="css/form_prestamo/prestamos.css">
<script type="text/javascript" src="js/admin/registroLibro.js"></script>
<script src="js/moment-with-locales.min.js"></script>
@endpush