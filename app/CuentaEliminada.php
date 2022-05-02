<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuentaEliminada extends Model
{
    protected $table = 'cuentas_eliminadas';
    protected $primaryKey = 'id';
    protected $fillable = ['motivo','descripcion', 'sugerencia', 'acepto_terminos', 'id_user', 'was_email_send', 'email_url_date']; 
}
