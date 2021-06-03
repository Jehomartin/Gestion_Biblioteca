<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Editoriales extends Model
{
    //se llama la tabla con la que se trabajara.
    protected $table = "editoriales";

    //se indica la llave primaria
    protected $primaryKey = "id_editorial";

    //se indica si es incrementable o de tiempo
    public $timestamps = false;
    public $incrementing = false;

    //se llama al resto de los atributos
    protected $Fillable = [
    	'id_editorial',
    	'editorial'
    ];
}
