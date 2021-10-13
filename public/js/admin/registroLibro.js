var ruta = document.querySelector("[name=route]").value;
var rute = 'http://localhost/Gestion_Biblioteca/public/';
var urlLibros = rute + 'apiRegistroLibros';
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
	this.getLibross();
	this.getEditorials();
	this.getAutors();
	this.getCarreras();
	this.getPaiss();
},

data:{
	// data para libros
	libros:[],
	isbn:'',
	titulo:'',
	folio:'',
	edicion:'',
	anio_pub:'',
	fecha_alta:'',
	paginas:'',
        ejemplares:'',
        clasificacion:'',
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
	getLibross:function(){
		this.$http.get(urlLibros).then(function(response){
			this.libros=response.data;
		}).catch(function(response){
			// console.log(response);
		});
	},

	getEditorials:function(){
		this.$http.get(urlEditorial).then(function(response){
			this.editoriales=response.data;
		}).catch(function(response){
			// console.log(response);
		});
	},

	getAutors:function(){
		this.$http.get(urlAutor).then(function(response){
			this.autores=response.data;
		}).catch(function(response){
			// console.log(response);
		});
	},

	getCarreras:function(){
		this.$http.get(urlCarrera).then(function(response){
			this.carreras=response.data;
		}).catch(function(response){
			// console.log(response);
		});
	},

	getPaiss:function(){
		this.$http.get(urlPais).then(function(response){
			this.paises=response.data;
		}).catch(function(response){
			// console.log(response);
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
		this.getLibross();
		swal({
			title: "Libro agregado",
			text: "El libro fue registrado exitosamente",
			icon: "success",
			buttons:false,
			timer: 3000,
		});

		}).catch(function(response){
			swal({
				title: "Libro no registrado",
				text: "Verifique si lleno todos los campos importantes",
				icon: "error",
				buttons:false,
				timer: 3000,
			});

		});
    
	},

	guardarEditorial:function(){
		var editor={id_editorial:this.id_editorial,
			editorial:this.editorial
		};

		this.$http.post(urlEditorial,editor).then(function(response){
			this.getEditorials();
			$('#Editorial').modal('hide');
			swal({
				title: "Editorial agregada",
				icon: "success",
				buttons:false,
				timer: 3000,
			});
			this.editorial='';
		}).catch(function(response){
			swal({
				title: "Editorial no agregada",
				icon: "error",
				buttons:false,
				timer: 3000,
			});
		});
	},


	guardarAutor:function(){
		var aut={
			id_autor:this.id_autor,
			nombre:this.nombre
		};
		this.$http.post(urlAutor,aut).then(function(response){
			this.getAutors();
			$('#Autor').modal('hide');
			swal({
				title: "Autor agregado",
				icon: "success",
				buttons:false,
				timer: 3000,
			});
		}).catch(function(response){
			swal({
				title: "Autor no agregado",
				icon: "error",
				buttons:false,
				timer: 3000,
			});
		});
	},

	guardarCarrera:function(){
		var carer={
			id_carrera:this.id_carrera,
			carrera:this.carrera
		};

		this.$http.post(urlCarrera,carer).then(function(response){
			this.getCarreras();
			$('#Carrera').modal('hide');
			swal({
				title: "Carrera agregada",
				icon: "success",
				buttons:false,
				timer: 3000,
			});
		}).catch(function(response){
			swal({
				title: "Carrera no agregada",
				icon: "error",
				buttons:false,
				timer: 3000,
			});
		});
	},

	guardarPais:function(){
		var pays={
			id_pais:this.id_pais,
			pais:this.pais
		};
		this.$http.post(urlPais,pays).then(function(json){
			this.getPaiss();
			$('#Pais').modal('hide');
			swal({
				title: "País agregado",
				icon: "success",
				buttons:false,
				timer: 3000,
			});
		}).catch(function(json){
			swal({
				title: "País no agregado",
				icon: "error",
				buttons:false,
				timer: 3000,
			});
		});
	},

	cancelarEdit:function(){
		this.editorial='';
		this.nombre='';
		this.carrera='';
		this.pais='';
	},
},
})