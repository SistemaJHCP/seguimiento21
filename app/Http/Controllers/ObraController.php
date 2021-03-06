<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use App\Models\Permiso;
use App\Models\Tipo;
use App\Models\Cliente;
use App\Models\Personal;
use App\Models\Codventas;
use App\Models\Valuacion;
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
        $tipo = Tipo::select("id", "tipo_nombre")->where('tipo_estado', 1)->orderBy("tipo_nombre", "ASC")->get();
        //Solicito todo el listado de la tabla cliente
        $cli = Cliente::select("id", "cliente_nombre")->where('cliente_estado', 1)->orderBy("cliente_nombre", "ASC")->get();
        //Solicito todo el listado de la tabla codventa
        $cod = Codventas::select("id", "codventa_codigo")->where('codventa_estado', 1)->orderBy("id", "DESC")->get();
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
            'anticipo' => 'max:17',
            'porcentaje' => 'max:6',
            'observaciones' => 'max:200'
        ]);

        //Instancio la variable que se encargara de enviar la info a la BD
        $obra = new Obra();

        //se crea el codigo de la obra
        $codObra = Obra::select("obra_codigo")->orderBy("id", "desc")->limit(1)->get();

        if(count($codObra) < 1){
            //Si es menor a 1
            $codObraNro = "OBR-1";
        } else {
            //Se extrae el numero y se le agrega un valor mas (xx + 1)
            preg_match_all('!\d+!', $codObra[0]->obra_codigo, $cod);
            $cod = $cod[0][0] + 1;
            $codObraNro = "OBR-".$cod;
        }

        //Se llenan los campos
        $obra->obra_codigo = $codObraNro;
        $obra->tipo_id = $request->tipo;
        $obra->cliente_id = $request->cliente;
        $obra->codventa_id = $request->codventa;
        $obra->obra_nombre = $request->nombreObra;
        $obra->obra_monto = $request->total;
        $obra->obra_anticipo = $request->anticipo;
        $obra->obra_ganancia = $request->porcentaje;
        $obra->obra_fechainicio = $request->fechaInicio;
        $obra->obra_fechafin = $request->fechaFin;
        $obra->obra_observaciones = $request->observaciones;
        $obra->obra_estado = 1;
        //guardar la informacion
        $obra->save();

        //Si existe el responsable, hara un buche y lo guardara en la BD
        if($request->responsable){
            for ($i=0; $i < count($request->responsable); $i++) {

                DB::table('obra_personal')->insert([
                    'op_cargo' => $request->cargoResponsable[$i],
                    'obra_id' => $obra->id,
                    'personal_id' => $request->responsable[$i]
                ]);
            }
        }

        //Retorna a la ruta del index
        return redirect()->route('obra.index')->with('obra', $obra);


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
    public function edit($id)
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->obra != 1 || $permisoUsuario[0]->modificar_obra != 1){
            return redirect()->route("home");
        }

        //buscamos los datos de la obra solicitados por ID
        $obra = Obra::find($id);

        //Solicito todo el listado de la tabla tipo
        $tipo = Tipo::select("id", "tipo_nombre")->orderBy("tipo_nombre", "ASC")->get();
        //Solicito todo el listado de la tabla cliente
        $cli = Cliente::select("id", "cliente_nombre")->orderBy("cliente_nombre", "ASC")->get();
        //Solicito todo el listado de la tabla codventa
        $cod = Codventas::select("id", "codventa_codigo")->orderBy("id", "DESC")->get();
        //Solicito todo el listado de la tabla Personal
        $per = Personal::select("id", "personal_nombre")->where("personal_estado", 1)->orderBy("personal_nombre", "ASC")->get();

        return view("sistema.obra.modificar")->with('obra', $obra)->with('permisoUsuario', $permisoUsuario[0])->with("tipo", $tipo)->with("cli", $cli)->with("cod", $cod)->with("per", $per);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Obra  $obra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->obra != 1 || $permisoUsuario[0]->modificar_obra != 1){
            return redirect()->route("home");
        }

        //Buscar obra en base al ID seleccionado
        $obra = Obra::find($id);

        //Se agregan los nuevos valores lod cuales sustituyen los antiguos
        $obra->tipo_id = $request->tipo;
        $obra->cliente_id = $request->cliente;
        $obra->codventa_id = $request->codventa;
        $obra->obra_nombre = $request->nombreObra;
        $obra->obra_monto = $request->total;
        $obra->obra_anticipo = $request->anticipo;
        $obra->obra_ganancia = $request->porcentaje;
        $obra->obra_fechainicio = $request->fechaInicio;
        $obra->obra_fechafin = $request->fechaFin;
        $obra->obra_observaciones = $request->observaciones;
        $obra->obra_estado = 1;
        //guardar la informacion
        $guardar = $obra->save();

        if($request->responsable){
            for ($i=0; $i < count($request->responsable); $i++) {

                DB::table('obra_personal')->insert([
                    'op_cargo' => $request->cargoResponsable[$i],
                    'obra_id' => $obra->id,
                    'personal_id' => $request->responsable[$i]
                ]);
            }
        }

        //Retorna a la ruta del index
        return redirect()->route('obra.index')->with('obra', $obra);

    }



    public function reactivar()
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->obra != 1 || $permisoUsuario[0]->reactivar_obra != 1){
            return redirect()->route("home");
        }

        return view('sistema.obra.reactivarObra')->with('permisoUsuario', $permisoUsuario[0]);

    }

    public function indexValuacion($id)
    {

        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->obra != 1 ){
            return redirect()->route("home");
        }

        // Consultamos la obra
        $obra = Obra::select(
            'obra.obra_codigo AS obra_codigo',
            'obra.obra_nombre AS obra_nombre',
            'obra.obra_monto AS obra_monto',
            'obra.obra_anticipo AS obra_anticipo',
            'obra.obra_montogasto AS obra_montogasto',
            'obra.obra_ganancia AS obra_ganancia',
            'obra.obra_fechainicio AS obra_fechainicio',
            'obra.obra_fechainicio AS obra_fechainicio',
            'obra.obra_fechafin AS obra_fechafin',
            'obra.obra_observaciones AS obra_observaciones',
            'cliente.cliente_nombre AS cliente_nombre',
            'tipo.tipo_nombre AS tipo_nombre',
            'codventa.codventa_nombre AS codventa_nombre',
        )
        ->leftJoin('cliente', 'cliente.id', '=', 'obra.cliente_id')
        ->leftJoin('tipo', 'tipo.id', '=', 'obra.tipo_id')
        ->leftJoin('codventa', 'codventa.id', '=', 'obra.codventa_id')

        ->where('obra.id', $id)
        ->where('obra.obra_estado', 1)->first();

        $valuacion = Valuacion::select()->where('valuacion_estado', 1)->where('obra_id', $id)->orderBy('id', 'DESC')->get();

        // Retornamos la informacion de la obra
        return view('sistema.obra.valuacion')->with( ['permisoUsuario' => $permisoUsuario[0], 'id' => $id, 'obra' => $obra, 'valuacion' => $valuacion]);
    }

    public function valuacionCreate(Request $request)
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if(  $permisoUsuario[0]->valuacion != 1 || $permisoUsuario[0]->crear_valuacion != 1 ){
            return redirect()->route("home");
        }

        // Creamos la instancia de la valuacion
        $val = new Valuacion();
        // Ingresamos los valores
        $val->valuacion_monto = $request->valuacion;
        $val->valuacion_fecha = $request->fecha;
        $val->observacion = $request->observacion;
        $val->obra_id = $request->dato;
        $val->valuacion_estado = 1;

        // Guardamos en la base de datos
        $resp = $val->save();
        // Retornamos a la vista dependiendo si se guardo o no se guardo la Valuacion
        return redirect()->route('obra.valuacion.index', $request->dato)->with('resp', $resp);

    }


    public function consultarValuacion(Request $request)
    {

        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->valuacion != 1 || $permisoUsuario[0]->modificar_valuacion != 1){
            return redirect()->route("home");
        }

        // Buscamos toda la informacion relacionada a este ID
        $val = Valuacion::select()->where('id', $request->id)->first();
        // Retornamos la respuesta a la vista mediante json
        return response()->json($val);
    }

    public function updateValuacion(Request $request, $id)
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->valuacion != 1 || $permisoUsuario[0]->modificar_valuacion != 1){
            return redirect()->route("home");
        }

        // Buscamos la valuacion relacionada con el ID
        $val = Valuacion::find($request->datoKid);
        //Sustituimos ls valores
        $val->valuacion_monto = $request->valuacionMod;
        $val->valuacion_fecha = $request->fechaMod;
        $val->observacion = $request->observacionMod;
        $val->obra_id = $id;
        //Guardamos en BD los cambios realizados
        $resp = $val->save();
        // Retornamos a la vista dependiendo si se guardo o no se guardo la Valuacion
        return redirect()->route('obra.valuacion.index', $id)->with('resp', $resp);

    }

    public function desactivarValuacion(Request $request)
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->valuacion != 1 || $permisoUsuario[0]->desactivar_valuacion != 1){
            return redirect()->route("home");
        }

        // Realizamos la busqueda de la valuacion
        $val = Valuacion::find($request->id);
        // Cambiamos el estado a inactivo
        $val->valuacion_estado = 0;
        // Guardamos la modificacion
        $resp = $val->save();
        return response()->json($resp);
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

    public function jq_listaDes()
    {

        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->obra != 1 || $permisoUsuario[0]->reactivar_obra != 1){
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
        ->where('obra.obra_estado',0)
        ->get();

        // validamos que opciones maneja este usuario y dependiendo de esto, se muestra la informacion
        if ( $permisoUsuario[0]->obra == 1 && $permisoUsuario[0]->ver_botones_obra == 1) {
            return datatables()->of($query)
            ->addColumn('btn','sistema.obra.btnReactivar')
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

    public function consultarPersonal3456($id)
    {
        $personal = Personal::select(
            "obra_personal.id AS id",
            "personal.personal_nombre AS personal_nombre",
            "obra_personal.op_cargo AS op_cargo"
        )
        ->join("obra_personal", "personal.id", "=", "obra_personal.personal_id")
        ->where("obra_personal.obra_id", $id)
        ->get();

        return response()->json($personal);
    }

    public function eliminarPersonalRelacionadoObra(Request $request)
    {

        $obra = DB::table('obra_personal')->where('id', '=', $request->codigo)->delete();

        return response()->json($obra);

    }

    public function jq_reactivarObra(Request $request)
    {


        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->obra != 1 || $permisoUsuario[0]->desactivar_obra != 1){
            return redirect()->route("home");
        }

        //Se realiza la busqueda en base al ID
        $obra = Obra::find($request->id);

        //Se cambia el estado de la obra a inactivo
        $obra->obra_estado = 1;
        //Se guarda en la BD el cambio realizado y se guarda en variable el resultado
        $resultado = $obra->save();

        //Se envia la respuesta a la vista usando Json
        return response()->json($resultado);

    }


    public function jq_desactivarObra(Request $request)
    {


        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->obra != 1 || $permisoUsuario[0]->desactivar_obra != 1){
            return redirect()->route("home");
        }

        //Se realiza la busqueda en base al ID
        $obra = Obra::find($request->id);

        //Se cambia el estado de la obra a inactivo
        $obra->obra_estado = 0;
        //Se guarda en la BD el cambio realizado y se guarda en variable el resultado
        $resultado = $obra->save();

        //Se envia la respuesta a la vista usando Json
        return response()->json($resultado);

    }

    //--------------------- Control de gastos ------------------------

    public function consultarObra(Request $request)
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );
        // if($permisoUsuario[0]->obra != 1 || $permisoUsuario[0]->desactivar_obra != 1){
        //     return redirect()->route("home");
        // }

        //Buscamos los datos de la obra asociada al ID a buscar
        $obra = Obra::select(
            'obra.id AS id',
            'obra.obra_codigo AS obra_codigo',
            'obra.obra_nombre AS obra_nombre',
            'obra.obra_monto AS obra_monto',
            'obra.obra_fechainicio AS obra_fechainicio',
            'obra.obra_anticipo AS obra_anticipo',
            'cliente.cliente_nombre AS cliente_nombre'
            )
        ->leftJoin('cliente', 'cliente.id', '=', 'obra.cliente_id')
        ->where('obra.id', $request->id)
        ->first();
        //Retornamos la respuesta via json
        return response()->json( $obra );

    }


}
