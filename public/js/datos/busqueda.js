var root = document.querySelector("#route").getAttribute("value");
var urlLibro = root + '/apiBusqueda';

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

			// Inicio Consulta
			getConsulta:function(){
				this.$http.get(urlLibro + '/' + this.clave).then(function(response){
					var unaconsulta={
						'isbn':response.data.isbn,
						'titulo':response.data.titulo,
						'autor':response.data.autor,
						'editorial':response.data.editorial,
						'carrera':response.data.carrera,
						'ejemplares':response.data.ejemplares,
					}
					if (response.data.ejemplares > 1) {
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