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

	el:"#libro",

	created:function(){
		this.getLibros();
		this.getEditorial();
		this.getAutor();
		this.getCarrera();
		this.getPais();
		this.getBuscar();
		this.getEjemplar();
	},

	data:{
		libros:[],
		editoriales:[],
		autores:[],
		carreras:[],
		paises:[],
		ejemplars:[],
		id_editorial:'',
		editorial:'',
		id_autor:'',
		id_carrera:'',
		id_pais:'',
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
        auxLibro:'',
        buscar:'',

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

		getEjemplar:function(){
			this.$http.get(urlEjemplar).then(function(response){
				this.ejemplars=response.data;
			}).catch(function(response){
				console.log(response);
			});
		},

		getBuscar:function(){
			this.$http.get(urlLibros).then(function(json){
				this.libros=json.data;
			}).catch(function(json){
				console.log(json);
			});
		},

		// inicio del evento libros
		// getLibrou(event){
		// 	var id = event.target.value;
		// 	this.$http.get(urlLibros + id).then(function(json){
		// 		this.libros = json.data;
		// 	});
		// },
		// fin del evento libros

		showModal:function(){
			$("#modal_custom").find(".modal-header").css("background","#f39c12");
			$("#modal_custom").find(".modal-header").css("color", "black");
			$("#modal_custom").find(".modal-title")   
			$('#modal_custom').modal('show');
			// $('#addlibro').modal('show');
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

		showModals:function(){
			$("#modal_customs").find(".modal-header").css("background","#f39c12");
			$("#modal_customs").find(".modal-header").css("color", "black");
			$("#modal_customs").find(".modal-title")   
			$('#modal_customs').modal('show');
			// $('#addejemplar').modal('show');
		},

		agregarLibro:function(){

			// var editoria=[];
			// editoria.push({
			// 	editorial:this.editoriales[i].editorial
			// });


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

		editLibro:function(id){
			this.editando=true;
			$('#modal_custom').modal('show');
			this.$http.get(urlLibros + '/' + id).then(function(response){
				this.isbn = response.data.isbn;
				this.folio = response.data.isbn;
				this.titulo = response.data.titulo;
				this.id_editorial = response.data.id_editorial;
				this.id_autor = response.data.id_autor;
				this.id_carrera = response.data.id_carrera;
				this.edicion = response.data.edicion;
				this.anio_pub = response.data.anio_pub;
				this.id_pais = response.data.id_pais;
				this.fecha_alta = response.data.fecha_alta;
				this.paginas = response.data.paginas;
				this.ejemplares = response.data.ejemplares;
				this.clasificacion = response.data.clasificacion;
				this.cutter = response.data.cutter;
				this.auxLibro = response.data.isbn;
			});

			toastr.info("Esta editando informacion del libro");
		},

		updateLibro:function(id){
			var libro={isbn:this.isbn,folio:this.isbn,titulo:this.titulo,id_editorial:this.id_editorial,id_autor:this.id_autor,
				id_carrera:this.id_carrera,edicion:this.edicion,anio_pub:this.anio_pub,id_pais:this.id_pais,
				fecha_alta:this.fecha_alta,paginas:this.paginas,ejemplares:this.ejemplares,clasificacion:this.clasificacion,cutter:this.cutter
			};

			this.$http.put(urlLibros + '/' + this.isbn,libro).then(function(response){
				this.getLibros();
				this.editando=false;
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

				$('#modal_custom').modal('hide');

				toastr.success("Actualizacion de libro exitosa");

			}).catch(function(response){

				toastr.error("Actualizacion fallida, ocurrio un error");

			});

			
		},

		eliminarLibro:function(id){
			var resp =confirm("Esta seguro de eliminar el libro")
			if (resp==true) 
			{
				this.$http.delete(urlLibros + '/' + id).then(function(json){
					this.getLibros();
				});
				toastr.success("Libro eliminado");
			}
			else{
				toastr.info("El libro no se elimino");
			}
			
		},

		cancelarEdit:function(){
			this.editando=false;
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
		},

		selecEjemp:function(id){
			
		},

		agregarEjemplar:function(){
			
			//creación del objeto json para enviar al metodo post
			var ejemplar={clasificacion:this.clasificacion,folio:this.folio,esbase:this.esbase,
				prestado:this.prestado,comentario:this.comentario,consec:this.consec,
				fecha_alta:this.fecha_alta,solodewee:this.solodewee,deweecompleto:this.deweecompleto};
			// se realiza la limpieza de los campos
			this.clasificacion = '';
			this.folio = '';
			this.esbase = '';
			this.prestado = '';
			this.comentario = '';
			this.consec = '';
			this.fecha_alta = '';
			this.solodewee = '';
			this.deweecompleto = '';
			// se realiza el envío del objeto json con un post
			this.$http.post(urlEjemplar, ejemplar).then(function(response){
				this.getEjemplar();
				$('#modal_customs').modal('hide');

				toastr.success("Ejemplar agregado con exito!!");

			}).catch(function(response){

				toastr.error("Ejemplar no agregado ocurrio un error");

			});

		},

		cancelEditj:function(){
			this.editejem=false;
			this.clasificacion = '';
			this.folio = '';
			this.esbase = '';
			this.prestado = '';
			this.comentario = '';
			this.consec = '';
			this.fecha_alta = '';
			this.solodewee = '';
			this.deweecompleto = '';
		},
		
	},

	computed:{
		filtroLibros:function(){
			return this.libros.filter((libro)=>{
				return libro.isbn.match(this.buscar.trim()) ||
				libro.titulo.toLowerCase()
				.match(this.buscar.trim().toLowerCase());
			});
		},
	},
});