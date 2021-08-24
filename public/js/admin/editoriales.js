// var ruta = document.querySelector("[name=route]").value;
// var rute = 'http://localhost/Gestion_Biblioteca/public/';
// var urlEditoriales = rute + '/apiEditoriales';


// new Vue({
// 	http:{
// 		headers:{
// 			'X-CSRF-TOKEN':document.querySelector('#token').getAttribute('value')
// 		}
// 	},

// 	el:"#editorial",

//     created:function(){
// 		this.getEditorial();
// 	},

//     data:{
//         editoriales:[],
//         editando:false,
//         auxLibro:'',
//         buscar:'',
//     },

//     methods:{
// 		getEditoriales:function(){
// 			this.$http.get(urlEditoriales).then(function(response){
// 				this.editoriales=response.data;
// 			}).catch(function(response){
// 				console.log(response);
// 			});
// 		},

//         showModalEditorial:function(){
// 			$("#Editorial").find(".modal-header").css("background","#f39c12");
// 			$("#Editorial").find(".modal-header").css("color", "black");
// 			$("#Editorial").find(".modal-title")   
// 			$('#Editorial').modal('show');
// 			// $('#addEditorial').modal('show');
//         },
//     },
// });