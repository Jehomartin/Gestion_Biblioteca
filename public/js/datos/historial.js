var route = document.querySelector("#route").getAttribute("value");
var urlDetalles = route + '/apiDetalles';
var urlPrestamos = route + '/apiPrestamos';
var urlAlumnos = route + '/apiAlumnos';
var urlMail = route + '/maili';
var urlPrint = route + '/ticket';

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
		},

		data:{
			saludo:'holamundo',
			mail:[],
			arrayprint:[],
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

			auxFecha:moment().format('YYYY-MM-DD'),

			// cantidades:[1,1,1,1,1,1,1,1,1,1],
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

			showModal:function(){
				$("#modal_custom").find(".modal-header").css("background","#f39c12");
				$("#modal_custom").find(".modal-header").css("color", "black");
				$("#modal_custom").find(".modal-title")   
				$('#modal_custom').modal('show');
				
			},

			infoPrestamo:function(id){
				
				$('#modal_custom').modal('show');
				//peticion al servidor
				this.$http.get(urlDetalles + '/' + id).then
				(function(response){
					this.foliodetalle = response.data.foliodetalle;
					this.folioprestamo = response.data.folioprestamo;
					this.isbn = response.data.isbn;
					this.titulo = response.data.titulo;
					this.devuelto = response.data.devuelto;
					this.cantidad = response.data.cantidad;
					this.id_prestador = response.data.id_prestador;
					this.correo = response.data.correo;
				});

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
					// console.log(json);
					swal({
						title:"CORREO ENVIADO",
						text: "El env??o del mensaje se realizo correctamente",
						icon:"success",
						buttons:false,
						timer:3000
					});
				});
			},

			imprimir(id){
				swal({
	                title: 'AVISO',
	                text: "??Est?? seguro de imprimir este registro?",
	                type: 'warning',
	                buttons: {
	                    confirm: {
	                        text: 'Imprimir!',
	                        className: 'btn btn-success'
	                    },
	                    cancel: {
	                        visible: true,
	                        className: 'btn btn-danger'
	                    },
	                },
	            }).then((result) => {
	                if (result) {
	                	id = id;
						print = this.detalleprestamos;

						var impobj = print.filter(function(obj){
							if (obj.foliodetalle == id) return obj;
						});

						if (impobj.length > 0) {
							this.arrayprint = impobj[0];
						}
	                    this.$http.post(urlPrint, this.arrayprint).then(function(print){
                            swal({
                                title: '??Imprimido!',
                                text: 'Usted a obtenido su ticket de pr??stamo',
                                icon: 'success',
                                buttons: false,
                                timer: 1500
                            });
	                    });
	                } else {
	                    swal.close();
	                }
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
					// this.getDetalles().splice(id,1);
					this.getDetalles();
					this.foliodetalle='';
					this.folioprestamo='';
					this.isbn='';
					this.titulo='';
					// this.fechadevolucion='';
					this.devuelto='';
					this.cantidad='';
					this.matricula='';
					this.correo='';

					$('#modal_custom').modal('hide');



					swal({
						title:"DEVOLUCI??N REALIZADA",
						text: "La devoluci??n se realizo correctamente",
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
		},
	});
}
window.onload=init;