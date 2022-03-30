<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\RouteServiceProvider;
use Illuminate\Routing\RouteCollection;

// uso de modelo
use App\Ejemplares;
use App\Libros;

// uso de db
use DB;

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

        $ejemplar->id_ejemplar = $request->get("id_ejemplar");
        $ejemplar->folio = $request->get("folio");
        $ejemplar->esbase = $request->get("esbase");
        $ejemplar->prestado = $request->get("prestado");
        $ejemplar->comentario = $request->get("comentario");
        $ejemplar->consec = $request->get("consec");
        $ejemplar->fechalta = $request->get("fechalta");
        $ejemplar->solodewee = $request->get("solodewee");
        $ejemplar->deweecompleto = $request->get("deweecompleto");

        // $num = $request->get("1");
        $cont = $request->get("folio");

        DB::update("UPDATE libros SET ejemplares = ejemplares + 1 WHERE folio = '$cont'");

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
        // return Ejemplares::find($id);
        return Libros::find($id);
        // $codigo = $id;
        // $libro = DB::select("SELECT * FROM libros WHERE folio = '$codigo'");
        // return $libro;
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
