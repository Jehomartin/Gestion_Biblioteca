var route = document.querySelector("#route").getAttribute("value");
var urlDetalles = route + '/apiDetalles';
var urlPrestamos = route + '/apiPrestamos';
var urlAlumnos = route + '/apiAlumnos';
var urlMail = route + '/maili';
var urlDeuda = route + '/apiAdeudo';
var urlMulta = route + '/apiMultas';

function init()
{
	new Vue({

		http:{
			headers:{
				'X-CSRF-TOKEN':document.querySelector("#token").getAttribute("value"),
			},
		},

		el:"#historial",

		created:function(){
			this.getDetalles();
			this.getBuscar();
			this.getPrestamos();
			this.getMultas();
		},

		data:{
			saludo:'holamundo',
			mail:[],
			detalleprestamos:[],
			prestamos:[],
			alumnos:[],
			fechadevolucion:'',
			matricula:'',
			nombre:'',
			apellidos:'',
			foliodetalle:'',
	    	folioprestamo:'',
	    	isbn:'',
	    	titulo:'',
	    	devuelto:'',
	    	cantidad:'',
			editando:false,
			auxDev:'',
			buscar:'',

			//Obtener los días atraso
			datenow:moment().format('YYYY-MM-DD'),
			datelast:'',
			//

			// obtener la multa
			arraymultas:[],
			precio:'',

			// datos para el adeudo
			arraydeudas:[],
			id_adeudos:'',
			matricula:'',
			clave_carrera:'',
			dias_atraso:'',
			precio_multa:'',
			total:'',

		},

		methods:{

			getDetalles:function()
		    {
	    		this.$http.get(urlDetalles).then(function(response){
					this.detalleprestamos=response.data;
				}).catch(function(response){
					toastr.error("no se encontraron datos");
				});
			},

			getAlumnos:function(){
				this.$http.get(urlAlumnos).then(function(response){
					this.alumnos = response.data;
				}).catch(function(response){
					toastr.error("no se encontraron datos");
				});
			},

			getBuscar:function(){
	    		this.$http.get(urlDetalles).then(function(response){
					this.detalleprestamos=response.data;
				}).catch(function(response){
					toastr.error("no se encontraron datos");
				});
			},

			getPrestamos:function()
			{
				this.$http.get(urlPrestamos).then(function(json){
					this.prestamos = json.data;

				}).catch(function(json){
					toastr.error("no se cargaron los datos");
				});
			},

			getMultas:function(){
	    		this.$http.get(urlMulta).then(function(response){
					this.arraymultas = response.data;
				}).catch(function(response){
					toastr.error("no se encontraron datos");
				});

			},

			showModal:function(){
				$("#modal_custom").find(".modal-header").css("background","#f39c12");
				$("#modal_custom").find(".modal-header").css("color", "black");
				$("#modal_custom").find(".modal-title")   
				$('#modal_custom').modal('show');
				
			},

			StartDeuda:function(id){
				$('#modal_custom').modal('show');
				//peticion al servidor
				this.$http.get(urlDetalles + '/' + id).then
				(function(response){
					// calcular los días de atraso
					let day1 = new Date(this.datenow);
					let day2 = new Date(response.data.fechadevolucion);

					let milisD = 24 * 60 * 60 * 1000;
					let miliT = Math.abs(day1.getTime() - day2.getTime());
					let diasT = Math.round(miliT / milisD);
					this.datelast = diasT;
					// 

					// calcular el precio de la multa
					for (var i = 0; i < this.arraymultas.length; i++) {
						var price ={
							precio:this.arraymultas[i].precio,
						}
						this.precio = price['precio'];
						console.log(this.precio);
					}
					// 

					// 

					// 

					this.foliodetalle = response.data.foliodetalle;
					this.folioprestamo = response.data.folioprestamo;
					this.isbn = response.data.isbn;
					this.titulo = response.data.titulo;
					this.devuelto = response.data.devuelto;
					this.cantidad = response.data.cantidad;
					this.id_prestador = response.data.id_prestador;
					this.correo = response.data.correo;
					this.dias_atraso = this.datelast;
					this.precio_multa = this.precio;
					this.total = (this.precio * this.datelast);
				});

			},

			SaveDeuda:function(){
				var unadeuda = {
					matricula:this.id_prestador, dias_atraso:this.dias_atraso,
					precio_multa:this.precio_multa, total:this.total, 
					deudor:true, id_prestador:this.id_prestador,
				};

				this.$http.post(urlDeuda,unadeuda).then(function(response){
					swal({
						title:'DEUDA INICIADA',
						text:'La deuda del prestador se ha iniciado',
						icon:'success',
						buttons:false,
						timer:3000,
					});

					$('#modal_custom').modal('hide');

				}).catch(function(response){
					swal({
						title:'ERROR',
						text:'La deuda no se inicio, ocurrio un error',
						icon:'error',
						buttons:false,
						timer:3000,
					});
				})
			},

			sendMail(id){
				id = id;
				det = this.detalleprestamos;

				var valObj = det.filter(function(elem){
					if (elem.foliodetalle == id) return elem;
				});

				if (valObj.length > 0){
					this.mail = valObj[0];
				};
				this.$http.post(urlMail, this.mail).then(function(json){
					swal({
						title:"CORREO ENVIADO",
						text: "El envío del mensaje se realizo correctamente",
						icon:"success",
						buttons:false,
						timer:3000
					});
				});
			},

			Datoscargar:function(id){
				var fecha = this.prestamos.fechadevolucion;

				this.editando=true;
				$('#modal_custom').modal('show');
				//peticion al servidor
				this.$http.get(urlDetalles + '/' + id).then
				(function(response){
					this.foliodetalle = response.data.foliodetalle;
					this.folioprestamo = response.data.folioprestamo;
					this.isbn = response.data.isbn;
					this.titulo = response.data.titulo;
					this.fechadevolucion = response.data.fecha;
					this.devuelto = response.data.devuelto;
					this.cantidad = response.data.cantidad;
					this.matricula = response.data.matricula;
					this.correo = response.data.correo;
					this.auxDev = response.data.foliodetalle;
				});
			},

			// funcion devolver con modal
			Devolver:function(id){
				var devuelto = {
					foliodetalle:this.foliodetalle, folioprestamo:this.folioprestamo, isbn:this.isbn,
					titulo:this.titulo, devuelto:1,cantidad:this.cantidad, matricula:this.matricula,
					correo:this.correo,
				};

				this.$http.put(urlDetalles + '/' + this.foliodetalle,devuelto).then(function(response){
					this.getDetalles();
					this.foliodetalle='';
					this.folioprestamo='';
					this.isbn='';
					this.titulo='';
					this.devuelto='';
					this.cantidad='';
					this.matricula='';
					this.correo='';

					$('#modal_custom').modal('hide');



					swal({
						title:"DEVOLUCIÓN REALIZADA",
						text: "La devolución se realizo correctamente",
						icon:"success",
						buttons:false,
						timer:3000
					});
				});
			},
			// fin devolver com modal

			cancelarEdit:function(){
				this.editando=false;
				this.foliodetalle='';
				this.folioprestamo='';
				this.isbn='';
				this.titulo='';
				this.fechadevolucion='';
				this.devuelto='';
				this.cantidad='';
				this.matricula='';
				this.correo='';
			},

		},
		
		computed:{
			filtroDetalles:function(){
				return this.detalleprestamos.filter((detalles)=>{
					return detalles.folioprestamo.match(this.buscar.trim()) ||
					detalles.titulo.toLowerCase().match(this.buscar.trim().toLowerCase());
				});
			},

			// days:function(){
			// 	let day1 = new Date(this.datenow);
			// 	let day2 = new Date('04/30/2022');

			// 	let milisD = 24 * 60 * 60 * 1000;

			// 	let miliT = Math.abs(day1.getTime() - day2.getTime());

			// 	let diasT = Math.round(miliT / milisD);
				
			// 	return diasT;
			// },

			total:function(){

			},
		},
	});
}
window.onload=init;