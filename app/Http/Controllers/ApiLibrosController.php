<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\RouteServiceProvider;
use Illuminate\Routing\RouteCollection;

// uso de modelo
use App\Libros;
use DB;
use App\Ejemplares;
use App\Caratulas;

class ApiLibrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $libro = Libros::orderBy('titulo','ASC')->paginate(25);

        return [
            'pagination' => [
                'total'         => $libro->total(),
                'current_page'  => $libro->currentpage(),
                'per_page'      => $libro->perPage(),
                'last_page'     => $libro->lastPage(),
                'from'          => $libro->firstItem(),
                'to'            => $libro->lastItem(),
            ],
            'tasks' => $libro
        ];
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
        return Libros::find($id);

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
        $libro = Libros::find($id);

        $libro->isbn = $request->get('isbn');
        $libro->folio = $request->get('isbn');
        $libro->titulo = $request->get('titulo');
        $libro->id_editorial = $request->get('id_editorial');
        $libro->id_autor = $request->get('id_autor');
        $libro->id_carrera =$request->get('id_carrera');
        $libro->edicion = $request->get('edicion');
        $libro->anio_pub = $request->get('anio_pub');
        $libro->id_pais = $request->get('id_pais');
        $libro->fecha_alta = $request->get('fecha_alta');
        $libro->paginas = $request->get('paginas');
        $libro->ejemplares = $request->get('ejemplares');
        $libro->clasificacion = $request->get('clasificacion');
        $libro->cutter =$request->get('cutter');

        // <--función para guardar y mandar la imagen-->
        // $portadas=[];
        // $detacara = $request->get('detacara');
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

        $libro->update();
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
        return Libros::destroy($id);
    }

    public function detallelibro(Request $request, $id)
    {
        $libros = Libros::find($id);
        return view('admin.infoli', compact('libros'));
    }
}
