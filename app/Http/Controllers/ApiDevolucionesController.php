<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Devoluciones;

class ApiDevolucionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Devoluciones::all();
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
        // $devolucion = new Devoluciones;

        // $devolucion->foliod = $request->get('foliod');
        // $devolucion-> = $request->get('');
        // $devolucion-> = $request->get('');
        // $devolucion-> = $request->get('');
        // $devolucion-> = $request->get('');

        // $devolucion->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return Devoluciones::find($id);
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
        // $devolucion = Devoluciones::find($id);

        // $devolucion->foliod = $request->get('foliod');
        // $devolucion-> = $request->get('');
        // $devolucion-> = $request->get('');
        // $devolucion-> = $request->get('');
        // $devolucion-> = $request->get('');

        // $devolucion->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //return Devoluciones::destroy($id);
    }
}
