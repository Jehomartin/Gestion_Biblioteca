var route = document.querySelector("[name=route]").value;
var ruta = 'http://localhost/Gestion_Biblioteca/public/';
var urlPresta = ruta + '/apiPrestamos';
var urlLibro = ruta + '/apiLibros';


function init()
{
	new Vue({
		
		http:{
			headers:{
				'X-CSRF-TOKEN' : document.querySelector('#token').getAttribute('value')
			}
		},

		el:'#prestacion',

		created:function(){
			this.foliarPrestamo();
		},

		data:{
			saludos:'eyyyyyy',
			libros:[],
			prestamos:[],
			codigo:'',
			folioprestamo:'',
			cantidad:'',
			consec:'',

			fechaprestamo:moment().format('YYYY-MM-DD'),
			// cantidades:[1,1,1,1,1]
		},

		methods:{
			// inicio getLibro
			getLibro:function(){
				this.$http.get(urlLibro + '/' + this.codigo)
				.then(function(json){
					var prestamo = {
						'isbn':json.data.isbn,
						'titulo':json.data.titulo,
						'consec':json.data.consec,
						
					}
					if (prestamo.isbn){
						this.prestamos.push(prestamo);
						this.codigo='';
						this.$refs.buscar.focus();
					}
				})
			}, //fin getLibro

			cancelarPrestamo:function(id){
				this.prestamos.splice(id,1);
			},

			foliarPrestamo:function(){
				this.folioprestamo = 'PRS-' + moment().format('YYMMDDhmmss');
			},

			prestar:function(){
				
				var prestar2=[];
				for (var i = 0; i < this.prestamos[i].length; i++) {
					prestar2.push({
						isbn:this.prestamos[i].isbn,
						titulo:this.prestamos[i].titulo,
						consec:this.prestamos[i].consec
					})
				}


				var unPrestamo = {
					folioprestamo:this.folioprestamo,
					fechaprestamo:this.fechaprestamo,
					fechadevolucion:this.fechadevolucion,
					matricula:this.matricula,
					cantidad:'1',
					prestar1:prestar2
				};

				console.log(unPrestamo);

				this.$http.post(urlPresta,unPrestamo)
				.then(function(json){
					console.log(json.data);
				}).catch(function(j){
					console.log(j.data);
				});

				toastr.success("Prestamo realizado con exito");
				this.foliarPrestamo();
				this.prestamos=[];
				// this.isbn='';
				// this.titulo='';
				this.fechaprestamo='';
				this.fecchadevolucion='';
				this.matricula='';
				this.liberado='';
				this.cantidad='';
				// this.consec='';
			},
		}
	})
}
window.onload=init;