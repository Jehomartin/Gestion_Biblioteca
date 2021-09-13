<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallePrestamos extends Model
{
    //
    protected $table = "detalle_prestamo";

    protected $primaryKey = "foliodetalle";

    protected $with = ['libros'];

    public $timestamps = false;

    protected $Fillable = [
    	'foliodetalle',
    	'folioprestamo',
    	'isbn',
    	'titulo',
    	'clasificacion',
    	'devuelto',
    	'consec',
    	'cantidad'
    ];

    public function libros(){
        return $this->belongsTo(Libros::class,'isbn','isbn');
    }

    public function detalles(){
        return $this->belongsTo(Prestamos::class,'folioprestamo','folioprestamo');
    }
}
