<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docentes extends Model
{
    //
    protected $table = "docentes";
    protected $primaryKey = "claves";

    public $timestamps = false;

    protected $Fillable = [
        'claves',
        'nombres',
        'apellidos',
        'email',
    ];
}
