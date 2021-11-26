<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permiso;
use App\Models\Proveedor;

class ProveedoresController extends Controller
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

        if($permisoUsuario[0]->proveedores != 1){
            return redirect()->route("home");
        }
        //Retorna a la vista de la ruta principal con los permisos de usuario
        return view("sistema.proveedor.index")->with('permisoUsuario', $permisoUsuario[0]);
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

    public function jq_lista()
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );
        //Realizamos la consulta
        $query = Proveedor::select(
            'proveedor.id AS id',
            'proveedor.proveedor_codigo AS codigo',
            'proveedor.proveedor_tipo AS tipo',
            'proveedor.proveedor_rif AS rif',
            'proveedor.proveedor_nombre AS nombre',
            'proveedor.proveedor_telefono AS tlf',
            'proveedor.proveedor_correo AS correo',
            'proveedor.proveedor_contacto AS contacto',
            'suministro.suministro_nombre AS suministro'
        )
        ->leftJoin("suministro","suministro.id", "=", "proveedor.suministro_id")
        ->where("proveedor.proveedor_estado", 1)
        ->get();
        // validamos que opciones maneja este usuario y dependiendo de esto, se muestra la informacion
        if ( $permisoUsuario[0]->cliente == 1 && $permisoUsuario[0]->ver_botones_cliente == 1) {
            return datatables()->of($query)
            ->addColumn('btn','sistema.proveedor.btnProveedores')
            ->rawColumns(['btn'])->toJson();
        } else {
            return datatables()->of($query)
            ->addColumn('btn','sistema.btnNull')
            ->rawColumns(['btn'])->toJson();
        }
    }









}
