var route = document.querySelector("[name=route]").value;
var ruta = 'http://localhost/Gestion_Biblioteca/public/';
var urlPresta = ruta + '/apiPrestamos';
var urlLibro = ruta + '/apiLibros';
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
					var unprestado={
						'isbn':response.data.isbn,
						'titulo':response.data.titulo,
						'consec':response.data.consec,
						'cantidad':1,
					}

					if (unprestado.isbn) {
						this.prestamos.push(unprestado);
						this.codigo='';
						this.$refs.buscar.focus();
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
				var presta=[];
				for (var i = 0; i < this.prestamos.length; i++) {
					presta.push({
						isbn:this.prestamos[i].isbn,
						titulo:this.prestamos[i].titulo,
						consec:this.prestamos[i].consec,
						cantidad:1,
					})
				}

				var unPrestamo={
					folioprestamo:this.folioprestamo,
					fechaprestamo:this.fechaprestamo,
					fechadevolucion:this.fechadevolucion,
					matricula:this.matricula,
					prestar1:presta
				};

				this.$http.post(urlPresta,unPrestamo).then(function(response){
					toastr.success("Prestamo realizado con exito");
					this.foliarprestamo();
					this.prestamos=[];
					this.fechadevolucion='';
					this.matricula='';
				}).catch(function(response){
					toastr.error("Prestamo no realizado");
				});

			},
		},
	});
}
window.onload=init;