<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
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

        if( $permisoUsuario[0]->cheque_emp != 1 ){
            return redirect()->route("home");
        }
        //Consultamos los datos de la chequera
        $chequera = Chequera::select(
            'chequera.id AS id',
            'chequera.chequera_codigo AS chequera_codigo',
            'chequera.chequera_correlativo AS chequera_correlativo',
            'chequera.chequera_cantidadcheque AS chequera_cantidadcheque',
             DB::raw('( SELECT COUNT(*) FROM cheque WHERE chequera_id = chequera.id AND cheque_estado IN (1,2) ) AS emitido'),
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
        //Si existe, creamos el numero siguiente
        if ($codigoActual) {
            $codigoSiguiente = $codigoActual->cheque_codigo + 1;
            //Creo un limite de cheques a permitir
            $limite = $chequera->chequera_correlativo + $chequera->chequera_cantidadcheque;
        } else {
            $codigoSiguiente = 0;
            $limite = 0;
        }

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->cheque_emp != 1 || $permisoUsuario[0]->crear_Cheque_emp != 1 ){
            return redirect()->route("home");
        }
        //Instanciamos la clase a ingresar los valores
        $cheque = new Cheque();
        //Agregamos la informacion captturada en la vista
        $cheque->cheque_codigo = $request->codigo;
        $cheque->cheque_destinatario = $request->destinatario;
        $cheque->cheque_monto = $request->monto;
        $cheque->cheque_fecha = $request->fecha;
        $cheque->cheque_estado = 1;
        $cheque->chequera_id = $request->chequeraId;
        //Guardar la informacion
        $resp = $cheque->save();
        //Envia la respuesta
        if ($resp) {
            return redirect()->route('cheque.index', $request->chequeraId)->with('resp', $resp);
        } else {
            return redirect()->route('cheque.index', $request->chequeraId)->with('resp', false);
        }



    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->cheque_emp != 1 || $permisoUsuario[0]->deshabilitar_Cheque_emp != 1 ){
            return redirect()->route("home");
        }

        //Se busca el cheque asociado al id
        $cheque = Cheque::find( $request->id );
        //Se cambia la informacion por anulada
        $cheque->cheque_monto = "0.00";
        $cheque->cheque_destinatario = "ANULADO";
        $cheque->cheque_estado = 0;
        $cheque->cheque_fecha = now();
        //Se guarda la modificacion
        $resp = $cheque->save();
        //Se retorna via json
        return response()->json( $resp );
    }


    public function jq_lista($id)
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->cheque_emp != 1 ){
            return redirect()->route("home");
        }

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

        // validamos que opciones maneja este usuario y dependiendo de esto, se muestra la informacion
        if ( $permisoUsuario[0]->cheque_emp == 1 && $permisoUsuario[0]->ver_boton_Cheque_emp == 1 ) {
            return datatables()->of($query)
            ->addColumn('btn','sistema.banco.cheques.btnCheque')
            ->addColumn('btn2','sistema.banco.cheques.btnEstado')
            ->rawColumns(['btn','btn2'])->toJson();
        } else {
            return datatables()->of($query)
            ->addColumn('btn','sistema.btnNull')
            ->addColumn('btn2','sistema.banco.cheques.btnEstado')
            ->rawColumns(['btn', 'btn2'])->toJson();
        }

    }


}
