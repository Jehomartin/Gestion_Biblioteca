<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuarios;
use Illuminate\Validation\ValidationException;

use Redirect;
use Session;
use Cookie;
use Cache;

class AccesoController extends Controller
{
    //se crea la funcion para validar el inicio de sesión
	public function validar(Request $request)
	{
		$usuario=$request->usuario;
    	$password=$request->pass;

    	$res = Usuarios::where('login','=',$usuario)
        ->where('pass','=',$password)->get();

    	if (count($res)>0) {
    		$usuario = $res[0]->nombre.' '.$res[0]->apellidos;
    		Session::put('usuario',$usuario);
    		Session::put('puesto',$res[0]->nivel);

    		if ($res[0]->nivel == "Administrador" && $res[0]->bloqueado == false) {
                return Redirect::to('inicio');    
            }
            else{
                throw ValidationException::withMessages([
                    'bloqueado' => __('auth.dead'),
                ]);
            }
        }else{
            throw ValidationException::withMessages([
                'usuario' && 'password' => __('auth.failed'),
            ]);
        }

	}

	public function salir(){

    	Session::flush();
    	Session::reflash();
    	Cache::flush();
    	Cookie::forget('laravel_session');
    	unset($_COOKIE);
    	unset($_SESSION);
    	return Redirect::to('/');
    }
}
