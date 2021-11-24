<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libros;
use Illuminate\Validation\ValidationException;

use Redirect;
use Session;
use Cookie;
use Cache;

class DetalleController extends Controller
{
    //
    public function detalle(Request $request)
	{
		$isbn=$request->isbn;

    	$res = Libros::where('libros','=',$isbn)->get();

    	if (count($res)>0) {
    		$isbn = $res[0]->titulo;
    		Session::put('isbn',$isbn);
    		Session::put('titulo',$res[0]->titulo);
    		Session::put('autor',$res[0]->id_autor);
    		Session::put('carrera',$res[0]->id_carrera);
    		return Redirect::to('info');   

	}
}
