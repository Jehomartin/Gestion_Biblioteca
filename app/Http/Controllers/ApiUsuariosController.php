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
        return Usuarios::where('bloqueado',false)->get(['login','pass','nombre','apellidos','sexo','edad','telefono','nivel','bloqueado']);
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
        $userN->bloqueado = $request->get('bloqueado');

        $userN->save();

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
        return Usuarios::find($id);
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
        $usuario = Usuarios::find($id);

        $usuario->login = $request->get('login');
        $usuario->pass = $request->get('pass');
        $usuario->nombre = $request->get('nombre');
        $usuario->apellidos = $request->get('apellidos');
        $usuario->sexo = $request->get('sexo');
        $usuario->edad = $request->get('edad');
        $usuario->telefono = $request->get('telefono');
        $usuario->nivel = $request->get('nivel');
        $usuario->bloqueado = $request->get('bloqueado');

        $usuario->update();
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
