<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permiso;

class PermisosController extends Controller
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
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->permisos_btn != 1){
            return redirect()->route("home");
        }
        //Redireccionamos a la vista para cargar obras
        return view('sistema.permisos.index')->with('permisoUsuario', $permisoUsuario[0]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->permisos_btn != 1 || $permisoUsuario[0]->crear_permisos != 1){
            return redirect()->route("home");
        }
        //Redireccionamos a la vista para cargar obras
        return view('sistema.permisos.crear')->with('permisoUsuario', $permisoUsuario[0]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
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

        //Realizamos la consulta a la base de datos
        $query = Permiso::select('id', 'nombre_permiso')->get();

        return datatables()->of($query)
        ->addColumn('btn','sistema.permisos.btnPermiso')
        ->rawColumns(['btn'])
        ->make(true);


    }
}
