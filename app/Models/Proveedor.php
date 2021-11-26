<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = "proveedor";

    protected $fillable = [
        'proveedor_codigo',
        'proveedor_tipo',
        'proveedor_rif',
        'proveedor_nombre',
        'proveedor_telefono',
        'proveedor_direccion',
        'proveedor_correo',
        'proveedor_contacto',
        'proveedor_estado',
        'suministro_id'
    ];

}
