var root = document.querySelector("#route").getAttribute("value");
// var key = document.querySelector("#titulo").getAttribute("value");
var urlLibro = root + '/apiBusqueda';
var urlImg = root + '/apiCaratula';
var urlAlumno = root + '/apiAlumnos';

function init()
{
	new Vue({

		http:{
			headers:{
				'X-CSRF-TOKEN':document.querySelector('#token').getAttribute('value')
			}
		},

		el:'#consultar',

		created:function(){
			this.getLib();
			// this.Consultalib(key);
		},

		data:{
			saludo:'jajajajaj',
			librosb:[],
			consultas:[],
			arraycaratulas:[],
			arrayAlumno:[],
	        clave:'',
	        matri:'',

	        consulta:false,
	        verificar:false,
		},

		methods:{

			// Funcion ayuda
			help:function(){
				swal({
					title:"AVISO",
					text:"En este apartado el alumno podrá escribir el título del libro que desee, \n" + 
						"para así poder verificar si este cuenta con ejemplares disponibles \n" +
						"y así mostrarle la información referente a ese libro",
					icon:"info",
					buttons: {
	                    confirm: {
	                        text: 'Aceptar',
	                        className: 'btn btn-success'
	                    },
                	},
				});
			},
			// Fin ayuda

			getLib:function(){
				this.$http.get(urlLibro).then(function(response){
					this.librosb = response.data;
				}).catch(function(response){
					toastr.error("no se encontraron datos");
				});
			},

			getCaratulas:function(id){
				this.$http.get(urlImg + '/' + id).then(function(response){
					this.arraycaratulas = response.data["caratulas"];
				});
			},

			consultar:function(){
				this.consulta=true;
				this.verificar=false;
				this.arrayAlumno=[];
			},

			verificacion:function(){
				this.verificar=true;
				this.consulta=false;
			},

			cancelarP:function(){
				this.consulta=false;
				this.verificar=false;
			},

			// Inicio Consulta
			getConsulta:function(){
				this.$http.get(urlLibro + '/' + this.clave).then(function(response){
					if (response.data == "") {
						swal({
							title:"ADVERTENCIA",
							text: "El titulo del libro colocado no se encontró, por favor verifique que este correctamente escrito",
							icon: "warning",
							buttons:{
								confirm: {
			                        text: 'OK',
			                        className: 'btn btn-warning'
			                    },
							},
						})
						this.clave='';
					} else {
						var unaconsulta={
							'isbn':response.data.isbn,
							'titulo':response.data.titulo,
							'autor':response.data.autor,
							'carrera':response.data.carrera,
							'editorial':response.data.editorial,
							'pais':response.data.pais,
							'anio_pub':response.data.anio_pub,
							'ejemplares':response.data.ejemplares,
							'paginas':response.data.paginas,
        					'fecha_alta':response.data.fecha_alta,        					
							'folio':response.data.folio,
							'edicion':response.data.edicion,
							// 'caratula':response.data.caratula,
						};
						// var caratula={
						// 	'caratula':response.data.caratula,
						// };


						if (response.data.ejemplares >= 2) {
							swal({
								title:"AVISO",
								text:"El libro consultado aun cuenta con ejemplares para ser prestados",
								icon:"info",
								buttons:{
									confirm: {
				                        text: 'OK',
				                        className: 'btn btn-primary'
				                    },
								},
							});
							this.clave='';

							if (unaconsulta.titulo) {
								this.consultas.push(unaconsulta);
								// this.arraycaratulas.push(caratula);
								this.clave='';
								this.$refs.buscar.focus();
							}
						} else {
							swal({
								title:"AVISO",
								text:"El libro consultado no cuenta con ejemplares para ser prestados",
								icon:"warning",
								buttons:{
									confirm: {
				                        text: 'OK',
				                        className: 'btn btn-warning'
				                    },
								},
							});
							this.clave='';
						}
					}
				});
			},
			// Fin consulta

			// inicio verificar
			getVerificar:function(){
				this.$http.get(urlAlumno + '/' + this.matri).then(function(json){
					if (json.data === "") {
						swal({
							title:'ADVERTENCIA',
							text:'La matricula ingresada no esta registrada o esta mal escrita',
							icon:'warning',
							buttons:false,
							timer:4000,
						});
						this.matri='';
					} else {
						var alumno={
							'matricula':json.data.matricula,
							'nombre':json.data.nombre,
							'apellidos':json.data.apellidos,
							'clave_carrera':json.data.clave_carrera,
						};

						if (alumno.matricula) {
							this.arrayAlumno.push(alumno);
							this.matri='';
							this.$refs.buscar.focus();
						}

						swal({
							title:"AVISO",
							text:"La matricula ingresada aun esta vigente, puede ingresar",
							icon:"info",
							buttons:false,
							timer:4000,
						});
					}
				});
			},

			NewSearch:function(){
				this.consultas=[];
				this.arraycaratulas=[];
			},
		},

	});
}
window.onload=init;