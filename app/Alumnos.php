<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumnos extends Model
{
    //se llama la tabla con la que se trabajara.
    protected $table = "alumnos";

    //se indica la llave primaria
    protected $primaryKey = "matricula";

    protected $with = ['carrera2'];

    //se indica si es incrementable o de tiempo
    // public $timestamps = false;
    // public $incrementing = false;

    //se llama al resto de los atributos
    protected $Fillable = [
    	'matricula',
    	'nombre',
    	'apellidos',
        'clave_carrera',
    	'bloqueado',
        'correo',
        'permiso'
    ];

    public function carrera2(){
        return $this->belongsTo(Carreras2::class,'clave_carrera','clave_carrera');
    }

}
