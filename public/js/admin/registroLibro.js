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

        // datas para editorial
        editoriales:[],
        id_editorial:'',
		editorial:'',
        // dastas para autor
		autores:[],
        id_autor:'',
		nombre:'',
        // datas para carreras
		carreras:[],
		id_carrera:'',
		carrera:'',
        // datas para pais
        paises:[],
        id_pais:'',
        pais:'',
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
			$("#Autor").find(".modal-header").css("background","#f39c12");
			$("#Autor").find(".modal-header").css("color", "black");
			$("#Autor").find(".modal-title")   
			$('#Autor').modal('show');
			
		},

		showModalCarrera:function(){
			$("#Carrera").find(".modal-header").css("background","#f39c12");
			$("#Carrera").find(".modal-header").css("color", "black");
			$("#Carrera").find(".modal-title")   
			$('#Carrera').modal('show');
			
		},

		showModalPais:function(){
			$("#Pais").find(".modal-header").css("background","#f39c12");
			$("#Pais").find(".modal-header").css("color", "black");
			$("#Pais").find(".modal-title")   
			$('#Pais').modal('show');
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

		guardarAutor:function(){
			var Aut={
				id_autor:this.id_autor,
				nombre:this.nombre
			};

			this.$http.post(urlAutor,Aut).then(function(response){
				this.getAutor();
				$('#Autor').modal('hide');
				toastr.success("Autor agregado");
			}).catch(function(response){
				toastr.error("Autor no registrado");
			});
		},

		guardarCarrera:function(){
			var carer={
				id_carrera:this.id_carrera,
				carrera:this.carrera
			};

			this.$http.post(urlCarrera,carer).then(function(response){
				this.getCarrera();
				$('#Carrera').modal('hide');
				toastr.success("Carrera Registrada");
			}).catch(function(response){
				toastr.error("Carrera no Registrada");
			});
		},

		guardarPais:function(){
			var pai={
				id_pais:this.id_pais,
				pais:this.pais
			};

			this.$http.post(urlPais,pai).then(function(json){
				this.getPais();
				$('#Pais').modal('hide');
				toastr.success("Pais Registrado");
			}).catch(function(json){
				toastr.error("Pais no Registrado");
			});
		},
	},
})