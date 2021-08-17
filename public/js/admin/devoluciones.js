var rut = document.querySelector("[name=route]").value;
var route = 'http://localhost/Gestion_Biblioteca/public/';
var urlPrestamo = route + '/apiPrestamos';
// var urlAlumno = route + '/apiAlumnos';
var urlLibro = route + '/apiLibros';

function init()
{
	new Vue({

		http:{
			headers:{
				'X-CSRF-TOKEN':document.querySelector('#token').getAttribute('value')
			}
		},

		el:"#devolver",

		created:function(){
			this.getPrestamo();
			this.getLibros();
			// this.getAlumno();
			this.getBuscar();
			this.foliarPrestamo();
		},

		data:{
			saludo:'holamundo',
			prestamos:[],
			// alumnos:[],
			libros:[],
			matricula:'',
			isbn:'',
			titulo:'',
			folioprestamo:'',
			fechaprestamo:moment().format('DD-MM-YYYY'),
			fechadevolucion:'',
			liberado:'',
			cantidad:'',
			consec:'',
			editando:false,
			auxPrestamo:'',
			buscar:'',

			// cantidades:[1,1,1,1,1,1,1,1,1,1],
		},

		methods:{

			getPrestamo:function()
		    {
				this.$http.get(urlPrestamo).then(function(response){
					this.prestamos=response.data;
				}).catch(function(response){
					console.log(response);
				});
			},

			// getAlumno:function(){
			// 	this.$http.get(urlAlumno).then(function(response){
			// 		this.alumnos = response.data;
			// 	}).catch(function(response){
			// 		console.log(response);
			// 	});
			// },

			getBuscar:function(){
				this.$http.get(urlPrestamo).then(function(json){
					this.prestamos=json.data;
				}).catch(function(json){
					console.log(json);
				});
			},

			getLibros:function(){
				this.$http.get(urlLibro).then(function(response){
					this.libros=response.data;
				}).catch(function(response){
					console.log(response);
				});
			},

			foliarPrestamo:function(){
				this.folioprestamo='PRS-'+moment().format('YYDDMMhmmss');
			},

			showModal:function(){
				$("#modal_custom").find(".modal-header").css("background","#f39c12");
				$("#modal_custom").find(".modal-header").css("color", "black");
				$("#modal_custom").find(".modal-title")   
				$('#modal_custom').modal('show');
				// $('#addprestamo').modal('show');
			},

			// agregarPrestamo:function() {
			// 	//Construyendo un objeto de tipo Json para enviar a la Api
			// 	var prestamo={folioprestamo:this.folioprestamo,isbn:this.isbn,titulo:this.titulo,fechaprestamo:this.fechaprestamo,
			// 		fechadevolucion:this.fechadevolucion,matricula:this.matricula,
			// 		liberado:this.liberado, cantidad:this.cantidad, consec:this.consec};
			// 	//limpiar campos
			// 	this.foliarPrestamo();
			// 	this.isbn='';
			// 	this.titulo='';
			// 	this.fechaprestamo='';
			// 	this.fecchadevolucion='';
			// 	this.matricula='';
			// 	this.liberado='';
			// 	this.cantidad='';
			// 	this.consec='';
			// 	//para poder entrar al método store necesitamos de un post y se evia el json
			// 	this.$http.post(urlPrestamo,prestamo).then
   //                  (function(response) {
   //                  	this.getPrestamo();
   //                  	$('#addprestamo').modal('hide');
   //                  });
   //              toastr.success("Prestamo realizado con exito");    
			// },
		
			// eliminarPrestamo:function(id){
			// 	var resp = confirm("Esta seguro de eliminar el prestamo: " + id)
			// 	if(resp==true)
			// 	{
			// 		this.$http.delete(urlPrestamo + '/' + id)
			// 		.then(function(json){
			// 			this.getPrestamo();
			// 		});
			// 	}
			// },

			infoPrestamo:function(id){
				this.editando=true;
				//alert(id);
				$('#modal_custom').modal('show');
				//peticion al servidor
				this.$http.get(urlPrestamo + '/' + id).then
				(function(response){
					this.folioprestamo = response.data.folioprestamo;
					this.isbn = response.data.isbn;
					this.titulo = response.data.titulo;
					this.fechaprestamo = response.data.fechaprestamo;
					this.fechadevolucion = response.data.fechadevolucion;
					this.matricula = response.data.matricula;
					// this.nombre = response.data.nombre;
					// this.apellidos = response.data.apellidos;
					this.liberado = response.data.liberado;
					this.cantidad = response.data.cantidad;
					this.consec = response.data.consec;
					this.auxPrestamo = response.data.folioprestamo;
				});
				// $('#addprestamo').modal('hide');

				toastr.info("Esta visualizando la informacion del prestamo");
			},

			// updatePrestamo:function(id){
			// 	var prestamo={folioprestamo:this.folioprestamo,fechaprestamo:this.fechaprestamo,
			// 		fechadevolucion:this.fechadevolucion, matricula:this.matricula,
			// 		liberado:this.liberado, cantidad:this.cantidad, consec:this.consec
			// 	};

			// 	this.$http.put(urlPrestamo + '/' + this.folioprestamo,prestamo).then
			// 	(function(response){
			// 		this.getPrestamo();
			// 		this.editando=false;
			// 		this.foliarPrestamo();
			// 		this.fechaprestamo='';
			// 		this.fechadevolucion='';
			// 		this.matricula='';
			// 		this.liberado='';
			// 		this.cantidad='';
			// 		this.consec='';			
			// 		$('#modal_custom').modal('hide');
			// 	});
			// },

			cancelarEdit:function(){
				// $('#modal_custom').modal('hide');
				this.editando=false;
				// this.foliarPrestamo();
				this.folioprestamo='';
				this.isbn='';
				this.titulo='';
				this.fechaprestamo='';
				this.fechadevolucion='';
				this.matricula='';
				this.liberado='';
				this.cantidad='';
				this.consec='';
			},

		},
		
		computed:{
			filtroPrestamos:function(){
				return this.prestamos.filter((prestamo)=>{
					return prestamo.folioprestamo.match(this.buscar.trim()) ||
					prestamo.titulo.toLowerCase().match(this.buscar.trim().toLowerCase());
				});
			},
		},
	});
}
window.onload=init;