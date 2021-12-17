<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    protected $table = 'ofertas';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre','id_tipo_oferta','tiempo_limite','estado']; 
}
