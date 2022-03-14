<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adeudos extends Model
{
    protected $table = "adeudos";

    protected $primaryKey = "id_adeudos";

    protected $with = ['alumno','multa','career'];

    // public $incrementing = false;
    public $timestamps = false;

    public $Fillable = [
        'id_adeudos',
        'matricula',
        'nombres',
        'apellidos',
        'clave_carrera',
        'dias_atraso',
        'id_multas',
        'total'
    ];

    public function alumno(){
        return $this->belongsTo(Alumnos::class,'matricula','matricula');
    }

    public function multa(){
        return $this->belongsTo(Multas::class,'id_multas','id_multas');
    }

    public function career(){
        return $this->belongsTo(Carreras2::class,'clave_carrera','clave_carrera');
    }
}
