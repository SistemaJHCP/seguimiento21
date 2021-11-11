<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obra extends Model
{
    use HasFactory;

    protected $table = "obra";

    protected $fillable = [
        'obra_codigo',
        'obra_nombre',
        'obra_monto',
        'obra_montogasto',
        'obra_ganancia',
        'obra_fechainicio',
        'obra_fechafin',
        'obra_residente',
        'obra_coordinador',
        'obra_observaciones',
        'obra_estado',
        'cliente_id',
        'tipo_id',
        'codventa_id'
    ];

    public function personales()
    {
        return $this->belongsToMany('App\Models\Personal');
    }


}
