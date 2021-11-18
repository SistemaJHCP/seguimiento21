<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use App\Models\Permiso;
use App\Models\Tipo;
use App\Models\Cliente;
use App\Models\Personal;
use App\Models\Codventas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObraController extends Controller
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

        if($permisoUsuario[0]->obra != 1){
            return redirect()->route("home");
        }
        //Redireccionamos a la vista para cargar obras
        return view('sistema.obra.index')->with('permisoUsuario', $permisoUsuario[0]);


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

        if($permisoUsuario[0]->crear_obra != 1 || $permisoUsuario[0]->obra != 1){
            return redirect()->route("home");
        }

        //Solicito todo el listado de la tabla tipo
        $tipo = Tipo::select("id", "tipo_nombre")->orderBy("tipo_nombre", "ASC")->get();
        //Solicito todo el listado de la tabla cliente
        $cli = Cliente::select("id", "cliente_nombre")->orderBy("cliente_nombre", "ASC")->get();
        //Solicito todo el listado de la tabla codventa
        $cod = Codventas::select("id", "codventa_codigo")->orderBy("id", "DESC")->get();
        //Solicito todo el listado de la tabla Personal
        $per = Personal::select("id", "personal_nombre")->where("personal_estado", 1)->orderBy("personal_nombre", "ASC")->get();

        //se envia todas las consultas a la vista
        return view('sistema.obra.crear')->with('permisoUsuario', $permisoUsuario[0])->with("tipo", $tipo)->with("cli", $cli)->with("cod", $cod)->with("per", $per);
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

        if($permisoUsuario[0]->crear_obra != 1 || $permisoUsuario[0]->obra != 1){
            return redirect()->route("home");
        }

        $request->validate([
            'tipo' => 'required',
            'cliente' => 'required',
            'codventa' => 'required',
            'nombreObra' => 'max:100',
            'total' => 'max:17',
            'porcentaje' => 'max:6',
            'observaciones' => 'max:200'
        ]);

        //Instancio la variable que se encargara de enviar la info a la BD
        $obra = new Obra();
        //Se llenan los campos
        $obra-> = $request-> ;
        $obra-> = $request-> ;
        $obra-> = $request-> ;
        $obra-> = $request-> ;
        $obra-> = $request-> ;
        $obra-> = $request-> ;
        $obra-> = $request-> ;
        $obra-> = $request-> ;
        $obra-> = $request-> ;



        dd( $request->all() );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Obra  $obra
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->obra != 1 || $permisoUsuario[0]->ver_botones_obra != 1){
            return redirect()->route("home");
        }
        //Busca en BD la indormacion relacioana al la obra con ese ID
        $obra = Obra::select(
            'obra.id AS id',
            'obra.obra_codigo AS obra_codigo',
            'obra.obra_nombre AS obra_nombre',
            'obra.obra_monto AS obra_monto',
            'obra.obra_observaciones AS obra_observaciones',
            'obra.obra_ganancia AS obra_ganancia',
            'obra.obra_fechainicio AS obra_fechainicio',
            'obra.obra_fechafin AS obra_fechafin',
            'cliente.cliente_nombre AS cliente_nombre',
            'tipo.tipo_nombre AS tipo_nombre',
            'codventa.codventa_codigo AS codventa_codigo'
            )
            ->leftJoin("cliente", "cliente.id", "=", "obra.cliente_id")
            ->leftJoin("tipo", "tipo.id", "=", "obra.tipo_id")
            ->leftJoin("codventa", "codventa.id", "=", "obra.codventa_id")
            ->where("obra.id", $id)
            ->get();

        //En base al ID de la obra se buscan el personal asignado
        $personal = Personal::select(
            "personal.personal_nombre AS personal_nombre",
            "obra_personal.op_cargo AS op_cargo"
        )
        ->join("obra_personal", "personal.id", "=", "obra_personal.personal_id")
        ->where("obra_personal.obra_id", $obra[0]->id)
        ->get();

        //Envia la informacion a la vista, se inicializa la vista junto con los permisos
        return view("sistema.obra.verObra")->with('permisoUsuario', $permisoUsuario[0])->with('obra', $obra[0])->with('personal', $personal);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Obra  $obra
     * @return \Illuminate\Http\Response
     */
    public function edit(Obra $obra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Obra  $obra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Obra $obra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Obra  $obra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Obra $obra)
    {
        //
    }

    public function jq_lista()
    {

        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->obra != 1){
            return redirect()->route("home");
        }

        //Realizamos la consulta a la base de datos
        $query = Obra::select(
            'obra.id AS id',
            'obra.obra_codigo AS obra_codigo',
            'tipo.tipo_nombre AS obra_tipo',
            'cliente.cliente_nombre AS obra_cliente',
            'codventa.codventa_codigo AS obra_codventa',
            'obra.obra_nombre AS obra_nombre',
            'obra.obra_fechainicio AS obra_fechaInicio',
            'obra.obra_fechafin AS obra_fechaFin',
            'obra.obra_monto AS obra_monto'
        )
        ->leftJoin('tipo','tipo.id', '=', 'obra.tipo_id')
        ->leftJoin('cliente','cliente.id', '=', 'obra.cliente_id')
        ->leftJoin('codventa','codventa.id', '=', 'obra.codventa_id')
        ->orderBy('obra.id', 'DESC')
        ->where('obra.obra_estado',1)
        ->get();

        // validamos que opciones maneja este usuario y dependiendo de esto, se muestra la informacion
        if ( $permisoUsuario[0]->obra == 1 && $permisoUsuario[0]->ver_botones_obra == 1) {
            return datatables()->of($query)
            ->addColumn('btn','sistema.obra.btnVerObra')
            ->rawColumns(['btn'])->toJson();
        } else {
            return datatables()->of($query)
            ->addColumn('btn','sistema.btnNull')
            ->rawColumns(['btn'])->toJson();
        }


    }


    public function consultarCoord($id)
    {
        $personal = Personal::find($id);
        return response()->json($personal);
    }



}
