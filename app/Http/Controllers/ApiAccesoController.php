<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuarios;

// use Redirect;
// use Session;
// use Cookie;
// use Cache;

class ApiAccesoController extends Controller
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
        
        // $usuario=$request->usuario;
        // $password=$request->pass;

        // $res = Usuarios::where('login','=',$usuario)
        // ->where('pass','=',$password)->get();

        // if (count($res)>0) {
        //     $usuario = $res[0]->nombre.' '.$res[0]->apellidos;
        //     Session::put('usuario',$usuario);
        //     Session::put('puesto',$res[0]->nivel);

        //     if ($res[0]->nivel == "Administrador") {
        //         return Redirect::to('inicio');    
        //     }
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
    }
}
