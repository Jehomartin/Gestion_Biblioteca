<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Multas extends Model
{
    //
    protected $table = "multas";

    protected $primaryKey = "id_multas";

    public $timestamps = false;

    protected $Fillable = [
        'id_multas',
        'precio',
        'vigente',
    ];
}
