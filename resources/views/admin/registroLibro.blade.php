@extends('layouts.layout')
@section('titulo','Registro Libro')
@section('contenido')

<div id="registros">
  <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="text text-center">REGISTRO DE LIBROS</h2>
                <br>    
                <br>
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="isbn">Isbn del libro</label>
                            <input type="text" name="" placeholder="ISBN del libro" class="form-control" v-model="isbn">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="titulo">Titulo del libro</label>
                            <input type="text" name="" placeholder="Titulo del libro" class="form-control" v-model="titulo">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
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
                                    <span class="fas fa-plus-circle"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="autor">Elija el autor</label>
                            <div class="input-group">
                                <select class="form-control" id="selectAutor" v-model="id_autor" @change="getAutor">
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
                        <label for="carrera">Elija la carrera</label>
                        <div class="input-group">
                            <select class="form-control" v-model="id_carrera" @change="getCarrera">
                            <option disabled value="">Elija la carrera del libro</option>
                            <option v-for="c in carreras" v-bind:value="c.id_carrera">@{{c.nombre}}</option>
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
                            <label for="pais">Elija el pais</label>
                            <div class="input-group">
                                <select class="form-control" v-model="id_pais" @change="getPais">
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
                            <label for="edicion">Edicion</label>
                            <input type="number" name="" placeholder="Edicion" class="form-control" min="1" v-model="edicion">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="anioPub">Año de publicación</label>
                            <input type="text" name="" placeholder="Año publicacion" class="form-control" v-model="anio_pub">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="fechaAlta">Fecha alta</label>
                            <input type="date" name="" placeholder="Fecha alta" class="form-control" v-model="fecha_alta">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="noPagina">Numero páginas</label>
                            <input type="number" name="" placeholder="Paginas" class="form-control" min="1" v-model="paginas">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="ejemplares">Ejemplares del libro</label>
                            <input type="text" name="" placeholder="Ejemplares del libro" class="form-control" v-model="ejemplares">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="clasificacion">Clasificación</label>
                            <input type="text" name="" placeholder="Clasificacion" class="form-control" v-model="clasificacion">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cutter">Cutter del libro</label>
                            <input type="text" name="" placeholder="Cutter del libro" class="form-control" v-model="cutter">
                        </div>
                    </div>

                    <div class="pull-right">
                        <button style="margin-left: 10px" type="submit" class="btn btn-primary" v-on:click="agregarLibro()" v-if="!editando">
                        <span class="fas fa-save"></span>
                        Guardar</button>
                    </div>  
                </form>
            </div>
        </div>
    </div>

    <!-- inicio Modal Editorial -->
     <div id="Editorial" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="">
        <!--inicio modal dialog-->
          <div class="modal-dialog" role="document">
            <!--inicio modal content-->
            <div class="modal-content">
              <!-- se inicia el encabezado de la ventana modal -->
              <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLiveLabel" v-if="!editando"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">REGISTRANDO EDITORIAL</font></font></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="cancelarEdit()">
                      <span aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></span>
                    </button>
                <!-- <span aria-hidden="true">&times;</span> -->
              </div>
              <div class="modal-body div1">
                    <div class="form-group">
                        <label for="Editoriales">Editorial del libro</label>
                        <input type="text" name="" placeholder="Editorial del libro" class="form-control" v-model="editorial">
                    </div>
              </div>
              <div class="modal-footer div1">
                <div class="pull-right">
                    <button style="margin-left: 10px" type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="cancelarEdit()">
                    <span class="far fa-window-close"></span>
                    Cancelar</button>
                </div>
                <div class="pull-right">
                    <button style="margin-left: 10px" type="submit" class="btn btn-primary" v-on:click="guardarEditorial()" v-if="!editando">
                    <span class="fas fa-save"></span>
                    Guardar</button>
                </div>
              </div>
          </div>
        </div>
    </div> <!-- fin Modal Editorial -->

</div> <!-- fin div principal -->

@endsection

@push('scripts')
<link rel="stylesheet" type="text/css" href="css/form_prestamo/prestamos.css">
<script type="text/javascript" src="js/admin/registroLibro.js"></script>
<script src="js/moment-with-locales.min.js"></script>


@endpush