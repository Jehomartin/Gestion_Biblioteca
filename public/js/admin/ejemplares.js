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
		comentario:'',
		consec:'',
        fecha_alta:'',
        solodewee:'',
        deweecompleto:'',
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
			$("#modal_custom").find(".modal-header").css("background","#f39c12");
			$("#modal_custom").find(".modal-header").css("color", "black");
			$("#modal_custom").find(".modal-title")   
			$('#modal_custom').modal('show');
			// $('#addejemplar').modal('show');
		},

		agregarEjemplar:function(){
			//creación del objeto json para enviar al metodo post
			var ejemplar={clasificacion:this.clasificacion,folio:this.folio,esbase:this.esbase,
				prestado:this.prestado,comentario:this.comentario,consec:this.consec,
				fecha_alta:this.fecha_alta,solodewee:this.solodewee,deweecompleto:this.deweecompleto};
			// se realiza la limpieza de los campos
			this.clasificacion = '';
			this.folio = '';
			this.esbase = '';
			this.prestado = '';
			this.comentario = '';
			this.consec = '';
			this.fecha_alta = '';
			this.solodewee = '';
			this.deweecompleto = '';
			// se realiza el envío del objeto json con un post
			this.$http.post(urlEjemplar, ejemplar).then(function(response){
				this.getEjemplar();
				$('#addejemplar').modal('hide');

				toastr.success("Ejemplar agregado con exito!!");

			}).catch(function(response){

				toastr.error("Ejemplar no agregado ocurrio un error");

			});

			
		},

		editEjemplar:function(id){
			this.editejem=true;
			$('#modal_custom').modal('show');
			this.$http.get(urlEjemplar + '/' + id).then(function(response){
				this.clasificacion = response.data.clasificacion;
				this.folio = response.data.folio;
				this.esbase = response.data.esbase;
				this.prestado = response.data.prestado;
				this.comentario = response.data.comentario;
				this.consec = response.data.consec;
				this.fecha_alta = response.data.fecha_alta;
				this.solodewee = response.data.solodewee;
				this.deweecompleto = response.data.deweecompleto;
				this.auxEjemplar = response.data.clasificacion;
			});

			toastr.info("Visualizando información del Ejemplar");
		},

		updateEjem:function(id){
			var ejemplar={clasificacion:this.clasificacion,folio:this.folio,esbase:this.esbase,
				prestado:this.prestado,comentario:this.comentario,consec:this.consec,
				fecha_alta:this.fecha_alta,solodewee:this.solodewee,deweecompleto:this.deweecompleto};

			this.$http.put(urlEjemplar + '/' + this.clasificacion, ejemplar).then(function(response){
				this.getEjemplar();
				this.editejem=false;
				this.clasificacion = '';
				this.folio = '';
				this.esbase = '';
				this.prestado = '';
				this.comentario = '';
				this.consec = '';
				this.fecha_alta = '';
				this.solodewee = '';
				this.deweecompleto = '';

				$('#modal_custom').modal('hide');

				toastr.success("Ejemplar Actualizado con exito!!");
				
			}).catch(function(response){

				toastr.error("Ejemplar no Actualizado ocurrio un error");

			});
			
		},

		eliminarEjemplar:function(id){
			// toastr.warning("Esta a punto de eliminar el registro de un ejemplar");
			var resp=confirm("Esta seguro de eliminar dicho ejemplar")
			if (resp==true) {
				this.$http.delete(urlEjemplar + '/' + id).then(function(json){
					this.getEjemplar();
				});
				toastr.success("La eliminacion del ejemplar se realizó correctamente");
			}else{
				toastr.info("El ejemplar no fue eliminado");
			}
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