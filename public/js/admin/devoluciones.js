var rut = document.querySelector("[name=route]").value;
var route = 'http://localhost/Gestion_Biblioteca/public/';
var urlPrestamo = route + '/apiPrestamos';

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
			this.getBuscar();

		},

		data:{
			saludo:'holamundo',
			prestamos:[],
			matricula:'',
			isbn:'',
			titulo:'',
			folioprestamo:'',
			fechaprestamo:'',
			fechadevolucion:'',
			liberado:'',
			cantidad:'',
			consec:'',
			info:false,
			auxPrestamo:'',
			buscar:'',
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

			getBuscar:function(){
				this.$http.get(urlPrestamo).then(function(json){
					this.prestamos=json.data;
				}).catch(function(json){
					console.log(json);
				});
			},

			infoPrestamo:function(id){
				this.info=true;
				//alert(id);
				$('#addprestamo').modal('show');
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
					this.auxEmpleado = response.data.folioprestamo;
				});
				// $('#addprestamo').modal('hide');

				toastr.info("Esta visualizando la informacion del prestamo");
			},

			cancelarEdit:function(){
				this.info=false;
				this.foliarPrestamo();
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
			filtroPrestados:function(){
				return this.prestamos.filter((prestamo)=>{
					return prestamo.folioprestamo.match(this.buscar.trim()) ||
					prestamo.fechaprestamo.toLowerCase().match(this.buscar.trim().toLowerCase());
				});
			},
		},
	});
}
window.onload=init;