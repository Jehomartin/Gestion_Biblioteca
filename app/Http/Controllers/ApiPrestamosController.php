<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\RouteServiceProvider;
use Illuminate\Routing\RouteCollection;

// uso de modelos
use App\Prestamos;
use App\DetallePrestamos;
use App\Libros;
use App\Alumnos;

// uso de base datos
use DB;

class ApiPrestamosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Prestamos::all();
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
        $prestamo = new Prestamos;

        $prestamo->folioprestamo = $request->get('folioprestamo');
        $prestamo->fechaprestamo = $request->get('fechaprestamo');
        $prestamo->fechadevolucion = $request->get('fechadevolucion');
        $prestamo->prestamista = $request->get('prestamista');

        $detalle1=[];

        $newdetalle3 = $request->get('newdetalle3');

        $prestmis = $request->get('prestamista');

        if ($prestmis == "alumno") {
            for ($i=0; $i < count($newdetalle3); $i++) { 
                $detalle1[]=[
                    'folioprestamo'=>$request->get('folioprestamo'),
                    'isbn'=>$newdetalle3[$i]['isbn'],
                    'titulo'=>$newdetalle3[$i]['titulo'],
                    'devuelto'=>$newdetalle3[$i]['devuelto'],
                    'cantidad'=>$newdetalle3[$i]['cantidad'],
                    'id_prestador'=>$request->get('matricula'),
                    'correo'=>$request->get('correo'),
                ];

                //se hace la actualización de la cantidad de ejemplares disponibles
                $exem=$newdetalle3[$i]['cantidad'];
                $codigo=$newdetalle3[$i]['isbn'];
            }

            $mat = $request->get('matricula');
            $cont = $request->get('permisos');
            DB::update("UPDATE alumnos SET permisos = permisos - $cont WHERE matricula = '$mat'");
            // DB::update("UPDATE libros SET ejemplares = ejemplares - $exem WHERE isbn = '$codigo'");

        } elseif ($prestmis == "docente") {
            for ($i=0; $i < count($newdetalle3); $i++) { 
                $detalle1[]=[
                    'folioprestamo'=>$request->get('folioprestamo'),
                    'isbn'=>$newdetalle3[$i]['isbn'],
                    'titulo'=>$newdetalle3[$i]['titulo'],
                    'devuelto'=>$newdetalle3[$i]['devuelto'],
                    'cantidad'=>$newdetalle3[$i]['cantidad'],
                    'id_prestador'=>$request->get('claves'),
                    'correo'=>$request->get('email'),
                ];

                //se hace la actualización de la cantidad de ejemplares disponibles
                $exem=$newdetalle3[$i]['cantidad'];
                $codigo=$newdetalle3[$i]['isbn'];
            }
            
        }
        
        $prestamo->save();
        DetallePrestamos::insert($detalle1);

        DB::update("UPDATE libros SET ejemplares = ejemplares - $exem WHERE isbn = '$codigo'");
        
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
        return Prestamos::find($id);
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
        // $prestamo = Prestamos::find($id);

        // $prestamo->folioprestamo = $request->get('folioprestamo');
        // $prestamo->fechaprestamo = $request->get('fechaprestamo');
        // $prestamo->fechadevolucion = $request->get('fechadevolucion');
        // $prestamo->matricula = $request->get('matricula');
        // $prestamo->liberado = $request->get('liberado');
        // $prestamo->cantidad = $request->get('cantidad');
        // $prestamo->consec = $request->get('consec');

        // $prestamo->update();
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
        // return Prestamos::destroy($id);
    }

    public function getAlumnos($id){
     $alumnos = DB::select("SELECT * FROM alumnos WHERE matricula=$id");
     return $alumnos;
    }
}
