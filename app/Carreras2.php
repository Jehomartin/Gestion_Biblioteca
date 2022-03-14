<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carreras2 extends Model
{
    //
    protected $table = "carreras2";

    protected $primaryKey = "clave_carrera";

    public $timestamps = false;
    public $incrementing = false;

    protected $Fillable = [
        'clave_carrera',
        'nombre_carrera'
    ];
}
