<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;

    protected $table = "permisos";

    protected $fillable = [
        'nombre_permiso',
        'usuario',
        'crear_usuario',
        'modificar_usuario',
        'ver_usuario',
        'eliminar_usuario',
        'cliente',
        'crear_cliente',
        'modificar_cliente',
        'ver_botones_cliente',
        'desactivar_cliente',
        'reactivar_cliente',
        'ptc',
        'crear_ptc',
        'modificar_ptc',
        'ver_botones_ptc',
        'desactivar_ptc',
        'reactivar_ptc'
    ];

    public function usuario()
    {
        return $this->hasOne('App\Models\User');
    }



}
