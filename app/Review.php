<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{

    use SoftDeletes;

    protected $table = 'opiniones';

    protected $primaryKey = 'id';

    protected $fillable = [
        'title', 'descripcion', 'id_usuario', 'rating', 'id_producto'
    ];

    protected $dates = ['deleted_at'];
}
