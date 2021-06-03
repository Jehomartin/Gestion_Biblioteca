var ruta = document.querySelector("[name=route]").value;
var rute = 'http://localhost/Gestion_Biblioteca/public/';
var urlDevol = rute + '/apiDevoluciones';
var urlPrestamo = rute + '/apiPrestamos';

new Vue({
	http:{
		headers:{
			'X-CSRF-TOKEN':document.querySelector('#token').getAttribute('value')
		}
	},

	el:"#devolucion",

	created:function(){
		this.getDevoluciones();
        this.getPrestamos();
		
	},

	data:{
		devoluciones:[],
        prestamos:[],
		foliodevolucion:'',
		clasificacion:'',
		folioprestamo:'',
		devuelto:'',
		consec:'',
        editando:false,
        buscar:''
	},

	methods:{
		getDevoluciones:function(){
			this.$http.get(urlDevol).then(function(response){
				this.devoluciones=response.data;
			}).catch(function(response){
				console.log(response);
			});
		},
        getPrestamos:function(){
			this.$http.get(urlPrestamo).then(function(response){
				this.prestamos=response.data;
			}).catch(function(response){
				console.log(response);
			});
		},

		
	},
	computed:{
		filtroDevolucion:function(){
			return this.devoluciones.filter((devolucion)=>{
				return devolucion.clasificacion.match(this.buscar.trim()) ||
				devolucion.foliodetalle.toLowerCase()
				.match(this.buscar.trim().toLowerCase());
			});
		}
	},
})