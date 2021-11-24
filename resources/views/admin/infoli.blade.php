@extends('layouts.layout')
@section('titulo','Detalle')
@section('contenido')

<div class="container">
	<div class="row">
	<div class="col-md-3"></div>
<div class="col-md-6">
	<fieldset>
		<img class="imgli" src="img/utc.jpeg">
	</fieldset>
	<hr>
	<form class="form-control-file">
		<label for="isbn"><font face="Sylfaen" size="4">ISBN</font></label>
    <input type="text" readonly="readonly" name="isbn" placeholder="{{Session::get('isbn')}}" class="form-control colorin" v-model="isbn">
    <label for="isbn"><font face="Sylfaen" size="4">TÍTULO</font></label>
    <input type="text" readonly="readonly" name="titulo" placeholder="{{Session::get('titulo')}}" class="form-control colorin" v-model="isbn">
    <label for="isbn"><font face="Sylfaen" size="4">AUTOR</font></label>
    <input type="text" readonly="readonly" name="autor" placeholder="{{Session::get('autor')}}" class="form-control colorin" v-model="isbn">
    <label for="isbn"><font face="Sylfaen" size="4">CARRERA</font></label>
    <input type="text" readonly="readonly" name="carrera" placeholder="{{Session::get('carrera')}}" class="form-control colorin" v-model="isbn">
	</form>
</div>
</div>
</div>


@endsection

@push('scripts')
  <script type="text/javascript" src="js/admin/libros.js"></script>
  <link rel="stylesheet" type="text/css" href="css/personalizados/info.css">
@endpush