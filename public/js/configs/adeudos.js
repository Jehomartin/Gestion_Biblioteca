var rute = document.querySelector("#route").getAttribute("value");
var urlAdeudo = rute + '/apiAdeudo';
var urlAlumno = rute + '/apiAlumnos';
// var urlCareer = rute + '/apiCareer';
// var urlMulta = rute + '/apiMultas';

function init()
{
	new Vue({

		http:{
			headers:{
				'X-CSRF-TOKEN':document.querySelector("#token").getAttribute("value"),
			},
		},

		el:"#adeudar",

		created:function(){
			this.getAdeudo();
			// this.getMulta();
			// this.getCareer();
			this.getAlumno();
		},

		data:{
			saludo:'holaaaaaaaaaa',
			arrayadeudos:[],
			arrayalumno2:[],
			id_adeudos:'',
	        matricula:'',
	        dias_atraso:'',
	        precio_multa:'',
	        total:'',

	        buscar:'',
	        editando:false,
	        auxDeuda:'',
		},

		// inicio methods
		methods:{

			// Inicio getAdeudo
			getAdeudo:function(){
				this.$http.get(urlAdeudo).then(function(response){
					this.arrayadeudos = response.data;
				}).catch(function(response){
					toastr.error("No se estan llamando los datos");
				});
			},
			// fin getadeudo

			// inicio getAlumno
			getAlumno:function(){
				this.$http.get(urlAlumno).then(function(response) {
					this.arrayalumno2 = response.data;
				}).catch(function(response) {
					toastr.error("No se estan cargando los datos");
				});
			}, 
			// fin

			// inicio modal
			showModal:function(){
				$("#modal_adeudo").find(".modal-header").css("background","#f39c12");
				$("#modal_adeudo").find(".modal-header").css("color", "black");
				$("#modal_adeudo").find(".modal-title")   
				$('#modal_adeudo').modal('show');
			},
			// fin
			
			// inicio infoAdeudo
			infoAdeudo:function(id){
				$('#modal_adeudo').modal('show');

				this.$http.get(urlAdeudo + '/' + id).then(function(response){
					this.id_adeudos = response.data.id_adeudos;
					this.matricula = response.data.matricula;
					this.dias_atraso = response.data.dias_atraso;
					this.precio_multa = response.data.precio_multa;
					this.total = response.data.total;
				});
			},
			// fin info

			// cargar deuda
			Cargardeuda:function(id){
				this.editando=true;
				$('#modal_adeudo').modal('show');
				this.$http.get(urlAdeudo + '/' + id).then(function(response){
					this.id_adeudos = response.data.id_adeudos;
					this.matricula = response.data.matricula;
					this.dias_atraso = response.data.dias_atraso;
					this.precio_multa = response.data.precio_multa;
					this.total = response.data.total;
					this.activo = response.data.activo;
					this.auxDeuda = response.data.id_adeudos;
				});
			},
			// fin cargar

			// Pagando deuda
			Pagando:function(id){
				var unpago = {
					id_adeudos:this.id_adeudos, matricula:this.matricula,
					dias_atraso:this.dias_atraso, precio_multa:this.precio_multa,
					total:this.total, activo:false,
				};

				this.$http.put(urlAdeudo + '/' + this.id_adeudos,unpago).then(function(response){
					this.getAdeudo();
					this.id_adeudos = '';
					this.matricula = '';
					this.dias_atraso = '';
					this.precio_multa = '';
					this.total = '';

					$('#modal_adeudo').modal('hide');

					swal({
						title:'PAGO EXITOSO',
						text:'El pago de la deuda se realizó correctamente',
						icon:'success',
						buttons:true,
					});
				}).catch(function(response){
					swal({
						title:'PAGO FALLIDO',
						text:'El pago no se realizó',
						icon:'error',
						buttons:false,
						timer:3000,
					});
				});

			},

			// inicio cancelar
			cancelar:function(){
				this.editando = false;
				this.id_adeudos = '';
				this.matricula = '';
				this.nombre = '';
				this.apellidos = '';
				this.clave_carrera = '';
				this.dias_atraso = '';
				this.id_multas = '';
				this.total = '';
			},
			// fin cancelar
		},
		// fin methods

		// inicio computed
		computed:{
			filtroDeudas:function(){
				return this.arrayadeudos.filter((adeudos)=>{
					return adeudos.matricula.match(this.buscar.trim()); 
					// adeudos.nombres.toLowerCase().match(this.buscar.trim().toLowerCase());
				});
			},
		},
		// fin computed
	});
}
window.onload=init;