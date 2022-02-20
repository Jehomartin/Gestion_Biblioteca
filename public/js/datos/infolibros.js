var ruta = document.querySelector("#route").getAttribute("value");
var ides = document.querySelector("#isbn").getAttribute("value");
var urlLibros = ruta + '/apiLibros';
var urlImg = ruta + '/apiCaratula';

new Vue({
	http:{
		headers:{
			'X-CSRF-TOKEN':document.querySelector("#token").getAttribute("value"),
		},
	},

	el:"#infolib",

	created:function(){
		this.detalleli(ides);
		this.getLibro();
	},

	data:{
		libros:[],
		arraycaratulas:[],
		id_caratula:'',
		caratula:'',
		id_editorial:'',
		id_autor:'',
		id_carrera:'',
		id_pais:'',
		folio:'',
		edicion:'',
		anio_pub:'',
		clasificacion:'',
		fecha_alta:'',
		paginas:'',
		isbn:'',
		titulo:'',
        ejemplares:'',
        cutter:'',
	},

	methods:{
		getLibro:function(){
			this.$http.get(urlLibros).then(function(response){
				this.libros = response.data;
			}).catch(function(response){
				toastr.error("no se estan cargando los datos");
			});
		},

		getCaratulas:function(id){
			this.$http.get(urlImg + '/' + id).then(function(response){
				this.arraycaratulas = response.data["caratulas"];
			});
		},

		detalleli:function(id){
			// this.editando=true;
			this.$http.get(urlLibros + '/' + id).then(function(response){
				this.isbn = response.data.isbn;
				this.folio = response.data.isbn;
				this.titulo = response.data.titulo;
				this.id_editorial = response.data.id_editorial;
				this.id_autor = response.data.id_autor;
				this.id_carrera = response.data.id_carrera;
				this.edicion = response.data.edicion;
				this.anio_pub = response.data.anio_pub;
				this.id_pais = response.data.id_pais;
				this.fecha_alta = response.data.fecha_alta;
				this.paginas = response.data.paginas;
				this.ejemplares = response.data.ejemplares;
				this.clasificacion = response.data.clasificacion;
				this.cutter = response.data.cutter;
				this.auxLibro = response.data.isbn;
				this.getCaratulas(ides);
			});
		},
	},
})