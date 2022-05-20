<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Chequera;
use App\Models\Cheque;
use App\Models\Cuenta;
use App\Models\Permiso;

class ChequeraController extends Controller
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
    public function index($id)
    {


        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );
        //Pendiente por crear permisos!!
        // if( $permisoUsuario[0]->ban != 1 ){
        //     return redirect()->route("home");
        // }
        //se consulta los datos del banco seleccionado para mostrar en la vista
        $banco = Cuenta::select(
            'cuenta.id AS id',
            'cuenta.cuenta_tipo AS cuenta_tipo',
            'cuenta.cuenta_numero AS cuenta_numero',
            'cuenta.cuenta_montoinicial AS cuenta_montoinicial',
            'banco.banco_nombre AS banco_nombre',
            'banco.banco_rif AS banco_rif'
        )
        ->leftJoin('banco','banco.id', '=', 'cuenta.banco_id' )
        ->where('cuenta.id', $id)
        ->first();

        //Retorna a la vista principal de bancos
        return view('sistema.banco.chequera.index')->with([
            'permisoUsuario' => $permisoUsuario[0],
            'id' => $id,
            'banco' => $banco
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
        dd("wwwwww");
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

    public function jq_lista($id)
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        // if( $permisoUsuario[0]->solicitud != 1 ){
        //     return redirect()->route("home");
        // }

        //Realizamos la consulta a la base de datos

        $query = Chequera::select(
            'chequera.id',
            'chequera.chequera_codigo AS chequera_codigo',
            'chequera.chequera_fecha AS fecha',
            'chequera.chequera_cantidadcheque AS chequera_cantidadcheque',
            'chequera.chequera_correlativo AS chequera_correlativo',
            DB::raw('( SELECT COUNT(*) FROM cheque WHERE chequera_id = chequera.id AND cheque_estado IN (1,2) ) AS emitido'),
            DB::raw('( SELECT COUNT(*) FROM cheque WHERE chequera_id = chequera.id AND cheque_estado IN (0) ) AS anulado')
        )
        ->where('chequera.cuenta_id', $id)
        ->orderBy('id', 'DESC')
        ->get();

        // // validamos que opciones maneja este usuario y dependiendo de esto, se muestra la informacion
        // if ( $permisoUsuario[0]->solicitud == 1 && $permisoUsuario[0]->ver_botones_solicitud == 1) {
        //     return datatables()->of($query)
        //     ->addColumn('btn','sistema.solicitud.btnSolicitud')
        //     ->addColumn('btn2','sistema.solicitud.aprobacion.btnAproRepro')
        //     ->rawColumns(['btn','btn2'])->toJson();
        // } else {
            return datatables()->of($query)
            // ->addColumn('btn','sistema.btnNull')
            ->addColumn('btn','sistema.banco.chequera.btnChequera')
            ->rawColumns(['btn'])->toJson();
        // }
    }



}
