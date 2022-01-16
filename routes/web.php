<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//enrutamiento de las APIS
Route::apiResource('apiEjemplares','ApiEjemplaresController');
Route::apiResource('apiAlumnos','ApiAlumnosController');
Route::apiResource('apiDevoluciones','ApiDevolucionesController');
Route::apiResource('apiPrestamos','ApiPrestamosController');
Route::apiResource('apiUsuarios','ApiUsuariosController');
Route::apiResource('apiAcceso','AccesoController');
Route::apiResource('apiPais','ApiPaisesController');
Route::apiResource('apiAutores','ApiAutoresController');
Route::apiResource('apiEditoriales','ApiEditorialesController');
Route::apiResource('apiCarreras','ApiCarrerasController');
Route::apiResource('apiDetalles','ApiDetallePrestamosController');
Route::apiResource('apiBusqueda','ApiBusquedaController');

//enrutamiento admin(VISTAS)
Route::view('inicio','admin.index');
Route::view('libros','admin.libros');
Route::view('ejemplares','admin.ejemplares');
Route::view('prestamos','admin.prestamos');
Route::view('devoluciones','admin.LibrosPrestados');
Route::view('prestacion','admin.prestacion');
Route::view('registro','admin.registroLibro');
Route::view('infoli','admin.infoli');
Route::view('/','login');
Route::view('buscar','search.busqueda');

//enrutamiento funciones de validación(LOGIN)
Route::post('entrar','AccesoController@validar');
Route::get('sale','AccesoController@salir');
Route::post('detalle','DetalleController@detalle');


// ruta de evento
Route::get('getLibros/{id}',[
	'as' => 'getLibros',
	'uses' => 'ApiPrestamosController@getLibros',
]);

// esta api es para realizar el actualizar y eliminar del libro
Route::apiResource('apiLibros','ApiLibrosController');
// esta api es para realizar el registro de un nuevo libro
Route::apiResource('apiRegistroLibros','ApiLibrousController');

//ruta informacion 
Route::get('libros/detallelibro/{id}', 'ApiLibrosController@detallelibro')->where('id','[0-9]+');