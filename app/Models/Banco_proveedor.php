<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banco_proveedor extends Model
{
    use HasFactory;

    protected $table = "banco_proveedor";

    protected $fillable = [
        'banco_id',
        'proveedor_id',
        'tipodecuenta',
        'numero',
        'estado'
    ];

}
