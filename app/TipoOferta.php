<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoOferta extends Model
{
    protected $table = 'tipos_ofertas';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre','estado']; 
}
