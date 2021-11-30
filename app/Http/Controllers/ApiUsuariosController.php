<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\RouteServiceProvider;
use Illuminate\Routing\RouteCollection;

// uso de modelos
use App\Usuarios;

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
        // $usuario = new Usuarios;

        // $usuario->id_usuario = $request->get('id_usuario');
        // $usuario->pass = $request->get('pass');
        // $usuario->nombre = $request->get('nombre');
        // $usuario->apellidos = $request->get('apellidos');
        // $usuario->nivel = $request->get('nivel');

        // $usuario->save();
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
