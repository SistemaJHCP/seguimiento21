<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banco;
use App\Models\Permiso;
use App\Models\Proveedor;

class BancoController extends Controller
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
        //
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
        dd( $request->all() );
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



    public function consultar($id)
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->banco != 1 || $permisoUsuario[0]->ver_botones_banco != 1 ){
            return redirect()->route("home");
        }

        //Se buscan los datos del proveedor a vincular su cuenta bancaria
        $pro = Proveedor::find($id);

        //Seleccionar banco
        $b = Banco::select('id', 'banco_nombre')->get();

        $banco = Banco::select(
            'banco_proveedor.id AS id',
            'banco_proveedor.proveedor_id',
            'banco.banco_rif AS banco_rif',
            'banco.banco_nombre AS banco_nombre',
            'banco_proveedor.numero AS numero',
            'banco_proveedor.tipodecuenta AS tipodecuenta'
        )
        ->leftJoin('banco_proveedor', 'banco_proveedor.banco_id', '=', 'banco.id')
        ->where('banco_proveedor.proveedor_id', $id)
        ->get();

        //Se agrega la informacion capturada previamente a la vista
        return view('sistema.proveedor.cuenta.cuenta')->with( ['permisoUsuario'=> $permisoUsuario[0], 'pro' => $pro, 'banco' => $banco, 'bancos' => $b, 'dato' => $id] );

    }

    public function jq_desactivar(Request $request)
    {
        dd($request->all());
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->banco != 1 || $permisoUsuario[0]->desactivar_banco != 1 ){
            return redirect()->route("home");
        }

        //Buscamos el numero de cuenta por ID
        $cuenta = Banco::find($request->id);



    }








}
