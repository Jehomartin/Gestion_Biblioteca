@extends('layouts.layout')
@section('titulo','Detalle')
@section('contenido')
<!-- Inicio div principal -->
<div id="infolib">
  <div class="container">
  <div class="row">
    <!-- Inicio div de inicial3-->
    <div class="col-lg-12">
      <br>
      <font color="black" face="Sylfaen">
        <h2 class="text text-center">Detalles del Libro</h2>
      </font>

      <!-- Inicio div img -->

      <div class="col-md-12" v-if="arraycaratulas.length">
        <font face="Sylfaen" size="4"><h5 class="text text-center">CARATULAS DEL LIBRO:</h5></font>
        <div class="row">
          <div class="col-md-6" v-for="image in arraycaratulas">
            <a data-fancybox="gallery" v-bind:href="'../../storage/' + image.caratula">
              <img v-bind:src="'../../storage/' + image.caratula" class="img-fluid" width="100%" height="200px">
            </a>
          </div>
        </div>
      </div>
      <div class="form-group col-md-12" v-else>error al cargar imagenes</div>
      <!-- Fin div img -->

      <!-- Div isbn y titulo -->
      <div class="form-row">
        <div class="form-group col-md-6 text text-center">
          <label for="isbn"><font face="Sylfaen" size="4">ISBN</font></label>
          <input type="text" readonly="readonly" name="isbn" id="isbn" value="{{ $libros->isbn }}" placeholder="" class="form-control colorin text text-center" v-model="isbn">
        </div>
        <div class="form-group col-md-6 text text-center">
          <label for="isbn"><font face="Sylfaen" size="4">TÍTULO</font></label>
          <input type="text" readonly="readonly" name="titulo" id="titulo" value="{{ $libros->titulo}}" placeholder="" class="form-control colorin text text-center" v-model="titulo">
        </div>
      </div>
      <!-- /isbn y titulo -->

      <!-- Div 3 -->
      <div class="form-row">
        <div class="form-group col-md-4 text text-center">
          <label for="isbn"><font face="Sylfaen" size="4">AUTOR</font></label>
          <input type="text" readonly="readonly" name="autor" id="autor" value="{{ $libros->id_autor}}" placeholder="" class="form-control colorin text text-center" v-model="id_autor">
        </div>
        <div class="form-group col-md-4 text text-center">
          <label for="isbn"><font face="Sylfaen" size="4">CARRERA</font></label>
          <input type="text" readonly="readonly" name="carrera" id="carrera" value="{{ $libros->id_carrera}}" placeholder="" class="form-control colorin text text-center" v-model="id_carrera">
        </div>
        <div class="form-group col-md-4 text text-center">
          <label for="isbn"><font face="Sylfaen" size="4">EDITORIAL</font></label>
          <input type="text" readonly="readonly" name="isbn" id="editorial" value="{{ $libros->id_editorial }}" placeholder="" class="form-control colorin text text-center" v-model="id_editorial">
        </div>
      </div>
      <!-- /div 3 -->

      <!-- Div 4 -->
      <div class="form-row">
        <div class="form-group col-md-3 text text-center">
          <label for="isbn"><font face="Sylfaen" size="4">PAÍS</font></label>
          <input type="text" readonly="readonly" name="titulo" id="id_pais" value="{{ $libros->id_pais}}" placeholder="" class="form-control colorin text text-center" v-model="id_pais">
        </div>
        <div class="form-group col-md-3 text text-center">
          <label for="isbn"><font face="Sylfaen" size="4">ANIO PUBLICACIÓN</font></label>
          <input type="text" readonly="readonly" name="carrera" id="anio_pub" value="{{ $libros->anio_pub}}" placeholder="" class="form-control colorin text text-center" v-model="anio_pub">
        </div>
        <div class="form-group col-md-3 text text-center">
          <label for="isbn"><font face="Sylfaen" size="4">EJEMPLARES</font></label>
          <input type="text" readonly="readonly" name="titulo" id="ejemplares" value="{{ $libros->ejemplares}}" placeholder="" class="form-control colorin text text-center" v-model="ejemplares">
        </div>
        <div class="form-group col-md-3 text text-center">
          <label for="isbn"><font face="Sylfaen" size="4">NO.PAGINAS</font></label>
          <input type="text" readonly="readonly" name="autor" id="paginas" value="{{ $libros->paginas}}" placeholder="" class="form-control colorin text text-center" v-model="paginas">
        </div>
      </div>
      <!-- /div 4 -->

      <!-- Div 3'' -->
      <div class="form-row">
        <div class="form-group col-md-4 text text-center">
          <label for="isbn"><font face="Sylfaen" size="4">FECHA DE ALTA</font></label>
          <input type="text" readonly="readonly" name="isbn" id="fecha_alta" value="{{ $libros->fecha_alta }}" placeholder="" class="form-control colorin text text-center" v-model="fecha_alta">
        </div>
        <div class="form-group col-md-4 text text-center">
          <label for="isbn"><font face="Sylfaen" size="4">FOLIO</font></label>
          <input type="text" readonly="readonly" name="" id="folio" value="{{ $libros->folio}}" placeholder="" class="form-control colorin text text-center" v-model="folio">
        </div>
        <div class="form-group col-md-4 text text-center">
          <label for="isbn"><font face="Sylfaen" size="4">EDICIÓN</font></label>
          <input type="text" readonly="readonly" name="carrera" id="edicion" value="{{ $libros->edicion}}" placeholder="" class="form-control colorin text text-center" v-model="edicion">
        </div>
      </div>
    </div>
    <!-- Fin div inicial3 -->
  </div>
</div>
</div>
<!-- Fin div principal -->

<a href="{{url('libros') }}"><button type="button" class="btn btn-warning" aria-label="Regresar"><label>Regresar</label></button></a>
</div>


@endsection

@push('scripts')
  <script type="text/javascript" src="{{ asset('js/datos/infolibros.js') }}"></script>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/personalizados/info.css') }}">
@endpush