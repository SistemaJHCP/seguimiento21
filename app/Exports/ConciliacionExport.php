<?php

namespace App\Exports;

// use App\Models\Solicitud;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Solicitud;
use App\Models\Obra;
use App\Models\Proveedor;
use App\Models\Requisicion;
use App\Models\Material;
use App\Models\Servicio;
use App\Models\Nomina;
use App\Models\Viatico;
use App\Models\Banco;
use App\Models\Pago;
use App\Models\Banco_proveedor;
use App\Models\Solicitud_detalle;
use App\Models\User;
use App\Models\Cuenta;

class ConciliacionExport implements  FromView
// class ConciliacionExport implements FromQuery
{

    public function __construct($request)
    {

        $this->inicial = $request->inicial;
        $this->final = $request->final;
        $this->obra = $request->obra;
        $this->estado = $request->estado;
        // dd($request->all());
    }


    // public function collection()
    // {

    //     $query = Solicitud::select(
    //         "solicitud.solicitud_numerocontrol AS solicitud_numerocontrol",
    //         "solicitud.solicitud_fecha AS solicitud_fecha",
    //         "solicitud.solicitud_motivo AS solicitud_motivo",
    //         "obra.obra_nombre AS obra_nombre",
    //         "solicitud_detalle.sd_cantidad AS cantidad",
    //         "solicitud_detalle.sd_preciounitario AS preciounitario",
    //         "material.material_nombre AS material_nombre",
    //         "nomina.nomina_nombre AS nomina_nombre",
    //         "servicio.servicio_nombre AS servicio_nombre",
    //         "viatico.viatico_nombre AS viatico_nombre",
    //         "solicitud_detalle.moneda AS moneda",
    //         "solicitud.usuario_id AS usuario_id"
    //         )
    //         ->leftJoin('solicitud_detalle', 'solicitud_detalle.solicitud_id', '=', 'solicitud.id')
    //         ->leftJoin('material', 'material.id', '=', 'solicitud_detalle.material_id')
    //         ->leftJoin('servicio', 'servicio.id', '=', 'solicitud_detalle.servicio_id')
    //         ->leftJoin('viatico', 'viatico.id', '=', 'solicitud_detalle.viatico_id')
    //         ->leftJoin('nomina', 'nomina.id', '=', 'solicitud_detalle.nomina_id')
    //         ->leftJoin('obra', 'obra.id', '=', 'solicitud.obra_id')

    //         ->limit(3)->toSql();


    //     return Solicitud::select("id AS Numeros totales")->where('id', 20619)
    //     ->limit(3)->get();
    // }

    public function view(): View
    {

        $query = Solicitud::select(
            "solicitud.solicitud_numerocontrol AS solicitud_numerocontrol",
            "solicitud.solicitud_fecha AS solicitud_fecha",
            "solicitud.solicitud_motivo AS solicitud_motivo",
            "obra.obra_nombre AS obra_nombre",
            "solicitud_detalle.sd_cantidad AS cantidad",
            "solicitud_detalle.sd_preciounitario AS preciounitario",
            "material.material_nombre AS material_nombre",
            "nomina.nomina_nombre AS nomina_nombre",
            "servicio.servicio_nombre AS servicio_nombre",
            "viatico.viatico_nombre AS viatico_nombre",
            "solicitud_detalle.moneda AS moneda",
            "solicitud.usuario_id AS usuario_id"
            )
            ->leftJoin('solicitud_detalle', 'solicitud_detalle.solicitud_id', '=', 'solicitud.id')
            ->leftJoin('material', 'material.id', '=', 'solicitud_detalle.material_id')
            ->leftJoin('servicio', 'servicio.id', '=', 'solicitud_detalle.servicio_id')
            ->leftJoin('viatico', 'viatico.id', '=', 'solicitud_detalle.viatico_id')
            ->leftJoin('nomina', 'nomina.id', '=', 'solicitud_detalle.nomina_id')
            ->leftJoin('obra', 'obra.id', '=', 'solicitud.obra_id')
            // ->whereBetween('solicitud.solicitud_fecha', ['%'.$this->inicial.'%' , '%'.$this->final.'%'])
            ->where('obra.id', $this->obra)
            ->get();

        // dd($query);

        
        return view('sistema.conciliacion.excel', [
            'conciliacion' => $query = Solicitud::select(
                                "solicitud.solicitud_numerocontrol AS solicitud_numerocontrol",
                                "solicitud.solicitud_fecha AS solicitud_fecha",
                                "solicitud.solicitud_motivo AS solicitud_motivo",
                                "obra.obra_nombre AS obra_nombre",
                                "solicitud_detalle.sd_cantidad AS cantidad",
                                "solicitud_detalle.sd_preciounitario AS preciounitario",
                                "material.material_nombre AS material_nombre",
                                "nomina.nomina_nombre AS nomina_nombre",
                                "servicio.servicio_nombre AS servicio_nombre",
                                "viatico.viatico_nombre AS viatico_nombre",
                                "solicitud_detalle.moneda AS moneda",
                                "users.user_name AS user_name"
                                )
                                ->leftJoin('solicitud_detalle', 'solicitud_detalle.solicitud_id', '=', 'solicitud.id')
                                ->leftJoin('material', 'material.id', '=', 'solicitud_detalle.material_id')
                                ->leftJoin('servicio', 'servicio.id', '=', 'solicitud_detalle.servicio_id')
                                ->leftJoin('viatico', 'viatico.id', '=', 'solicitud_detalle.viatico_id')
                                ->leftJoin('nomina', 'nomina.id', '=', 'solicitud_detalle.nomina_id')
                                ->leftJoin('obra', 'obra.id', '=', 'solicitud.obra_id')
                                ->leftJoin('users', 'users.id', '=', 'solicitud.usuario_id')
                                // ->whereBetween('solicitud.solicitud_fecha', [$this->inicial , $this->final])
                                // ->where('obra.id', $this->obra)
                                ->limit(10)
                                ->get()

        ]);
    }



}
