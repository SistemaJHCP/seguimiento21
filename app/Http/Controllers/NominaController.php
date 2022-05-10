<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permiso;
use App\Models\Nomina;

class NominaController extends Controller
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

        if($permisoUsuario[0]->nomina != 1){
            return redirect()->route("home");
        }

        return view('sistema.nomina.index')->with([
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

        if( $permisoUsuario[0]->nomina != 1 || $permisoUsuario[0]->crear_nomina != 1 ){
            return redirect()->route("home");
        }

        $request->validate([
            'nomina' => 'required|max:60'
        ]);

        //Se valida el ultimo codigo en el sistema
        $codigo = Nomina::select("nomina_codigo")->orderBy("id", "desc")->limit(1)->get();
        //Si la variable codigo es mayor o igual a 1, ejecuta el conteo
        if(count($codigo) < 1){
            //Si es menor a 1
            $codigoNom = "NOM-1";
        } else {
            //Se extrae el numero y se le agrega un valor mas (xx + 1)
            preg_match_all('!\d+!', $codigo[0]->nomina_codigo, $cod);
            $cod = $cod[0][0] + 1;
            $codigoNom = "NOM-".$cod;
        }

        //Instanciamos la clase nomina
        $nomina = new Nomina();
        //Sustituimos los valores
        $nomina->nomina_codigo = $codigoNom;
        $nomina->nomina_nombre = $request->nomina;
        $nomina->nomina_estado = 1;
        //Se realiza el guardado de la informacion
        $resp = $nomina->save();
        //Dependiendo del resultado, se envia un mensaje a la vista
        if ($resp) {
            return redirect()->route('nomina.index')->with('sum', $resp);
        } else {
            return redirect()->route('nomina.index')->with('sum', false);
        }
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
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->nomina != 1 || $permisoUsuario[0]->modificar_nomina != 1 ){
            return redirect()->route("home");
        }

        //Ubicar los datos por el ID
        $nomina = Nomina::find( $id );

        //Lo enviamos via json
        return response()->json($nomina);
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

        if( $permisoUsuario[0]->nomina != 1 || $permisoUsuario[0]->modificar_nomina != 1 ){
            return redirect()->route("home");
        }
        //Uicamos la nomina a modificar
        $nomina = Nomina::find( $request->dato );
        //Sustituimos el valor
        $nomina->nomina_nombre = $request->nominaMod;
        //Guardamos en la base de datos
        // dump( $request->all() );
        // dd( $nomina );
        $resp = $nomina->save();
        //Si se guarda o no la informacion se envia la respuesta al usuario
        if ($resp) {
            return redirect()->route('nomina.index')->with('sum', $resp);
        } else {
            return redirect()->route('nomina.index')->with('sum', false);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->nomina != 1 || $permisoUsuario[0]->desactivar_nomina != 1 ){
            return redirect()->route("home");
        }

        //Ubicar los datos por el ID
        $nomina = Nomina::find( $id );
        //Cambiamos el estado a inactivo
        $nomina->nomina_estado = 0;
        //Guardamos este cambio
        $resp = $nomina->save();
        //Lo enviamos via json
        return response()->json($resp);
    }

    public function disabled()
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->nomina != 1 || $permisoUsuario[0]->reactivar_nomina != 1 ){
            return redirect()->route("home");
        }

        return view('sistema.nomina.deshabilitar')->with([
            'permisoUsuario' => $permisoUsuario[0]
        ]);
    }

    public function jq_lista()
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );
        //consultamos a la base de datos
        $query = Nomina::select()->where("nomina_estado", 1)->get();

        // validamos que opciones maneja este usuario y dependiendo de esto, se muestra la informacion
        if ($permisoUsuario[0]->nomina != 1 || $permisoUsuario[0]->ver_boton_nomina != 1) {
            return datatables()->of($query)
            ->addColumn('btn','sistema.btnNull')
            ->rawColumns(['btn'])->toJson();
        } else {
            return datatables()->of($query)
            ->addColumn('btn','sistema.nomina.btnNomina')
            ->rawColumns(['btn'])->toJson();
        }
    }

    public function jq_listaDeshabilitadas()
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );
        //consultamos a la base de datos
        $query = Nomina::select()->where("nomina_estado", 0)->get();

        // validamos que opciones maneja este usuario y dependiendo de esto, se muestra la informacion
        if ($permisoUsuario[0]->nomina != 1 || $permisoUsuario[0]->ver_boton_nomina != 1) {
            return datatables()->of($query)
            ->addColumn('btn','sistema.btnNull')
            ->rawColumns(['btn'])->toJson();
        } else {
            return datatables()->of($query)
            ->addColumn('btn','sistema.nomina.btnNominaRe')
            ->rawColumns(['btn'])->toJson();
        }
    }

    public function enabled($id)
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->nomina != 1 || $permisoUsuario[0]->reactivar_nomina != 1 ){
            return redirect()->route("home");
        }

        //Ubicar los datos por el ID
        $nomina = Nomina::find( $id );
        //Cambiamos el estado a inactivo
        $nomina->nomina_estado = 1;
        //Guardamos este cambio
        $resp = $nomina->save();
        //Lo enviamos via json
        return response()->json($resp);
    }

}
