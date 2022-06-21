<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valuacion extends Model
{
    use HasFactory;

    protected $table = "valuacion";

    protected $fillable = [
        'valuacion_monto',
        'observacion',
        'valuacion_fecha',
        'obra_id'
    ];
}
