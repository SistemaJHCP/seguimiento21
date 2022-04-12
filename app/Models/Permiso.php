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
        'ver_botones_usuario',
        'desactivar_usuario',
        'reactivar_usuario',
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
        'reactivar_ptc',
        'obra',
        'crear_obra',
        'modificar_obra',
        'ver_botones_obra',
        'desactivar_obra',
        'reactivar_obra',
        'materiales',
        'crear_materiales',
        'ver_botones_materiales',
        'desactivar_materiales',
        'proveedores',
        'crear_proveedores',
        'modificar_proveedores',
        'ver_botones_proveedores',
        'desactivar_proveedores',
        'reactivar_proveedores',
        'tipo',
        'crear_tipo',
        'modificar_tipo',
        'ver_botones_tipo',
        'desactivar_tipo',
        'personal',
        'crear_personal',
        'modificar_personal',
        'ver_botones_personal',
        'desactivar_personal',
        'reactivar_personal',
        'suministros',
        'crear_suministros',
        'modificar_suministros',
        'ver_botones_suministros',
        'desactivar_suministros',
        'reactivar_suministros',
        'banco',
        ' crear_banco',
        'desactivar_banco',
        'requisicion',
        'crear_requisicion',
        'modificar_requisicion',
        'ver_botones_requisicion',
        'anular_requisicion',
        'solicitud',
        'crear_solicitud',
        'modificar_solicitud',
        'ver_botones_solicitud',
        'anular_solicitud',
        'nomina_solicitud_opcion',
        'material_solicitud_opcion',
        'servicio_solicitud_opcion',
        'viatico_solicitud_opcion',
        'nomina_solicitud',
        'materiales_solicitud',
        'servicio_solicitud',
        'viatico_solicitud',
        'solicitud_pago',
        'ver_solicitud_pago',
        'aprobacion_solicitud_pago',
        'servicio',
        'crear_servicio',
        'ver_botones_servicio',
        'desactivar_servicio',
        'viatico',
        'crear_viatico',
        'ver_botones_viatico',
        'desactivar_viatico',
        'compra_cuentas_x_pagar',
        'aproRepro_compra_cuentas_x_pagar',
        'ver_botones_compra_cuentas_x_pagar',
        'reactivar_compra_cuentas_x_pagar',
        'conciliacion',
        'crear_conciliacion',
        'configuracion_btn',
        'maestro_btn',
        'control_de_obras_btn',
        'cuentas_por_pagar_btn'
    ];

    public function usuario()
    {
        return $this->hasOne('App\Models\User');
    }



}
