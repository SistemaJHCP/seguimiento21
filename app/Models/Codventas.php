<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Codventas extends Model
{
    use HasFactory;

    protected $table = "codventa";

    protected $fillable = [
        'codventa_codigo',
        'codventa_nombre',
        'codventa_codigo2',
        'codventa_telefono',
        'codventa_direccion',
        'codventa_correo',
        'codventa_estado'
    ];

}
