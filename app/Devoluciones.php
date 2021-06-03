<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Devoluciones extends Model
{
    //llamdo de la tabla
    protected $table = "devoluciones";

    //llamdo de llave primaria
    protected $primaryKey = "foliodevolucion";

    //union con llaves foraneas (funcion join)
    protected $with=['prestamo'];

    //especificado de incrementable o tiempo
    public $timestamps = false;
    public $incrementing = false;

    //llamado del resto de datos
    protected $Fillable = [
    	'foliodevolucion',
        'folioprestamo',
    	'clasificación',
        'devuelto',
        'consec'
    ];

    public function prestamo(){
        return $this->belongsTo(Prestamos::class,'folioprestamo','folioprestamo');
    }
}
