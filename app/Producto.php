<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
   protected $primaryKey = 'id';
   protected $fillable = [
       'nombre',
       'imagen',
       'descripcion',
       'id_proveedor',
       'id_marca',
       'id_categoria',
       'id_subcat',
       'imagen_principal'
    ];
}
