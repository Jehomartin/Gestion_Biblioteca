<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caratulas extends Model
{
    //
    protected $table = "caratulas";

    protected $primaryKey = "id_caratula";

    protected $with = ['libro'];

    public $timestamps = false;

    protected $Fillable = [
        'id_caratula',
        'caratula',
        'isbn'
    ];

    public function libro(){
        return $this->belongsTo(Libros::class, 'isbn' , 'isbn');
    }
}
