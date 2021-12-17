<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre',
    'direccion',
    'telefono',
    'nombre_contacto',
    'tel_contacto',
    'estado'
    ]; 
}
