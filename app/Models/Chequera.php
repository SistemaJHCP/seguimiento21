<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chequera extends Model
{
    protected $table = "chequera";

    protected $fillable = [
        'chequera_codigo',
        'chequera_fecha',
        'chequera_cantidadcheque',
        'chequera_correlativo',
        'chequera_estado'
    ];
}
