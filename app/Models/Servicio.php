<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $table = "servicio";

    protected $fillable = [
        'servicio_codigo',
        'servicio_nombre',
        'servicio_estado'
    ];
}
