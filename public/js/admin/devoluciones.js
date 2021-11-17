var rut = document.querySelector("[name=route]").value;
var route = 'http://localhost/Gestion_Biblioteca/public/';
var urlDetalles = route + 'apiDetalles';
var urlPrestamos = route + 'apiPrestamos';

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
			this.getDetalles();
			this.getBuscar();
			this.getPrestamos();
		},

		data:{
			saludo:'holamundo',
			detalleprestamos:[],
			prestamos:[],
			fechadevolucion:'',
			foliodetalle:'',
	    	folioprestamo:'',
	    	isbn:'',
	    	titulo:'',
	    	clasificacion:'',
	    	devuelto:'',
	    	consec:'',
	    	cantidad:'',
			editando:false,
			auxDev:'',
			buscar:'',

			// cantidades:[1,1,1,1,1,1,1,1,1,1],
		},

		methods:{

			getDetalles:function()
		    {
				this.$http.get(urlDetalles).then(function(response){
					this.detalleprestamos=response.data;
				}).catch(function(response){
					toastr.error("no se encontraron datos");
				});
			},

			getBuscar:function(){
				this.$http.get(urlDetalles).then(function(json){
					this.detalleprestamos=json.data;
				}).catch(function(json){
					toastr.error("no se encontraron datos");
				});
			},

			getPrestamos:function()
			{
				this.$http.get(urlPrestamos).then(function(json){
					this.prestamos = json.data;
				}).catch(function(json){
					toastr.error("no se cargaron los datos");
				});
			},

			showModal:function(){
				$("#modal_custom").find(".modal-header").css("background","#f39c12");
				$("#modal_custom").find(".modal-header").css("color", "black");
				$("#modal_custom").find(".modal-title")   
				$('#modal_custom').modal('show');
				// $('#addprestamo').modal('show');
			},

			infoPrestamo:function(id){
				var fecha = this.prestamos.fechadevolucion;
				
				$('#modal_custom').modal('show');
				//peticion al servidor
				this.$http.get(urlDetalles + '/' + id).then
				(function(response){
					this.foliodetalle = response.data.foliodetalle;
					this.folioprestamo = response.data.folioprestamo;
					this.isbn = response.data.isbn;
					this.titulo = response.data.titulo;
					this.fechadevolucion = response.data.fecha;
					this.devuelto = response.data.devuelto;
					this.cantidad = response.data.cantidad;
				});

			},

			Datoscargar:function(id){
				var fecha = this.prestamos.fechadevolucion;

				this.editando=true;
				$('#modal_custom').modal('show');
				//peticion al servidor
				this.$http.get(urlDetalles + '/' + id).then
				(function(response){
					this.foliodetalle = response.data.foliodetalle;
					this.folioprestamo = response.data.folioprestamo;
					this.isbn = response.data.isbn;
					this.titulo = response.data.titulo;
					this.fechadevolucion = response.data.fecha;
					this.devuelto = response.data.devuelto;
					this.cantidad = response.data.cantidad;
					this.auxDev = response.data.foliodetalle;
				});
			},

			Devolver:function(id){
				var devuelto = {
					foliodetalle:this.foliodetalle, folioprestamo:this.folioprestamo, isbn:this.isbn,
					titulo:this.titulo, devuelto:this.devuelto,cantidad:this.cantidad
				};

				this.$http.put(urlDetalles + '/' + this.foliodetalle,devuelto).then(function(response){
					// this.getDetalles().splice(id,1);
					this.getDetalles();
					this.foliodetalle='';
					this.folioprestamo='';
					this.isbn='';
					this.titulo='';
					// this.fechadevolucion='';
					this.devuelto='';
					this.cantidad='';

					$('#modal_custom').modal('hide');



					swal({
						title:"DEVOLUCIÓN REALIZADA",
						text: "La devolución se realizo correctamente",
						icon:"success",
						buttons:false,
						timer:3000
					});

				}).catch(function(response){
					swal({
						title: "FALLÓ LA DEVOLUCIÓN",
						text: "El proceso no se completo, ocurrio un error",
						icon: "error",
						buttons:false,
						timer: 3000,
					});

				});
			},

			cancelarEdit:function(){
				this.editando=false;
				this.foliodetalle='';
				this.folioprestamo='';
				this.isbn='';
				this.titulo='';
				this.fechadevolucion='';
				this.devuelto='';
				this.cantidad='';
			},

		},
		
		computed:{
			filtroDetalles:function(){
				return this.detalleprestamos.filter((detalles)=>{
					return detalles.folioprestamo.match(this.buscar.trim()) ||
					detalles.titulo.toLowerCase().match(this.buscar.trim().toLowerCase());
				});
			},
		},
	});
}
window.onload=init;