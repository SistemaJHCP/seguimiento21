<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = "pago";

    protected $fillable = [
        'pago_fecha',
        'pago_formapago',
        'pago_numerocomprobante',
        'pago_monto',
        'pago_descripcion',
        'pago_estado',
        'orden_compra_id',
        'solicitud_id',
        'cuenta_id',
        'cheque_id'
    ];

}
