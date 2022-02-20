var route = document.querySelector("#route").getAttribute("value");
var urlPresta = route + '/apiPrestamos';
var urlLibro = route + '/apiBusqueda';
var urlAlumnos = route + '/apiAlumnos';
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
			nopres:'',
			arrayprestamos:[],
			arraylibros:[],
			arrayalumnos:[],
			ejemplares:'',

			codigo:'',
			folioprestamo:'',
			fechadevolucion:'',
			matricula:'',
			correo:'',

			fechaprestamo:moment().format('YYYY-MM-DD'),

			permisos:0,
		},

		methods:{
			//inicio del getLibro
			getLibros:function(){
				this.$http.get(urlLibro + '/' + this.codigo)
				.then(function(response){
					if (response.data==="") {
						swal({
							title:"ADVERTENCIA",
							text: "El libro no se encuentra disponible o coloco el título de manera incorrecta",
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
						this.permisos = this.permisos + 1;
						if (this.permisos > 3) {
							swal({
								title: "PERMISOS ALCANZADOS",
								text: "El alumno ha alcanzado el limite de 3 permisos para prestar un libro",
								icon: "warning",
								buttons: false,
								timer: 4000,
							});
							this.permisos = this.permisos - 1;
							response.data="";
							this.codigo='';
						}else{
							var unprestado={
							'isbn':response.data.isbn,
							'titulo':response.data.titulo,
							'devuelto':0,
							'cantidad':1,
							}

							if (unprestado.titulo) {
								this.arrayprestamos.push(unprestado);
								this.codigo='';
								this.$refs.buscar.focus();
							}
						}
						
					}
					
				});
			},
			//fin getLibro

			getAlumnos:function(){
				this.$http.get(urlAlumnos).then(function(response){
					this.arrayalumnos = response.data;
				}).catch(function(response){
					toastr.error("no se encontraron datos");
				});
			},

			cancelarPrestamo:function(id){
				this.arrayprestamos.splice(id,1);
				this.permisos = this.permisos - 1;
			},

			foliarprestamo:function(){
				this.folioprestamo='PRS-' + moment().format('YYMMDDhmmss');
			},

			prestar:function(){
				
				var detalles2=[];
				var newdetalle3=[];

				for (var i = 0; i < this.arrayprestamos.length; i++) {
					detalles2.push({
						isbn:this.arrayprestamos[i].isbn,
						titulo:this.arrayprestamos[i].titulo,
						devuelto:0,
						cantidad:1,
						// matricula:this.arrayprestamos[i].matricula,
						// correo:this.arrayprestamos[i].correo,
					})

					var set = new Set(detalles2.map(JSON.stringify))
					var newdetalle3 = Array.from(set).map(JSON.parse);
				}

				var unPrestamo={
					folioprestamo:this.folioprestamo,
					fechaprestamo:this.fechaprestamo,
					fechadevolucion:this.fechadevolucion,
					matricula:this.matricula,
					correo:this.correo,
					liberado:0,
					permisos:this.permisos,
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
								this.correo='';
								this.arrayprestamos=[];
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
				}else if (this.fechadevolucion=="" && this.matricula=="" && this.correo=="") {
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
				}else if(this.correo == ""){
					swal({
						title:"ERROR DE PRESTAMO",
						text:"Verifique que el correo este colocado",
						icon:"error",
						buttons:false,
						timer:4000,
					});
				} else if (this.fechadevolucion=="") {
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
						this.arrayprestamos=[];
						this.fechadevolucion='';
						this.matricula='';
						this.correo='';
					}).catch(function(response){
						console.log(unPrestamo);
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