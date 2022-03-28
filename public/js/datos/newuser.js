var route = document.querySelector("#route").getAttribute("value");
var urlValidar = route + '/apiAcceso';
var urlUser = route + '/apiUsuarios';

new Vue({

	http: {
		headers: {
			'X-CSRF-TOKEN': document.querySelector("#token").getAttribute("value"),
		},
	},

	created:function(){
		this.getUsuarios();
		// this.getValidar();
	},

	el:'#newuser',

	data:{
		saludo:'hola',
		arrayusuarios:[],
		login:'',
		pass:'',
		nombre:'',
		apellidos:'',
		sexo:'',
		edad:'',
		telefono:'',
		nivel:'',
		pass2:'',


		auxpass:false,
		// auxpass2:false,
	},

	methods:{
		getUsuarios:function(){
			this.$http.get(urlUser).then(function(response){
				this.arrayusuarios = response.data;
			}).catch(function(response){
				console.log(response);
			});
		},

		SaveUS:function(){
			var usernew = {
				login:this.login, pass:this.pass, nombre:this.nombre, apellidos:this.apellidos,
				sexo:this.sexo,edad:this.edad,telefono:this.telefono,nivel:'Administrador',
			};

			if (this.login == "" && this.pass == "") {
				swal("Los campos solicitados deben llenarse",{
					icon:"error",
				});
			}else if (this.login == "") {
				swal("El campo de nombre de usuario debe llenarse",{
					icon:"error",
				});
			} else if (this.pass == "") {
				swal("El campo de contraseña debe llenarse",{
					icon:"error",
				});
			} else if (this.pass2 == "") {
				swal("La contraseña debe confirmarse",{
					icon:"error",
				});
			} else if (this.nombre == "" && this.apellidos == "") {
				swal("Los campos de nombre y apellidos deben llenarse",{
					icon:"error",
				});
			} else if (this.nombre == "") {
				swal("El campo de nombre debe llenarse",{
					icon:"error",
				});
			} else if (this.apellidos == "") {
				swal("El campo de los apellidos debe llenarse",{
					icon:"error",
				});
			} else if (this.sexo == "" && this.edad == "" && this.telefono == "") {
				swal("Los campos de sexo, edad y telefono deben llenarse",{
					icon:"error",
				});
			} else if (this.sexo == "") {
				swal("El campo de sexo debe llenarse",{
					icon:"error",
				});
			} else if (this.edad == "") {
				swal("El campo de edad debe llenarse",{
					icon:"error",
				});
			} else if (this.telefono == "") {
				swal("El campo de telefono debe llenarse",{
					icon:"error",
				});
			} else if (this.pass != this.pass2) {
				swal("Las dos contraseñas colocadas deben ser iguales",{
					icon:"error",
				});
				this.auxpass=true;
			} else if (this.pass == this.pass2) {
				this.auxpass = false;
				this.$http.post(urlUser,usernew).then(function(response){
					this.getUsuarios();
					this.login='';
					this.pass='';
					this.pass2='';
					this.nombre='';
					this.apellidos='';
					this.sexo='';
					this.edad='';
					this.telefono='';

					swal({
						title: "REGISTRO EXITOSO",
						text: "El usuario fue registrado exitosamente",
						icon: "success",
						buttons:false,
						timer: 3000,
					});
				}).catch(function(response){
					swal({
						title: "REGISTRO FALLIDO",
						text: "Ocurrio un error, por favor verifique sus datos",
						icon: "error",
						buttons:false,
						timer: 3000,
					});
				});
			}
		},
	},
});