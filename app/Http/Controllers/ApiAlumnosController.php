<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumnos;

class ApiAlumnosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Alumnos::all();
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
        // $alumno = new Alumnos;

        // $alumno->id_alumnos = $request->get('id_alumnos');
        // $alumno->nombre = $request->get('nombre');
        // $alumno->apellidos = $request->get('apellidos');
        // $alumno-> = $request->get('');
        // $alumno-> = $request->get('');
        // $alumno-> = $request->get('');

        // $alumno->save();
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
        return Alumnos::find($id);
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
        // $alumno = Alumnos::find($id);

        // $alumno->id_alumnos = $request->get('id_alumnos');
        // $alumno->nombre = $request->get('nombre');
        // $alumno->apellidos = $request->get('apellidos');
        // $alumno-> = $request->get('');
        // $alumno-> = $request->get('');
        // $alumno-> = $request->get('');
        // $alumno-> = $request->get('');

        // $alumno->update();
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
        //return Alumnos::destroy($id);
    }
}
