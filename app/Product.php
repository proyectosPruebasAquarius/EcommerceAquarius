<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'productos';

    protected $primaryKey = 'id';

    /* protected $fillable = [
        'title', 'descripcion', 'id_usuario', 'rating', 'id_producto'
    ]; */
    
}
