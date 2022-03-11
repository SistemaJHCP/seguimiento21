<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    use HasFactory;

    protected $table = "cuenta";

    protected $fillable = [
        'cuenta_tipo',
        'cuenta_numero',
        'cuenta_montoinicial',
        'cuenta_estado',
        'banco_id'
    ];
}
