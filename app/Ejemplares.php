<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ejemplares extends Model
{
    //
        //llamado de la tabla
    protected $table = "ejemplares";

    //llamado de llave primaria
    protected $primaryKey = "clasificacion";

    //union con llaves foraneas
   protected $with=['libro'];

    //incrementable o de tiempo;
    public $incrementing = false;
    public $timestamps = false;

    //llamado resto datos
    protected $Fillable = [
    	'clasificacion',
        'folio',
        'esbase',
        'prestado',
        'consec',
        'fecha_alta'
    ];

    public function libro(){
        return $this->belongsTo(Libros::class,'folio','folio');
    }
}
