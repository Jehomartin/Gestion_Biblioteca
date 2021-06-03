<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prestamos;
use App\Libros;
// use App\Alumnos;

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
        // $prestamo->isbn = $request->get('isbn');
        // $prestamo->titulo = $request->get('titulo');
        $prestamo->fechaprestamo = $request->get('fechaprestamo');
        $prestamo->fechadevolucion = $request->get('fechadevolucion');
        $prestamo->matricula = $request->get('matricula');
        $prestamo->liberado = $request->get('liberado');
        $prestamo->cantidad = $request->get('cantidad');
        // $prestamo->consec = $request->get('consec');

        $prestar=[];

        $prestar1 = $request->get('prestar1');

        for ($i=0; $i < count($prestar1); $i++) { 
            $prestar[]=[
                'isbn'=>$prestar1[$i]['isbn'],
                'titulo'=>$prestar1[$i]['titulo'],
                'consec'=>$prestar1[$i]['consec']
            ];
        }

        $prestamo->save();
        Prestamos::insert($prestar);
        
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
}
