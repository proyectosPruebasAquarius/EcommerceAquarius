<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table = 'inventarios';
    protected $primaryKey = 'id';
    protected $fillable = [
        'precio_compra',
        'precio_venta',
        'codigo',
        'stock',
        'id_producto',
        'min_stock',
        'precio_descuento'
        ];
}
