<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = "solicitud";

    protected $fillable = [
        'solicitud_numerocontrol',
        'solicitud_fecha',
        'solicitud_tipo',
        'solicitud_tiposolicitud',
        'solicitud_iva',
        'solicitud_factura',
        'solicitud_motivo',
        'solicitud_observaciones',
        'solicitud_formapago',
        'solicitud_aprobacion',
        'solicitud_comentario',
        'solicitud_comentarior',
        'solicitud_contador',
        'solicitud_estadopago',
        'solicitud_comentariopago',
        'usuario_idÍndice',
        'obra_idÍndice',
        'proveedor_id',
        'banco_proveedor_id',
        'aprobador_id',
        'cotizacion_id',
        'requisicion_id'
    ];

}
