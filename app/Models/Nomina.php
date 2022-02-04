<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nomina extends Model
{
    use HasFactory;

    protected $table = "nomina";

    protected $fillable = [
        'nomina_codigo',
        'nomina_nombre',
        'nomina_estado'
    ];

}
