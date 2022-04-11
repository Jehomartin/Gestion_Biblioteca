@extends('layouts.master')
@section('titulo','Consulta')
@section('contenido')

<!-- inicio div principal -->
<div id="consultar">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<span class="btn btn-primary form-control" @click="verificacion()">
					VALIDAR MATRICULA <i class="fas fa-file-signature"></i>
				</span>
			</div>
			<div class="col-md-4" v-if="validado">
				<span class="btn btn-success form-control" @click="consultar()">
					CONSULTAR LIBROS <i class="fas fa-search"></i>
				</span>
			</div>
			<div class="col-md-4" v-if="validado">
				<span class="btn btn-danger form-control" @click="cancelarP()">
					FINALIZAR PROCESOS <i class="fas fa-window-close"></i>
				</span>
			</div>
		</div>
	</div>
	<br>

	<!-- div verificar -->
	<div class="container" v-if="verificar">
		<div class="container sombra">
			<div class="col-lg-12"> <!-- titulo -->
				<font face="Sylfaen" color="white">
					<h3 class="text text-center">VERIFICACIÓN DE MATRICULAS</h3>
				</font>
			</div> <!-- /titulo -->
			<div class="row"> <!-- buscar -->
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<div class="input-group">
						<!-- <select class="form-control" v-model="matri" ref="buscar" v-on:keyup.enter="getVerificar()" @change="getStudent">
							<option disabled value="">Seleccione su matricula</option>
							<option v-for="s in students" v-bind:value="s.matricula"> @{{s.matricula}} </option>
						</select> -->
						<input type="text" class="form-control" v-model="matri" ref="buscar" v-on:keyup.enter="getVerificar()" placeholder="Buscando alumno..." style="border-color:orange;">
						<span class="input-group-btn">
		                	<button type="submit" name="search" id="search-btn" class="btn btn-flat" style="background-color: orange" @click="getVerificar()"><i class="fa fa-search"></i>
		                	</button>
		          		</span>
					</div>
				</div>
				<div class="col-md-2"></div>
			</div> <!-- /buscar -->
			<br>
		</div>
		<hr>

		<h4 class="text text-center">
			<font face="Sylfaen" color="black">DATOS DEL ALUMNO</font>
		</h4>
		<br>
		<!-- datos alumnos -->
		<div class="col-lg-12" v-for="(al,index) in arrayAlumno">
			<!-- matricula y nombre -->
			<div class="form-row">
				<div class="form-group col-md-6 text text-center">
					<label for="isbn"><font face="Sylfaen" size="4" color="black">MATRICULA: </font></label>
					<span class="form-control colorin text text-center" id="matricula">
		          		@{{al.matricula}}
		          	</span>
				</div>
				<div class="form-group col-md-6 text text-center">
					<label for="isbn"><font face="Sylfaen" size="4" color="black">NOMBRE(S): </font></label>
					<span class="form-control colorin text text-center" id="nombre">
		          		@{{al.nombre}}
		          	</span>
				</div>
			</div>
			<!-- /matricula y nombre -->
			<!-- apellidos y carrera -->
			<div class="form-row">
				<div class="form-group col-md-6 text text-center">
					<label for="isbn"><font face="Sylfaen" size="4" color="black">APELLIDOS: </font></label>
					<span class="form-control colorin text text-center" id="apellidos">
		          		@{{al.apellidos}}
		          	</span>
				</div>
				<div class="form-group col-md-6 text text-center">
					<label for="isbn"><font face="Sylfaen" size="4" color="black">CARRERA: </font></label>
					<span class="form-control colorin text text-center" id="clave_carrera">
		          		@{{al.clave_carrera}}
		          	</span>
				</div>
			</div>
			<!-- /apellidos y carrera -->
		</div>
		<!-- /datos alumnos -->
		<hr>
		<!-- <div class="form-row" v-if="validado">
			<div class="form-group">
				<label>DESEA CONSULTAR ALGUN LIBRO</label>
				<span class="btn btn-success" @click="consultar()">
					SI <i class="fas fa-search"></i>
				</span>
				<span class="btn btn-danger" @click="cancelarP()">
					NO <i class="fas fa-window-close"></i>
				</span>
			</div>
		</div> -->
	</div>
	<!--/verificar -->

	<!-- div consulta -->
	<div class="container" v-if="consulta">
		<div class="container sombra">
			<br>
			<!-- Titulo -->
			<div class="row">
				<div class="col-lg-2"></div>
				<div class="col-lg-8">
					<font face="Sylfaen" color="white">
						<h3 class="text text-center">SECCIÓN DE CONSULTA</h3>
						
					</font>
				</div>
				<div class="col-lg-2">
					<font size="6"><span class="btn btn-primary fas fa-question-circle" @click="help()"></span></font>
				</div>
			</div>
			<!-- fin titulo -->
			<br>
			<!-- div buscar -->
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<!-- search form (Optional) -->
		        	<div class="input-group">
		          		<!-- <input type="text" class="form-control" v-model="clave" ref="buscar" v-on:keyup.enter="getConsulta()" placeholder="Buscando título..." style="border-color:orange;"> -->
		          		<select class="form-control" v-model="clave" ref="buscar" v-on:keyup.enter="getConsulta()" @change="getLib" style="border-color: orange;">
				          <option disabled value="">Ingrese el titulo</option>
				          <option v-for="l in librosb" v-bind:value="l.titulo">@{{l.titulo}}</option>
				        </select>
		          		<span class="input-group-btn">
		                	<button type="submit" name="search" id="search-btn" class="btn btn-flat" style="background-color: orange" @click="getConsulta()"><i class="fa fa-search"></i>
		                	</button>
		          		</span>
		        	</div>
		        	<!-- /.search form -->
				</div>
				<!-- <div class="col-md-2">
					<button class="btn btn-success" @click="NewSearch()">
						<span class="fas fa-sync-alt"></span>
					</button>
				</div> -->
			</div>
			<br>
			<!-- fin buscar -->
		</div>

		<hr>
		<h4 class="text text-center">
			<font face="Sylfaen" color="black">CARACTERÍSTICAS DEL LIBRO CONSULTADO</font>
		</h4>
		<!-- Inicio div img -->
		<div class="col-md-12" v-if="arraycaratulas.length">
	        <div class="row">
	          	<div class="col-md-6" v-for="image in arraycaratulas">
	            	<a data-fancybox="gallery" v-bind:href="'../public/storage/' + image.caratula.caratula">
	              		<img v-bind:src="'../public/storage/' + image.caratula.caratula" class="img-fluid" width="400px" height="500px">
	            	</a>
	          	</div>
	        </div>
	    </div>
	    <!-- <div class="form-group col-md-12" v-else>EL LIBRO NO TIENE CARATULA DISPONIBLE</div> -->
	    <!-- Fin div img -->
	    <br>
		<div class="col-lg-12" v-for="(b,index) in consultas">
			
	      	<!-- Div isbn y titulo -->
	      	<div class="form-row">
		        <div class="form-group col-md-6 text text-center">
		          <label for="isbn"><font face="Sylfaen" size="4" color="black">ISBN</font></label>
		          <span class="form-control colorin text text-center" id="isbn">
		          	@{{b.isbn}}
		          </span>
		        </div>
		        <div class="form-group col-md-6 text text-center">
		          <label for="isbn"><font face="Sylfaen" size="4" color="black">TÍTULO</font></label>
		          <span class="form-control colorin text text-center" id="titulo">
		          	@{{b.titulo}}
		          </span>
		        </div>
	      	</div>
	      	<!-- /isbn y titulo -->

	      	<!-- div autor, carrera y editorial -->
	      	<div class="form-row">
		        <div class="form-group col-md-4 text text-center">
		          <label for="isbn"><font face="Sylfaen" size="4" color="black">AUTOR</font></label>
		          <span class="form-control colorin text text-center" id="id_autor">
		          	@{{b.autor.nombre}}
		          </span>
		        </div>
		        <div class="form-group col-md-4 text text-center">
		          <label for="isbn"><font face="Sylfaen" size="4" color="black">CARRERA</font></label>
		          <span class="form-control colorin text text-center" id="id_carrera">
		          	@{{b.carrera.carrera}}
		          </span>
		        </div>
		        <div class="form-group col-md-4 text text-center">
		          <label for="isbn"><font face="Sylfaen" size="4" color="black">EDITORIAL</font></label>
		          <span class="form-control colorin text text-center" id="id_editorial">
		          	@{{b.editorial.editorial}}
		          </span>
		        </div>
	      	</div>
	      	<!-- /autor, carrera y editorial-->

	      	<!-- Div país, año, ejemplares y páginas -->
	      	<div class="form-row">
		        <div class="form-group col-md-3 text text-center">
		          <label for="isbn"><font face="Sylfaen" size="4" color="black">PAÍS</font></label>
		          <span class="form-control colorin text text-center" id="id_pais">
		          	@{{b.pais.pais}}
		          </span>
		        </div>
		        <div class="form-group col-md-3 text text-center">
		          <label for="isbn"><font face="Sylfaen" size="4" color="black">ANIO PUBLICACIÓN</font></label>
		          <span class="form-control colorin text text-center" id="anio_pub">
		          	@{{b.anio_pub}}
		          </span>
		        </div>
		        <div class="form-group col-md-3 text text-center">
		          <label for="isbn"><font face="Sylfaen" size="4" color="black">EJEMPLARES</font></label>
		          <span class="form-control colorin text text-center" id="ejemplares">
		          	@{{b.ejemplares}}
		          </span>
		        </div>
		        <div class="form-group col-md-3 text text-center">
		          <label for="isbn"><font face="Sylfaen" size="4" color="black">NO.PAGINAS</font></label>
		          <span class="form-control colorin text text-center" id="paginas">
		          	@{{b.paginas}}
		          </span>
		        </div>
		    </div>
		    <!-- /país, año, ejemplares y páginas-->

	      	<!-- Div fecha, folio y edicion -->
	      	<div class="form-row">
		        <div class="form-group col-md-4 text text-center">
		          <label for="isbn"><font face="Sylfaen" size="4" color="black">FECHA DE ALTA</font></label>
		          <span class="form-control colorin text text-center" id="fecha_alta">
		          	@{{b.fecha_alta}}
		          </span>
		        </div>
		        <div class="form-group col-md-4 text text-center">
		          <label for="isbn"><font face="Sylfaen" size="4" color="black">FOLIO</font></label>
		          <span class="form-control colorin text text-center" id="folio">
		          	@{{b.folio}}
		          </span>
		        </div>
		        <div class="form-group col-md-4 text text-center">
		          <label for="isbn"><font face="Sylfaen" size="4" color="black">EDICIÓN</font></label>
		          <span class="form-control colorin text text-center" id="edicion">
		          	@{{b.edicion}}
		          </span>
		        </div>
		    </div>
		    <!-- /fecha, folio y edicion -->

		    <div class="input-group">
		    	<button class="btn btn-success" @click="NewSearch()">ACEPTAR <i class="fas fa-check"></i></button>
		    </div>
		</div>
	</div>
	<!--/consulta -->
</div>
<!-- fin div principal -->

@endsection

@push('scripts')
	<script type="text/javascript" src="{{ asset('js/datos/busqueda.js') }}"></script>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/personalizados/info.css') }}">
@endpush