<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permiso;
use App\Models\Chequera;
use App\Models\Cheque;

class ChequeController extends Controller
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
        //Consultamos los datos de la chequera
        $chequera = Chequera::select(
            'chequera.id AS id',
            'chequera.chequera_codigo AS chequera_codigo',
            'chequera.chequera_correlativo AS chequera_correlativo',
            'chequera.chequera_cantidadcheque AS chequera_cantidadcheque',
            'cuenta.id AS id_cuenta',
            'cuenta.cuenta_numero AS cuenta_numero',
            'cuenta.cuenta_tipo AS cuenta_tipo',
            'banco.banco_nombre AS banco_nombre',
            'banco.banco_rif AS banco_rif'
        )
        ->leftJoin('cuenta', 'cuenta.id', '=', 'chequera.cuenta_id')
        ->leftJoin('banco', 'banco.id', '=', 'cuenta.banco_id')
        ->where('chequera.id', $id)
        ->first();
        //Consultamos el ultimo numero del cheque que hay
        $codigoActual = Cheque::select('cheque_codigo')->where('chequera_id', $id)->orderBy('id', 'DESC')->first();
        //Creamos el numero siguiente
        $codigoSiguiente = $codigoActual->cheque_codigo + 1;
        dump($codigoSiguiente);
        //Creo un limite de cheques a permitir
        $limite = $chequera->chequera_correlativo + $chequera->chequera_cantidadcheque;

        //Retorna a la vista principal de bancos
        return view('sistema.banco.cheques.index')->with([
            'permisoUsuario' => $permisoUsuario[0],
            'chequera' => $chequera,
            'codigoActual' => $codigoActual,
            'codigoSiguiente' => $codigoSiguiente,
            'limite' => $limite,
            'id' => $id
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


    public function jq_lista($id)
    {

        //Validamos los permisos
        // $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        // if( $permisoUsuario[0]->solicitud != 1 ){
        //     return redirect()->route("home");
        // }

        //Realizamos la consulta a la base de datos

        $query = Cheque::select(
            'cheque.id AS id',
            'cheque.cheque_codigo AS cheque_codigo',
            'cheque.cheque_monto AS cheque_monto',
            'cheque.cheque_destinatario AS cheque_destinatario',
            'cheque.cheque_fecha AS cheque_fecha',
            'cheque.cheque_estado AS cheque_estado',
            'chequera.chequera_codigo AS chequera_codigo'
        )
        ->leftJoin('chequera','chequera.id','=','cheque.chequera_id')
        ->where('cheque.chequera_id', $id)
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
            ->addColumn('btn','sistema.banco.cheques.btnCheque')
            ->addColumn('btn2','sistema.banco.cheques.btnEstado')
            ->rawColumns(['btn', 'btn2'])->toJson();
        // }

    }


}
