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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Pendiente por crear permisos!!
        // if( $permisoUsuario[0]->ban != 1 ){
        //     return redirect()->route("home");
        // }

        // Se crea el codigo, dependiendo de que exista o no uno previo, se crea el codigo
        $codigo = Chequera::select("chequera_codigo")->orderBy("id", "desc")->first();
        //Si la variable codigo es mayor o igual a 1, ejecuta el conteo

        if(count( array($codigo) ) < 1){
            //Si es menor a 1
            $codigoChe = "CHE-1";
        } else {
            //Se extrae el numero y se le agrega un valor mas (xx + 1)
            preg_match_all('!\d+!', $codigo->chequera_codigo, $cod);
            $cod = $cod[0][0] + 1;
            $codigoChe = "CHE-".$cod;
        }

        //Se instanciará la clase donde se guardara la información
        $banco = new Chequera();
        // Se sustituyen los valores
        $banco->chequera_codigo = $codigoChe;
        $banco->cuenta_id = $request->dato;
        $banco->chequera_fecha = $request->fechaE;
        $banco->chequera_cantidadcheque = $request->nroCheque;
        $banco->chequera_correlativo = $request->correlativo;
        $banco->chequera_estado = 1;
        //Guardamos la nueva chequera
        $resp = $banco->save();
        //Retornamos la respuesta a la vista
        if ($resp) {
            return redirect()->route('chequera.index', $request->dato)->with('resp', $resp);
        } else {
            return redirect()->route('chequera.index', $request->dato)->with('resp', false);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Pendiente por crear permisos!!
        // if( $permisoUsuario[0]->ban != 1 ){
        //     return redirect()->route("home");
        // }
        // Consultamos los valores asociados a ese ID
        $chequera = Chequera::find( $id );
        // Retornamos todo lo traido por medio de json
        return response()->json($chequera);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //Pendiente por crear permisos!!
        // if( $permisoUsuario[0]->ban != 1 ){
        //     return redirect()->route("home");
        // }
        // Se buscan los datos asociados al ID
        $chequera = Chequera::find( $request->id );
        // Sustituir los valores
        $chequera->chequera_fecha = $request->fechaEMod;
        // $chequera->chequera_cantidadcheque = $request->nroChequeMod;
        $chequera->chequera_correlativo = $request->correlativoMod;
        //Guardamos la modificacion y retornamos segun el resultado
        $resp = $chequera->save();
        if ($resp) {
            return redirect()->route('chequera.index', $request->dato)->with('resp', $resp);
        } else {
            return redirect()->route('chequera.index', $request->dato)->with('resp', false);
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

        // if( $permisoUsuario[0]->solicitud != 1 ){
        //     return redirect()->route("home");
        // }
        //Se busca la informacion que esta asociado al id
        $chequera = Chequera::find( $request->id );
        // Se cambia el estado a deshabilitado
        $chequera->chequera_estado = 0;
        //Se guarda la informacion
        $resp = $chequera->save();
        //Retornamos la respuesta via json
        return response()->json( $resp );

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
        ->where('chequera.chequera_estado', 1)
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
