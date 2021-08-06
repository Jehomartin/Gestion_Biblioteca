var route = document.querySelector("[name=route]").value;
var ruta = 'http://localhost/Gestion_Biblioteca/public/';
var urlPresta = ruta + '/apiPrestamos';
var urlLibro = ruta + '/getLibros/';


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
			this.getPrestamo();
		},

		data:{
			saludos:'eyyyyyy',
			libros:[],
			prestamos:[],
			isbn:'',
			titulo:'',
			consec:'',
			folioprestamo:'',
			fechadevolucion:'',
			matricula:'',
			liberado:'',
			cantidad:'',

			fechaprestamo:moment().format('YYYY-MM-DD'),
			// cantidades:[1,1,1,1,1]
		},

		methods:{

			getPrestamo:function(){
				this.$http.get(urlPresta).then(function(response){
					this.prestamos = response.data;
				});
			},

			// inicio getLibro
			getLibros(event){
				var id = event.target.value;

				this.$http.get(urlLibro + id)
				.then(function(json){
					//console.log(json.data);
					this.libros=json.data;
				});
			}, //fin getLibro

			cancelarPrestamo:function(id){
				this.prestamos.splice(id,1);
			},

			foliarPrestamo:function(){
				this.folioprestamo = 'PRS-' + moment().format('YYMMDDhmmss');
			},

			prestar:function(){
				var proba={folioprestamo:this.folioprestamo,isbn:this.isbn,titulo:this.titulo,
					fechaprestamo:this.fechaprestamo,fechadevolucion:this.fechadevolucion,
					matricula:this.matricula,liberado:this.liberado,
					cantidad:this.cantidad,consec:this.consec};

				this.foliarPrestamo();
				this.isbn='';
				this.titulo='';
				this.fechadevolucion='';
				this.matricula='';
				this.liberado='';
				this.cantidad='';
				this.consec='';	

				this.$http.post(urlPresta,proba).then(function(response){
					this.getPrestamo();
					console.log(proba);
					toastr.success("prestamo agregado");

				}).catch(function(response){

					toastr.error("Prestamo no realizado, algo salio mal");
				});
			},
		},
	});
}
window.onload=init;