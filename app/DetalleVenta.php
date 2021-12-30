<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table = 'detalle_ventas';
    protected $primaryKey = 'id';
    protected $fillable = ['id_producto',
    'id_venta',
    'cantidad',
    'precio_venta',
    'oferta'
    
    ]; 
}
