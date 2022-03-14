var ruth = document.querySelector("#route").getAttribute("value");
var ulrMulta = ruth + '/apiMultas';

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
		},

		// inicio data
		data:{
			saludo:'jajajajajajaja',
			arraymultas:[],
			id_multas:'',
			precio:'',
			vigente:'',

			editando:false,
			editmulta:false,

			auxmulta:'',

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

			// inicio modal
			Modalmulta:function() {
				$("#modal_multa").find(".modal-header").css("background","#f39c12");
				$("#modal_multa").find(".modal-header").css("color", "black");
				$("#modal_multa").find(".modal-title")   
				$('#modal_multa').modal('show');
			},
			// fin

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