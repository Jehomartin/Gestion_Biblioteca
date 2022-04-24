<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\RouteServiceProvider;
use Illuminate\Routing\RouteCollection;
use Illuminate\Support\Facades\Storage;

// uso de modelo
use App\Librous;
use App\Ejemplares;
use App\Caratulas;

class ApiLibrousController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Librous::all();
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
        $librou = new Librous;

        // dd( $request->hasFile('caratula'));

        $librou->isbn = $request->get('isbn');
        $librou->folio = $request->get('isbn');
        $librou->titulo = $request->get('titulo');
        $librou->id_editorial = $request->get('id_editorial');
        $librou->id_autor = $request->get('id_autor');
        $librou->id_carrera =$request->get('id_carrera');
        $librou->edicion = $request->get('edicion');
        $librou->anio_pub = $request->get('anio_pub');
        $librou->id_pais = $request->get('id_pais');
        $librou->fecha_alta = $request->get('fecha_alta');
        $librou->paginas = $request->get('paginas');
        $librou->ejemplares = $request->get('ejemplares');
        $librou->clasificacion = $request->get('clasificacion');
        $librou->cutter =$request->get('cutter');

        // <--función para guardar y mandar la imagen-->
        $llave = $request->get('isbn');

        if ($request->hasFile('caratulafile')) {
            $caratulas = $request->file('caratulafile');
            foreach ($caratulas as $caratula){
                $namefile = storage::disk('public')->put('caratulas',$caratula);
                $portada[]=[
                    'caratula'=>$namefile,
                    'isbn'=>$llave
                ];
            }
            Caratulas::insert($portada);
        }
        // <--fin guardar imagen-->


        // <--inicio agregar ejemplar-->

        $canti = $request->get("ejemplares");
        $foli = $request->get("isbn");
        $fechi = $request->get("fecha_alta");

        for ($i=0; $i <($canti) ; $i++) 
        { 
            $ejemplar[] = [
                'id_ejemplar'=> $foli.'-'. 1,
                'folio'=>$foli,
                'esbase'=>1,
                'prestado'=>0,
                'fechalta'=>$fechi,
            ];
        }
        // <--fin ejemplar-->
        Ejemplares::insert($ejemplar);
        $librou->save();
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
