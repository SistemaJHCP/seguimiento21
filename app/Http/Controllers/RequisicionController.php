<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permiso;
use App\Models\Requisicion;
use App\Models\Obra;
use App\Models\Material;
use App\Models\Servicio;
use App\Models\Viatico;
use App\Models\Proveedor;
use App\Models\Solicitud_detalle;


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
        $obra = Obra::select("id", "obra_codigo", "obra_nombre")->orderBy("id", "DESC")->get();

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

        //Validamos permisos de este usuario
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->requisicion != 1 || $permisoUsuario[0]->crear_requisicion != 1){
            return redirect()->route("home");
        }


        //validamos que todo este bien
        $request->validate([
            'fechaE' => 'required|max:10',
            'proveedorRec' => 'required',
            'obra' => 'required',
            'direccion' => 'required|max:320',
            'motivo' => 'required|max:320'

        ]);


        $codRequi = Requisicion::select("requisicion_codigo")->orderBy("id", "desc")->limit(1)->get();

        if(count($codRequi) < 1){
            //Si es menor a 1
            $codRequiNro = "REQ-1";
        } else {
            //Se extrae el numero y se le agrega un valor mas (xx + 1)
            preg_match_all('!\d+!', $codRequi[0]->requisicion_codigo, $cod);
            $cod = $cod[0][0] + 1;
            $codRequiNro = "REQ-".$cod;
        }

        $req = new Requisicion();

        $req->requisicion_codigo = $codRequiNro;
        $req->requisicion_tipo = $request->tipos[0];
        $req->requisicion_fecha = date('Y-m-d');
        $req->requisicion_fechae = $request->fechaE;
        $req->requisicion_motivo = $request->motivo;
        $req->requisicion_direccion = $request->direccion;
        $req->requisicion_observaciones = $request->observacion;
        $req->requisicion_estado = "No Vista";
        $req->usuario_id = \Auth::user()->id;
        $req->obra_id = $request->obra;
        $req->proveedor_id = $request->proveedorRec;

        $req->save();


        foreach (array_keys( $request->cantdd ) as $key) {
            $soldet = new Solicitud_detalle();
            $soldet->sd_cantidad = $request->cantdd[$key];
            $soldet->requisicion_id = $req->id;

            if ($request->tipos[$key] == "Material") {
                $soldet->material_id = $request->concrip424[$key];
            } elseif ($request->tipos[$key] == "Servicio") {
                $soldet->servicio_id = $request->concrip424[$key];
            } elseif ($request->tipos[$key] == "Viatico") {
                $soldet->viatico_id = $request->concrip424[$key];
            }

            $soldet->sd_caracteristicas = $request->especificacionesewq[$key];

            $soldet->save();
        }

        if ($soldet) {
            return redirect()->route('requisicion.index')->with('resp', 1);
        } else {
            return redirect()->route('requisicion.index')->with('resp', 0);
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
        //Validamos permisos de este usuario
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->requisicion != 1 || $permisoUsuario[0]->ver_botones_requisicion != 1){
            return redirect()->route("home");
        }

        //Realizo la consulta

        $requisicion = Requisicion::select(
            'requisicion.id AS id',
            'requisicion.requisicion_codigo',
            'requisicion.requisicion_tipo AS requisicion_tipo',
            'requisicion.requisicion_fecha AS requisicion_fecha',
            'requisicion.requisicion_fechae AS requisicion_fechae',
            'requisicion.requisicion_motivo AS requisicion_motivo',
            'requisicion.requisicion_direccion AS requisicion_direccion',
            'requisicion.requisicion_observaciones AS requisicion_observaciones',
            'requisicion.requisicion_estado AS requisicion_estado',
            'obra.id AS obra_id',
            'obra.obra_codigo AS obra_codigo',
            'obra.obra_nombre AS obra_nombre',
            'obra.obra_monto AS obra_monto',
            'obra.obra_ganancia AS obra_ganancia',
            'obra.obra_fechainicio AS obra_fecha_inicio',
            'obra.obra_fechafin AS obra_fecha_fin',
            'obra.obra_observaciones AS obra_observaciones',
            'proveedor.id AS proveedor_id',
            'proveedor.proveedor_codigo AS proveedor_codigo',
            'proveedor.proveedor_tipo AS proveedor_tipo',
            'proveedor.proveedor_rif AS proveedor_rif',
            'proveedor.proveedor_nombre AS proveedor_nombre',
            'proveedor.proveedor_telefono AS proveedor_telefono',
            'proveedor.proveedor_direccion AS proveedor_direccion',
            'proveedor.proveedor_correo AS proveedor_correo'
        )
        ->leftJoin('obra', 'obra.id', '=','requisicion.obra_id')
        ->leftJoin('proveedor', 'proveedor.id', '=','requisicion.proveedor_id')
        ->where('requisicion.id', $id)
        ->limit(1)->get();

        $sol_det = Solicitud_detalle::select(
            'solicitud_detalle.id AS id',
            'solicitud_detalle.sd_cantidad AS sd_cantidad',
            'solicitud_detalle.requisicion_id AS requisicion_id',
            'solicitud_detalle.sd_caracteristicas AS sd_caracteristicas',
            'solicitud_detalle.material_id AS material_id',
            'solicitud_detalle.servicio_id AS servicio_id',
            'solicitud_detalle.viatico_id AS viatico_id',
            'material.material_codigo AS material_codigo',
            'material.material_nombre AS material_nombre',
            'servicio.servicio_codigo AS servicio_codigo',
            'servicio.servicio_nombre AS servicio_nombre',
            'viatico.viatico_codigo AS viatico_codigo',
            'viatico.viatico_nombre AS viatico_nombre'
        )
        ->leftJoin('material', 'material.id', '=','solicitud_detalle.material_id')
        ->leftJoin('servicio', 'servicio.id', '=','solicitud_detalle.servicio_id')
        ->leftJoin('viatico', 'viatico.id', '=','solicitud_detalle.viatico_id')
        ->where('solicitud_detalle.requisicion_id', $id)
        ->get();

        return view('sistema.requisicion.consultar')
        ->with('permisoUsuario', $permisoUsuario[0])
        ->with('requisicion', $requisicion[0])
        ->with('sol_det', $sol_det);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Validamos permisos de este usuario
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->requisicion != 1 || $permisoUsuario[0]->modificar_requisicion != 1){
            return redirect()->route("home");
        }

        //Realizo las consultas

        $proveedor = Proveedor::select("id", "proveedor_nombre")->orderBy("proveedor_nombre", "ASC")->get();
        $obra = Obra::select("id", "obra_codigo", "obra_nombre")->orderBy("id", "DESC")->get();

        $requisicion = Requisicion::select(
            'requisicion.id AS id',
            'requisicion.requisicion_codigo',
            'requisicion.requisicion_tipo AS requisicion_tipo',
            'requisicion.requisicion_fecha AS requisicion_fecha',
            'requisicion.requisicion_fechae AS requisicion_fechae',
            'requisicion.requisicion_motivo AS requisicion_motivo',
            'requisicion.requisicion_direccion AS requisicion_direccion',
            'requisicion.requisicion_observaciones AS requisicion_observaciones',
            'requisicion.requisicion_estado AS requisicion_estado',
            'obra.id AS obra_id',
            'obra.obra_codigo AS obra_codigo',
            'obra.obra_nombre AS obra_nombre',
            'obra.obra_monto AS obra_monto',
            'obra.obra_ganancia AS obra_ganancia',
            'obra.obra_fechainicio AS obra_fecha_inicio',
            'obra.obra_fechafin AS obra_fecha_fin',
            'obra.obra_observaciones AS obra_observaciones',
            'proveedor.id AS proveedor_id',
            'proveedor.proveedor_codigo AS proveedor_codigo',
            'proveedor.proveedor_tipo AS proveedor_tipo',
            'proveedor.proveedor_rif AS proveedor_rif',
            'proveedor.proveedor_nombre AS proveedor_nombre',
            'proveedor.proveedor_telefono AS proveedor_telefono',
            'proveedor.proveedor_direccion AS proveedor_direccion',
            'proveedor.proveedor_correo AS proveedor_correo'
        )
        ->leftJoin('obra', 'obra.id', '=','requisicion.obra_id')
        ->leftJoin('proveedor', 'proveedor.id', '=','requisicion.proveedor_id')
        ->where('requisicion.id', $id)
        ->limit(1)->get();

        //validamos que aun no haya sido vista para permitir su modificacion
        if ( $requisicion[0]->requisicion_estado != "No Vista" ) {
            return redirect()->route("home");
        }

        return view('sistema.requisicion.modificar')
        ->with('requisicion', $requisicion[0])
        // ->with('sol_det', $sol_det)
        ->with(['permisoUsuario' => $permisoUsuario[0], 'proveedor' => $proveedor, 'obra' => $obra]);
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
        //vlidamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->requisicion != 1 || $permisoUsuario[0]->modificar_requisicion != 1){
            return redirect()->route("home");
        }

        //Buscamos la requisicion en base a su id
        $req = Requisicion::find( $id );

        //validamos que aun no haya sido vista para permitir su modificacion
        if ( $req->requisicion_estado != "No Vista" ) {
            return redirect()->route("home");
        }

        $req->requisicion_fechae = $request->fechaE;
        $req->proveedor_id = $request->proveedorRec;
        $req->obra_id = $request->obra;
        $req->requisicion_direccion = $request->direccion;
        $req->requisicion_motivo = $request->motivo;
        $req->requisicion_observaciones = $request->observacion;
        //Guardamos la modificacion
        $resp = $req->save();
        //Retornamos a la vista principal de requisicion con la respuesta para enviar el mensaje
        return redirect()->route('requisicion.index')->with('resp', $resp);

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

        if( $permisoUsuario[0]->requisicion != 1 && $permisoUsuario[0]->desactivar_requisicion != 1 ){
            return redirect()->route("home");
        }
        //Buscamos  esta solicitud
        $destroy = Solicitud_detalle::find( $id );
        //Eliminamos el archivo solicitado
        $resp = $destroy->delete();
        //retornar la respuesta a la vista
        return response()->json($resp);


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
        // ->where('requisicion.usuario_id', \Auth::user()->id)
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

    public function jq_consultarTipo(Request $request, $valor)
    {

        // $busqueda = $request->search;



        //     switch ($valor) {
        //             case 'Material':
        //                 $querys = Material::orderBy('material_nombre', 'ASC')->select('id', 'material_nombre')->get();
        //                 break;

        //             case 'Servicio':
        //                 $querys = Servicio::orderBy('servicio_nombre', 'ASC')->select('id', 'servicio_nombre')->get();
        //                 break;

        //             case 'Viatico':
        //                 $querys = Viatico::orderBy('viatico_nombre', 'ASC')->select('id', 'viatico_nombre')->get();
        //                 break;

        //             default:
        //                 $querys = Material::orderBy('material_nombre', 'ASC')->select('id', 'material_nombre')->get();
        //                 break;
        //     }

        // $response = array();

        // switch ($valor) {
        //     case 'Material':

        //         foreach ($querys as $query) {
        //             $response[] = array(
        //                 'id' => $query->id,
        //                 'text' => $query->material_nombre,
        //             );
        //         }
        //         break;

        //     case 'Servicio':

        //         foreach ($querys as $query) {
        //             $response[] = array(
        //                 'id' => $query->id,
        //                 'text' => $query->servicio_nombre,
        //             );
        //         }
        //         break;

        //     case 'Viatico':

        //         foreach ($querys as $query) {
        //             $response[] = array(
        //                 'id' => $query->id,
        //                 'text' => $query->viatico_nombre,
        //             );
        //         }
        //         break;

        //     default:

        //         foreach ($querys as $query) {
        //             $response[] = array(
        //                 'id' => $query->id,
        //                 'text' => $query->material_nombre,
        //             );
        //         }
        //         break;
        // }

        // return response()->json( $response );


        //----------------------------------------

        // Metodo antiguo sin uso de ajax

        // Dependendo de la seleccion, muestra todo lo referente a material, servicio o viatico
        switch ($valor) {
            case 'Material':
                $query = Material::orderBy('material_nombre', 'ASC')->get();
                break;

            case 'Servicio':
                $query = Servicio::orderBy('servicio_nombre', 'ASC')->get();
                break;

            case 'Viatico':
                $query = Viatico::orderBy('viatico_nombre', 'ASC')->get();
                break;

            default:
                $query = Material::orderBy('material_nombre', 'ASC')->get();
                break;
        }
        //retorna toda la informacion por json
        return response()->json($query);
    }

    public function jq_consultarprov($id)
    {
        $pro = Proveedor::find($id);
        return response()->json($pro);
    }

    public function jq_consultarObra($id)
    {
        $obra = Obra::find($id);
        return response()->json($obra);
    }

    public function jq_consultarNombreConcepto($id, $tipo)
    {
        //dependiendo del tipo de producto que busque se activara la consulta Sql, se busca y se guarda en variable
        switch ($tipo) {
            case 'Material':
                $nombre = Material::select("material_nombre")->where('id', $id)->first();
                break;

            case 'Viatico':
                $nombre = Viatico::select("viatico_nombre")->where('id', $id)->first();
                break;

            case 'Servicio':
                $nombre = Servicio::select("servicio_nombre")->where('id', $id)->first();
                break;
            default:
                $nombre = Material::select("material_nombre")->where('id', $id)->first();
                break;
        }

        //Se envia por json a la vista
        return response()->json($nombre);
    }

    public function jq_listaMateriales($id, $tipo)
    {

        if ($tipo == "Material") {
            $sol_det = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                'solicitud_detalle.sd_caracteristicas AS sd_caracteristicas',
                'material.material_nombre AS material_nombre'
            )
            ->leftJoin('material', 'material.id', '=','solicitud_detalle.material_id')
            ->where('solicitud_detalle.requisicion_id', $id)
            ->get();
        }

        if ($tipo == "Servicio") {
            $sol_det = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                'solicitud_detalle.sd_caracteristicas AS sd_caracteristicas',
                'servicio.servicio_nombre AS servicio_nombre'
            )
            ->leftJoin('servicio', 'servicio.id', '=','solicitud_detalle.servicio_id')
            ->where('solicitud_detalle.requisicion_id', $id)
            ->get();
        }

        if ($tipo == "Viatico") {

            $sol_det = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                'solicitud_detalle.sd_caracteristicas AS sd_caracteristicas',
                'viatico.viatico_nombre AS viatico_nombre'
            )
            ->leftJoin('viatico', 'viatico.id', '=','solicitud_detalle.viatico_id')
            ->where('solicitud_detalle.requisicion_id', $id)
            ->get();

        }

        return response()->json([$sol_det, $tipo]);

    }

    public function jq_modificarNombreConcepto(Request $request)
    {

        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->requisicion != 1 && $permisoUsuario[0]->modificar_requisicion != 1 ){
            return redirect()->route("home");
        }

        // instanciamos y guardamos los archivos


            $agregar = new Solicitud_detalle();

            $agregar->sd_cantidad = $request->cantidad;
            $agregar->requisicion_id = $request->dato;

            if ($request->tipo == "Material") {
                $agregar->material_id = $request->concepto;
            } elseif ($request->tipo == "Servicio") {
                $agregar->servicio_id = $request->concepto;
            } elseif ($request->tipo == "Viatico") {
                $agregar->viatico_id = $request->concepto;
            }

            $agregar->sd_caracteristicas = $request->especificaciones;

            $resp = $agregar->save();

            if ($resp) {
                if ($request->tipo == "Material") {
                    $mostrar = Material::find( $request->concepto );
                    $mostrarNombre = $mostrar->material_nombre;
                } elseif ($request->tipo == "Servicio") {
                    $mostrar = Servicio::find( $request->concepto );
                    $mostrarNombre = $mostrar->servicio_nombre;
                } elseif ($request->tipo == "Viatico") {
                    $mostrar = Viatico::find( $request->concepto );
                    $mostrarNombre = $mostrar->viatico_nombre;
                }
            }




            return response()->json( [$mostrarNombre, $agregar->id] );

    }

    public function anular(Request $request)
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->requisicion != 1 && $permisoUsuario[0]->desactivar_requisicion != 1 ){
            return redirect()->route("home");
        }

        //Ubicamos la requisicion usando el ID
        $req = Requisicion::find( $request->dato );

        //validamos que aun no haya sido vista para permitir su anulacion
        if ( $req->requisicion_estado != "No Vista" ) {
            return redirect()->route("home");
        }

        //Cambiamos el estado de la reuqisicion a anulada
        $req->requisicion_estado = "Anulada";
        //Guardamos los cambios
        $resp = $req->save();
        //Retornamos los cambios por medio de json
        return response()->json( $resp );

    }







}
