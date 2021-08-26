var ruta = document.querySelector("[name=route]").value;
var rute = 'http://localhost/Gestion_Biblioteca/public/';
var urlLibros = rute + 'apiLibros';
var urlEditorial = rute + 'apiEditoriales';
var urlAutor = rute + 'apiAutores';
var urlCarrera = rute + 'apiCarreras';
var urlPais = rute + 'apiPais';
var urlEjemplar = rute + 'apiEjemplares';

new Vue({

	http:{
		headers:{
			'X-CSRF-TOKEN':document.querySelector('#token').getAttribute('value')
		}
	},

	el:"#registros",

	created:function(){
		this.getLibros();
		this.getEditorial();
		this.getAutor();
		this.getCarrera();
		this.getPais();
		// this.getBuscar();
		// this.getEjemplar();
	},

	data:{
		// data para libros
		libros:[],
		folio:'',
		edicion:'',
		anio_pub:'',
		clasificacion:'',
		fecha_alta:'',
		paginas:'',
		isbn:'',
		titulo:'',
        ejemplares:'',
        cutter:'',
        editando:false,

	

		// datas para editorial
		editoriales:[],
		id_editorial:'',
		editorial:'',

		// data para autores
		autores:[],
		id_autor:'',
		nombre:'',

		// data para carreras
		carreras:[],
		id_carrera:'',
		nombre:'',

		// data para paises
		paises:[],
		id_pais:'',
		pais:'',
		

        //datos para agregar el ejemplar
        folio:'',
		clasificacion:'',
		esbase:'',
		prestado:'',
		comentario:'',
		consec:'',
        fecha_alta:'',
        solodewee:'',
        deweecompleto:'',
        editejem:false,
        auxEjemplar:'',
	},

	methods:{
		getLibros:function(){
			this.$http.get(urlLibros).then(function(response){
				this.libros=response.data;
			}).catch(function(response){
				console.log(response);
			});
		},

		getEditorial:function(){
			this.$http.get(urlEditorial).then(function(response){
				this.editoriales=response.data;
			}).catch(function(response){
				console.log(response);
			});
		},

		getAutor:function(){
			this.$http.get(urlAutor).then(function(response){
				this.autores=response.data;
			}).catch(function(response){
				console.log(response);
			});
		},

		getCarrera:function(){
			this.$http.get(urlCarrera).then(function(response){
				this.carreras=response.data;
			}).catch(function(response){
				console.log(response);
			});
		},

		getPais:function(){
			this.$http.get(urlPais).then(function(response){
				this.paises=response.data;
			}).catch(function(response){
				console.log(response);
			});
		},

		showModalEditorial:function(){
			$("#Editorial").find(".modal-header").css("background","#f39c12");
			$("#Editorial").find(".modal-header").css("color", "black");
			$("#Editorial").find(".modal-title")   
			$('#Editorial').modal('show');
			// $('#addEditorial').modal('show');
		},

		showModalAutor:function(){
			$("#Autor_Modal").find(".modal-header").css("background","#f39c12");
			$("#Autor_Modal").find(".modal-header").css("color", "black");
			$("#Autor_Modal").find(".modal-title")   
			$('#Autor_Modal').modal('show');
			
		},

		showModalCarrera:function(){
			$("#Carrera_Modal").find(".modal-header").css("background","#f39c12");
			$("#Carrera_Modal").find(".modal-header").css("color", "black");
			$("#Carrera_Modal").find(".modal-title")   
			$('#Carrera_Modal').modal('show');
			
		},

		showModalPais:function(){
			$("#Pais_Modal").find(".modal-header").css("background","#f39c12");
			$("#Pais_Modal").find(".modal-header").css("color", "black");
			$("#Pais_Modal").find(".modal-title")   
			$('#Pais_Modal').modal('show');
		},

		agregarLibro:function(){

			//creación del objeto json para enviar a la api
			var libro={isbn:this.isbn,folio:this.isbn,titulo:this.titulo,id_editorial:this.id_editorial,
				id_autor:this.id_autor,id_carrera:this.id_carrera,edicion:this.edicion,anio_pub:this.anio_pub,
				id_pais:this.id_pais,fecha_alta:this.fecha_alta,paginas:this.paginas,ejemplares:this.ejemplares,
				clasificacion:this.clasificacion,cutter:this.cutter
			};

			//limpieza de los campos
			this.isbn='';
			this.folio='';
			this.titulo='';
			this.id_editorial='';
			this.id_autor='';
			this.id_carrera='';
			this.edicion='';
			this.anio_pub='';
			this.id_pais='';
			this.fecha_alta='';
			this.paginas='';
			this.ejemplares='';
			this.clasificacion='';
			this.cutter='';

			//se realiza el post para enviar el json y entrar al metodo store de la api
			this.$http.post(urlLibros,libro).then(function(response) {
                this.getLibros();
                $('#modal_custom').modal('hide');

                toastr.success("libro agregado con exito");

            }).catch(function(response){

            	toastr.error("Libro no agregado ocurrio un error o dejo algun campo importante vacío");

            });
            
		},

		guardarEditorial:function(){
			var editor={id_editorial:this.id_editorial,
				editorial:this.editorial
			};

			this.$http.post(urlEditorial,editor).then(function(response){
				this.getEditorial();
				$('#Editorial').modal('hide');
				toastr.success("Editorial Agregado");
				this.editorial='';
			}).catch(function(response){
				toastr.error("Editorial no agregado");
			});
		},

		cancelarEdito:function(){
			this.editando=false;
			this.nombre='';
		},


		guardarAutor:function(){
			var aut={
				id_autor:this.id_autor,
				nombre:this.nombre
			};

			this.$http.post(urlAutor,aut).then(function(response){
				this.getAutor();
				$('#Autor_Modal').modal('hide');
				toastr.success('Autor Agregado');
				this.nombre='';
			}).catch(function(response){
				toastr.error('Autor no Agregado');
			});
		},

		cancelarAutor:function(){
			this.editando=false;
			this.nombre='';
		},

		guardarPais:function(){
			var pai={
				id_pais:this.id_pais,
				pais:this.pais
			};

			this.$http.post(urlPais,pai).then(function(response){
				this.getPais();
				$('#Pais_Modal').modal('hide');
				toastr.success('Pais Agregado');
				this.pais='';
			}).catch(function(response){
				toastr.error('Pais no Agregado');
			});
		},

		cancelarPais:function(){
			this.editando=false;
			this.pais='';
		},

		guardarCarrera:function(){
			var carre ={
				id_carrera:this.id_carrera,
				nombre:this.nombre
			};
			this.$http.post(urlCarrera,carre).then(function(response){
				this.getCarrera();
				$('#Carrera_Modal').modal('hide');
				toastr.success('Carrera Agregado');
				this.nombre='';
			}).catch(function(response){
				toastr.error('Carrera no Agregado');
			});
		},

		cancelarCarrera:function(){
			this.editando=false;
			this.nombre='';
		},
	},
})