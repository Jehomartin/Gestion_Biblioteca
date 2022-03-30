<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\RouteServiceProvider;
use Illuminate\Routing\RouteCollection;

// uso de modelos
use App\Usuarios;

use Illuminate\Validation\ValidationException;

use Redirect;
use Session;
use Cookie;
use Cache;

class ApiUsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Usuarios::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $userN = new Usuarios;

        $userN->login = $request->get('login');
        $userN->pass = $request->get('pass');
        $userN->nombre = $request->get('nombre');
        $userN->apellidos = $request->get('apellidos');
        $userN->sexo = $request->get('sexo');
        $userN->edad = $request->get('edad');
        $userN->telefono = $request->get('telefono');
        $userN->nivel = $request->get('nivel');

        $userN->save();

        // if ($request->get($userN)) {
        //     $usuario=$request->usuario;
        //     $password=$request->pass;

        //     $res = Usuarios::where('login','=',$usuario)
        //     ->where('pass','=',$password)->get();
        //     if (count($res)>0) {
                
        //         $usuario = $res[0]->nombre.' '.$res[0]->apellidos;
        //         Session::put('usuario',$usuario);
        //         Session::put('puesto',$res[0]->nivel);

        //         if ($res[0]->nivel == "Administrador") {
        //             return Redirect::to('inicio');    
        //         }
        //     } else {
        //         return 'fallaste';
        //     }
        // } else {
        //     return 'error';
        // }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // return Usuarios::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // $usuario = Usuarios::find($id);

        // $usuario->id_usuario = $request->get('id_usuario');
        // $usuario->pass = $request->get('pass');
        // $usuario->nombre = $request->get('nombre');
        // $usuario->apellidos = $request->get('apellidos');
        // $usuario->nivel = $request->get('nivel');

        // $usuario->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // return Usuarios::destroy($id);
    }
}
