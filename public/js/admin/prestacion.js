var route = document.querySelector("[name=route]").value;
var ruta = 'http://localhost/Gestion_Biblioteca/public/';
var urlPresta = ruta + 'apiPrestamos';
var urlLibro = ruta + 'apiLibros';
// var urlEjemplar = ruta + '/apiEjemplares';

function init()
{

	new Vue({

		http:{
			headers:{
				'X-CSRF-TOKEN':document.querySelector('#token').getAttribute('value')
			}
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
							text: "El libro no se encuentra disponible ",
							icon: "warning",
							buttons: true,
							timer: 3000,
						})
						this.codigo='';
					} else if (response.data.ejemplares == 1) {
						swal({
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
						title: "Datos Vacíos",
						text: "No hay datos para realizar el prestamo",
						icon: "error",
						buttons: "ok",
						timer: 4000,
					  });
				}

				else if(detalles2.length!=newdetalle3.length){
					swal({
						title: "Datos repetidos",
						text: "Solo se tomara en cuenta un libro ¿continuar?",
						icon: "warning",
						buttons: true,
						dangerMode: true,
					  }).then((willDelete) => {
						if (willDelete) {
							this.$http.post(urlPresta,unPrestamo)
							.then(function(json){
							swal("Prestamo realizado con éxito, con folio:" + unPrestamo.folioprestamo, {
								icon: "success",
							});
								this.foliarprestamo();
								this.fechadevolucion='';
								this.matricula='';
								this.prestamos=[];
							// document.getElementById("libro").disabled=true;
							}).catch(function(json){
								swal({
									title: "Prestamo fallido",
									text: "No se pudo realizar el prestamo",
									icon: "error",
									buttons: false,
									timer: 3000,
								});
							});
						}
						else{
							swal("revise los libros repetidos porfavor");
						}
					  });
				}else if (this.fechaprestamo >= this.fechadevolucion) {
					swal({
						title:"ERROR DE PRESTAMO",
						text:"Verifique las fechas, la de devolución no puede ser menor a la de prestamo",
						icon:"error",
						buttons:"OK",
						timer:4000,
					});

				}else{
					this.$http.post(urlPresta,unPrestamo).then(function(response){
						swal({
							title: "Prestamo Exitoso",
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
							title: "Prestamo fallido",
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