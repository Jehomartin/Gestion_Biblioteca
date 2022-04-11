<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\RouteServiceProvider;
use Illuminate\Routing\RouteCollection;
use Illuminate\Support\Facades\Mail;
use App\DetallePrestamos;

use DB;
class CorreoController extends Controller
{
    //
    public function mail( Request $request){


        $isbn = $request->isbn;
        $correo = $request->correo;
        $prestador = $request->id_prestador;
        $titulo = $request->titulo;

        Mail::send('components.correo.newmensaje', $request->all(), function($mensage) use ($isbn,
            $correo,
            // $prestador,
            $titulo){
            $mensage->to($correo,'Aviso');
            $mensage->subject('Fecha expirada');
        });
    }
}
