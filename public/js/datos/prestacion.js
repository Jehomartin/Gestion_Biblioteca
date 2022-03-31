var route = document.querySelector("#route").getAttribute("value");
var urlPresta = route + '/apiPrestamos';
var urlLibro = route + '/apiBusqueda';
var urlAlumnos = route + '/apiAlumnos';
var urlDocentes = route + '/apiDocente';
var urlRegreso = route + '/fechi';
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
			this.getLib();
		},

		data:{
			saludo:'hola mundo',
			// nopres:'',
			arrayprestamos:[],
			arraylibros:[],
			arrayalumnos:[],
			arraydocentes:[],
			ejemplares:'',
			id_prestador:'',

			codigo:'',
			folioprestamo:'',
			fechadevolucion:'',
			matricula:'',
			correo:'',
			email:'',
			claves:'',

			fechaprestamo:moment().format('YYYY-MM-DD'),

			permisos:0,
			prestamista:'',
			prst:'',

			estudiante:false,
			docente:false,
		},

		// inicio methods
		methods:{

			// fechandoregreso:function(){
			// 	this.$http.get(urlRegreso).then(function(response){
			// 		var arrfech = response.data;
			// 		console.log(arrfech);
			// 		this.fechadevolucion = response.data;
			// 	});
				
			// },

			getLib:function(){
				this.$http.get(urlLibro).then(function(response){
					this.arraylibros = response.data;
				}).catch(function(response){
					toastr.error("no se encontraron datos");
				});
			},

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

			// getAlumno
			getAlumnos:function(){
				this.$http.get(urlAlumnos + '/' + this.matricula).then(function(json){
					if (json.data === "") {
						swal({
							title:"AVISO",
							text:"La matricula ingresada no esta registrada o esta mal escrita",
							icon:"warning",
							buttons:false,
							timer:3000,
						});
					} else {
						var alumno={
							'matricula':json.data.matricula,
							'nombre':json.data.nombre,
							'apellidos':json.data.apellidos,
							'correo':json.data.correo,
						};

						if (alumno.matricula) {
							this.arrayalumnos.push(alumno);
							this.$refs.buscar.focus();
							this.matricula = json.data.matricula;
							this.correo=json.data.correo;
						}
					}
					
				}).catch(function(json){
					toastr.error("no se encontraron datos");
				});
			},
			// fin getAlumno

			getDocentes:function(){
				this.$http.get(urlDocentes + '/' + this.claves).then(function(teach) {
					if (teach.data === "") {
						swal({
							title:"AVISO",
							text:"La clave ingresada no esta registrada o esta mal escrita",
							icon:"warning",
							buttons:false,
							timer:3000,
						});
					}else{
						var maestro={
							'claves':teach.data.claves,
							'nombres':teach.data.nombres,
							'apellidos':teach.data.apellidos,
							'email':teach.data.email,
						};
						if (maestro.claves) {
							this.arraydocentes.push(maestro);
							this.$refs.buscar.focus();
							this.claves = teach.data.claves;
							this.email = teach.data.email;
						}
					};
				});
			},

			student:function(){
				this.$http.get(urlRegreso).then(function(response){
					var arrfech = response.data;
					console.log(arrfech);
					this.fechadevolucion = response.data;
				});
				this.estudiante=true;
				this.docente=false;
				this.arraydocentes=[];
				this.claves='';
			},

			teacher:function(){
				this.$http.get(urlRegreso).then(function(response){
					var arrfech = response.data;
					console.log(arrfech);
					this.fechadevolucion = response.data;
				});
				this.docente=true;
				this.estudiante=false;
				this.arrayalumnos=[];
				this.matricula='';
			},

			cancelarPrestamo:function(id){
				this.arrayprestamos.splice(id,1);
				this.permisos = this.permisos - 1;
			},

			foliarprestamo:function(){
				this.folioprestamo='PRS-' + moment().format('YYMMDDhmmss');
			},

			// inicio prestar
			prestar:function(){
				// this.estudiante=true;
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

				if (this.estudiante == true) {
					var unPrestamo={
						folioprestamo:this.folioprestamo,
						fechaprestamo:this.fechaprestamo,
						fechadevolucion:this.fechadevolucion,
						matricula:this.matricula,
						correo:this.correo,
						prestamista:'alumno',
						prst:1,
						permisos:this.permisos,
						newdetalle3:newdetalle3
					};

					if(newdetalle3==""){
						swal({
							title: "DATOS VACÍOS",
							text: "No hay datos para realizar el prestamo",
							icon: "error",
							buttons: "ok",
							timer: 4000,
					 	});
					} else if(detalles2.length!=newdetalle3.length){
						swal({
							title: "DATOS REPETIDOS",
							text: "Solo se tomara en cuenta un libro ¿continuar?",
							icon: "warning",
							buttons: true,
							dangerMode: true,
					  	}).then((willDelete) => {
							if (willDelete) {
								this.$http.post(urlPresta,unPrestamo).then(function(json){
									swal("PRESTAMO REALIZADO EXITOSAMENTE, CON FOLIO:" + unPrestamo.folioprestamo, {
										icon: "success",
									});
									this.foliarprestamo();
									// this.fechadevolucion='';
									this.matricula='';
									this.arrayprestamos=[];
									this.arrayalumnos=[];
								}).catch(function(json){
									swal({
										title: "PRESTAMO FALLIDO",
										text: "No se pudo realizar el prestamo",
										icon: "error",
										buttons: false,
										timer: 3000,
									});
								});
							} else{
								swal("POR FAVOR, REVISE LOS LIBROS REPETIDOS");
							}
				  		});
					}else if (this.matricula == "") {
						swal({
							title:"ERROR DE PRESTAMO",
							text:"Verifique que la matricula este colocada",
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
							this.arrayalumnos=[];
							// this.fechadevolucion='';
							this.matricula='';
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
					};
				} else if (this.docente == true) {
					var unPrestamo={
						folioprestamo:this.folioprestamo,
						fechaprestamo:this.fechaprestamo,
						fechadevolucion:this.fechadevolucion,
						claves:this.claves,
						email:this.email,
						prestamista:'docente',
						prst:2,
						newdetalle3:newdetalle3
					};

					if(newdetalle3==""){
						swal({
							title: "DATOS VACÍOS",
							text: "No hay datos para realizar el prestamo",
							icon: "error",
							buttons: "ok",
							timer: 4000,
						 });
					} else if(detalles2.length!=newdetalle3.length){
						swal({
							title: "DATOS REPETIDOS",
							text: "Solo se tomara en cuenta un libro ¿continuar?",
							icon: "warning",
							buttons: true,
							dangerMode: true,
					  	}).then((willDelete) => {
							if (willDelete) {
								this.$http.post(urlPresta,unPrestamo).then(function(json){
									swal("PRESTAMO REALIZADO EXITOSAMENTE, CON FOLIO:" + unPrestamo.folioprestamo, {
										icon: "success",
									});
									this.foliarprestamo();
									// this.fechadevolucion='';
									this.claves='';
									this.arrayprestamos=[];
									this.arraydocentes=[];
								}).catch(function(json){
									swal({
										title: "PRESTAMO FALLIDO",
										text: "No se pudo realizar el prestamo",
										icon: "error",
										buttons: false,
										timer: 3000,
									});
								});
							} else{
								swal("POR FAVOR, REVISE LOS LIBROS REPETIDOS");
							}
				  		});
					} else if (this.claves == "") {
						swal({
							title:"ERROR DE PRESTAMO",
							text:"Verifique que la clave del docente este colocada",
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
							this.arraydocentes=[];
							// this.fechadevolucion='';
							this.claves='';
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
					};
				}

				
			},
			// fin prestar estudiante

			// prestar docente
			// prestarD:function(){
			// 	this.docente=true;

			// 	var detalles2=[];
			// 	var newdetalle3=[];

			// 	for (var i = 0; i < this.arrayprestamos.length; i++) {
			// 		detalles2.push({
			// 			isbn:this.arrayprestamos[i].isbn,
			// 			titulo:this.arrayprestamos[i].titulo,
			// 			devuelto:0,
			// 			cantidad:1,
			// 			// matricula:this.arrayprestamos[i].matricula,
			// 			// correo:this.arrayprestamos[i].correo,
			// 		})

			// 		var set = new Set(detalles2.map(JSON.stringify))
			// 		var newdetalle3 = Array.from(set).map(JSON.parse);
			// 	}

			// 	var unPresto={
			// 		folioprestamo:this.folioprestamo,
			// 		fechaprestamo:this.fechaprestamo,
			// 		fechadevolucion:this.fechadevolucion,
			// 		claves:this.claves
			// 		email:this.email,
			// 		liberado:0,
			// 		prestamista:'docente',
			// 		// permisos:this.permisos,
			// 		newdetalle3:newdetalle3
			// 	};

			// 	
			// }
			// fin prestar docente
		},
		// fin methods
	});
}
window.onload=init;