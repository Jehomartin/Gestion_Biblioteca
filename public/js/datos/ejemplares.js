var route = document.querySelector("#route").getAttribute("value");
var urlEjemplar = route + '/apiEjemplares';
var urlLibro = route + '/apiLibros';

new Vue({
	http:{
		headers:{
			'X-CSRF-TOKEN':document.querySelector("#token").getAttribute("value"),
		},
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
				toastr.error("LOS DATOS NO SE CARGARON");
			});
		},

		getLibro:function(){
			this.$http.get(urlLibro).then(function(json){
				this.libros = json.data;
			}).catch(function(json){
				toastr.error("LOS DATOS NO SE CARGARON");
			});
		},

		getBuscan:function(){
			this.$http.get(urlEjemplar).then(function(response){
				this.ejemplares=response.data;
			}).catch(function(response){
				toastr.error("LOS DATOS NO SE CARGARON");
			});
		},

		showModal:function(){
			$("#modal_custo").find(".modal-header").css("background","#f39c12");
			$("#modal_custo").find(".modal-header").css("color", "black");
			$("#modal_custo").find(".modal-title")   
			$('#modal_custo').modal('show');
			
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

				swal({
					title:"EJEMPLAR AGREGADO",
					text:"Ejemplar agregado con exito!!",
					icon:"success",
					buttons:false,
					timer:3000,
				});

			}).catch(function(response){

				swal({
					title:"ERROR DE REGISTRO",
					text:"El ejemplar no se agrego ocurrio un error",
					icon:"error",
					buttons:false,
					timer:3000,
				});

			});

			
		},

		editEjemplar:function(id){
			this.editejem=true;
			$('#modal_custo').modal('show');
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

				$('#modal_custo').modal('hide');

				swal({
					title:"ACTUALIZACION EXITOSA",
					text:"Ejemplar Actualizado con exito!!",
					icon:"success",
					buttons:false,
					timer:3000,
				});
				
			}).catch(function(response){

				swal({
					title:"ERROR DE ACTUALIZACIÓN",
					text:"Ocurrio un error al actualizar el ejemplar",
					icon:"error",
					buttons:false,
					timer:3000,
				});

			});
			
		},

		eliminarEjemplar:function(id){

			swal({
                title: 'ADVERTENCIA',
                text: "¿Está seguro de eliminar este registro?",
                type: 'warning',
                buttons: {
                    confirm: {
                        text: 'Eliminar!',
                        className: 'btn btn-success'
                    },
                    cancel: {
                        visible: true,
                        className: 'btn btn-danger'
                    },
                },
            }).then((result) => {
                if (result) {
                    this.$http.delete(urlEjemplar + '/' + id).then(function(json){
                            swal({
                                title: '¡ELIMINADO!',
                                text: 'Usted a eliminado el registro corréctamente',
                                icon: 'success',
                                buttons: false,
                                timer: 1500
                            });
                            this.getEjemplar();
                        });
                } else {
                    swal.close();
                }
            });
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