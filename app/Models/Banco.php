<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    protected $table = "banco";

    protected $fillable = [
        'banco_rif',
        'banco_nombre',
        'banco_estado'
    ];
}
