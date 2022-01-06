<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facturacion extends Model
{
    protected $table = 'direcciones_facturaciones';

    protected $primaryKey = 'id';

    protected $fillable = ['direccion','id_user','id_municipio', 'referencia'];
}
