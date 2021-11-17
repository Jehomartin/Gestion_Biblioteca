<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetallePrestamos;
use App\Prestamos;
use App\Libros;
use DB;

class ApiDetallePrestamosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return DetallePrestamos::all();
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
        $detalle = DetallePrestamos::find($id);
        return $detalle;
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
        $devolucion = DetallePrestamos::find($id);

        $devolucion->foliodetalle  = $request->get("foliodetalle");
        $devolucion->folioprestamo  = $request->get("folioprestamo");
        $devolucion->isbn  = $request->get("isbn");
        $devolucion->titulo  = $request->get("titulo");
        $devolucion->devuelto  = $request->get("devuelto");
        $devolucion->cantidad  = $request->get("cantidad");


        $cant=$request->get("cantidad");
        $clave=$request->get("isbn");

        DB::update("UPDATE libros SET ejemplares = ejemplares + $cant WHERE isbn = '$clave'");

        $devolucion->update();
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
