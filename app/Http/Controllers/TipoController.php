<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use Illuminate\Http\Request;
use App\Models\Permiso;

class TipoController extends Controller
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

        if($permisoUsuario[0]->tipo != 1){
            return redirect()->route("home");
        }

        return view("sistema.tipo.index")->with('permisoUsuario', $permisoUsuario[0]);
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

        //Validamos los perisos que tenga el usuario
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->tipo != 1 || $permisoUsuario[0]->crear_tipo != 1){
            return redirect()->route("home");
        }

        $request->validate([
            'tipo' => 'required'
        ]);

        //Instancio la variable que se encargara de enviar la info a la BD
        $tipo = new Tipo();

        //se crea el codigo de la obra
        $codTipo = Tipo::select("tipo_codigo")->orderBy("id", "desc")->limit(1)->get();

        if(count($codTipo) < 1){
            //Si es menor a 1
            $codTipoNro = "TIP-1";
        } else {
            //Se extrae el numero y se le agrega un valor mas (xx + 1)
            preg_match_all('!\d+!', $codTipo[0]->tipo_codigo, $cod);
            $cod = $cod[0][0] + 1;
            $codTipoNro = "TIP-".$cod;
        }

        //Se almacena en sus respectivas variables la informacion almacenada
        $tipo->tipo_codigo = $codTipoNro;
        $tipo->tipo_nombre = $request->tipo;
        $tipo->tipo_estado = 1;

        $resp = $tipo->save();

        return redirect()->route('tipo.index')->with("resp", $resp);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tipo  $tipo
     * @return \Illuminate\Http\Response
     */
    public function show(Tipo $tipo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tipo  $tipo
     * @return \Illuminate\Http\Response
     */
    public function edit(Tipo $tipo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tipo  $tipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        //Validamos que se ingresen correctamente los datos solicitados
        $request->validate([
            'tipoMod' => 'required',
            'dato' => 'required'
        ]);

        //Validamos los perisos que tenga el usuario
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->tipo != 1 || $permisoUsuario[0]->modificar_tipo != 1){
            return redirect()->route("home");
        }


        //Buscamos los datos del tipo seleccionado
        $mod = Tipo::find( $request->dato );
        $mod->tipo_nombre = $request->tipoMod;
        ;
        //se guardan las modificaciones
        $resp = $mod->save();
        if ($resp) {
            $resp = 1;
        } else {
            $resp = 0;
        }

        return redirect()->route('tipo.index')->with("resp", $resp);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tipo  $tipo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipo $tipo)
    {
        //
    }

    public function jq_listaObras()
    {
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );
        //Realizamos la consulta a la base de datos
        $query = Tipo::select()->where("tipo_estado", 1)->get();

        // validamos que opciones maneja este usuario y dependiendo de esto, se muestra la informacion
        if ( $permisoUsuario[0]->tipo == 1 && $permisoUsuario[0]->ver_botones_tipo == 1) {
            return datatables()->of($query)
            ->addColumn('btn','sistema.tipo.btnTipo')
            ->rawColumns(['btn'])->toJson();
        } else {
            return datatables()->of($query)
            ->addColumn('btn','sistema.btnNull')
            ->rawColumns(['btn'])->toJson();
        }


    }


    public function jq_busquedaTipo($id)
    {
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->tipo != 1 || $permisoUsuario[0]->modificar_tipo != 1 ){
            return redirect()->route("home");
        }
        //Se realiza la busqueda de el tipo que cohincida con ese id
        $modTipo = Tipo::find( $id );
        //se retrna a la vista por medio de ajax
        return response()->json($modTipo);

    }

    public function jq_deshabilitar($id)
    {
        //Validamos los perisos que tenga el usuario
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->tipo != 1 || $permisoUsuario[0]->desactivar_tipo != 1){
            return redirect()->route("home");
        }
        //Buscamos en la base de datos el id correspondiente al tipo a deshabilitar
        $eliminar = Tipo::find($id);
        //cambiamos su estado de activo a inactivo
        $eliminar->tipo_estado = 0;
        //Guardamos los cambios
        $resp = $eliminar->save();
        //retornamos la espuesta de la BD a la vista por medio de json
        return response()->json( $resp );

    }

}
