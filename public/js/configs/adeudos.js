var rute = document.querySelector("#route").getAttribute("value");
var urlAdeudo = rute + '/apiAdeudo';
var urlAlumno = rute + '/apiAlumnos';
var urlCareer = rute + '/apiCareer';
var urlMulta = rute + '/apiMultas';

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
			this.getMulta();
			this.getCareer();
			this.getAlumno();
		},

		data:{
			saludo:'holaaaaaaaaaa',
			arrayadeudos:[],
			arraymultas:[],
			arrayalumno2:[],
			arraycareer:[],
			id_adeudos:'',
	        matricula:'',
	        clave_carrera:'',
	        dias_atraso:'',
	        id_multas:'',
	        total:'',

	        buscar:'',
	        editando:'',

	        // career
	        nombre_carrera:'',

	        // alumno
	        nombre:'',
	        apellidos:'',
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

			// inicio getMulta
			getMulta:function(){
				this.$http.get(urlMulta).then(function(mta){
					this.arraymultas = mta.data;
				}).catch(function(mta){
					toastr.error("No se estan cargando los datos");
				});
			},
			// fin

			// inicio getCareer
			getCareer:function(){
				this.$http.get(urlCareer).then(function(json){
					this.arraycareer = json.data;
				}).catch(function(json){
					toastr.error("No se estan cargando los datos");
				});
			},
			// fin

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
				var name = this.arrayalumno2['nombre'];
				var ape = this.arrayalumno2['apellidos'];

				$('#modal_adeudo').modal('show');
				this.editando=true;

				this.$http.get(urlAdeudo + '/' + id).then(function(response){
					this.id_adeudos = response.data.id_adeudos;
					this.matricula = response.data.matricula;
					this.nombre = this.name;
					this.apellidos = this.ape;
					this.clave_carrera = response.data.clave_carrera;
					this.dias_atraso = response.data.dias_atraso;
					this.id_multas = response.data.id_multas;
					this.total = response.data.total;
				});
			},
			// fin info

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
					return adeudos.matricula.match(this.buscar.trim()) ||
					adeudos.nombres.toLowerCase().match(this.buscar.trim().toLowerCase());
				});
			},
		},
		// fin computed
	});
}
window.onload=init;