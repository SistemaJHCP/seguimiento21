<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permiso;
use App\Models\Solicitud;
use App\Models\Obra;
use App\Models\Proveedor;
use App\Models\Requisicion;
use App\Models\Material;
use App\Models\Servicio;
use App\Models\Nomina;
use App\Models\Viatico;


class SolicitudController extends Controller
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

        if($permisoUsuario[0]->solicitud != 1){
            return redirect()->route("home");
        }

        return view('sistema.solicitud.index')->with([
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
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->solicitud != 1 && $permisoUsuario[0]->crear_solicitud != 1){
            return redirect()->route("home");
        }
        //Solicitamos la lista de obra
        $obra = Obra::select('id', 'obra_codigo', 'obra_nombre')->orderBy('id', 'DESC')->get();

        //Solicitamos la lista de proveedores
        $proveedor = Proveedor::select('id', 'proveedor_codigo', 'proveedor_nombre')->get();

        //retornamos a la vista para crear solicitudes
        return view('sistema.solicitud.crear')
        ->with('permisoUsuario', $permisoUsuario[0])
        ->with('obra', $obra)
        ->with('proveedor', $proveedor);
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

    public function jq_lista(){

        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->solicitud != 1 ){
            return redirect()->route("home");
        }

        //Realizamos la consulta a la base de datos
        $query = Solicitud::select(
            'solicitud.id AS id',
            'solicitud.solicitud_numerocontrol AS solicitud_numerocontrol',
            'solicitud.solicitud_fecha AS fecha',
            'solicitud.solicitud_motivo AS solicitud_motivo',
            'solicitud.solicitud_aprobacion AS solicitud_aprobacion',
            'users.user_name AS nombre'
        )
        ->leftJoin('users','users.id', '=', 'solicitud.usuario_id')
        ->orderBy('id', 'DESC')->limit(3000)
        ->get();

        // validamos que opciones maneja este usuario y dependiendo de esto, se muestra la informacion
        if ( $permisoUsuario[0]->solicitud == 1 && $permisoUsuario[0]->ver_botones_solicitud == 1) {
            return datatables()->of($query)
            ->addColumn('btn','sistema.solicitud.btnSolicitud')
            ->rawColumns(['btn'])->toJson();
        } else {
            return datatables()->of($query)
            ->addColumn('btn','sistema.btnNull')
            ->rawColumns(['btn'])->toJson();
        }

    }

    public function consultarObra( $id )
    {
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

        return response()->json($obra);
    }

    public function consultarProveedores($id)
    {
        $pro = Proveedor::select(
            'proveedor.id AS id',
            'proveedor.proveedor_codigo AS proveedor_codigo',
            'suministro.suministro_nombre AS suministro_nombre',
            'proveedor.proveedor_tipo AS proveedor_tipo',
            'proveedor.proveedor_rif AS proveedor_rif',
            'proveedor.proveedor_nombre AS proveedor_nombre',
            'proveedor.proveedor_telefono AS proveedor_telefono',
            'proveedor.proveedor_direccion AS proveedor_direccion',
            'proveedor.proveedor_correo AS proveedor_correo',
            'proveedor.proveedor_contacto AS proveedor_contacto',
            'proveedor.suministro_id AS suministro_id',
            'proveedor.created_at AS created_at'
        )
        ->join("suministro", "suministro.id", "=", "proveedor.suministro_id")
        ->where('proveedor.id', $id)
        ->get();

        return response()->json($pro);
    }

    public function listarRequisicion($valor)
    {

        $requisicion = Requisicion::select(
            'requisicion.id AS id',
            'requisicion.requisicion_codigo AS requisicion_codigo',
            // 'requisicion.requisicion_tipo AS requisicion_tipo',
            // 'requisicion.requisicion_fecha AS requisicion_fecha',
            // 'requisicion.requisicion_fechae AS requisicion_fechae',
            'obra.obra_nombre AS obra',
            // 'requisicion.requisicion_motivo AS requisicion_motivo',
            // 'requisicion.requisicion_estado AS requisicion_estado',
            // 'users.user_name AS usuario_nombre',
        )
        ->leftJoin('obra','obra.id', '=', 'requisicion.obra_id')
        // ->leftJoin('users','users.id', '=', 'requisicion.usuario_id')
        ->where('requisicion.requisicion_tipo', $valor)
        ->orderBy('id', 'DESC')
        ->get();

        return response()->json($requisicion);

    }


    public function consultarRequisicion($id)
    {
        $requisicion = Requisicion::select(
            'requisicion.id AS id',
            'requisicion.requisicion_codigo AS requisicion_codigo',
            'requisicion.requisicion_tipo AS requisicion_tipo',
            'requisicion.requisicion_fecha AS requisicion_fecha',
            'requisicion.requisicion_fechae AS requisicion_fechae',
            'obra.obra_nombre AS obra',
            'requisicion.requisicion_motivo AS requisicion_motivo',
            'requisicion.requisicion_estado AS requisicion_estado',
            'users.user_name AS usuario_nombre',
        )
        ->leftJoin('obra','obra.id', '=', 'requisicion.obra_id')
        ->leftJoin('users','users.id', '=', 'requisicion.usuario_id')
        ->where('requisicion.id', $id)
        ->limit(1)
        ->get();

        return response()->json($requisicion);
    }


}


