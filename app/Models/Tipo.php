<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;

    protected $table = "";

    protected $fillable = [
        'tipo_codigo',
        'tipo_nombre',
        'tipo_estado'
    ];

}
