<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cheque extends Model
{
    use HasFactory;
    protected $table = "cheque";

    protected $fillable = [
        'cheque_codigo',
        'cheque_monto',
        'cheque_destinatario',
        'cheque_fecha',
        'cheque_estado',
        'chequera_id'
    ];
}