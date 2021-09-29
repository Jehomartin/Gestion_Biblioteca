<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Librous extends Model
{

    //llamado de la tabla
    protected $table = "libros";

    //llamado de llave primaria
    protected $primaryKey = "isbn";

    //union con llaves foraneas
    protected $with=['autors','editorials','carreras','paiss',];

    //incrementable o de tiempo;
    public $incrementing = false;
    public $timestamps = false;

    //llamado resto datos
    protected $Fillable = [
        'isbn',
        'folio',
        'titulo',
        'id_editorial',
        'id_autor',
        'edicion',
        'anio_pub',
        'fecha_alta',
        'id_carrera',
        'paginas',
        'id_pais',
        'ejemplares',
        'clasificacion',
        'cutter'
    ];

    public function autors(){
        return $this->belongsTo(Autores::class,'id_autor','id_autor');
    }

    public function editorials(){
        return $this->belongsTo(Editoriales::class,'id_editorial','id_editorial');
    }

    public function carreras(){
        return $this->belongsTo(Carreras::class,'id_carrera','id_carrera');
    }
    public function paiss(){
        return $this->belongsTo(paises::class,'id_pais','id_pais');
    }

}
