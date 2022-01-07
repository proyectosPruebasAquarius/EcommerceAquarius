<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistorialInventario extends Model
{
    protected $table = 'historial_inventarios';
    protected $primaryKey = 'id';
    protected $fillable = [
        'precio_compra',
        'precio_venta',
        'stock',
        'id_producto',
        'min_stock',
        'created_at'
        ];
}
