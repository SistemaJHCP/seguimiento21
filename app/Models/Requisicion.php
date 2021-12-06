<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisicion extends Model
{
    use HasFactory;

    protected $table = "requisicion";

    protected $fillable = [
        'requisicion_codigo',
        'requisicion_tipo',
        'requisicion_fecha',
        'requisicion_fechae',
        'requisicion_motivo',
        'requisicion_direccion',
        'requisicion_observaciones',
        'requisicion_estado',
        'requisicion_comentario',
        'obra_observaciones',
        'requisicion_solicitud',
        'usuario_idÍndice',
        'usuario_view_id',
        'obra_id',
        'proveedor_id',
        'aprobador_id'
    ];

}
