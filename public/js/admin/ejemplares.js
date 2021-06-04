var ruta = document.querySelector("[name=route]").value;
var rute = 'http://localhost/Gestion_Biblioteca/public/';
var urlEjemplar = rute + '/apiEjemplares';
var urlLibro = rute + '/apiLibros';

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
		this.getLibro();
	},

	data:{
		ejemplares:[],
		libros:[],
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

		getLibro:function(){
			this.$http.get(urlLibro).then(function(json){
				this.libros = json.data;
			}).catch(function(json){
				console.log(json);
			});
		},

		getBuscan:function(){
			this.$http.get(urlEjemplar).then(function(response){
				this.ejemplares=response.data;
			}).catch(function(response){
				console.log(response);
			});
		},

		showModal:function(){
			$('#addejemplar').modal('show');
		},

		agregarEjemplar:function(){
			//creación del objeto json para enviar al metodo post
			var ejemplar = { clasificacion:this.clasificacion, folio:this.folio, esbase:this.esbase,
				prestado:this.prestado, consec:this.consec, fecha_alta:this.fecha_alta
			};
			// se realiza la limpieza de los campos
			this.clasificacion='';
			this.folio='';
			this.esbase='';
			this.prestado='';
			this.consec='';
			this.fecha_alta='';
			// se realiza el envío del objeto json con un post
			this.$http.post(urlEjemplar, ejemplar).then(function(response){
				this.getEjemplar();
				$('#addejemplar').modal('hide');
			});

			toastr.success("Ejemplar agregado con exito!!");
		},

		cancelEditj:function(){
			this.clasificacion='';
			this.folio='';
			this.esbase='';
			this.prestado='';
			this.consec='';
			this.fecha_alta='';
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