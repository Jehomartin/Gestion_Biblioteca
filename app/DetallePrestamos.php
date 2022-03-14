<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallePrestamos extends Model
{
    //
    protected $table = "detalle_prestamo";

    protected $primaryKey = "foliodetalle";

    protected $with = ['libros', 'prestamo', 'alumno'];

    public $timestamps = false;

    protected $Fillable = [
    	'foliodetalle',
    	'folioprestamo',
    	'isbn',
    	'titulo',
    	'devuelto',
    	'cantidad',
        'matricula',
        'claves',
        'correo'
    ];

    public function libros(){
        return $this->belongsTo(Libros::class,'isbn','isbn');
    }

    public function prestamo(){
        return $this->belongsTo(Prestamos::class,'folioprestamo','folioprestamo');
    }

    public function alumno(){
        return $this->belongsTo(Alumnos::class,'matricula','matricula');
    }

    public function docente(){
        return $this->belongsTo(Docentes::class,'claves','claves');
    }
}
