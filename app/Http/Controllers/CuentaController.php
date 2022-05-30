<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permiso;
use App\Models\Cuenta;
use App\Models\Banco;

class CuentaController extends Controller
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

        if( $permisoUsuario[0]->cuenta_emp != 1 ){
            return redirect()->route("home");
        }

        $banco = Banco::select('id','banco_nombre')->get();

        //Retorna a la vista principal de bancos
        return view('sistema.banco.cuenta_empresa.index')->with([
            'permisoUsuario' => $permisoUsuario[0],
            'banco_nombres'=> $banco
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

        if( $permisoUsuario[0]->cuenta_emp != 1 ||  $permisoUsuario[0]->crear_cuenta_emp != 1 ){
            return redirect()->route("home");
        }

        //Validamos que el formulario este correctamente cargado
        $request->validate([
            'tipo_cuenta' => 'required',
            'num_cuenta' => 'required|max:20',
            'monto_inicial' => 'required|max:14'
        ]);

        //Instanciamos la clase cuenta
        $cuenta = new Cuenta();
        // Ingresamos los valores
        $cuenta->cuenta_tipo = $request->tipo_cuenta;
        $cuenta->cuenta_numero = $request->num_cuenta;
        $cuenta->cuenta_montoinicial = $request->monto_inicial;
        $cuenta->banco_id = $request->nombre_banco;

        //Guardamos en la BD
        $resp = $cuenta->save();
        if ($resp) {
            return redirect()->route('cuenta.index', $request->dato)->with('sum', true);
        } else {
            return redirect()->route('cuenta.index', $request->dato)->with('sum', false);
        }





    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->cuenta_emp != 1 ||  $permisoUsuario[0]->modificar_cuenta_emp != 1 ){
            dd("No cuenta con los permisos adecuados");
            return response()->json( false );
        }
        // Buscamos el valor a editar
        $cuenta = Cuenta::find( $request->valor );
        // Enviamos la informacion via json
        return response()->json( $cuenta );
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
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->cuenta_emp != 1 ||  $permisoUsuario[0]->modificar_cuenta_emp != 1 ){
            dd("No cuenta con los permisos adecuados");
            return response()->json( false );
        }

        //Validamos que el formulario este correctamente cargado
        $request->validate([
            'tipo_cuenta' => 'required',
            'num_cuenta' => 'required|max:20',
            'monto_inicial' => 'required|max:14'
        ]);

        //Instanciamos la clase cuenta
        $cuenta = Cuenta::find( $request->dato );
        // Ingresamos los valores
        $cuenta->cuenta_tipo = $request->tipo_cuenta;
        $cuenta->cuenta_numero = $request->num_cuenta;
        $cuenta->cuenta_montoinicial = $request->monto_inicial;
        $cuenta->banco_id = $request->nombre_banco;

        //Guardamos en la BD
        $resp = $cuenta->save();
        if ($resp) {
            return redirect()->route('cuenta.index', $request->dato)->with('sum', true);
        } else {
            return redirect()->route('cuenta.index', $request->dato)->with('sum', false);
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

        if( $permisoUsuario[0]->cuenta_emp != 1 ||  $permisoUsuario[0]->deshabilitar_cuenta_emp != 1 ){
            dd("No cuentan con los permisos");
            return response()->json( false );
        }
        //Buscamos la informacion asociada al ID
        $cuenta = Cuenta::find( $request->dato );
        // Cambiamos el estado de la solicitud a deshabilitada
        $cuenta->cuenta_estado = 0;
        // Guardamos la informacion en la base de datos
        $resp = $cuenta->save();
        // retornamos la informacion via json dependiendo si se guardo o no
        if($resp){
            return response()->json( true );
        } else {
            return response()->json( false );
        }

    }

    public function jq_lista()
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );
        //consultamos a la base de datos
        $query = Cuenta::select(
            'cuenta.id AS id',
            'cuenta.cuenta_tipo AS cuenta_tipo',
            'cuenta.cuenta_numero AS cuenta_numero',
            'cuenta.cuenta_montoinicial AS cuenta_montoinicial',
            'banco.banco_nombre AS banco_nombre'
        )
        ->leftJoin('banco', 'banco.id', '=', 'cuenta.banco_id')
        ->where('cuenta.cuenta_estado', 1)
        ->get();

        // validamos que opciones maneja este usuario y dependiendo de esto, se muestra la informacion
        if ($permisoUsuario[0]->cuenta_emp != 1 || $permisoUsuario[0]->ver_boton_cuenta_emp != 1) {
            return datatables()->of($query)
            ->addColumn('btn','sistema.btnNull')
            ->rawColumns(['btn'])->toJson();
        } else {
            return datatables()->of($query)
            ->addColumn('btn','sistema.banco.cuenta_empresa.btnCuenta')
            ->rawColumns(['btn'])->toJson();
        }
    }


}
