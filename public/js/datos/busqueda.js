var root = document.querySelector("#route").getAttribute("value");
var urlLibro = root + '/apiBusqueda';
var urlImg = root + '/apiCaratula';

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

		},

		data:{
			saludo:'jajajajaj',
			librosb:[],
			consultas:[],
			arraycaratulas:[],
			clave:'',

		},

		methods:{

			// Funcion ayuda
			help:function(){
				swal({
					title:"AVISO",
					text:"En este apartado el alumno podrá escribir el título o la clave del libro que desee, para así poder verificar si este cuenta con ejemplares disponibles",
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

			getCaratulas:function(id){
				this.$http.get(urlImg + '/' + id).then(function(response){
					this.arraycaratulas = response.data["caratulas"];
				});
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
							'editorial':response.data.editorial,
							'carrera':response.data.carrera,
							'ejemplares':response.data.ejemplares,
							this.getCaratulas(response.data.isbn),
						}
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
								this.clave='';
								this.$refs.buscar.focus();
							}
						} else {
							console.log(unaconsulta);
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

			NewSearch:function(){
				this.consultas=[];
			},
		},

	});
}
window.onload=init;