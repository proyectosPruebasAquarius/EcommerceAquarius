<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StackService extends Model
{
    protected $table = 'track_services';
    protected $primaryKey = 'id';
    protected $fillable = ['ip', 'user_agent', 'fecha']; 
}
