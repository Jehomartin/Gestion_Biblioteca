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

			// funcion devolver con modal
			Devolver:function(id){
				var devuelto = {
					foliodetalle:this.foliodetalle, folioprestamo:this.folioprestamo, isbn:this.isbn,
					titulo:this.titulo, devuelto:this.devuelto,cantidad:this.cantidad
				};

				if (this.devuelto==1) {
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
					});
				}else if (this.devuelto == 0) {
					swal({
						title:"DEVOLUCIÓN FALLIDA",
						text: "El indicador de devolución debe ser 1",
						icon:"error",
						buttons:false,
						timer:3000
					});
				}
				
			},
			// fin devolver com modal

			// función devolución con mensaje
			DevolverLibro:function(id){
				// se crea la variable para almacenar los datos
				var devoluciones=[];

				devoluciones.push({
					foliodetalle:this.detalleprestamos.foliodetalle,
					folioprestamo:this.detalleprestamos.folioprestamo,
					isbn:this.detalleprestamos.isbn,
					titulo:this.detalleprestamos.titulo,
					devuelto:1,
					cantidad:this.detalleprestamos.cantidad,
				});
				// fin

				swal({
					title:"REALIZANDO DEVOLUCIÓN",
					text:"¿Está seguro de realizar la devolución del libro con clave \n" + this.isbn,
					type: 'info',
					icon: 'warning',
					buttons:{
						confirm:{
							text: '¡Devolver!',
							className: 'btn btn-success',
						},
						cancel:{
							visible:true,
							className:'btn btn-danger'
						},
					}, 
				}).then((result) =>{
					if (result) {
						this.$http.post(urlDetalles + '/' + this.foliodetalle,devoluciones).then(function(response){
							// this.foliodetalle='';
							// this.folioprestamo='';
							// this.isbn='';
							// this.titulo='';
							// this.fechadevolucion='';
							// this.devuelto='';
							// this.cantidad='';

							swal({
								title:"DEVOLUCIÓN REALIZADA",
								text: "La devolución se realizo correctamente",
								icon:"success",
								buttons:false,
								timer:3000
							});
							this.getDetalles();
						}).catch(function(response){
							swal({
								title: "FALLÓ LA DEVOLUCIÓN",
								text: "El proceso no se completo, ocurrio un error",
								icon: "error",
								buttons:false,
								timer: 3000,
							});
						});
					}else{
						swal.close();
					}
				});
			},
			// fin devolución con mensaje

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