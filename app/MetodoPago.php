<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
    protected $table = 'metodos_pagos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'qr',
        'numero',
        'cuenta_asociado',
        'estado'
        ];
}
