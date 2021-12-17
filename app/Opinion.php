<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    protected $table = 'opiniones';
    protected $primaryKey = 'id';
    protected $fillable = [
        'descripcion',
        'id_usuario',
        'titulo',
        'puntuacion'
        ];
}
