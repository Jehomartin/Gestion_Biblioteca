var root = document.querySelector("[name=route]").value;
var urlLibro2 = root + 'apiLibu';
var ulrConsulta = root + 'apiConsulta';

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
			clave:'',

		},

		methods:{
			help:function(){
				swal({
					title:"AVISO",
					text:"En este apartado el alumno podrá escribir el título o la clave del libro que desee,\n" + 
					"para así poder verificar si este cuenta con ejemplares disponibles",
					icon:"info",
					buttons: {
	                    confirm: {
	                        text: 'Aceptar',
	                        className: 'btn btn-success'
	                    },
	                    cancel: {
	                        visible: true,
	                        className: 'btn btn-danger'
	                    },
                	},
				});
			}
		}
	})
}
window.onload=init;