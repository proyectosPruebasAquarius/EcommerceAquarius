<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoProveedor extends Model
{
    protected $table = 'pedidos_proveedores';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_proveedor',
        'id_inventario',
        'cantidad',
        'precio',
        'fecha_entrega',
        'estado'
        ];
}
