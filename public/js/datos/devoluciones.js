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
			this.details();
		},

		data:{
			mensaje:'holaaaaaaaaaaa',
			arraydevolucion:[],
			arraydetalles:[],
			arraydetail:[],
			arrayalumnos:[],
			arraydocentes:[],
			matricula:'',
			claves:'',

			folio:'',
			foliodevolucion:'',
			datedevolucion:moment().format('YYYY/MM/DD'),

			estudiante:false,
			docente:false,
			// nomber:0,
		},
		// fin data

		// methods
		methods:{

			details:function(){
				this.$http.get(urlDetalles).then(function(dll){
					this.arraydetail = dll.data;
				}).catch(function(dll){
					toastr.error("no se encontraron datos");
				});
			},

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
						// this.nomber = this.nomber + 1;
						var undetalle = {
							'folioprestamo':response.data.folioprestamo,
							'isbn':response.data.isbn,
							'titulo':response.data.titulo,
							'id_prestador':response.data.id_prestador,
							'cantidad':response.data.cantidad,
							'correo':response.data.correo,
							'prst':response.data.prst,
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
				// this.nomber = this.nomber - 1;
			},

			devolver:function(){
				var devolucion2=[];
				var devolucion3=[];

				for (var i = 0; i < this.arraydevolucion.length; i++) {
					devolucion2.push({
						folioprestamo:this.arraydevolucion[i].folioprestamo,
						isbn:this.arraydevolucion[i].isbn,
						titulo:this.arraydevolucion[i].titulo,
						cantidad:this.arraydevolucion[i].cantidad,
						id_prestador:this.arraydevolucion[i].id_prestador,
						correo:this.arraydevolucion[i].correo,
						prst:this.arraydevolucion[i].prst,
					})
					var set = new Set(devolucion2.map(JSON.stringify))
					var devolucion3 = Array.from(set).map(JSON.parse);
				}

				var unadevolucion = {
					foliodevolucion:this.foliodevolucion,
					datedevolucion:this.datedevolucion,
					permiso:true,
					devolucion3:devolucion3,
				}

				if (devolucion3 == "") {
					swal({
						title: "DATOS VACÍOS",
						text: "No hay datos para realizar la devolución",
						icon: "error",
						buttons: "ok",
						timer: 4000,
				 	});
				} else if (true) {
					this.$http.post(urlDevolucion,unadevolucion).then(function(devo){
						swal({
							title: "DEVOLUCIÓN EXITOSA",
							text: "Devolución realizada correctamente con folio: \n " + unadevolucion.foliodevolucion,
							icon: "success",
							buttons: false,
							timer: 3000,
						});
						this.foliardevolucion();
						this.arraydevolucion=[];
						// this.nomber='';
					})
				}
			},
		},
		// fin methods
	});
}
window.onload=init;