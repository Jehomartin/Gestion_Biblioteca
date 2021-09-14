<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class paises extends Model
{
     //llamado de la tabla
    protected $table = "paises";

    //llamado de llave primaria
    protected $primaryKey = "id_pais";

    //incrementable o de tiempo;
    public $timestamps = false;

    //llamado resto datos
    public $Fillable = [
    	'id_pais',
    	'pais'
    ];
}
