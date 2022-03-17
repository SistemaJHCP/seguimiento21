<?php

namespace App\Exports;

// use App\Models\Solicitud;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
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

// class ConciliacionExport implements FromCollection
class ConciliacionExport implements FromView
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //     return Solicitud::select("id AS Numeros totales")
    //     ->limit(3)->get();
    // }

    public function view(): View
    {
        return view('sistema.conciliacion.excel', [
            'conciliacion' => Solicitud::select("id")->limit(3)->get()
        ]);
    }


}
