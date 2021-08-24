<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Editoriales extends Model
{
    //se llama la tabla con la que se trabajara.
    protected $table = "editoriales";

    //se indica la llave primaria
    protected $primaryKey = "id_editorial";

     //union con llaves foraneas
//    protected $with=['libro'];

    //se indica si es incrementable o de tiempo
    public $timestamps = false;
    public $incrementing = false;

    //se llama al resto de los atributos
    protected $Fillable = [
    	'id_editorial',
    	'editorial'
    ];

    // public function libro(){
    //     return $this->belongsTo(Libros::class,'id_editorial','id_editorial');
    // }
}
