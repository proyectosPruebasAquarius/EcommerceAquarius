<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatoVenta extends Model
{
    protected $table = 'datos_ventas';
    protected $primaryKey = 'id';
    protected $fillable = ['numero','imagen', 'id_venta']; 
}
