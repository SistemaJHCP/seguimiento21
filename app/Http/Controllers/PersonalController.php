<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use Illuminate\Http\Request;
use App\Models\Permiso;
use App\Models\Profesion;

class PersonalController extends Controller
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

        if($permisoUsuario[0]->personal != 1){
            return redirect()->route("home");
        }

        $profesion = Profesion::select()->where('profesion_estado', 1)->orderBy('profesion', 'ASC')->get();

        return view('sistema.personal.index')->with('permisoUsuario', $permisoUsuario[0])->with('profesion', $profesion);
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

        if($permisoUsuario[0]->personal != 1 || $permisoUsuario[0]->crear_personal != 1){
            return redirect()->route("home");
        }

        //Validamos que se cumplan las normativas del formulario
        $request->validate([
            'personal' => 'required|max:80',
            'profesion' => 'required'
        ]);
        //Instanciamos la clase
        $personal = new Personal();

        //Creamos el codigo identificativo
        $codPersonal = Personal::select("personal_codigo")->orderBy("id", "desc")->limit(1)->get();

        if(count($codPersonal) < 1){
            //Si es menor a 1
            $codPersonalNro = "PER-1";
        } else {
            //Se extrae el numero y se le agrega un valor mas (xx + 1)
            preg_match_all('!\d+!', $codPersonal[0]->personal_codigo, $cod);
            $cod = $cod[0][0] + 1;
            $codPersonalNro = "PER-".$cod;
        }

        //Agregamos la informacion a la variable
        $personal->personal_codigo = $codPersonalNro;
        $personal->personal_nombre = $request->personal;
        $personal->personal_profesion = $request->profesion;

        //Guardar la informacion
        $resp = $personal->save();

        //Retornar a la vista
        return redirect()->route('personal.index')->with('resp', $resp);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function show(Personal $personal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function edit(Personal $personal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->personal != 1 || $permisoUsuario[0]->modificar_personal != 1){
            return redirect()->route("home");
        }

        //Validamos que se cumplan las normativas del formulario
        $request->validate([
            'personalMod' => 'required|max:80',
            'profesionMod' => 'required'
        ]);

        //Buscamos los datos del personal asociado al ID
        $personal = Personal::find( $request->dato );

        //Agregamos la informacion a la variable
        $personal->personal_nombre = $request->personalMod;
        $personal->personal_profesion = $request->profesionMod;

        //Guardar la informacion
        $resp = $personal->save();

        //Retornar a la vista
        return redirect()->route('personal.index')->with('resp', $resp);

        dd( $request->all() );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personal $personal)
    {
        //
    }

    public function jq_listaPersonal()
    {

        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        // if($permisoUsuario[0]->personal != 1 || $permisoUsuario[0]->reactivar_personal != 1){
        //     return redirect()->route("home");
        // }

        //Realizamos la consulta a la base de datos
        $query = Personal::select()->where('personal_estado', 1)->get();

        // validamos que opciones maneja este usuario y dependiendo de esto, se muestra la informacion
        if ( $permisoUsuario[0]->personal == 1 && $permisoUsuario[0]->ver_botones_personal == 1 ) {
            return datatables()->of($query)
            ->addColumn('btn','sistema.personal.btnPersonal')
            ->rawColumns(['btn'])->toJson();
        } else {
            return datatables()->of($query)
            ->addColumn('btn','sistema.btnNull')
            ->rawColumns(['btn'])->toJson();
        }
    }

    public function jq_traerDatos($id)
    {

        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->personal != 1 || $permisoUsuario[0]->modificar_personal != 1){
            return redirect()->route("home");
        }
        //Buscamos los datos del personal en base a el id
        $personal = Personal::find( $id );
        //Retornamos la informacion capturada a la vista
        return response()->json( $personal );

    }

    public function jq_deshabilitar($id)
    {

        //Validamos los permisos, si no funciona simplemente no hara el proceso y arrojara error
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->personal != 1 || $permisoUsuario[0]->desactivar_personal != 1){
            return redirect()->route("home");
        }
        //Ubicamos al personal segun su ID
        $personal = Personal::findOrFail($id);
        //Modificamos el estado a inactivo
        $personal->personal_estado = 0;
        //Guardamos el cambio en la BD
        $resp = $personal->save();
        //Retornamos a la vista la respuesta por Json
        return response()->json($resp);
    }

    public function jq_listaRehabilitar()
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );
        //Realizamos la consulta a la base de datos
        $query = Personal::select()->where('personal_estado', 0)->get();

        // validamos que opciones maneja este usuario y dependiendo de esto, se muestra la informacion
        if ( $permisoUsuario[0]->personal == 1 && $permisoUsuario[0]->reactivar_personal == 1) {
            return datatables()->of($query)
            ->addColumn('btn','sistema.personal.btnReactivar')
            ->rawColumns(['btn'])->toJson();
        } else {
            return datatables()->of($query)
            ->addColumn('btn','sistema.btnNull')
            ->rawColumns(['btn'])->toJson();
        }
    }

    public function reactivarPersonal()
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->personal != 1 || $permisoUsuario[0]->reactivar_personal != 1){
            return redirect()->route("home");
        }

        return view('sistema.personal.reactivar')->with('permisoUsuario', $permisoUsuario[0]);
    }

    public function reactivando(Request $request)
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->personal != 1 || $permisoUsuario[0]->reactivar_personal != 1){
            return response()->json(false);
        }

        //Buscamos el id a reactivar
        $re = Personal::find($request->id);
        //Cambiamos el estado del personal a activo
        $re->personal_estado = 1;
        //Guardamos este cambio en la BD
        $resp = $re->save();

        if($resp){
            return response()->json(true);
        } else {
            return response()->json(false);
        }

    }


}
