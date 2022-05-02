<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EncargadoRetiro extends Model
{
    protected $table = 'encargados_retiros';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre','DUI']; 
}
