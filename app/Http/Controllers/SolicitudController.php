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
use App\Models\Banco;
use App\Models\Banco_proveedor;
use App\Models\Solicitud_detalle;


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

        if($permisoUsuario[0]->solicitud != 1 || $permisoUsuario[0]->crear_solicitud != 1){
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
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->solicitud != 1 || $permisoUsuario[0]->crear_solicitud != 1){
            return redirect()->route("home");
        }

        //Validamos que el formulario tenga la informacion correcta
        $request->validate([
            'pagos' => 'required|max:10',
            'obra' => 'required|max:12',
            'opcion' => 'required|max:12',
            'forma_pago' => 'required|max:12',
            'numero_cuenta' => 'required|max:12',
            'iva' => 'required|max:12',
            'requisicion' => 'max:12',
            'motivo' => 'required|max:250',
            'observacion' => 'max:250'
        ]);

        //Solicitamos el ultimo codigo en el sistema
        $cdSol = Solicitud::select("solicitud_numerocontrol")->orderBy("id", "desc")->limit(1)->get();
        //Definimos para el codigo de control, la letra que acompaara al codigo dependiendo de la opcion seleccionada
        switch ($request->opcion) {
            case '1':
            $tipo = "M"; //material
            break;

            case '2':
            $tipo = "S"; //Servicio
            break;


            case '3':
            $tipo = "V"; //Viatico
            break;


            case '4':
            $tipo = "C"; //Caja chica la cual aun no esta habilitada
            break;


            case '5':
            $tipo = "N"; //Nomina
            break;

        }

        //Creamos el codigo unico que se guardara en la base de datos
        if(count($cdSol) < 1){
            //Si es menor a 1
            $codSolicitud = "SOL" . $tipo . "-1";
        } else {
            //Se extrae el numero y se le agrega un valor mas (xx + 1)
            preg_match_all('!\d+!', $cdSol[0]->solicitud_numerocontrol, $cod);
            $cod = $cod[0][0] + 1;
            $codSolicitud = "SOL" . $tipo . "-".$cod;
        }
        // dd($request->all());
        //Instanciamos la solicitud
        $solicitud = new Solicitud();
        //Colocamos la informacion capturada en el request en cada uno de los campos a guardar en la BD
        $solicitud->solicitud_fecha = date('Y-m-d');
        $solicitud->solicitud_numerocontrol = $codSolicitud;
        $solicitud->solicitud_tipo = $request->opcion;
        $solicitud->solicitud_tiposolicitud = $request->pagos;
        $solicitud->solicitud_iva = $request->iva;
        $solicitud->solicitud_observaciones = $request->observacion;
        $solicitud->solicitud_formapago = $request->forma_pago;
        $solicitud->solicitud_motivo = $request->motivo;
        $solicitud->usuario_id = \Auth::user()->id ;
        $solicitud->obra_id = $request->obra;
        $solicitud->proveedor_id = $request->proveedor;
        $solicitud->banco_proveedor_id = $request->numero_cuenta;
        $solicitud->requisicion_id = $request->requisicion;
        //Guardamos la informacion de todo lo capturado
        $resultado = $solicitud->save();
        //De no hacer el proceso anterior, envia un mensaje de error
        if (!$resultado) {
            return Redirect::back()->withErrors(['msg' => 'El formulario no ha sido cargado correctamente']);
        } else {
            //En caso contrario, has un bucle cargando la informacion de los costos en base a los materiales
            //existentes en el formulario
            foreach (array_keys( $request->cantidadHide ) as $key) {
                //Instanciamos en donde guardaremos los precios
                $soldet = new Solicitud_detalle();
                //agregamos en su contenedor la cantidad
                $soldet->sd_cantidad = $request->cantidadHide[$key];
                //Agregamos el ID de la solicitud
                $soldet->solicitud_id = $solicitud->id;

                //Segun lo seleccionado, guardamos en el campo indicado.
                if ($request->opcion == "1") {       //materiales
                    $soldet->material_id = $request->conceptoHide[$key];
                } elseif ($request->opcion == "2") { // servicios
                    $soldet->servicio_id = $request->conceptoHide[$key];
                } elseif ($request->opcion == "3") { //  viaticos
                    $soldet->viatico_id = $request->conceptoHide[$key];
                } elseif ($request->opcion == "5") { //    nomina
                    $soldet->nomina_id = $request->conceptoHide[$key];
                }

                $soldet->sd_preciounitario = $request->montoHide[$key];
                $soldet->save();
            }

            if ($soldet) {
                return redirect()->route('solicitud.index')->with('resp', 1);
            } else {
                return redirect()->route('solicitud.index')->with('resp', 0);
            }
        }






        //retorna la respuesta en una vista
        return redirect()->route('solicitud.index')->with('resp', $resp);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->solicitud != 1 || $permisoUsuario[0]->ver_botones_solicitud != 1){
            return redirect()->route("home");
        }

        $solicitud = Solicitud::select(
            'solicitud.id AS id',
            'solicitud.solicitud_numerocontrol AS solicitud_numerocontrol',
            'solicitud.solicitud_fecha AS solicitud_fecha',
            'solicitud.solicitud_motivo AS solicitud_motivo',
            'solicitud.solicitud_observaciones AS solicitud_observaciones',
            'solicitud.solicitud_aprobacion AS solicitud_aprobacion',
            'solicitud.solicitud_tipo AS solicitud_tipo',
            'solicitud.solicitud_formapago AS solicitud_formapago',
            'solicitud.solicitud_iva AS solicitud_iva',
            'obra.obra_codigo AS obra_codigo',
            'obra.obra_nombre AS obra_nombre',
            'obra.obra_fechainicio AS obra_fechainicio',
            'obra.obra_fechafin AS obra_fechafin',
            'proveedor.proveedor_codigo AS proveedor_codigo',
            'proveedor.proveedor_tipo AS proveedor_tipo',
            'proveedor.proveedor_rif AS proveedor_rif',
            'proveedor.proveedor_nombre AS proveedor_nombre',
            'proveedor.proveedor_telefono AS proveedor_telefono',
            'proveedor.proveedor_direccion AS proveedor_direccion',
            'proveedor.proveedor_correo AS proveedor_correo',
            'requisicion.requisicion_codigo AS requisicion_codigo',
            'requisicion.requisicion_tipo AS requisicion_tipo',
            'requisicion.requisicion_fecha AS requisicion_fecha',
            'requisicion.requisicion_fechae AS requisicion_fechae',
            'requisicion.requisicion_motivo AS requisicion_motivo',
            'requisicion.requisicion_direccion AS requisicion_direccion',
            'requisicion.requisicion_estado AS requisicion_estado'
        )
        ->leftJoin('obra', 'obra.id', '=', 'solicitud.obra_id')
        ->leftJoin('proveedor', 'proveedor.id', '=', 'solicitud.proveedor_id')
        ->leftJoin('requisicion', 'requisicion.id', '=', 'solicitud.requisicion_id')
        ->where('solicitud.id', $id)
        ->first();


        if ($solicitud->solicitud_tipo == "1") {       //materiales

            $costo = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                'solicitud_detalle.sd_preciounitario AS sd_preciounitario',
                'material.material_nombre AS nombre'
                )
                ->leftJoin('material', 'material.id', '=', 'solicitud_detalle.material_id')
                ->where('solicitud_id', $solicitud->id)->get();

        } elseif ($solicitud->solicitud_tipo == "2") { // servicios

            $costo = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                'solicitud_detalle.sd_preciounitario AS sd_preciounitario',
                'servicio.servicio_nombre AS nombre'
                )
                ->leftJoin('servicio', 'servicio.id', '=', 'solicitud_detalle.servicio_id')
                ->where('solicitud_id', $solicitud->id)->get();

        } elseif ($solicitud->solicitud_tipo == "3") { //  viaticos

            $costo = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                'solicitud_detalle.sd_preciounitario AS sd_preciounitario',
                'viatico.viatico_nombre AS nombre'
                )
                ->leftJoin('viatico', 'viatico.id', '=', 'solicitud_detalle.viatico_id')
                ->where('solicitud_id', $solicitud->id)->get();

        } elseif ($solicitud->solicitud_tipo == "4") { //    Caja Chica

            $costo = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                'solicitud_detalle.sd_preciounitario AS sd_preciounitario',
                'caja.caja_nombre AS nombre'
                )
                ->leftJoin('caja', 'caja.id', '=', 'solicitud_detalle.caja_id')
                ->where('solicitud_id', $solicitud->id)->get();

        } elseif ($solicitud->solicitud_tipo == "5") { //    nomina

            $costo = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                'solicitud_detalle.sd_preciounitario AS sd_preciounitario',
                'nomina.nomina_nombre AS nombre'
                )
                ->leftJoin('nomina', 'nomina.id', '=', 'solicitud_detalle.nomina_id')
                ->where('solicitud_id', $solicitud->id)->get();

        }





        dump( $solicitud );
        dump( $costo );
        return view('sistema.solicitud.consultar')->with(
            [
                'permisoUsuario' => $permisoUsuario[0],
                'solicitud' => $solicitud,
                'costo' => $costo
            ]
        );






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

    public function listarRequisicion($id)
    {

        switch ($id) {
            case '1':
                $valor = "Material";
                break;
            case '2':
                $valor = "Servicio";
                break;
            case '3':
                $valor = "Viatico";
            break;
            case '4':
                $valor = "Nomina";
            break;
            case '5':
                $valor = "Nomina";
            break;

        default:
            # code...
            break;
        }


        $requisicion = Requisicion::select(
            'requisicion.id AS id',
            'requisicion.requisicion_codigo AS requisicion_codigo',
            'obra.obra_nombre AS obra',

        )
        ->leftJoin('obra','obra.id', '=', 'requisicion.obra_id')
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

        $materiales = Solicitud_detalle::select(
            'solicitud_detalle.id AS id',
            'solicitud_detalle.sd_cantidad AS sd_cantidad',
            'solicitud_detalle.sd_preciounitario AS sd_preciounitario',
            'solicitud_detalle.sd_caracteristicas AS sd_caracteristicas',
            'material.material_nombre AS material_nombre'
            )
            ->leftJoin('material', 'material.id', '=', 'solicitud_detalle.material_id')
            ->where('requisicion_id', $requisicion[0]->id)->get();

        return response()->json([$requisicion, $materiales]);
    }

    public function consultarNroCuenta($id)
    {
        $banco = Banco_proveedor::select(
            'banco_proveedor.id AS id',
            'banco_proveedor.numero AS numero',
            'banco.banco_nombre AS banco_nombre',
            'banco.banco_rif AS banco_rif',
            'banco_proveedor.tipodecuenta AS tipoCuenta'
        )
        ->leftJoin('banco', 'banco_proveedor.banco_id', '=', 'banco.id')
        ->where('banco_proveedor.proveedor_id', $id)
        ->get();

        return response()->json( $banco);

    }

    public function consultarNomina()
    {
        $nomina = Nomina::select()->orderBy('id', 'DESC')->get();
        return response()->json( $nomina );
    }

    public function consultarListaMateriales($id)
    {

        if ($id == 1) {
            $mat = Material::select()->orderBy('material_nombre', 'ASC')->get();
        } elseif($id == 2) {
            $mat = Servicio::select()->orderBy('id', 'DESC')->get();
        } elseif($id == 3) {
            $mat = Viatico::select()->orderBy('id', 'DESC')->get();
        } elseif ($id == 5) {
            $mat = Nomina::select()->orderBy('id', 'DESC')->get();
        }

        return response()->json( $mat );

    }

    public function cargarNombreConcepto(Request $request)
    {
        $mat = "";

        switch ($request->opcion) {

            case '1':
                # Materiales
                $mat = Material::find($request->concepto);
                break;

            case '2':
                # Servicio
                $mat = Servicio::find($request->concepto);
                break;

            case '3':
                # Viatico
                $mat = Viatico::find($request->concepto);
                break;

            case '4':
                # Caja Chica la cual no esta creada
                $mat = Nomina::find($request->concepto);
                break;

            case '5':
                # Nomina
                $mat = Nomina::find($request->concepto);
                break;

        }

        // $mat = Material::find($request->concepto);
        return response()->json($mat);
    }



}
