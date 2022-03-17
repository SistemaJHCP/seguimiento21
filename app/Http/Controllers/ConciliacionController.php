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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->solicitud != 1){
            return redirect()->route("home");
        }

        //Solicitamos la lista de obra
        $obra = Obra::select('id', 'obra_codigo', 'obra_nombre')->where('obra_estado', 1)->orderBy('id', 'DESC')->get();


        return view('sistema.conciliacion.index')->with([
            'permisoUsuario' => $permisoUsuario[0],
            'obra' => $obra
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function imprimirConciliacion()
    {
        return Excel::download(new ConciliacionExport, 'nombe-de-excel.xlsx');
    }


}
