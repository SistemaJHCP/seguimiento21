<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viatico extends Model
{
    use HasFactory;

    protected $table = "viatico";

    protected $fillable = [
        'viatico_codigo',
        'viatico_nombre',
        'viatico_estado'
    ];
}
