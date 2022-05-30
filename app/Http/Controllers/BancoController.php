<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banco;
use App\Models\Permiso;
use App\Models\Proveedor;
use App\Models\Banco_proveedor;

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
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->ban != 1 ){
            return redirect()->route("home");
        }

        //Retorna a la vista principal de bancos
        return view('sistema.banco.index')->with([
            'permisoUsuario' => $permisoUsuario[0]
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

        if($permisoUsuario[0]->banco != 1 || $permisoUsuario[0]->crear_banco != 1){
            return redirect()->route("home");
        }

        $request->validate([
            'banco' => 'required',
            'nroCuenta' => 'required|max:20',
            'dato' => 'required',
            'tipo' => 'required'
        ]);

        $banco = new Banco_proveedor();
        $banco->banco_id = $request->banco;
        $banco->proveedor_id = $request->dato;
        $banco->tipodecuenta = $request->tipo;
        $banco->numero = $request->nroCuenta;

        $resp = $banco->save();

        if ($resp) {
            return redirect()->route('proveedor.cuenta', $request->dato)->with('resp', 1);
        } else {
            return redirect()->route('proveedor.cuenta', $request->dato)->with('resp', 0);
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

        if($permisoUsuario[0]->ban != 1 || $permisoUsuario[0]->modificar_ban != 1){
            return redirect()->route("home");
        }

        // buscamos los valores relacionados a este banco
        $banco = Banco::find( $request->valor );
        // Retornamos la informacion a la vista mediante json
        return response()->json( $banco );
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

        if($permisoUsuario[0]->ban != 1 || $permisoUsuario[0]->modificar_ban != 1){
            return redirect()->route("home");
        }

        //Buscamos por el ID el valor del banco a modificar
        $banco = Banco::find( $request->dato );
        // sustituimos los valores
        $banco->banco_rif = $request->rif;
        $banco->banco_nombre = $request->nombreBanco;
        //Guardamos los valores
        $resp = $banco->save();

        //Retornamos a la vista la respuesta de este procedimiento
        return redirect()->route('banco.index')->with('sum', $resp);

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

        if( $permisoUsuario[0]->ban != 1 || $permisoUsuario[0]->deshabilitar_ban != 1 ){
            return response()->json(false);
        }

        //Ubicamos el banco por el numero ID
        $banco = Banco::find( $request->dato );
        // Cambiar el estado a deshabilitado
        $banco->banco_estado = 0;
        $resp = $banco->save();
        // Retorna a la vista la respuesta via json
        return response()->json($resp);

    }



    public function consultar($id)
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->banco != 1 || $permisoUsuario[0]->crear_banco != 1 ){
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
        ->where('estado', 1)
        ->get();

        //Se agrega la informacion capturada previamente a la vista
        return view('sistema.proveedor.cuenta.cuenta')->with( ['permisoUsuario'=> $permisoUsuario[0], 'pro' => $pro, 'banco' => $banco, 'bancos' => $b, 'dato' => $id] );

    }

    public function jq_desactivar(Request $request)
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->banco != 1 || $permisoUsuario[0]->desactivar_banco != 1 ){
            return response()->json(false);
        }

        //Buscamos el numero de cuenta por ID
        $cuenta = Banco_proveedor::find($request->id);
        //Cambamos el estado de la cuenta a inactivo
        $cuenta->estado = 0;
        //Guardamos el cambio
        $resp = $cuenta->save();
        //Retornamos la respuesta a la vista
        return response()->json($cuenta);
    }

    public function jq_lista()
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );
        //consultamos a la base de datos
        $query = Banco::select()->where("banco_estado", 1)->get();

        // validamos que opciones maneja este usuario y dependiendo de esto, se muestra la informacion
        if ($permisoUsuario[0]->ban != 1 || $permisoUsuario[0]->ver_botones_ban != 1) {
            return datatables()->of($query)
            ->addColumn('btn','sistema.btnNull')
            ->rawColumns(['btn'])->toJson();
        } else {
            return datatables()->of($query)
            ->addColumn('btn','sistema.banco.btnBanco')
            ->rawColumns(['btn'])->toJson();
        }
    }

    public function guardar(Request $request){
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->ban != 1 || $permisoUsuario[0]->crear_ban != 1 ){
            return redirect()->route('home');
        }
        dd("Crear banco");
        //Instanciamos la clase para agregar los valores
        $banco = new Banco();
        // Agregamos los valores
        $banco->banco_rif = $request->rif;
        $banco->banco_nombre = $request->nombreBanco;
        $banco->banco_estado = 1;

        //Guardamos los valores
        $resp = $banco->save();

        //Retornamos a la vista la respuesta de este procedimiento
        return redirect()->route('banco.index')->with('sum', $resp);

    }




}
