@extends('layouts.layout')
@section('titulo','Libros')
@section('contenido')

<div id="ejemplar">
  <div class="col-md-10"></div>
  <div class="col-md-2">
    <button class="btn btn-warning form-control glyphicon glyphicon-plus" v-on:click="showModal">Agregar Ejemplar</button>
  </div>
  <!-- inicio ventana modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="addejemplar">
    <!--inicio modal dialog-->
    <div class="modal-dialog" role="document">
      <!--inicio modal content-->
      <div class="modal-content">
        <!-- se inicia el encabezado de la ventana modal -->
        <div class="modal-header div1">
          <button type="button" class="close" data-dismiss="modal" aria-label="close" v-on:click="cancelEditj()"><span aria-hidden="true">X</span></button>
          <h4 class="modal-title">Nuevo Ejemplar</h4>
        </div>
        <!-- fin encabezado de ventana modal -->

        <!-- inicio cuerpo modal -->
        <div class="modal-body div1">
          <input type="text" name="" placeholder="clasificacion del libro" class="form-control" v-model='clasificacion'>
          <input type="text" name="" placeholder="" class="form-control" v-model="folio">
          <input type="text" name="" placeholder="" class="form-control" v-model="esbase">
          <input type="text" name="" placeholder="" class="form-control" v-model="prestado">
          <input type="text" name="" placeholder="" class="form-control" v-model="consec">
          <input type="date" name="" placeholder="" class="form-control" v-model="fecha_alta">
        </div><!-- fin cuerpo modal -->

        <!-- footer modal -->
        <div class="modal-footer div1">
          <font face="arial black" color="red">
            <h6>Clasificación : @{{clasificacion}} </h6>
            <h6>Folio : @{{folio}} </h6>
            <h6>Es Base : @{{esbase}} </h6>
            <h6>Prestado : @{{prestado}} </h6>
            <h6>Consec : @{{consec}} </h6>
            <h6>Fecha Alta : @{{fecha_alta}} </h6>
          </font>
          <button type="button" class="btn btn-default" data-dismiss="modal" v-on:click="cancelEditj()">Cancelar</button>
          <button type="submit" class="btn btn-primary" v-on:click="agregarEjemplar()">Guardar</button>
        </div><!-- fin footer modal -->
      </div> <!--fin modal content-->
    </div><!--/modal dialog-->
  </div><!--fin ventana modal-->

</div>

<!-- El id es del identificador del js -->
<div id="libro">

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

  <div class="row">
    <div class="col-sm-12">
      <button class="btn btn-success glyphicon glyphicon-plus" v-on:click="showModal">
        Nuevo Libro
      </button>

      <!-- <a href="{{url('prestacion')}}">
        <button class="btn btn-danger glyphicon glyphicon-send" style="float: right;">
          Prestar libro
        </button>
      </a> -->
      <br>
      <font color="black" face="times new roman">
        <h1 class="text text-center">Libros Registrados</h1>
      </font>
      <table class="table table-hover tabl-condensed table-bordered">
        <thead class="div4">
          <th width="8%">ISBN</th>
          <th>TITULO</th>
          <th>AUTOR</th>
          <th>EDITORIAL</th>
          <th>CARRERA</th>
          <th width="8%">EJEMPLARES</th>
          <th width="5%">CUTTER</th>
          <th width="15%">Opciones</th>
        </thead>
        <tbody>
          <tr v-for="(libro,index) in filtroLibros">
            <td v-on:click="">@{{libro.isbn}}</td>
            <td v-on:click="">@{{libro.titulo}}</td>
            <td v-on:click="">@{{libro.autor.nombre}}</td>
            <td v-on:click="">@{{libro.editorial.editorial}}</td>
            <td v-on:click="">@{{libro.carrera.nombre}}</td>
            <td v-on:click="">@{{libro.ejemplares}}</td>
            <td v-on:click="">@{{libro.cutter}}</td>
            <td>
              <center>
                <span class="btn btn-primary glyphicon glyphicon-pencil " 
                v-on:click="editLibro(libro.isbn)"></span>

                <span class="btn btn-danger glyphicon glyphicon-trash " 
                v-on:click="eliminarLibro(libro.isbn)"></span>

                <span class="btn btn-success glyphicon glyphicon-copy "></span>
              </center>
            </td> 
          </tr>
        </tbody>
      </table>
    </div>
    <!-- inicio ventana modal -->
      <div class="modal fade" tabindex="-1" role="dialog" id="addlibro">
        <!--inicio modal dialog-->
        <div class="modal-dialog" role="document">
          <!--inicio modal content-->
          <div class="modal-content">
            <!-- se inicia el encabezado de la ventana modal -->
            <div class="modal-header div1">
              <button type="button" class="close" data-dismiss="modal" aria-label="close" v-on:click="cancelarEdit()"><span aria-hidden="true">X</span></button>
              <h4 class="modal-title" v-if="!editando">Nuevo Libro</h4>
              <h4 class="modal-title" v-if="editando">Editando Libro</h4>
            </div>
            <!-- fin encabezado de ventana modal -->

            <!-- inicio cuerpo modal -->
            <div class="modal-body div1">
              <input type="text" name="" placeholder="ISBN del libro" class="form-control" v-model='isbn'>
              <input type="text" name="" placeholder="Titulo del libro" class="form-control" v-model="titulo">
              <select class="form-control" v-model="id_editorial" @change="getEditorial">
                <option disabled value="">Elija la editorial del libro</option>
                <option v-for="e in editoriales" v-bind:value="e.id_editorial">@{{e.editorial}}</option>
              </select>
              <select class="form-control" v-model="id_autor" @change="getAutor">
                <option disabled value="">Elija el Autor del libro</option>
                <option v-for="a in autores" v-bind:value="a.id_autor">@{{a.nombre}}</option>
              </select>
              <select class="form-control" v-model="id_carrera" @change="getCarrera">
                <option disabled value="">Elija la carrera del libro</option>
                <option v-for="c in carreras" v-bind:value="c.id_carrera">@{{c.nombre}}</option>
              </select>
              <input type="number" name="" placeholder="Edicion" class="form-control" min="1" v-model="edicion">
              <input type="text" name="" placeholder="Año publicacion" class="form-control" v-model="anio_pub">
               <select class="form-control" v-model="id_pais" @change="getPais">
                <option disabled value="">Elija el pais del libro</option>
                <option v-for="p in paises" v-bind:value="p.id_pais">@{{p.pais}}</option>
              </select>
              <input type="date" name="" placeholder="Fecha alta" class="form-control" v-model="fecha_alta">
              <input type="number" name="" placeholder="Paginas" class="form-control" min="1" v-model="paginas">
              <input type="text" name="" placeholder="Ejemplares del libro" class="form-control" v-model="ejemplares">
              <input type="text" name="" placeholder="Clasificacion" class="form-control" v-model="clasificacion">
              <input type="text" name="" placeholder="Cutter del libro" class="form-control" v-model="cutter">
              </div>
            <!-- fin cuerpo modal -->

            <!-- footer modal -->
            <div class="modal-footer div1">
              <font face="arial black" color="red">
                <h6>ISBN: @{{isbn}}</h6>
                <h6>Folio: @{{isbn}}</h6>
                <h6>Titulo: @{{titulo}}</h6>
                <h6>Editorial: @{{id_editorial}}</h6>
                <h6>Autor: @{{id_autor}}</h6>
                <h6>Carrera: @{{id_carrera}}</h6>
                <h6>Edicion: @{{edicion}}</h6>
                <h6>Anio_pub: @{{anio_pub}}</h6>
                <h6>Pais: @{{id_pais}}</h6>
                <h6>Fecha_Alta: @{{fecha_alta}}</h6>
                <h6>Paginas: @{{paginas}}</h6>
                <h6>Ejemplares: @{{ejemplares}}</h6>
                <h6>Clasificacion: @{{clasificacion}}</h6>
                <h6>Cutter: @{{cutter}}</h6>
              </font>
              <button type="button" class="btn btn-default" data-dismiss="modal" v-on:click="cancelarEdit()">Cancelar</button>
              <button type="submit" class="btn btn-primary" v-on:click="agregarLibro()" v-if="!editando">Guardar</button>
              <button type="submit" class="btn btn-primary" v-on:click="updateLibro(auxLibro)" v-if="editando">Editar</button>
            </div>
            <!-- fin footer modal -->
          </div> <!--fin modal content-->
        </div><!--/modal dialog-->
      </div><!--fin ventana modal-->
  </div>
</div>

@endsection

@push('scripts')
  <script type="text/javascript" src="js/admin/libros.js"></script>
  <script type="text/javascript" src="js/admin/ejemplares.js"></script>
  <script type="text/javascript" src="js/vue-resource.js"></script>
  <script type="text/javascript" src="js/vue.js"></script>
@endpush