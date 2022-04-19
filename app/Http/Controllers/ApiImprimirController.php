<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\RouteServiceProvider;
use Illuminate\Routing\RouteCollection;

use Codedge\Fpdf\Fpdf\Fpdf;

// uso de los modelos
use App\DetallePrestamos;
use DB;

class ApiImprimirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $detalles = DetallePrestamos::where('foliodetalle',$id)->get(['foliodetalle','folioprestamo','isbn','titulo','id_prestador','correo']);
        // se crea el documento nuevo
        $pdf = new Fpdf('L','mm','A4');
        // se agrega la pagina
        $pdf->AddPage();

        // se indica la fuente
        $pdf->SetFont('Arial','',10);

         //se crea el encabezado del documento
        $pdf->cell(50,8,utf8_decode(''),0,0,'L');
        $pdf->cell(180,8,utf8_decode('UNIVERSIDAD TECNOLÓGICA DEL CENTRO'),0,0,'C');
        $pdf->cell(50,8,utf8_decode(''),0,1,'L');
        $pdf->cell(50,8,utf8_decode(''),0,0,'L');
        $pdf->cell(180,8,utf8_decode('2018 - 2021'),0,0,'C');
        $pdf->cell(50,8,utf8_decode(''),0,1,'L');
        $pdf->cell(50,8,utf8_decode(''),0,0,'L');
        $pdf->cell(180,8,utf8_decode('SISTEMA DE GESTIÓN Y CONTROL DE PRESTAMOS'),'B',0,'C');
        $pdf->cell(50,8,utf8_decode(''),0,1,'L');

        //Se llaman y se anexan los escudos(imagenes)
        $pdf->image('img/utc.jpeg',8,5,25,25);
        $pdf->image('img/UTC.png',265,5,25,25);

        $pdf->Ln(10);

        //se va definiendo las carectiristicas de la fuente
        $pdf->SetFont('Arial','B',16);

        //se define el titulo del documento
        $pdf->cell(50,8,utf8_decode(''),0,0,'L');
        $pdf->cell(180,8,utf8_decode('TICKET DE PRESTAMO'),0,0,'C');
        $pdf->cell(50,8,utf8_decode(''),0,1,'L');

        $pdf->Ln(10);

        //se definen las características de las celdas
        $pdf->SetFont('Arial','B',14);
        $pdf->cell(50,8,utf8_decode(''),0,0,'C');
        $pdf->cell(50,8,utf8_decode('Datos'),1,0,'C');
        $pdf->cell(130,8,utf8_decode('Valores'),1,0,'C');
        $pdf->cell(50,8,utf8_decode(''),0,1,'C');

        // $pdf->cell(30,8,utf8_decode('FECHA DEV.'),1,1,'C');
        // $pdf->cell(40,8,utf8_decode('RESPONSABLE'),1,1,'C');

        $pdf->SetFont('Arial','',12);
        foreach ($detalles as $det) {
            $pdf->cell(50,8,utf8_decode(''),0,0,'C');
            $pdf->cell(50,8,utf8_decode('NO.'),1,0,'C');
            $pdf->cell(130,8,utf8_decode($det->foliodetalle),1,0,'C');
            $pdf->cell(50,8,utf8_decode(''),0,1,'C');
            // 
            $pdf->cell(50,8,utf8_decode(''),0,0,'C');
            $pdf->cell(50,8,utf8_decode('FOLIO'),1,0,'C');
            $pdf->cell(130,8,utf8_decode($det->folioprestamo),1,0,'C');
            $pdf->cell(50,8,utf8_decode(''),0,1,'C');
            // 
            $pdf->cell(50,8,utf8_decode(''),0,0,'C');
            $pdf->cell(50,8,utf8_decode('ISBN'),1,0,'C');
            $pdf->cell(130,8,utf8_decode($det->isbn),1,0,'C');
            $pdf->cell(50,8,utf8_decode(''),0,1,'C');
            // 
            $pdf->cell(50,8,utf8_decode(''),0,0,'C');
            $pdf->cell(50,8,utf8_decode('TITULO'),1,0,'C');
            $pdf->cell(130,8,utf8_decode($det->titulo),1,0,'C');
            $pdf->cell(50,8,utf8_decode(''),0,1,'C');
            // 
            $pdf->cell(50,8,utf8_decode(''),0,0,'C');
            $pdf->cell(50,8,utf8_decode('PRESTADOR'),1,0,'C');
            $pdf->cell(130,8,utf8_decode($det->id_prestador),1,0,'C');
            $pdf->cell(50,8,utf8_decode(''),0,1,'C');
            // 
            $pdf->cell(50,8,utf8_decode(''),0,0,'C');
            $pdf->cell(50,8,utf8_decode('CORREO'),1,0,'C');
            $pdf->cell(130,8,utf8_decode($det->correo),1,0,'C');
            $pdf->cell(50,8,utf8_decode(''),0,1,'C');
        }
        // $pdf->cell(30,8,utf8_decode($detalle->fechadevolucion),1,1,'C');

        $pdf->Ln(20);

        $pdf->Output('');
        exit;
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
