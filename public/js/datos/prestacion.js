var route = document.querySelector("#route").getAttribute("value");
var urlPresta = route + '/apiPrestamos';
var urlLibro = route + '/apiLibros';
// var urlEjemplar = ruta + '/apiEjemplares';

function init()
{

	new Vue({

		http:{
			headers:{
				'X-CSRF-TOKEN':document.querySelector("#token").getAttribute("value"),
			},
		},

		el:'#prestacion',

		created:function(){
			this.foliarprestamo();
		},

		data:{
			saludo:'hola mundo',
			prestamos:[],
			libros:[],
			ejemplares:'',
			// ejemplares:[],
			// isbn:'',
			// titulo:'',
			// consec:'',
			codigo:'',
			folioprestamo:'',
			fechadevolucion:'',
			matricula:'',
			// cantidad:'',

			fechaprestamo:moment().format('YYYY-MM-DD'),
		},

		methods:{
			//inicio del getLibro
			getLibros:function(){
				this.$http.get(urlLibro + '/' + this.codigo)
				.then(function(response){
					if (response.data==="") {
						swal({
							title:"ADVERTENCIA",
							text: "El libro no se encuentra disponible ",
							icon: "warning",
							buttons: true,
							timer: 3000,
						})
						this.codigo='';
					} else if (response.data.ejemplares == 1) {
						swal({
							title:"ADVERTENCIA",
							text:"El libro ya no tiene ejemplares disponibles",
							icon:"warning",
							buttons:true,
							timer:3000,
						})
						this.codigo='';
					} else {

						var unprestado={
							'isbn':response.data.isbn,
							'titulo':response.data.titulo,
							'devuelto':0,
							'cantidad':1,
						}

						if (unprestado.isbn) {
							this.prestamos.push(unprestado);
							this.codigo='';
							this.$refs.buscar.focus();
						}
					}
					
				});
			},
			//fin getLibro

			cancelarPrestamo:function(id){
				this.prestamos.splice(id,1);
			},

			foliarprestamo:function(){
				this.folioprestamo='PRS-' + moment().format('YYMMDDhmmss');
			},

			prestar:function(){
				
				var detalles2=[];
				var newdetalle3=[];

				for (var i = 0; i < this.prestamos.length; i++) {
					detalles2.push({
						isbn:this.prestamos[i].isbn,
						titulo:this.prestamos[i].titulo,
						devuelto:0,
						cantidad:1,
					})

					var set = new Set(detalles2.map(JSON.stringify))
					var newdetalle3 = Array.from(set).map(JSON.parse);
				}

				var unPrestamo={
					folioprestamo:this.folioprestamo,
					fechaprestamo:this.fechaprestamo,
					fechadevolucion:this.fechadevolucion,
					matricula:this.matricula,
					liberado:0,
					newdetalle3:newdetalle3
				}

				if(newdetalle3=="")
				{
					swal({
						title: "DATOS VACÍOS",
						text: "No hay datos para realizar el prestamo",
						icon: "error",
						buttons: "ok",
						timer: 4000,
					  });
				}

				else if(detalles2.length!=newdetalle3.length){
					swal({
						title: "DATOS REPETIDOS",
						text: "Solo se tomara en cuenta un libro ¿continuar?",
						icon: "warning",
						buttons: true,
						dangerMode: true,
					  }).then((willDelete) => {
						if (willDelete) {
							this.$http.post(urlPresta,unPrestamo)
							.then(function(json){
							swal("PRESTAMO REALIZADO EXITOSAMENTE, CON FOLIO:" + unPrestamo.folioprestamo, {
								icon: "success",
							});
								this.foliarprestamo();
								this.fechadevolucion='';
								this.matricula='';
								this.prestamos=[];
							}).catch(function(json){
								swal({
									title: "PRESTAMO FALLIDO",
									text: "No se pudo realizar el prestamo",
									icon: "error",
									buttons: false,
									timer: 3000,
								});
							});
						}
						else{
							swal("POR FAVOR, REVISE LOS LIBROS REPETIDOS");
						}
					  });
				}else if (this.fechadevolucion=="" && this.matricula=="") {
					swal({
						title:"ERROR DE PRESTAMO",
						text:"Verifique que los campos solicitados esten llenos",
						icon:"error",
						buttons:"OK",
						timer:4000,
					});

				}else if (this.matricula == "") {
					swal({
						title:"ERROR DE PRESTAMO",
						text:"Verifique que la matricula este colocada",
						icon:"error",
						buttons:false,
						timer:4000,
					});
				}else if (this.fechadevolucion=="") {
					swal({
						title:"ERROR DE PRESTAMO",
						text:"Verifique que la fecha de devolución este colocada",
						icon:"error",
						buttons:false,
						timer:4000,
					});
				} else if (this.fechaprestamo >= this.fechadevolucion) {
					swal({
						title:"ERROR DE PRESTAMO",
						text:"Verifique las fechas, la de devolución no puede ser menor a la de prestamo",
						icon:"error",
						buttons:{
							comfirm: {
								text: 'OK',
								className: 'btn btn-success'
							},
						},
						timer:5000,
					});
				} else{
					this.$http.post(urlPresta,unPrestamo).then(function(response){
						swal({
							title: "PRESTAMO EXITOSO",
							text: "Prestamo realizado correctamente con folio: \n " + unPrestamo.folioprestamo,
							icon: "success",
							buttons: false,
							timer: 3000,
						});
						this.foliarprestamo();
						this.prestamos=[];
						this.fechadevolucion='';
						this.matricula='';
					}).catch(function(response){
						swal({
							title: "PRESTAMO FALLIDO",
							text: "No se pudo realizar el prestamo",
							icon: "error",
							buttons: false,
							timer: 3000,
						});
					});
				}
			},
		},
	});
}
window.onload=init;