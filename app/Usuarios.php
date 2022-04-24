<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    //llamdo de la tabla con la que se trabajará
    protected $table="users";

    //llamado de la llave primaria
    protected $primaryKey="login";

    //especificado de autoincrementable o de tiempo
    public $incrementing = false;
    public $timestamps = false;

    //llamado del resto de datos
    protected $Fillable = [
    	'login',
        'pass',
    	'nombre',
    	'apellidos',
        'sexo',
        'edad',
        'telefono',
    	'nivel',
        'bloqueado',
    ];
}
