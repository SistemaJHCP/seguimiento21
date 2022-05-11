<?php

namespace App\Exports;

// use App\Models\Solicitud;

use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
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

class ConciliacionExport implements  FromView, WithTitle
// class ConciliacionExport implements FromQuery
{

    public function __construct($request)
    {

        $this->inicial = $request->inicial;
        $this->final = $request->final;
        $this->obra = $request->obra;
        $this->estado = $request->estado;

    }

    public function title(): string
    {
        return 'Control de gasto';
    }


    public function view(): View
    {

        if($this->inicial == ""){
            $fechaInicial = 2000-01-01;
        } else {
            $fechaInicial = $this->inicial;
        }

        if($this->final == ""){
            $fechaFinal = date('Y-m-d');
        } else {
            $fechaFinal = $this->final;
        }


        if ($this->obra) {

            return view('sistema.conciliacion.excel', [
                    'conciliacion' => Solicitud::select(
                        "solicitud.solicitud_numerocontrol AS solicitud_numerocontrol",
                        "solicitud.solicitud_fecha AS solicitud_fecha",
                        "solicitud.solicitud_motivo AS solicitud_motivo",
                        "obra.obra_nombre AS obra_nombre",
                        "users.user_name AS nombre",
                        "solicitud_detalle.sd_cantidad AS cantidad",
                        "solicitud_detalle.sd_preciounitario AS preciounitario",
                        "material.material_nombre AS material_nombre",
                        "nomina.nomina_nombre AS nomina_nombre",
                        "caja.caja_nombre AS caja_nombre",
                        "servicio.servicio_nombre AS servicio_nombre",
                        "viatico.viatico_nombre AS viatico_nombre",
                        "solicitud_detalle.moneda AS moneda",
                        "solicitud.solicitud_estadopago AS solicitud_estadopago",
                        "pago.pago_fecha AS pago_fecha",
                        "pago.pago_formapago AS pago_formapago",
                        "pago.pago_numerocomprobante AS pago_numerocomprobante",
                        "pago.pago_monto AS pago_monto",
                        "pago.pago_descripcion AS pago_descripcion",
                        "cuenta.cuenta_tipo AS cuenta_tipo",
                        "banco.banco_nombre AS banco_nombre"
                        )
                        ->leftJoin('solicitud_detalle', 'solicitud_detalle.solicitud_id', '=', 'solicitud.id')
                        ->leftJoin('material', 'material.id', '=', 'solicitud_detalle.material_id')
                        ->leftJoin('servicio', 'servicio.id', '=', 'solicitud_detalle.servicio_id')
                        ->leftJoin('viatico', 'viatico.id', '=', 'solicitud_detalle.viatico_id')
                        ->leftJoin('nomina', 'nomina.id', '=', 'solicitud_detalle.nomina_id')
                        ->leftJoin('caja', 'caja.id', '=', 'solicitud_detalle.caja_id')
                        ->leftJoin('obra', 'obra.id', '=', 'solicitud.obra_id')
                        ->leftJoin('users', 'users.id', '=', 'solicitud.usuario_id')
                        ->leftJoin('pago', 'pago.solicitud_id', '=', 'solicitud.id')
                        ->leftJoin('cuenta', 'cuenta.id', '=', 'pago.cuenta_id')
                        ->leftJoin('banco', 'banco.id', '=', 'cuenta.banco_id')
                        ->whereBetween('solicitud.solicitud_fecha', [$fechaInicial , $fechaFinal])
                        ->where('obra.id', $this->obra)
                        ->whereIn('solicitud.solicitud_aprobacion', ['Aprobada'])
                        ->where('solicitud.solicitud_estadopago', $this->estado)
                    ->get()

            ]);
        } else {

            $rev = Solicitud::select(
                "solicitud.solicitud_numerocontrol AS solicitud_numerocontrol",
                "solicitud.solicitud_fecha AS solicitud_fecha",
                "solicitud.solicitud_motivo AS solicitud_motivo",
                "obra.obra_nombre AS obra_nombre",
                "users.user_name AS nombre",
                "solicitud_detalle.sd_cantidad AS cantidad",
                "solicitud_detalle.sd_preciounitario AS preciounitario",
                "material.material_nombre AS material_nombre",
                "nomina.nomina_nombre AS nomina_nombre",
                "caja.caja_nombre AS caja_nombre",
                "servicio.servicio_nombre AS servicio_nombre",
                "viatico.viatico_nombre AS viatico_nombre",
                "solicitud_detalle.moneda AS moneda",
                "solicitud.solicitud_estadopago AS solicitud_estadopago",
                "pago.pago_fecha AS pago_fecha",
                "pago.pago_formapago AS pago_formapago",
                "pago.pago_numerocomprobante AS pago_numerocomprobante",
                "pago.pago_monto AS pago_monto",
                "pago.pago_descripcion AS pago_descripcion",
                "cuenta.cuenta_tipo AS cuenta_tipo",
                "banco.banco_nombre AS banco_nombre"
                )
                ->leftJoin('solicitud_detalle', 'solicitud_detalle.solicitud_id', '=', 'solicitud.id')
                ->leftJoin('material', 'material.id', '=', 'solicitud_detalle.material_id')
                ->leftJoin('servicio', 'servicio.id', '=', 'solicitud_detalle.servicio_id')
                ->leftJoin('viatico', 'viatico.id', '=', 'solicitud_detalle.viatico_id')
                ->leftJoin('nomina', 'nomina.id', '=', 'solicitud_detalle.nomina_id')
                ->leftJoin('caja', 'caja.id', '=', 'solicitud_detalle.caja_id')
                ->leftJoin('obra', 'obra.id', '=', 'solicitud.obra_id')
                ->leftJoin('users', 'users.id', '=', 'solicitud.usuario_id')
                ->leftJoin('pago', 'pago.solicitud_id', '=', 'solicitud.id')
                ->leftJoin('cuenta', 'cuenta.id', '=', 'pago.cuenta_id')
                ->leftJoin('banco', 'banco.id', '=', 'cuenta.banco_id')
                ->whereBetween('solicitud.solicitud_fecha', [$fechaInicial , $fechaFinal])
                ->whereIn('solicitud.solicitud_aprobacion', ['Aprobada'])
                ->where('solicitud.solicitud_estadopago', $this->estado)
            ->get();
            dd($rev);


            return view('sistema.conciliacion.excel', [
                'conciliacion' => Solicitud::select(
                    "solicitud.solicitud_numerocontrol AS solicitud_numerocontrol",
                    "solicitud.solicitud_fecha AS solicitud_fecha",
                    "solicitud.solicitud_motivo AS solicitud_motivo",
                    "obra.obra_nombre AS obra_nombre",
                    "users.user_name AS nombre",
                    "solicitud_detalle.sd_cantidad AS cantidad",
                    "solicitud_detalle.sd_preciounitario AS preciounitario",
                    "material.material_nombre AS material_nombre",
                    "nomina.nomina_nombre AS nomina_nombre",
                    "caja.caja_nombre AS caja_nombre",
                    "servicio.servicio_nombre AS servicio_nombre",
                    "viatico.viatico_nombre AS viatico_nombre",
                    "solicitud_detalle.moneda AS moneda",
                    "solicitud.solicitud_estadopago AS solicitud_estadopago",
                    "pago.pago_fecha AS pago_fecha",
                    "pago.pago_formapago AS pago_formapago",
                    "pago.pago_numerocomprobante AS pago_numerocomprobante",
                    "pago.pago_monto AS pago_monto",
                    "pago.pago_descripcion AS pago_descripcion",
                    "cuenta.cuenta_tipo AS cuenta_tipo",
                    "banco.banco_nombre AS banco_nombre"
                    )
                    ->leftJoin('solicitud_detalle', 'solicitud_detalle.solicitud_id', '=', 'solicitud.id')
                    ->leftJoin('material', 'material.id', '=', 'solicitud_detalle.material_id')
                    ->leftJoin('servicio', 'servicio.id', '=', 'solicitud_detalle.servicio_id')
                    ->leftJoin('viatico', 'viatico.id', '=', 'solicitud_detalle.viatico_id')
                    ->leftJoin('nomina', 'nomina.id', '=', 'solicitud_detalle.nomina_id')
                    ->leftJoin('caja', 'caja.id', '=', 'solicitud_detalle.caja_id')
                    ->leftJoin('obra', 'obra.id', '=', 'solicitud.obra_id')
                    ->leftJoin('users', 'users.id', '=', 'solicitud.usuario_id')
                    ->leftJoin('pago', 'pago.solicitud_id', '=', 'solicitud.id')
                    ->leftJoin('cuenta', 'cuenta.id', '=', 'pago.cuenta_id')
                    ->leftJoin('banco', 'banco.id', '=', 'cuenta.banco_id')
                    ->whereBetween('solicitud.solicitud_fecha', [$fechaInicial , $fechaFinal])
                    ->whereIn('solicitud.solicitud_aprobacion', ['Aprobada'])
                    ->where('solicitud.solicitud_estadopago', $this->estado)
                ->get()

            ]);
        }




    }



}
