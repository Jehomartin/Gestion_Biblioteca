<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\RouteServiceProvider;
use Illuminate\Routing\RouteCollection;

use App\Adeudos;
use App\Alumnos;
use App\Multas;

use DB;

class ApiAdeudosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Adeudos::where('activo',true)->get(['id_adeudos','matricula','dias_atraso','precio_multa','total','activo']);
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
        $deuda = new Adeudos;

        $deuda->matricula = $request->get('matricula');
        $deuda->dias_atraso = $request->get('dias_atraso');
        $deuda->precio_multa = $request->get('precio_multa');
        $deuda->total = $request->get('total');

        // actualizando en alumnos
        $cod = $request->get('deudor');
        $mat = $request->get('id_prestador');
        DB::update("UPDATE alumnos SET deudor = $cod WHERE matricula = '$mat'");

        $deuda->save();
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
        $adeudo = Adeudos::find($id);
        return $adeudo;
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
        $deuda = Adeudos::find($id);

        $deuda->id_adeudos = $request->get('id_adeudos');
        $deuda->matricula = $request->get('matricula');
        $deuda->dias_atraso = $request->get('dias_atraso');
        $deuda->precio_multa = $request->get('precio_multa');
        $deuda->total = $request->get('total');
        $deuda->activo = $request->get('activo');

        $mat = $request->get('matricula');
        $act = $request->get('activo');

        $deuda->update();

        DB::update("UPDATE alumnos SET deudor = '$act' WHERE matricula = '$mat'");
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
