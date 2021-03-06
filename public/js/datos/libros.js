var route = document.querySelector("#route").getAttribute("value");
var urlLibros = route + '/apiLibros';
var urlEditorial = route + '/apiEditoriales';
var urlAutor = route + '/apiAutores';
var urlCarrera = route + '/apiCarreras';
var urlPais = route + '/apiPais';
var urlEjemplar = route + '/apiEjemplares';
var urlImg = route + '/apiCaratula';

function init(){
	new Vue({
		http:{
			headers:{
				'X-CSRF-TOKEN':document.querySelector("#token").getAttribute("value"),
			},
		},

		el:"#libro",

		created:function(){
			this.getLibros();
			this.getEditorial();
			this.getAutor();
			this.getCarrera();
			this.getPais();
			// this.getCaratulas(this.id);
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
	        auxLibro:'',
	        buscar:'',

	        //datos para agregar el ejemplar
	        id_ejemplar:'',
	        folio:'',
			esbase:'',
			prestado:'',
			comentario:'',
			consec:'',
	        fechalta:moment().format('YYYY-MM-DD'),
	        solodewee:'',
	        deweecompleto:'',
	        editejem:false,
	        auxEjemplar:'',

	        pagination: {
	            total: 0,
	            current_page: 0,
	            per_page: 0,
	            last_page: 0,
	            from: 0,
	            to: 0,
	        },
	        offset: 2,
	        adjacents: 3,
	        numerador: 0,

	        // imagen
		    preview:false,
		    arraycaratulas:[],
		    caratulafile:'',
		    // 
		},

		methods:{
			getLibros:function(page){
				var url = urlLibros + "?page=" + page;
				this.$http.get(url).then(function(response){

					this.libros = response.data.tasks.data;
					this.pagination = response.data.pagination;

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

			showModal:function(){
				$("#modal_custom").find(".modal-header").css("background","#f39c12");
				$("#modal_custom").find(".modal-header").css("color", "black");
				$("#modal_custom").find(".modal-title")   
				$('#modal_custom').modal('show');

			},

			showEjemplar:function(){
				$("#modal_ejemplar").find(".modal-header").css("background","#f39c12");
				$("#modal_ejemplar").find(".modal-header").css("color", "black");
				$("#modal_ejemplar").find(".modal-title")   
				$('#modal_ejemplar').modal('show');

			},

			previewFiles(e){
				this.preview = true;
				this.arraycaratulas = e.target.files;
			},

			editLibro:function(id){
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
				// var upbook = new FormData();
				// upbook.append('isbn',this.isbn);
				// upbook.append('folio',this.isbn);
				// upbook.append('titulo',this.titulo);
				// upbook.append('id_editorial',this.id_editorial);
				// upbook.append('id_autor',this.id_autor);
				// upbook.append('id_carrera',this.id_carrera);
				// upbook.append('edicion',this.edicion);
				// upbook.append('anio_pub',this.anio_pub);
				// upbook.append('id_pais',this.id_pais);
				// upbook.append('fecha_alta',this.fecha_alta);
				// upbook.append('paginas',this.paginas);
				// upbook.append('ejemplares',this.ejemplares);
				// upbook.append('clasificacion',this.clasificacion);
				// upbook.append('cutter',this.cutter);
				for (var i = 0; i < this.arraycaratulas.length; i++) {
					let file = this.arraycaratulas[i];
					var detacara = ("caratulafile["+ i + "]", file);
				}


				var libro={isbn:this.isbn,folio:this.isbn,titulo:this.titulo,id_editorial:this.id_editorial,
					id_autor:this.id_autor,id_carrera:this.id_carrera,edicion:this.edicion,
					anio_pub:this.anio_pub,id_pais:this.id_pais,fecha_alta:this.fecha_alta,
					paginas:this.paginas,ejemplares:this.ejemplares,clasificacion:this.clasificacion,
					cutter:this.cutter, detacara:detacara,

				};

				this.$http.put(urlLibros + '/' + this.isbn,libro).then(function(response){
					this.getLibros();
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
						title: "ACTUALIZACI??N EXITOSA",
						text: "Se modificaron los campos del libro",
						icon: "success",
						buttons:false,
						timer: 3000,
					});

				}).catch(function(response){

					swal({
						title: "ERROR DE ACTUALIZACI??N",
						text: "El proceso no se completo, ocurrio un error",
						icon: "error",
						buttons:false,
						timer: 3000,
					});

				});

				
			},

			eliminarLibro:function(id){
				
				swal({
	                title: 'ADVERTENCIA',
	                text: "??Est?? seguro de eliminar este registro?",
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
	                                title: '??ELIMINADO!',
	                                text: 'Usted a eliminado el registro corr??ctamente',
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

			loadExample:function(id){
				this.editejem=true;
				$('#modal_ejemplar').modal('show');
				this.$http.get(urlEjemplar + '/' + id).then(function(response){
					// this.auxEjemplar = response.data.ejemplares + 1;
					this.id_ejemplar = response.data.folio + '-' + (response.data.ejemplares + 1);
					this.folio = response.data.folio;
					this.titulo = response.data.titulo;
					// this.fechalta = response.data.fechalta;
					this.ejemplares = response.data.ejemplares + 1;
				});
			},

			agregarEjemplar:function(){
				
				//creaci??n del objeto json para enviar al metodo post
				var ejemplar1={
					id_ejemplar:this.id_ejemplar,
					folio:this.folio,
					esbase:0,
					prestado:0,
					comentario:this.comentario,
					consec:this.consec,
					fechalta:this.fechalta,
					solodewee:null,
					deweecompleto:null,
				};

				// se realiza la limpieza de los campos
				this.id_ejemplar = '';
				this.folio = '';
				this.esbase = '';
				this.prestado = '';
				this.comentario = '';
				this.consec = '';
				this.solodewee = '';
				this.deweecompleto = '';
				this.getLibros();
				// se realiza el env??o del objeto json con un post
				this.$http.post(urlEjemplar, ejemplar1).then(function(response){
					this.getEjemplar();
					$('#modal_ejemplar').modal('hide');

					swal({
						title: "REGISTRO EXITOSO",
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
					
					this.getEjemplar();
				}).catch(function(response){
					

					swal({
						title:"ERROR DE REGISTRO",
						text: "Ejemplar no registrado",
						icon: "error",
						buttons: false,
						timer: 3000,
					});

				});
			},

			cancelEditj:function(){
				this.editejem=false;
				this.id_ejemplar = '';
				this.folio = '';
				this.esbase = '';
				this.prestado = '';
				this.comentario = '';
				this.consec = '';
				this.solodewee = '';
				this.deweecompleto = '';
			},

			NextPage:function(page){
				this.pagination.current_page = page;
				this.getLibros(page);
			},
			
		},

		computed:{
			Numerador(){
				var valNo = (this.pagination.current_page - 1) * this.pagination.per_page;
				num = valNo == "" ? 1 : valNo + 1;
				this.numerador = num;
				return num;
			},

			Activates(){
				return this.pagination.current_page;
			},

			PagesNo:function(){
				if (!this.pagination.to) {
					return [];
				}

				var from = this.pagination.current_page - this.offsets;
				if (from < 1) {
					from = 1;
				}

				var to = from + this.offsets * 2;
				if (to >= this.pagination.last_page) {
					to = this.pagination.last_page;
				}

				var paginas = [];
				while (from <= to ){
					paginas.push(from);
					from ++;
				}

				return paginas;

			},

			filtroLibros:function(){
				return this.libros.filter((libros)=>{
					return libros.isbn.match(this.buscar.trim()) ||
					libros.titulo.toLowerCase()
					.match(this.buscar.trim().toLowerCase());
				});
			},
		},
	});
}
window.onload=init;