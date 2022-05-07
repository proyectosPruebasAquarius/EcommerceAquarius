<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    public $timestamps = false;
    protected $table = 'pedidos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_venta',
        'preparacion',
        'revicion',
        'envio',
        'entregado',
        'fecha_entrega'
        ];
}
