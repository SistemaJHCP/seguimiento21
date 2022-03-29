<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permiso;
use App\Models\Viatico;

class ViaticoController extends Controller
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

        if($permisoUsuario[0]->viatico != 1){
            return redirect()->route("home");
        }

        return view('sistema.viatico.index')->with([
            'permisoUsuario' => $permisoUsuario[0]
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
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->viatico != 1 || $permisoUsuario[0]->crear_viatico != 1 ){
            return redirect()->route("home");
        }

        //Se realiza el calculo para crear e codigo
        $codigo = Viatico::select("viatico_codigo")->orderBy("id", "desc")->limit(1)->get();
        //Si la variable codigo es mayor o igual a 1, ejecuta el conteo
        if(count($codigo) < 1){
            //Si es menor a 1
            $codigoVia = "VIA-1";
        } else {
            //Se extrae el numero y se le agrega un valor mas (xx + 1)
            preg_match_all('!\d+!', $codigo[0]->viatico_codigo, $cod);
            $cod = $cod[0][0] + 1;
            $codigoVia = "VIA-".$cod;
        }

        //Se instancia el modelo servicio
        $viatico = new Viatico();
        //se agregan los valores en los campos
        $viatico->viatico_codigo = $codigoVia;
        $viatico->viatico_nombre = $request->viatico;
        //Guardamos los datos en la BD
        $resp = $viatico->save();
        //Retornamos a la vista la respuesta del guardar la informacion
        return redirect()->route('viatico.index')->with('resp', $resp);

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
    public function destroy(Request $request)
    {

        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->viatico != 1 || $permisoUsuario[0]->desactivar_viatico != 1 ){
            return redirect()->route("home");
        }
        //Buscamos el ID seleccionado por el usuario
        $viatico = Viatico::find( $request->id );
        //Cambiamos su estado a deshabilitado
        $viatico->viatico_estado = 0;
        //Guardamos este cambio en la base de datos
        $resp = $viatico->save();
        //Retornamos la respuesta a la vista
        return response()->json($resp);

    }

    public function jq_lista()
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        $query = Viatico::select()->where("viatico_estado", 1)->orderBy('viatico_codigo', 'DESC')->get();
        // validamos que opciones maneja este usuario y dependiendo de esto, se muestra la informacion
        if ( $permisoUsuario[0]->viatico == 1 AND $permisoUsuario[0]->ver_botones_viatico == 1) {
            return datatables()->of($query)
            ->addColumn('btn','sistema.viatico.btnViatico')
            ->rawColumns(['btn'])->toJson();
        } else {
            return datatables()->of($query)
            ->addColumn('btn','sistema.btnNull')
            ->rawColumns(['btn'])->toJson();
        }
    }

}
