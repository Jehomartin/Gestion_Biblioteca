<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\RouteServiceProvider;
use Illuminate\Routing\RouteCollection;

// uso de los modelos
use App\DetallePrestamos;
use App\Prestamos;
use App\Libros;

// uso de Base datos
use DB;

// Archivos para fecha
use Carbon\Carbon;
use DateTime;
use DatePeriod;
use DateInterval;

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

        return DetallePrestamos::where('devuelto',0)->get(['foliodetalle','folioprestamo','isbn','titulo','id_prestador','correo','fechadevolucion']);
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
        $devolucion->id_prestador = $request->get("id_prestador");
        $devolucion->correo = $request->get("correo");

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
