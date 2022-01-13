var rute=document.querySelector("[name=route]").value;
var urlValidar = rute + 'apiAccess';
var urlUser = rute + 'apiUsuarios';

new Vue({

	http: {
		headers: {
			'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
		}
	},

	created:function(){
		this.getUsuarios();
		this.getValidar();
	},

	el:'#validar',

	data:{
		saludo:'hola',
		usuarios:[],
		login:'',
		pass:'',
	},

	methods:{
		getUsuarios:function(){
			this.$http.get(urlUser).then(function(response){
				this.usuarios = response.data;
			}).catch(function(response){
				console.log(response);
			});
		},

		getValidar:function(){
			this.$http.get(urlValidar).then(function(response){
				this.usuarios = response.data;
			}).catch(function(response){
				console.log(response);
			});
		},

		validando:function(){

			var entrar={login:this.login,pass:this.pass};

			if (this.login == "") {
				toastr.error("El usuario esta vacío");
			}
			if (this.pass == "") {
				toastr.error("La contraseña esta vacía");
			}
			else if (this.login == "" && this.pass == "") {
				toastr.error("Los campos no pueden quedar vacíos");
			}
			else{
				
				this.$http.post(urlValidar,entrar).then
	                (function(response) {
	                	this.getPrestamo();
	                });
			}
		},
	},
});