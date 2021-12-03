<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ejemplares extends Model
{
    //
        //llamado de la tabla
    protected $table = "ejemplares";

    //llamado de llave primaria
    protected $primaryKey = "id_ejemplar";

    //union con llaves foraneas
   protected $with=['libro'];

    //incrementable o de tiempo;
    public $incrementing = false;
    public $timestamps = false;

    //llamado resto datos
    protected $Fillable = [
    	'id_ejemplar',
        'folio',
        'esbase',
        'prestado',
        'comentario',
        'consec',
        'fecha_alta',
        'solodewee',
        'deweecompleto'
    ];

    public function libro(){
        return $this->belongsTo(Libros::class,'folio','folio');
    }
}
