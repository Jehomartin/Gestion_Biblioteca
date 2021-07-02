<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ejemplares;

class ApiEjemplaresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response 
     */
    public function index()
    {
        //
        return Ejemplares::all();
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
        $ejemplar = new Ejemplares;

        $ejemplar->clasificacion = $request->get('clasificacion');
        $ejemplar->folio = $request->get('folio');
        $ejemplar->esbase = $request->get('esbase');
        $ejemplar->prestado = $request->get('prestado');
        $ejemplar->comentario = $request->get('comentario');
        $ejemplar->consec = $request->get('consec');
        $ejemplar->fecha_alta = $request->get('fecha_alta');
        $ejemplar->solodewee = $request->get('solodewee');
        $ejemplar->deweecompleto = $request->get('deweecompleto');

        $ejemplar->save();
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
        return Ejemplares::find($id);
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
        $ejemplar = Ejemplares::find($id);

        $ejemplar->clasificacion = $request->get('clasificacion');
        $ejemplar->folio = $request->get('folio');
        $ejemplar->esbase = $request->get('esbase');
        $ejemplar->prestado = $request->get('prestado');
        $ejemplar->comentario = $request->get('comentario');
        $ejemplar->consec = $request->get('consec');
        $ejemplar->fecha_alta = $request->get('fecha_alta');
        $ejemplar->solodewee = $request->get('solodewee');
        $ejemplar->deweecompleto = $request->get('deweecompleto');

        $ejemplar->update();
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
        return Ejemplares::destroy($id);
    }
}
