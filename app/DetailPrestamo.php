<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPrestamo extends Model
{
    //
    protected $table = "detalle_prestamo";

    protected $primaryKey = "folioprestamo";

    protected $with = ['libros', 'prestamo', 'alumno','docente'];

    public $timestamps = false;

    protected $Fillable = [
        'foliodetalle',
        'folioprestamo',
        'isbn',
        'titulo',
        'devuelto',
        'cantidad',
        'id_prestador',
        'correo',
        'prst',
    ];

    public function libros(){
        return $this->belongsTo(Libros::class,'isbn','isbn');
    }

    public function prestamo(){
        return $this->belongsTo(Prestamos::class,'folioprestamo','folioprestamo');
    }

    public function alumno(){
        return $this->belongsTo(Alumnos::class,'id_prestador','matricula');
    }

    public function docente(){
        return $this->belongsTo(Docentes::class,'id_prestador','claves');
    }
}
