<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = "cliente";

    protected $fillable = [
        'cliente_codigo',
        'cliente_rif',
        'cliente_nombre',
        'cliente_telefono',
        'cliente_direccion',
        'cliente_correo',
        'cliente_estado'
    ];

}
