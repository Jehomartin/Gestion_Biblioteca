<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prestamos;
use App\Libros;

class ApiPrestacionController extends Controller
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
        $prestamo->isbn = $request->get('isbn');
        $prestamo->titulo = $request->get('titulo');
        $prestamo->fechaprestamo = $request->get('fechaprestamo');
        $prestamo->fechadevolucion = $request->get('fechadevolucion');
        $prestamo->matricula = $request->get('matricula');
        $prestamo->liberado = $request->get('liberado');
        $prestamo->cantidad = $request->get('cantidad');
        $prestamo->consec = $request->get('consec');

        $prestamo->save();

        // $detail=[];

        // $prestar=$request->get('prestar');
        // for ($i=0; $i < count($prestar); $i++) { 
        //     $detail[]=[
        //         'folioprestamo'=>$prestar[$i]['folioprestamo'],
        //         'isbn' => $prestar[$i]['isbn'];
        //         'titulo' => $prestar[$i]['titulo'];
        //         'fechaprestamo' => $prestar[$i]['fechaprestamo'];
        //         'fechadevolucion' => $prestar[$i]['fechadevolucion'];
        //         'matricula' => $prestar[$i]['matricula'];
        //         'liberado' => $prestar[$i]['liberado'];
        //         'cantidad' => $prestar[$i]['cantidad'];
        //         'consec' => $prestar[$i]['consec'];
        //     ];
        // }

        // Prestamos::insert($detail);
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
