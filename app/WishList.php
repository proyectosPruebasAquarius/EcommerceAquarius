<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    protected $table = 'wishlists';
    protected $primaryKey = 'id';
    protected $fillable = ['id_user', 'id_producto']; 
}
