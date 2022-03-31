<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleDevoluciones extends Model
{
    //
    protected $table = "detalles_devolucion";
    protected $primaryKey = "foliodetail";

    protected $with = ['devolucion','prestamo','libro','alumno','docente'];

    public $timestamps = false;

    protected $Fillable = [
        'foliodetail',
        'foliodevolucion',
        'folioprestamo',
        'isbn',
        'titulo',
        'cantidad',
        'id_prestador',
        'correo',
    ];

    public function devolucion(){
        return $this->belongsTo(Devoluciones::class, 'foliodevolucion', 'foliodevolucion');
    }

    public function prestamo(){
        return $this->belongsTo(Prestamos::class, 'folioprestamo', 'folioprestamo');
    }

    public function libro(){
        return $this->belongsTo(Libros::class, 'isbn', 'isbn');
    }

    public function alumno(){
        return $this->belongsTo(Alumnos::class,'id_prestador','matricula');
    }

    public function docente(){
        return $this->belongsTo(Docentes::class,'id_prestador','claves');
    }
}
