<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumnos extends Model
{
    //se llama la tabla con la que se trabajara.
    protected $table = "alumnos";

    //se indica la llave primaria
    protected $primaryKey = "matricula";

    //se indica si es incrementable o de tiempo
    // public $timestamps = false;
    // public $incrementing = false;

    //se llama al resto de los atributos
    protected $Fillable = [
    	'matricula',
    	'nombre',
    	'apellidos',
    	'bloqueado'
    ];

}
