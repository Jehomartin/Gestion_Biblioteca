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
		// this.getBuscar();
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
        // editando:false,
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
				toastr.info("No se estan llamando los datos");
			});
		},

		getEditorial:function(){
			this.$http.get(urlEditorial).then(function(response){
				this.editoriales=response.data;
			}).catch(function(response){
				toastr.info("No se estan llamando los datos");
			});
		},

		getAutor:function(){
			this.$http.get(urlAutor).then(function(respon){
				this.autores=respon.data;
			}).catch(function(respon){
				toastr.info("No se estan llamando los datos");
			});
		},

		getCarrera:function(){
			this.$http.get(urlCarrera).then(function(respo){
				this.carreras=respo.data;
			}).catch(function(respo){
				toastr.info("No se estan llamando los datos");
			});
		},

		getPais:function(){
			this.$http.get(urlPais).then(function(career){
				this.paises=career.data;
			}).catch(function(career){
				toastr.info("No se estan llamando los datos");
			});
		},

		getEjemplar:function(){
			this.$http.get(urlEjemplar).then(function(response){
				this.ejemplars=response.data;
			}).catch(function(response){
				toastr.info("No se estan llamando los datos");
			});
		},

		getBuscar:function(){
			this.$http.get(urlLibros).then(function(json){
				this.libros=json.data;
			}).catch(function(json){
				toastr.info("No se estan llamando los datos");
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

		showEjemplar:function(){
			$("#modal_ejemplar").find(".modal-header").css("background","#f39c12");
			$("#modal_ejemplar").find(".modal-header").css("color", "black");
			$("#modal_ejemplar").find(".modal-title")   
			$('#modal_ejemplar').modal('show');
			// $('#addejemplar').modal('show');
		},

		editLibro:function(id){
			// this.editando=true;
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
				// this.editando=false;
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

				swal({
					title: "Libro Actualizado",
					text: "Se modificaron los campos del libro",
					icon: "success",
					buttons:false,
					timer: 3000,
				});

			}).catch(function(response){

				swal({
					title: "Falló la actualización",
					text: "El proceso no se completo, ocurrio un error",
					icon: "error",
					buttons:false,
					timer: 3000,
				});

			});

			
		},

		eliminarLibro:function(id){
			
			swal({
                title: 'Aviso',
                text: "¿Está seguro de eliminar este registro?",
                type: 'warning',
                buttons: {
                    confirm: {
                        text: 'Eliminar!',
                        className: 'btn btn-success'
                    },
                    cancel: {
                        visible: true,
                        className: 'btn btn-danger'
                    },
                },
            }).then((result) => {
                if (result) {
                    this.$http.delete(urlLibros + '/' + id).then(function(json){
                            swal({
                                title: '¡Eliminado!',
                                text: 'Usted a eliminado el registro corréctamente',
                                icon: 'success',
                                buttons: false,
                                timer: 1500
                            });
                            this.getLibros();
                        });
                } else {
                    swal.close();
                }
            });
		},

		cancelarEdit:function(){
			// this.editando=false;
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

		// selecEjemp:function(id){
			
		// },

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
				$('#modal_ejemplar').modal('hide');

				swal({
					title: "Ejemplar agregado",
					text: "Registro de ejemplar exitoso",
					icon: "success",
					buttons: {
						comfirm: {
							text: 'OK',
							className: 'btn btn-success'
						},
					},
					timer: 3000,
				});

			}).catch(function(response){

				swal({
					text: "Ejemplar no registrado",
					icon: "error",
					buttons: false,
					timer: 3000,
				});

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
			return this.libros.filter((libros)=>{
				return libros.isbn.match(this.buscar.trim()) ||
				libros.titulo.toLowerCase()
				.match(this.buscar.trim().toLowerCase());
			});
		},
	},
});