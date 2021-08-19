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
Route::apiResource('apiLibros','ApiLibrosController');
Route::apiResource('apiPrestamos','ApiPrestamosController');
Route::apiResource('apiUsuarios','ApiUsuariosController');
Route::apiResource('apiAcceso','AccesoController');
Route::apiResource('apiPais','ApiPaisesController');
Route::apiResource('apiAutores','ApiAutoresController');
Route::apiResource('apiEditoriales','ApiEditorialesController');
Route::apiResource('apiCarreras','ApiCarrerasController');

//enrutamiento admin
Route::view('inicio','admin.index');
Route::view('libros','admin.libros');
Route::view('ejemplares','admin.ejemplares');
Route::view('prestamos','admin.prestamos');
Route::view('devoluciones','admin.LibrosPrestados');
Route::view('prestacion','admin.prestacion');
Route::view('registro','admin.registroLibro');


//enrutamiento de las funciones de validación
Route::post('entrar','AccesoController@validar');
Route::get('sale','AccesoController@salir');

//enrutamiento basico
Route::view('/','login');
Route::view('mensaje','mensaje');

Route::get('getLibros/{id}',[
	'as' => 'getLibros',
	'uses' => 'ApiPrestamosController@getLibros',
]);