var ruta = document.querySelector("[name=route]").value;
var rute = 'http://localhost/Gestion_Biblioteca/public/';
var urlEjemplar = rute + '/apiEjemplares';

new Vue({
	http:{
		headers:{
			'X-CSRF-TOKEN':document.querySelector('#token').getAttribute('value')
		}
	},

	el:"#ejemplar",

	created:function(){
		this.getEjemplar();
		this.getBuscan();
	},

	data:{
		ejemplares:[],
		onda:'jajajaj',
		folio:'',
		clasificacion:'',
		esbase:'',
		prestado:'',
		consec:'',
        fecha_alta:'',
        editejem:false,
        auxEjemplar:'',
        buscar:''
	},

	methods:{
		getEjemplar:function(){
			this.$http.get(urlEjemplar).then(function(response){
				this.ejemplares=response.data;
			}).catch(function(response){
				console.log(response);
			});
		},

		
	},
	computed:{
		filtroEjemplares:function(){
			return this.ejemplares.filter((ejemplar)=>{
				return ejemplar.clasificacion.match(this.buscar.trim()) ||
				ejemplar.folio.toLowerCase()
				.match(this.buscar.trim().toLowerCase());
			});
		}
	},
})