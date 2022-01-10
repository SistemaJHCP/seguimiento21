<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud_detalle extends Model
{
    use HasFactory;

    protected $table = "solicitud_detalle";

    protected $fillable = [
        'sd_cantidad',
        'sd_preciounitario',
        'sd_caracteristicas',
        'solicitud_id',
        'requisicion_id',
        'caja_id',
        'nomina_id',
        'material_id',
        'servicio_id',
        'viatico_id'
    ];

}
