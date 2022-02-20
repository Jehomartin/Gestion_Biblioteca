<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestamos extends Model
{
    //llamdo de la tabla
    protected $table = "nota_prestamos";

    //llamdo de llave primaria
    protected $primaryKey = "folioprestamo";

    //declaracion de la union con otra tabla
    protected $with=['alumno'];

    //especificado de incrementable o tiempo
    public $timestamps = false;
    public $incrementing = false;

    //llamado del resto de datos
    protected $Fillable = [
    	'folioprestamo',
    	'fechaprestamo',
        'fechadevolucion',
        'matricula',
        'correo'
    ];

    public function alumno(){
        return $this->belongsTo(Alumnos::class,'matricula','matricula');
    }
}
