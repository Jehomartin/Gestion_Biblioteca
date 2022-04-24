var ruth = document.querySelector("#route").getAttribute("value");
var ulrMulta = ruth + '/apiMultas';
var urlUser = ruth + '/apiUsuarios';

function init(){
	new Vue({

		http:{
			headers:{
				'X-CSRF-TOKEN':document.querySelector("#token").getAttribute("value"),
			},
		},

		el:"#config",

		created:function(){
			this.getMultas();
			this.getUsuarios();
		},

		// inicio data
		data:{
			// datas multa
			saludo:'jajajajajajaja',
			arraymultas:[],
			id_multas:'',
			precio:'',
			vigente:'',
			editando:false,
			editmulta:false,
			auxmulta:'',
			// fin multa

			confmul:false,
			confus:false,

			// datos para usuario
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
			auxuser:'',
			bloqueado:'',
			auxpass:false,
			editus:false,
			desacUs:false,
		},
		// fin
		
		// inicio methods
		methods:{
			// inicio getMultas
			getMultas:function(){
				this.$http.get(ulrMulta).then(function(response){
					this.arraymultas = response.data;
				}).catch(function(response) {
					toastr.error("No se estan llamando los datos");
				});
			},
			// fin

			getUsuarios:function(){
				this.$http.get(urlUser).then(function(response){
					this.arrayusuarios = response.data;
				}).catch(function(response){
					console.log(response);
				});
			},

			// inicio modal
			Modalmulta:function() {
				$("#modal_multa").find(".modal-header").css("background","#f39c12");
				$("#modal_multa").find(".modal-header").css("color", "black");
				$("#modal_multa").find(".modal-title")   
				$('#modal_multa').modal('show');
			},
			// fin

			ModalUS:function(){
				$("#modal_us").find(".modal-header").css("background","#f39c12");
				$("#modal_us").find(".modal-header").css("color", "black");
				$("#modal_us").find(".modal-title")   
				$('#modal_us').modal('show');
			},

			cofigmulta:function(){
				this.confmul=true;
				this.confus=false;
			},

			configuser:function(){
				this.confmul=false;
				this.confus=true;
			},

			close:function(){
				this.confus=false;
				this.confmul=false;
			},

			// inicio editMulta
			editMulta:function(id) {
				this.editmulta = true;
				$('#modal_multa').modal('show');

				this.$http.get(ulrMulta + '/' + id).then(function(response){
					this.id_multas = response.data.id_multas;
					this.precio = response.data.precio;
					this.vigente = response.data.vigente;
					this.auxmulta = response.data.id_multas;
				}).catch(function(response) {
					toastr.error("Ocurrio un error al cargar la información");
				});
			},
			// fin editMulta

			// inicio desactivar
			DesactivarMul:function(id){
				var desactivar ={
					id_multas:this.id_multas,
					precio:this.precio,
					vigente:false,
				};

				this.$http.put(ulrMulta + '/' + this.id_multas,desactivar).then(function(response){
					this.getMultas();
					this.id_multas='';
					this.precio='';
					this.vigente='';
					this.editmulta = false;

					$('#modal_multa').modal('hide');

					swal({
						title: "DESACTIVACIÓN EXITOSA",
						text: "Se realizo la baja de la multa seleccionada",
						icon: "success",
						buttons:false,
						timer: 3000,
					});
				}).catch(function(response){
					swal({
						title: "DESACTIVACIÓN FALLIDA",
						text: "No se pudo dar de baja la multa",
						icon: "error",
						buttons: false,
						timer: 3000,
					});
				});
			},
			// fin desactivar

			// NewMulta
			NewMulta:function(){
				var multa ={
					id_multas:this.id_multas,
					precio:this.precio,
					vigente:true,
				};

				this.$http.post(ulrMulta,multa).then(function(response){
					this.getMultas();
					$('#modal_multa').modal('hide');
					this.id_multas='';
					this.precio='';
					this.vigente='';

					swal({
						title: "REGISTRO EXITOSO",
						text: "La multa fue dada de alta con exito",
						icon: "success",
						buttons:false,
						timer: 3000,
					});
				}).catch(function(response){
					swal({
						title: "REGISTRO FALLIDO",
						text: "Ocurrio un error al dar de alta la multa",
						icon: "error",
						buttons:false,
						timer: 3000,
					});
				});
			},
			// fin

			SaveUS:function(){
				var usernew = {
					login:this.login, pass:this.pass, nombre:this.nombre, apellidos:this.apellidos,
					sexo:this.sexo,edad:this.edad,telefono:this.telefono,nivel:'Administrador', bloqueado:false,
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

			EditUser:function(id) {
				this.editus=true;
				$('#modal_us').modal('show');
				this.$http.get(urlUser + '/' + id).then(function(response){
					this.login = response.data.login;
					this.pass = response.data.pass;
					this.nombre = response.data.nombre;
					this.apellidos = response.data.apellidos;
					this.sexo = response.data.sexo;
					this.edad = response.data.edad;
					this.telefono = response.data.telefono;
					this.auxuser = response.data.login;
				});
			},

			DeadUser:function(id){
				this.desacUs=true
				$('#modal_us').modal('show');
				this.$http.get(urlUser + '/' + id).then(function(response){
					this.login = response.data.login;
					this.pass = response.data.pass;
					this.nombre = response.data.nombre;
					this.apellidos = response.data.apellidos;
					this.sexo = response.data.sexo;
					this.edad = response.data.edad;
					this.telefono = response.data.telefono;
					this.auxuser = response.data.login;
				});
			},

			UpdateUs:function(id){
				var upuser = {
					login:this.login, pass:this.pass, nombre:this.nombre, apellidos:this.apellidos,
					sexo:this.sexo, edad:this.edad, telefono:this.telefono, nivel:'Administrador', bloqueado:false
				};
				this.$http.put(urlUser + '/' + this.login, upuser).then(function(response){
					this.getUsuarios();
					this.login='';
					this.pass ='';
					this.nombre ='';
					this.apellidos ='';
					this.sexo ='';
					this.edad ='';
					this.telefono ='';
					$('#modal_us').modal('hide');

					swal({
						title: "ACTUALIZACIÓN EXITOSA",
						text: "Se realizo la actualización del usario seleccionado",
						icon: "success",
						buttons:false,
						timer: 3000,
					});
				}).catch(function(response){
					swal({
						title: "ACTUALIZACIÓN FALLIDO",
						text: "No se realizo la actualización del usario seleccionado",
						icon: "success",
						buttons:false,
						timer: 3000,
					});
				});
			},

			DesacUser:function(id){
				var upuser = {
					login:this.login, pass:this.pass, nombre:this.nombre, apellidos:this.apellidos,
					sexo:this.sexo, edad:this.edad, telefono:this.telefono, nivel:'Administrador', bloqueado:true
				};
				this.$http.put(urlUser + '/' + this.login, upuser).then(function(response){
					this.getUsuarios();
					this.login='';
					this.pass ='';
					this.nombre ='';
					this.apellidos ='';
					this.sexo ='';
					this.edad ='';
					this.telefono ='';
					$('#modal_us').modal('hide');

					swal({
						title: "DESACTIVACIÓN EXITOSA",
						text: "Se realizo la desactivación del usario seleccionado",
						icon: "success",
						buttons:false,
						timer: 3000,
					});
				}).catch(function(response){
					swal({
						title: "DESACTIVACIÓN FALLIDO",
						text: "No se desactivo el usario seleccionado",
						icon: "success",
						buttons:false,
						timer: 3000,
					});
				});
			},

			cancelUs:function(){
				this.editus=false;
				this.desacUs=false;
				this.login='';
				this.pass ='';
				this.pass2 ='';
				this.nombre ='';
				this.apellidos ='';
				this.sexo ='';
				this.edad ='';
				this.telefono ='';
			},

			// cancelar
			cancelar:function() {
				this.editmulta=false;
				this.id_multas='';
				this.precio='';
				this.vigente='';
			},
		},
		// fin methods
	})
}
window.onload=init;