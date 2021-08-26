<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carreras extends Model
{
    //llamado de la tabla
    protected $table = "carreras";

    //llamado de llave primaria
    protected $primaryKey = "id_carrera";

    //incrementable o de tiempo;
    public $timestamps = false;

    //llamado resto datos
    protected $Fillable = [
    	'id_carrera',
        'carrera',
    ];
}
