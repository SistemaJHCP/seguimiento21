<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permiso;
use App\Models\Requisicion;
use App\Models\Obra;
use App\Models\Proveedor;

class RequisicionController extends Controller
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

        if($permisoUsuario[0]->requisicion != 1){
            return redirect()->route("home");
        }

        return view("sistema.requisicion.index")->with('permisoUsuario', $permisoUsuario[0]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        $proveedor = Proveedor::select("id", "proveedor_nombre")->orderBy("proveedor_nombre", "ASC")->get();
        $obra = Obra::select("id", "obra_codigo", "obra_nombre")->orderBy("obra_nombre", "ASC")->get();

        if($permisoUsuario[0]->requisicion != 1){
            return redirect()->route("home");
        }
        //Retorna la vista para cargar la requisicion
        return view('sistema.requisicion.crear')->with(['permisoUsuario' => $permisoUsuario[0], 'proveedor' => $proveedor, 'obra' => $obra]);
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

    public function jq_lista()
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->requisicion != 1 ){
            return redirect()->route("home");
        }

        //Realizamos la consulta a la base de datos
        $query = Requisicion::select(
            'requisicion.id AS id',
            'requisicion.requisicion_codigo AS requisicion_codigo',
            'requisicion.requisicion_tipo AS requisicion_tipo',
            'requisicion.requisicion_fecha AS requisicion_fecha',
            'requisicion.requisicion_fechae AS requisicion_fechae',
            'obra.obra_nombre AS obra',
            'requisicion.requisicion_motivo AS requisicion_motivo',
            'requisicion.requisicion_estado AS requisicion_estado',
        )
        ->leftJoin('obra','obra.id', '=', 'requisicion.obra_id')
        ->where('requisicion.usuario_id', \Auth::user()->id)
        // ->orderBy('requisicion.requisicion_codigo', 'DESC')
        ->get();


        // validamos que opciones maneja este usuario y dependiendo de esto, se muestra la informacion
        if ( $permisoUsuario[0]->obra == 1 && $permisoUsuario[0]->ver_botones_requisicion == 1) {
            return datatables()->of($query)
            ->addColumn('btn','sistema.requisicion.btnRequisicion')
            ->rawColumns(['btn'])->toJson();
        } else {
            return datatables()->of($query)
            ->addColumn('btn','sistema.btnNull')
            ->rawColumns(['btn'])->toJson();
        }
    }




}
