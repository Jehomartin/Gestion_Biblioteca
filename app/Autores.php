<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autores extends Model
{
    //se llama la tabla con la que se trabajara.
    protected $table = "autores";

    //se indica la llave primaria
    protected $primaryKey = "id_autor";

    //se indica si es incrementable o de tiempo
    public $timestamps = false;
    public $incrementing = false;

    //se llama al resto de los atributos
    protected $Fillable = [
    	'id_autor',
    	'nombre'
    ];
}
