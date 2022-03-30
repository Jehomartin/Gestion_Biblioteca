var route = document.querySelector("#route").getAttribute("value");
var urlLibros = route + '/apiRegistroLibros';
var urlEditorial = route + '/apiEditoriales';
var urlAutor = route + '/apiAutores';
var urlCarrera = route + '/apiCarreras';
var urlPais = route + '/apiPais';
var urlEjemplar = route + '/apiEjemplares';

function init(){
	new Vue({

		http:{
			headers:{
				'X-CSRF-TOKEN':document.querySelector("#token").getAttribute("value"),
			},
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
			paginas:'',
		    ejemplares:'',
		    clasificacion:'',
		    cutter:'',

		    // imagen
		    preview:'',
		    arraycaratulas:[],
		    caratulafile:'',
		    // 

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

		    fecha_alta:moment().format('YYYY-MM-DD'),
		},

		methods:{

			getLibross:function(){
				this.$http.get(urlLibros).then(function(response){
					this.libros=response.data;
				}).catch(function(response){
					toastr.error("Datos no cargados");
				});
			},

			getEditorials:function(){
				this.$http.get(urlEditorial).then(function(response){
					this.editoriales=response.data;
				}).catch(function(response){
					toastr.error("Datos no cargados");
				});
			},

			getAutors:function(){
				this.$http.get(urlAutor).then(function(response){
					this.autores=response.data;
				}).catch(function(response){
					toastr.error("Datos no cargados");
				});
			},

			getCarreras:function(){
				this.$http.get(urlCarrera).then(function(response){
					this.carreras=response.data;
				}).catch(function(response){
					toastr.error("Datos no cargados");
				});
			},

			getPaiss:function(){
				this.$http.get(urlPais).then(function(response){
					this.paises=response.data;
				}).catch(function(response){
					toastr.error("Datos no cargados");
				});
			},

			showModalEditorial:function(){
				$("#Editorial").find(".modal-header").css("background","#f39c12");
				$("#Editorial").find(".modal-header").css("color", "black");
				$("#Editorial").find(".modal-title")   
				$('#Editorial').modal('show');
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

			alSeleccionar(event){
				this.caratula = event.target.files[0];
				this.preview= URL.createObjectURL(this.caratula);
				// this.arrayimages.push(preview);
			},

			previewFiles(e){
				this.arraycaratulas = e.target.files;
			},

			agregarLibro:function(){
				let newbook = new FormData();

		    	newbook.append('isbn',this.isbn);
				newbook.append('folio',this.isbn);
				newbook.append('titulo',this.titulo);
				newbook.append('id_editorial',this.id_editorial);
				newbook.append('id_autor',this.id_autor);
				newbook.append('id_carrera',this.id_carrera);
				newbook.append('edicion',this.edicion);
				newbook.append('anio_pub',this.anio_pub);
				newbook.append('id_pais',this.id_pais);
				newbook.append('fecha_alta',this.fecha_alta);
				newbook.append('paginas',this.paginas);
				newbook.append('ejemplares',1);
				newbook.append('clasificacion',this.clasificacion);
				newbook.append('cutter',this.cutter);

				for (var i = 0; i < this.arraycaratulas.length; i++) {
					let file = this.arraycaratulas[i];
					newbook.append("caratulafile["+ i + "]", file);
				}

				// var portada = {
				// 	header:{'Content-Type':'image/jpg'}
				// }

				this.$http.post(urlLibros,newbook).then(function(response){
					swal({
						title: "REGISTRO EXITOSO",
						text: "El libro fue registrado exitosamente",
						icon: "success",
						buttons:false,
						timer: 3000,
					});
					this.arraycaratulas=[];
					this.isbn='';
					this.titulo='';
					this.folio='';
					this.edicion='';
					this.anio_pub='';
					this.paginas='';
				    this.ejemplares='';
				    this.clasificacion='';
				    this.caratulafile='';
				    this.id_editorial='';
					this.id_autor='';
					this.id_carrera='';
					this.id_pais='';

				}).catch(function(response){
					console.log(newbook);
					swal({
						title: "REGISTRO FALLIDO",
						text: "Verifique si lleno todos los campos importantes",
						icon: "error",
						buttons:false,
						timer: 3000,
					});
				})
			},

			guardarEditorial:function(){
				var editor={id_editorial:this.id_editorial,
					editorial:this.editorial
				};

				this.$http.post(urlEditorial,editor).then(function(response){
					this.getEditorials();
					$('#Editorial').modal('hide');
					swal({
						title: "REGISTRO EXITOSO",
						text:"Editorial registrada con exito",
						icon: "success",
						buttons:false,
						timer: 3000,
					});
					this.editorial='';
				}).catch(function(response){
					swal({
						title: "REGISTRO FALLIDO",
						text:"Editorial no registrada",
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
						title: "REGISTRO EXITOSO",
						text:"Autor registrado con exito",
						icon: "success",
						buttons:false,
						timer: 3000,
					});
				}).catch(function(response){
					swal({
						title: "REGISTRO FALLIDO",
						text:"Autor no registrado",
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
						title: "REGISTRO EXITOSO",
						text:"Carrera registrada con exito",
						icon: "success",
						buttons:false,
						timer: 3000,
					});
				}).catch(function(response){
					swal({
						title: "REGISTRO FALLIDO",
						text:"Carrera no registrada",
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
						title: "REGISTRO EXITOSO",
						text:"País registrado con exito",
						icon: "success",
						buttons:false,
						timer: 3000,
					});
				}).catch(function(json){
					swal({
						title: "REGISTRO FALLIDO",
						text:"País no registrado",
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
}
window.onload=init;