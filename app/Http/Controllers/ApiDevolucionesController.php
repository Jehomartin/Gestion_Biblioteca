<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\RouteServiceProvider;
use Illuminate\Routing\RouteCollection;

// uso de modelo
use App\Devoluciones;
use App\DetalleDevoluciones;
use App\Prestamos;

use DB;

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
        // $fol = 'PRS-22033055000';
        // $prestador = DB::select("SELECT prestamista FROM nota_prestamos WHERE folioprestamo ='$fol'");
        // if ($prestador == 'alumno') {
        //     return 'verdad';
        // } else {
        //     return 'FALSO';
        // }

        // return Devoluciones::all();

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
        $devolucion = new Devoluciones;

        $devolucion->foliodevolucion = $request->get('foliodevolucion');
        $devolucion->datedevolucion = $request->get('datedevolucion');

        $devolucion1 = [];
        $devolucion3 = $request->get('devolucion3');

        // se crea el array para detalle_devolucion
        for ($i=0; $i < count($devolucion3); $i++) { 
            $devolucion1[]=[
                'foliodevolucion'=>$request->get('foliodevolucion'),
                'folioprestamo'=>$devolucion3[$i]['folioprestamo'],
                'isbn'=>$devolucion3[$i]['isbn'],
                'titulo'=>$devolucion3[$i]['titulo'],
                'cantidad'=>$devolucion3[$i]['cantidad'],
                'id_prestador'=>$devolucion3[$i]['id_prestador'],
                'correo'=>$devolucion3[$i]['correo'],
                // 'prst'=>$devolucion3[$i]['prst']
            ];
            $folp = $devolucion3[$i]['folioprestamo'];
            $people = $devolucion3[$i]['prst'];
            // $prestador = DB::select("SELECT prestamista FROM nota_prestamos WHERE folioprestamo ='$folp'");

            $mat = $devolucion3[$i]['id_prestador'];
            $exem=$devolucion3[$i]['cantidad'];
            $codigo=$devolucion3[$i]['isbn'];
        }
        // fin array detalle

        $cont = $request->get('permiso');

        // se verifica si el prestamista es alumno
        if ($people == 1) {
            DB::update("UPDATE alumnos SET permiso = $cont WHERE matricula = '$mat'");
        }
        // fin verificación

        $devolucion->folioprestamo = $folp;

        DetalleDevoluciones::insert($devolucion1);
        $devolucion->save();

        DB::update("UPDATE libros SET ejemplares = ejemplares + $exem WHERE isbn = '$codigo'");
        DB::update("UPDATE detalle_prestamo SET devuelto = 1 WHERE folioprestamo = '$folp'");
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
