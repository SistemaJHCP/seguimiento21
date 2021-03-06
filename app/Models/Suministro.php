<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suministro extends Model
{
    use HasFactory;

    protected $table = "suministro";

    protected $fillable = [
        'suministro_codigo',
        'suministro_nombre',
        'suministro_estado'
    ];
}
