var rut = document.querySelector("[name=route]").value;
var route = 'http://localhost/Gestion_Biblioteca/public/';
var urlDetalles = route + 'apiDetalles';

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
		},

		data:{
			saludo:'holamundo',
			detalleprestamos:[],
			foliodetalle:'',
	    	folioprestamo:'',
	    	isbn:'',
	    	titulo:'',
	    	clasificacion:'',
	    	devuelto:'',
	    	consec:'',
	    	cantidad:'',
			editando:false,
			auxPrestamo:'',
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

			showModal:function(){
				$("#modal_custom").find(".modal-header").css("background","#f39c12");
				$("#modal_custom").find(".modal-header").css("color", "black");
				$("#modal_custom").find(".modal-title")   
				$('#modal_custom').modal('show');
				// $('#addprestamo').modal('show');
			},

			infoPrestamo:function(id){
				this.editando=true;
				// swal({
				// 	title: "Información",
				// 	text: "Esta visualizando informacion del prestamo",
				// 	icon: "info",
				// 	buttons: false,
				// 	timer: 2000,
				// });
				$('#modal_custom').modal('show');
				//peticion al servidor
				this.$http.get(urlDetalles + '/' + id).then
				(function(response){
					this.foliodetalle = response.data.foliodetalle;
					this.folioprestamo = response.data.folioprestamo;
					this.isbn = response.data.isbn;
					this.titulo = response.data.titulo;
					this.clasificacion = response.data.clasificacion;
					this.devuelto = response.data.devuelto;
					this.cantidad = response.data.cantidad;
					this.consec = response.data.consec;
					this.auxPrestamo = response.data.folioprestamo;
				});

			},

			cancelarEdit:function(){
				this.editando=false;
				this.foliodetalle='';
				this.folioprestamo='';
				this.isbn='';
				this.titulo='';
				this.devuelto='';
				this.cantidad='';
				this.consec='';
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