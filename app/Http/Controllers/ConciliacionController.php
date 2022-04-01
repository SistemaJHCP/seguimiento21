<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permiso;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ConciliacionExport;
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

class ConciliacionController extends Controller
{

    public function permisos($p)
    {
        //Se encarga de validar los permisos que se manejan en el sistema,
        //saber a que areas del sistema se puede ingresar
        $permiso = Permiso::select()->where('id', $p )->get();
        return $permiso;
    }

    public function index()
    {

        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->conciliacion != 1){
            return redirect()->route("home");
        }

        //Solicitamos la lista de obra
        $obra = Obra::select('id', 'obra_codigo', 'obra_nombre')->where('obra_estado', 1)->orderBy('id', 'DESC')->get();

        //Retornamos a la vista junto con las obras
        return view('sistema.conciliacion.index')->with([
            'permisoUsuario' => $permisoUsuario[0],
            'obra' => $obra
        ]);

    }



    public function imprimirConciliacion(Request $request)
    {
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->conciliacion != 1 || $permisoUsuario[0]->crear_conciliacion != 1){
            return redirect()->route("home");
        }
        //Crea un numero dandom
        $random = rand(0,100);
        //Este es el comando para imprimir en XLSX la informacion suministrada
        return Excel::download(new ConciliacionExport( $request ), 'JHCP_OBR-'.$request->obra.'_'.$request->inicial.'_'.$request->final.'_'. $random .'.xlsx');
    }


}
