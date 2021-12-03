@extends('layouts.layout')
@section('titulo','Detalle')
@section('contenido')

<div class="container">
	<div class="row">
	<!-- <div class="col-md-4"></div> -->
<div class="col-md-12">
	<div class="col-12">
	<fieldset>
		<img class="imgli" src="{{ asset('img/utc.jpeg') }}">
	</fieldset>
	<hr>
	</div>
	<div class="row">
	<div class="col-3">
		<div class="form-group">
	<label for="isbn"><font face="Sylfaen" size="4">ISBN</font></label>
    <input type="text" readonly="readonly" name="isbn" id="isbn" value="{{ $libros->isbn }}" placeholder="" class="form-control colorin" v-model="isbn">
    </div>
    </div>
    <div class="col-3">
    	<div class="form-group">
    <label for="isbn"><font face="Sylfaen" size="4">TÍTULO</font></label>
    <input type="text" readonly="readonly" name="titulo" id="titulo" value="{{ $libros->titulo}}" placeholder="" class="form-control colorin" v-model="titulo">
    </div>
    </div>
    <div class="col-3">
    	<div class="form-group">
    <label for="isbn"><font face="Sylfaen" size="4">AUTOR</font></label>
    <input type="text" readonly="readonly" name="autor" id="autor" value="{{ $libros->id_autor}}" placeholder="" class="form-control colorin" v-model="id_autor">
    </div>
    </div>
    <div class="col-3">
    	<div class="form-group">
    <label for="isbn"><font face="Sylfaen" size="4">CARRERA</font></label>
    <input type="text" readonly="readonly" name="carrera" id="carrera" value="{{ $libros->id_carrera}}" placeholder="" class="form-control colorin" v-model="id_carrera">
    </div>
    </div>
	</div>
	<div class="row">
	<div class="col-3">
		<div class="form-group">
	<label for="isbn"><font face="Sylfaen" size="4">EDITORIAL</font></label>
    <input type="text" readonly="readonly" name="isbn" id="editorial" value="{{ $libros->id_editorial }}" placeholder="" class="form-control colorin" v-model="isbn">
    </div>
    </div>
    <div class="col-3">
    	<div class="form-group">
    <label for="isbn"><font face="Sylfaen" size="4">EJEMPLARES</font></label>
    <input type="text" readonly="readonly" name="titulo" id="ejemplares" value="{{ $libros->ejemplares}}" placeholder="" class="form-control colorin" v-model="titulo">
    </div>
    </div>
    <div class="col-3">
    	<div class="form-group">
    <label for="isbn"><font face="Sylfaen" size="4">NO.PAGINAS</font></label>
    <input type="text" readonly="readonly" name="autor" id="paginas" value="{{ $libros->paginas}}" placeholder="" class="form-control colorin" v-model="id_autor">
    </div>
    </div>
    <div class="col-3">
    	<div class="form-group">
    <label for="isbn"><font face="Sylfaen" size="4">ANIO PUBLICACIÓN</font></label>
    <input type="text" readonly="readonly" name="carrera" id="anio_pub" value="{{ $libros->anio_pub}}" placeholder="" class="form-control colorin" v-model="id_carrera">
    </div>
    </div>
	</div>
	<div class="row">
	<div class="col-3">
		<div class="form-group">
	<label for="isbn"><font face="Sylfaen" size="4">FECHA DE ALTA</font></label>
    <input type="text" readonly="readonly" name="isbn" id="fecha_alta" value="{{ $libros->fecha_alta }}" placeholder="" class="form-control colorin" v-model="isbn">
    </div>
    </div>
    <div class="col-3">
    	<div class="form-group">
    <label for="isbn"><font face="Sylfaen" size="4">PAÍS</font></label>
    <input type="text" readonly="readonly" name="titulo" id="id_pais" value="{{ $libros->id_pais}}" placeholder="" class="form-control colorin" v-model="titulo">
    </div>
    </div>
    <div class="col-3">
    	<div class="form-group">
    <label for="isbn"><font face="Sylfaen" size="4">FOLIO</font></label>
    <input type="text" readonly="readonly" name="" id="folio" value="{{ $libros->folio}}" placeholder="" class="form-control colorin" v-model="id_autor">
    </div>
    </div>
    <div class="col-3">
    	<div class="form-group">
    <label for="isbn"><font face="Sylfaen" size="4">EDICIÓN</font></label>
    <input type="text" readonly="readonly" name="carrera" id="edicion" value="{{ $libros->edicion}}" placeholder="" class="form-control colorin" v-model="id_carrera">
    </div>
    </div>
	</div>
</div>
</div>
<a href="{{url('libros') }}"><button type="button" class="btn btn-warning" aria-label="Regresar"><label>Regresar</label></button></a>
</div>


@endsection

@push('scripts')
  <script type="text/javascript" src="{{ asset('js/datos/libros.js') }}"></script>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/personalizados/info.css') }}">
@endpush