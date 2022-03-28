var root = document.querySelector("#route").getAttribute("value");
var urlDevolucion = root + '/apiDevoluciones';
var urlDetalles = root + '/apiDetalles';
var urlPresta = root + '/apiPrestamos';
var urlAlumnos = root + '/apiAlumnos';
var urlDocentes = root + '/apiDocente';

function init(){
	new Vue({

		http:{
			headers:{
				'X-CSRF-TOKEN':document.querySelector("#token").getAttribute("value"),
			},
		},

		el:'#devolucion',

		created:function(){
			this.foliardevolucion();
		},

		data:{
			mensaje:'holaaaaaaaaaaa',
			arraydevolucion:[],
			arraydetalles:[],
			arrayalumnos:[],
			arraydocentes:[],
			matricula:'',
			claves:'',

			folio:'',
			foliodevolucion:'',
			datedevolucion:moment().format('YYYY/MM/DD'),

			estudiante:false,
			docente:false,
		},
		// fin data

		// methods
		methods:{
			// getDetalles
			getDetalles:function(){
				this.$http.get(urlDetalles + '/' + this.folio).then(function(response) {
					if (response.data === "") {
						swal({
							title:"ADVERTENCIA",
							text: "El código ingresado no se encontró o esta mal escrito",
							icon: "warning",
							buttons: true,
							timer: 3000,
						});
						this.folio='';
					} else {
						var undetalle = {
							'folioprestamo':response.data.folioprestamo,
							'isbn':response.data.isbn,
							'titulo':response.data.titulo,
							'matricula':response.data.matricula,
							'claves':response.data.claves,
							'cantidad':response.data.cantidad,
							'correo':response.data.correo,
						};

						if (undetalle.folioprestamo) {
							this.arraydevolucion.push(undetalle);
							this.folio='';
							this.$refs.buscar.focus();
						}
					}
				});
			},
			// fin getDetalles

			foliardevolucion:function(){
				this.foliodevolucion = 'DVS-' + moment().format('YYMMDDhmmss');
			},

			cancelarDevolucion:function(id){
				this.arraydevolucion.splice(id,1);
			},

			student:function(){
				this.estudiante=true;
				this.docente=false;
				this.arraydocentes=[];
				this.claves='';
			},

			teacher:function(){
				this.docente=true;
				this.estudiante=false;
				this.arrayalumnos=[];
				this.matricula='';
			},
		},
		// fin methods
	});
}
window.onload=init;