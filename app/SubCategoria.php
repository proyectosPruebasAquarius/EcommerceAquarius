<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategoria extends Model
{
   protected $table = 'sub_categorias';
   protected $primaryKey = 'id';
   protected $fillable = ['nombre','id_categoria']; 
}
