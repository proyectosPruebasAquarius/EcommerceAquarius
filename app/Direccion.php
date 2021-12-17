<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Direccion extends Model
{
    use SoftDeletes;
    
    protected $table = 'direcciones';

    protected $primaryKey = 'id';

    protected $fillable = ['direccion','first_name','last_name','email','telefono','id_user','id_municipio', 'facturacion', 'referencia'];
}
