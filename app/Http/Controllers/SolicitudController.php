<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
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
// use App\Models\Banco;
use App\Models\Pago;
use App\Models\Banco_proveedor;
use App\Models\Solicitud_detalle;
use App\Models\User;
use App\Models\Cuenta;


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
        $obra = Obra::select('id', 'obra_codigo', 'obra_nombre')->where('obra_estado', 1)->orderBy('id', 'DESC')->get();

        //Solicitamos la lista de proveedores
        $proveedor = Proveedor::select('id', 'proveedor_codigo', 'proveedor_nombre')->where('proveedor_estado', 1)->get();

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
        $solicitud->moneda = $request->tipoMoneda;
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
            //Busca las caracteristicas de la requisicion
            $req = Requisicion::find( $request->requisicion );
            //Si existe la requisicion
            if($req){
                //Si el estado esta en vista o no vista, cambia su estado en "En proceso"
                if($req->requisicion_estado == "No Vista" OR $req->requisicion_estado == "Vista"){
                    $req->requisicion_estado = "En Proceso";
                    $req->save();
                }
            }





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
                //Agregamos el precio unitario de la solicitud
                $soldet->sd_preciounitario = $request->montoHide[$key];
                //Agregamos el tipo de moneda a usar
                $soldet->moneda = $request->dolarHide[$key];
                $soldet->save();
            }
        //
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
            'solicitud.solicitud_comentario AS solicitud_comentario',
            'solicitud.solicitud_estadopago AS solicitud_estadopago',
            'users.user_name AS nombre_aprobador',
            'solicitud.usuario_id AS usuario_id',
            'banco_proveedor.numero AS numero',
            'banco.banco_nombre AS banco_nombre',
            'banco_proveedor.tipodecuenta AS tipodecuenta',
            'obra.obra_codigo AS obra_codigo',
            'obra.obra_nombre AS obra_nombre',
            'obra.obra_fechainicio AS obra_fechainicio',
            'obra.obra_fechafin AS obra_fechafin',
            'obra.obra_observaciones AS obra_observaciones',
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
        ->leftJoin('users', 'users.id', '=', 'solicitud.aprobador_id')
        ->leftJoin('banco_proveedor', 'banco_proveedor.id', '=', 'solicitud.banco_proveedor_id')
        ->leftJoin('banco', 'banco.id', '=', 'banco_proveedor.banco_id')
        ->where('solicitud.id', $id)
        ->where('solicitud.usuario_id', \Auth::user()->id)
        ->first();

        //En base a la consulta se busca el nombre de quien creó la solicitud
        $usuario = User::select('user_name')->where('id', $solicitud->usuario_id )->first();


        if ($solicitud->solicitud_tipo == "1") {       //materiales

            $costo = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                'solicitud_detalle.sd_preciounitario AS sd_preciounitario',
                'solicitud_detalle.moneda AS moneda',
                'material.material_nombre AS nombre'
                )
                ->leftJoin('material', 'material.id', '=', 'solicitud_detalle.material_id')
                ->where('solicitud_id', $solicitud->id)->get();

        } elseif ($solicitud->solicitud_tipo == "2") { // servicios

            $costo = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                'solicitud_detalle.sd_preciounitario AS sd_preciounitario',
                'solicitud_detalle.moneda AS moneda',
                'servicio.servicio_nombre AS nombre'
                )
                ->leftJoin('servicio', 'servicio.id', '=', 'solicitud_detalle.servicio_id')
                ->where('solicitud_id', $solicitud->id)->get();

        } elseif ($solicitud->solicitud_tipo == "3") { //  viaticos

            $costo = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                'solicitud_detalle.sd_preciounitario AS sd_preciounitario',
                'solicitud_detalle.moneda AS moneda',
                'viatico.viatico_nombre AS nombre'
                )
                ->leftJoin('viatico', 'viatico.id', '=', 'solicitud_detalle.viatico_id')
                ->where('solicitud_id', $solicitud->id)->get();

        } elseif ($solicitud->solicitud_tipo == "4") { //    Caja Chica

            $costo = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                'solicitud_detalle.sd_preciounitario AS sd_preciounitario',
                'solicitud_detalle.moneda AS moneda',
                'caja.caja_nombre AS nombre'
                )
                ->leftJoin('caja', 'caja.id', '=', 'solicitud_detalle.caja_id')
                ->where('solicitud_id', $solicitud->id)->get();

        } elseif ($solicitud->solicitud_tipo == "5") { //    nomina

            $costo = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                'solicitud_detalle.sd_preciounitario AS sd_preciounitario',
                'solicitud_detalle.moneda AS moneda',
                'nomina.nomina_nombre AS nombre'
                )
                ->leftJoin('nomina', 'nomina.id', '=', 'solicitud_detalle.nomina_id')
                ->where('solicitud_id', $solicitud->id)->get();

        }

        return view('sistema.solicitud.consultar')->with(
            [
                'permisoUsuario' => $permisoUsuario[0],
                'solicitud' => $solicitud,
                'costo' => $costo,
                'usuario' => $usuario
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
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->solicitud != 1 || $permisoUsuario[0]->modificar_solicitud != 1 ){
            return redirect()->route("home");
        }
        //Solicitamos la informacion de la solicitud
        $solicitud = Solicitud::find( $id );
        //Solicitamos la lista de obra
        $obra = Obra::select('id', 'obra_codigo', 'obra_nombre')->orderBy('id', 'DESC')->where('obra_estado', 1)->get();

        //Solicitamos la lista de proveedores
        $proveedor = Proveedor::select('id', 'proveedor_codigo', 'proveedor_nombre')->where('proveedor_estado', 1)->get();
        // dump( $solicitud );
        //retornamos a la vista para crear solicitudes
        return view('sistema.solicitud.modificar')
        ->with('permisoUsuario', $permisoUsuario[0])
        ->with('solicitud', $solicitud)
        ->with('obra', $obra)
        ->with('id', $id)
        ->with('proveedor', $proveedor);

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

        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->solicitud != 1 || $permisoUsuario[0]->modificar_solicitud != 1 ){
            return redirect()->route("home");
        }

        //buscamos la solicitud asociada a su id
        $solicitud = Solicitud::find( $id );

        //Validamos que sea la misma persona que creo la solicitud, quien modifique los datos
        if(\Auth::user()->id != $solicitud->usuario_id){
            return redirect()->route("solicitud.index")->with('edit', "No puede");
        }

        //realizamos la sustitucion de la informacion
        $solicitud->solicitud_iva = $request->iva;
        $solicitud->solicitud_tiposolicitud = $request->pagos;
        $solicitud->solicitud_observaciones = $request->observacion;
        $solicitud->solicitud_formapago = $request->forma_pago;
        $solicitud->solicitud_motivo = $request->motivo;
        $solicitud->usuario_id = \Auth::user()->id ;
        $solicitud->obra_id = $request->obra;
        $solicitud->proveedor_id = $request->proveedor;
        $solicitud->banco_proveedor_id = $request->numero_cuenta;
        $solicitud->requisicion_id = $request->requisicion;
        //Guardamos las modificaciones
        $resp = $solicitud->save();
        //Retornamos a la vista
        return redirect()->route('solicitud.index')->with('mod', $resp);


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

        if( $permisoUsuario[0]->solicitud != 1 || $permisoUsuario[0]->anular_solicitud != 1 ){
            return redirect()->route("home");
        }

        //Campturamos el ID dela solicitud a anular
        $anular = Solicitud::find($id);


        //Validamos que sea la misma persona que creo la solicitud, quien modifique los datos
        if(\Auth::user()->id != $anular->usuario_id){
            return response()->json("negativo");
        }


        //Cambiamos el estado a anulado
        $anular->solicitud_aprobacion = "Anulada";
        //Guardamos en la base de datos esta modificacion de estado
        $resp = $anular->save();
        //Retornamos la respuesta a la vista por medio de json
        return response()->json($resp);
    }


    public function eliminarSolicitudDetalle(Request $request)
    {

        //Queda pendiente por crear una validacion para la eliminacion de la solicitud de los materiales

        //Buscas el ID seleccionado
        $elim = Solicitud_detalle::find( $request->id );

        //Borrar todo lo referente a ese ID eliminado
        $resp = $elim->delete();
        //Retorna la respuesta por json
        return response()->json($resp);
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
        ->where('solicitud.usuario_id', \Auth::user()->id) //habilita el solo mostrar informacion de quien crea la solicitud
        ->orderBy('id', 'DESC')
        ->limit(5000)
        ->get();

        // validamos que opciones maneja este usuario y dependiendo de esto, se muestra la informacion
        if ( $permisoUsuario[0]->solicitud == 1 && $permisoUsuario[0]->ver_botones_solicitud == 1) {
            return datatables()->of($query)
            ->addColumn('btn','sistema.solicitud.btnSolicitud')
            ->addColumn('btn2','sistema.solicitud.aprobacion.btnAproRepro')
            ->rawColumns(['btn','btn2'])->toJson();
        } else {
            return datatables()->of($query)
            ->addColumn('btn','sistema.btnNull')
            ->rawColumns(['btn','btn2'])->toJson();
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
        ->limit(1)->first();

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


    public function consultarRequisicion($id, $valor)
    {
        $requisicion = Requisicion::select(
            'requisicion.id AS id',
            'requisicion.requisicion_codigo AS requisicion_codigo',
            'requisicion.requisicion_tipo AS requisicion_tipo',
            'requisicion.requisicion_fecha AS requisicion_fecha',
            'requisicion.requisicion_fechae AS requisicion_fechae',
            'requisicion.requisicion_observaciones AS requisicion_observaciones',
            'obra.obra_nombre AS obra',
            'requisicion.requisicion_motivo AS requisicion_motivo',
            'requisicion.requisicion_estado AS requisicion_estado',
            'users.user_name AS usuario_nombre',
            'proveedor.proveedor_nombre AS proveedor_nombre'
        )
        ->leftJoin('obra','obra.id', '=', 'requisicion.obra_id')
        ->leftJoin('users','users.id', '=', 'requisicion.usuario_id')
        ->leftJoin('proveedor','proveedor.id', '=', 'requisicion.proveedor_id')
        ->where('requisicion.id', $id)
        ->limit(1)
        ->get();

        if ( $valor == 1 ) {
            $materiales = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                // 'solicitud_detalle.sd_preciounitario AS sd_preciounitario',
                'solicitud_detalle.sd_caracteristicas AS sd_caracteristicas',
                'material.material_nombre AS nombre'
                )
                ->leftJoin('material', 'material.id', '=', 'solicitud_detalle.material_id')
                ->where('requisicion_id', $requisicion[0]->id)->get();
        } elseif( $valor == 2 ) {
            $materiales = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                // 'solicitud_detalle.sd_preciounitario AS sd_preciounitario',
                'solicitud_detalle.sd_caracteristicas AS sd_caracteristicas',
                'servicio.servicio_nombre AS nombre'
                )
                ->leftJoin('servicio', 'servicio.id', '=', 'solicitud_detalle.servicio_id')
                ->where('requisicion_id', $requisicion[0]->id)->get();
        }  elseif( $valor == 3 ) {
            $materiales = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                // 'solicitud_detalle.sd_preciounitario AS sd_preciounitario',
                'solicitud_detalle.sd_caracteristicas AS sd_caracteristicas',
                'viatico.viatico_nombre AS nombre'
                )
                ->leftJoin('viatico', 'viatico.id', '=', 'solicitud_detalle.viatico_id')
                ->where('requisicion_id', $requisicion[0]->id)->get();
        }  elseif( $valor == 4 ) {
            $materiales = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                // 'solicitud_detalle.sd_preciounitario AS sd_preciounitario',
                'solicitud_detalle.sd_caracteristicas AS sd_caracteristicas',
                'caja.caja_nombre AS nombre'
                )
                ->leftJoin('caja', 'caja.id', '=', 'solicitud_detalle.caja_id')
                ->where('requisicion_id', $requisicion[0]->id)->get();
        }  elseif( $valor == 5 ) {
            $materiales = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                // 'solicitud_detalle.sd_preciounitario AS sd_preciounitario',
                'solicitud_detalle.sd_caracteristicas AS sd_caracteristicas',
                'nomina.nomina_nombre AS nombre'
                )
                ->leftJoin('nomina', 'nomina.id', '=', 'solicitud_detalle.nomina_id')
                ->where('requisicion_id', $requisicion[0]->id)->get();
        }
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

    public function cargaInicial(Request $request){  //Rosman

        $solicitud = Solicitud::find( $request->id );
        return response()->json( [$solicitud] );

    }

    public function consultarListaReq($tipo, $valor)
    {

        if ($tipo == "1") {       //materiales

            $costo = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                'solicitud_detalle.sd_preciounitario AS sd_preciounitario',
                'solicitud_detalle.moneda AS moneda',
                'material.material_nombre AS nombre'
                )
                ->leftJoin('material', 'material.id', '=', 'solicitud_detalle.material_id')
                ->where('solicitud_id', $valor)->get();

        } elseif ($tipo == "2") { // servicios

            $costo = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                'solicitud_detalle.sd_preciounitario AS sd_preciounitario',
                'solicitud_detalle.moneda AS moneda',
                'servicio.servicio_nombre AS nombre'
                )
                ->leftJoin('servicio', 'servicio.id', '=', 'solicitud_detalle.servicio_id')
                ->where('solicitud_id', $valor)->get();

        } elseif ($tipo == "3") { //  viaticos

            $costo = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                'solicitud_detalle.sd_preciounitario AS sd_preciounitario',
                'solicitud_detalle.moneda AS moneda',
                'viatico.viatico_nombre AS nombre'
                )
                ->leftJoin('viatico', 'viatico.id', '=', 'solicitud_detalle.viatico_id')
                ->where('solicitud_id', $valor)->get();

        } elseif ($tipo == "4") { //    Caja Chica

            $costo = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                'solicitud_detalle.sd_preciounitario AS sd_preciounitario',
                'solicitud_detalle.moneda AS moneda',
                'caja.caja_nombre AS nombre'
                )
                ->leftJoin('caja', 'caja.id', '=', 'solicitud_detalle.caja_id')
                ->where('solicitud_id', $valor)->get();

        } elseif ($tipo == "5") { //    nomina

            $costo = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                'solicitud_detalle.sd_preciounitario AS sd_preciounitario',
                'solicitud_detalle.moneda AS moneda',
                'nomina.nomina_nombre AS nombre'
                )
                ->leftJoin('nomina', 'nomina.id', '=', 'solicitud_detalle.nomina_id')
                ->where('solicitud_id', $valor)->get();

        }

        return response()->json($costo);
    }

    public function agregarMaterialExtra(Request $request)
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->solicitud != 1 || $permisoUsuario[0]->crear_solicitud != 1){
            return redirect()->route("home");
        }

        //Instanciamos en donde guardaremos los precios
        $mat = new Solicitud_detalle();
        //agregamos en su contenedor la cantidad
        $mat->sd_cantidad = $request->cantidad;
        //Agregamos el ID de la solicitud
        $mat->solicitud_id = $request->id;

        //Segun lo seleccionado, guardamos en el campo indicado.
        if ($request->opcion == "1") {       //    materiales
            $mat->material_id = $request->concepto;
        } elseif ($request->opcion == "2") { //    servicios
            $mat->servicio_id = $request->concepto;
        } elseif ($request->opcion == "3") { //    viaticos
            $mat->viatico_id = $request->concepto;
        } elseif ($request->opcion == "4") { //    caja chica
            $mat->caja_id = $request->concepto;
        } elseif ($request->opcion == "5") { //    nomina
            $mat->nomina_id = $request->concepto;
        }
        //Agregamos el precio unitario de la solicitud
        $mat->sd_preciounitario = $request->precio;
        //Agregamos el tipo de moneda a usar
        $mat->moneda = $request->moneda;
        //Resguardamos en la base de datos
        $resp = $mat->save();
        //Retornamos a la vista el ID mediante el json (en caso que la respuesta sea afirmativa)
        if($resp){
            return response()->json($mat->id);
        } else {
            return response()->json(false);
        }

    }


    //---------------------- Solicitudes de pago --------------------------------

    public function solicitudesPagoIndex()
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->solicitud_pago != 1 ){
            return redirect()->route("home");
        }

        return view('sistema.solicitud.aprobacion.index')->with([
            'permisoUsuario' => $permisoUsuario[0]
        ]);
    }

    public function solicitudesPagoLista()
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->solicitud_pago != 1 ){
            return redirect()->route("home");
        }

        //Realizamos la consulta a la base de datos


        $query = DB::select('select
        `solicitud`.`id` as `id`,
        `solicitud`.`solicitud_numerocontrol` as `solicitud_numerocontrol`,
        `solicitud`.`solicitud_fecha` as `fecha`,
        `solicitud`.`solicitud_estadopago` as `pago`,
        (select SUM(solicitud_detalle.sd_cantidad * solicitud_detalle.sd_preciounitario) from solicitud_detalle WHERE solicitud.id = solicitud_detalle.solicitud_id) as `suma`,
        `solicitud`.`moneda` as `moneda`,
        `obra`.`obra_nombre` as `obra_nombre`,
        `solicitud`.`solicitud_motivo` as `solicitud_motivo`,
        `solicitud`.`solicitud_aprobacion` as `solicitud_aprobacion`,
        `users`.`user_name` as `nombre`

        from `solicitud`
        left join `users` on `users`.`id` = `solicitud`.`usuario_id`
        left join `obra` on `obra`.`id` = `solicitud`.`obra_id`
        order by `id` desc limit 500');

        // $query = Solicitud::select(
        //     'solicitud.id AS id',
        //     'solicitud.solicitud_numerocontrol AS solicitud_numerocontrol',
        //     'solicitud.solicitud_fecha AS fecha',
        //     'solicitud.solicitud_motivo AS solicitud_motivo',
        //     'solicitud.solicitud_aprobacion AS solicitud_aprobacion',
        //     'obra.obra_nombre AS obra_nombre',
        //     'users.user_name AS nombre'
        // )
        // ->leftJoin('users','users.id', '=', 'solicitud.usuario_id')
        // ->leftJoin('obra','obra.id', '=', 'solicitud.obra_id')
        // ->orderBy('id', 'DESC')
        // ->limit(1000)
        // ->toSql();


        // validamos que opciones maneja este usuario y dependiendo de esto, se muestra la informacion
        if ( $permisoUsuario[0]->solicitud_pago == 1 && $permisoUsuario[0]->ver_solicitud_pago == 1) {
            return datatables()->of($query)
            ->addColumn('btn','sistema.solicitud.aprobacion.btnConsultarAprobacion')
            ->addColumn('aproRepro', 'sistema.solicitud.aprobacion.btnAproRepro')
            ->addColumn('btn2','sistema.solicitud.aprobacion.btnPago')
            ->rawColumns(['btn', 'aproRepro', 'btn2'])->toJson();
        } else {
            return datatables()->of($query)
            ->addColumn('btn','sistema.btnNull')
            ->addColumn('aproRepro','sistema.solicitud.aprobacion.btnAproRepro')
            ->addColumn('btn2','sistema.solicitud.aprobacion.btnPago')
            ->rawColumns(['btn', 'aproRepro', 'btn2'])->toJson();
        }
    }


    public function consultarAprobacion($id)
    {

        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->solicitud_pago != 1 || $permisoUsuario[0]->ver_solicitud_pago != 1){
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
            'solicitud.solicitud_comentario AS solicitud_comentario',
            'solicitud.solicitud_estadopago AS solicitud_estadopago',
            'users.user_name AS nombre_aprobador',
            'solicitud.usuario_id AS usuario_id',
            'banco_proveedor.numero AS numero',
            'banco.banco_nombre AS banco_nombre',
            'banco_proveedor.tipodecuenta AS tipodecuenta',
            'obra.obra_codigo AS obra_codigo',
            'obra.obra_nombre AS obra_nombre',
            'obra.obra_fechainicio AS obra_fechainicio',
            'obra.obra_fechafin AS obra_fechafin',
            'obra.obra_observaciones AS obra_observaciones',
            'proveedor.proveedor_codigo AS proveedor_codigo',
            'proveedor.proveedor_tipo AS proveedor_tipo',
            'proveedor.proveedor_rif AS proveedor_rif',
            'proveedor.proveedor_nombre AS proveedor_nombre',
            'proveedor.proveedor_telefono AS proveedor_telefono',
            'proveedor.proveedor_direccion AS proveedor_direccion',
            'proveedor.proveedor_correo AS proveedor_correo',
            'requisicion.id AS id_requisicion',
            'requisicion.requisicion_codigo AS requisicion_codigo',
            'requisicion.requisicion_tipo AS requisicion_tipo',
            'requisicion.requisicion_fecha AS requisicion_fecha',
            'requisicion.requisicion_fechae AS requisicion_fechae',
            'requisicion.requisicion_motivo AS requisicion_motivo',
            'requisicion.requisicion_direccion AS requisicion_direccion',
            'requisicion.requisicion_estado AS requisicion_estado',
            'requisicion.usuario_id AS usuario_id',
        )
        ->leftJoin('obra', 'obra.id', '=', 'solicitud.obra_id')
        ->leftJoin('proveedor', 'proveedor.id', '=', 'solicitud.proveedor_id')
        ->leftJoin('requisicion', 'requisicion.id', '=', 'solicitud.requisicion_id')
        ->leftJoin('users', function ($join) {
            $join->on('users.id', '=', 'solicitud.aprobador_id');
            // ->orOn('users.id', '=', 'requisicion.usuario_id');
        })
        ->leftJoin('banco_proveedor', 'banco_proveedor.id', '=', 'solicitud.banco_proveedor_id')
        ->leftJoin('banco', 'banco.id', '=', 'banco_proveedor.banco_id')
        ->where('solicitud.id', $id)
        ->first();

        //Si existe el id de la requisicion, que me de el nombre de quien la realizo
        if($solicitud->id_requisicion){
            $nombre = User::select('user_name')->where('id',  $solicitud->usuario_id)->first();
        } else {
            $nombre = false;
        }

        //En base a la consulta se busca el nombre de quien creó la solicitud
        $usuario = User::select('user_name')->where('id', $solicitud->usuario_id )->first();

        if ($solicitud->solicitud_tipo == "1") {       //materiales

            $costo = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                'solicitud_detalle.sd_preciounitario AS sd_preciounitario',
                'solicitud_detalle.moneda AS moneda',
                'material.material_nombre AS nombre'
                )
                ->leftJoin('material', 'material.id', '=', 'solicitud_detalle.material_id')
                ->where('solicitud_id', $solicitud->id)->get();

        } elseif ($solicitud->solicitud_tipo == "2") { // servicios

            $costo = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                'solicitud_detalle.sd_preciounitario AS sd_preciounitario',
                'solicitud_detalle.moneda AS moneda',
                'servicio.servicio_nombre AS nombre'
                )
                ->leftJoin('servicio', 'servicio.id', '=', 'solicitud_detalle.servicio_id')
                ->where('solicitud_id', $solicitud->id)->get();

        } elseif ($solicitud->solicitud_tipo == "3") { //  viaticos

            $costo = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                'solicitud_detalle.sd_preciounitario AS sd_preciounitario',
                'solicitud_detalle.moneda AS moneda',
                'viatico.viatico_nombre AS nombre'
                )
                ->leftJoin('viatico', 'viatico.id', '=', 'solicitud_detalle.viatico_id')
                ->where('solicitud_id', $solicitud->id)->get();

        } elseif ($solicitud->solicitud_tipo == "4") { //    Caja Chica

            $costo = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                'solicitud_detalle.sd_preciounitario AS sd_preciounitario',
                'solicitud_detalle.moneda AS moneda',
                'caja.caja_nombre AS nombre'
                )
                ->leftJoin('caja', 'caja.id', '=', 'solicitud_detalle.caja_id')
                ->where('solicitud_id', $solicitud->id)->get();

        } elseif ($solicitud->solicitud_tipo == "5") { //    nomina

            $costo = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                'solicitud_detalle.sd_preciounitario AS sd_preciounitario',
                'solicitud_detalle.moneda AS moneda',
                'nomina.nomina_nombre AS nombre'
                )
                ->leftJoin('nomina', 'nomina.id', '=', 'solicitud_detalle.nomina_id')
                ->where('solicitud_id', $solicitud->id)->get();

        }
        //Dependiendo si extiste o no costo, retornara la informacion a la vista

        if (count( $costo ) >= 1) {
            //Sumamos los costos
            for ($i=0; $i < count( $costo ); $i++) {
                $num[] = $costo[$i]->sd_preciounitario * $costo[$i]->sd_cantidad;
            }
            //Si num existe (para nomina no deberia de existir)
            // dd(  );
            if($num){
                //Suma los montos dentro de un array
                $total = array_sum($num);
                //enviamos toda la informacion a la vista
                return view('sistema.solicitud.aprobacion.consultar')->with(
                    [
                        'permisoUsuario' => $permisoUsuario[0],
                        'solicitud' => $solicitud,
                        'costo' => $costo,
                        'usuario' => $usuario,
                        'total' => $total,
                        'nombre' => $nombre
                    ]

                );
            }

        } else {

            return view('sistema.solicitud.aprobacion.consultar')->with(
                [
                    'permisoUsuario' => $permisoUsuario[0],
                    'solicitud' => $solicitud,
                    'costo' => array(),
                    'usuario' => $usuario,
                    'total' => array(),
                    'nombre' => $nombre
                ]

            );
        }

        return view('sistema.solicitud.aprobacion.consultar')->with(
            [
                'permisoUsuario' => $permisoUsuario[0],
                'solicitud' => $solicitud,
                'costo' => $costo,
                'usuario' => $usuario,
                'total' => array(),
                'nombre' => $nombre
            ]
        );

    }


    public function solicitudesPagoRespuestaAprobada(Request $request)
    {

        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->solicitud_pago != 1 || $permisoUsuario[0]->aprobacion_solicitud_pago != 1){
            return redirect()->route("home");
        }

        //Buscamos la informacion asociado a esta solicitud
        $solicitud = Solicitud::find( $request->dato );

        //Cambiamos el estado a aprobado
        $solicitud->solicitud_aprobacion = "Aprobada";
        //Guardamos el comentario del aprobador
        $solicitud->solicitud_comentario = $request->comentario;
        //Aprobado por
        $solicitud->aprobador_id = \Auth::user()->id;
        //guardamos en la BD
        $resp = $solicitud->save();
        //Retornamos a la vista
        return redirect()->route('sPagoIndex.index')->with('respApro', $resp);

    }

    public function solicitudesPagoRespuestaNegada(Request $request)
    {

        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->solicitud_pago != 1 || $permisoUsuario[0]->aprobacion_solicitud_pago != 1){
            return redirect()->route("home");
        }

        //Buscamos la informacion asociado a esta solicitud
        $solicitud = Solicitud::find( $request->dato );

        //Cambiamos el estado a aprobado
        $solicitud->solicitud_aprobacion = "Rechazada";
        //Guardamos el comentario del aprobador
        $solicitud->solicitud_comentario = $request->comentario;
        //Aprobado por
        $solicitud->aprobador_id = \Auth::user()->id;
        //guardamos en la BD
        $resp = $solicitud->save();
        //Retornamos a la vista
        return redirect()->route('sPagoIndex.index')->with('respNega', $resp);
    }


// ---------------------------  Solicitud cuentas por pagar  -------------------------------

    public function indexCuenta()
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->compra_cuentas_x_pagar != 1 ){
            return redirect()->route("home");
        }

        return view('sistema.solicitud.cuentas.index')->with([
            'permisoUsuario' => $permisoUsuario[0]
        ]);
    }

    public function solicitudesPagoCuenta($id)
    {

        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->compra_cuentas_x_pagar != 1 ){
            return redirect()->route("home");
        }

        if($id == 1){

            //Realizamos la consulta a la base de datos
            $query = Solicitud::select(
                'solicitud.id AS id',
                'solicitud.solicitud_numerocontrol AS solicitud_numerocontrol',
                'solicitud.solicitud_fecha AS fecha',
                'obra.obra_nombre AS obra_nombre',
                'solicitud.solicitud_motivo AS solicitud_motivo',
                'solicitud.solicitud_aprobacion AS solicitud_aprobacion',
                'solicitud.solicitud_estadopago AS pago',
                'users.user_name AS nombre'

            )
            ->leftJoin('users','users.id', '=', 'solicitud.usuario_id')
            ->leftJoin('obra','obra.id', '=', 'solicitud.obra_id')
            // ->where('solicitud.solicitud_tipo', $id)
            ->orderBy('id', 'DESC')
            // ->limit(5000) //Sin limites, es decir, podra ver absolutamente todas las solicitudes
            ->get();

        } else {

            switch ($id) {
                case 2:
                    $valor = "Sin Respuesta";
                    $estadoPago = 1;
                    break;
                case 3:
                    $valor = "Aprobada";
                    $estadoPago = 1;
                    break;
                case 4:
                    $valor = "Aprobada";
                    $estadoPago = 0;
                    break;
                case 5:
                    $valor = "Rechazada";
                    $estadoPago = 1;
                    break;
                case 6:
                    $valor = "Anulada";
                    $estadoPago = 1;
                    break;
            }


            //Realizamos la consulta a la base de datos
            $query = Solicitud::select(
                'solicitud.id AS id',
                'solicitud.solicitud_numerocontrol AS solicitud_numerocontrol',
                'solicitud.solicitud_fecha AS fecha',
                'solicitud.solicitud_motivo AS solicitud_motivo',
                'solicitud.solicitud_aprobacion AS solicitud_aprobacion',
                'solicitud.solicitud_estadopago AS pago',
                'users.user_name AS nombre',
                'obra.obra_nombre AS obra_nombre'
            )
            ->leftJoin('users','users.id', '=', 'solicitud.usuario_id')
            ->leftJoin('obra','obra.id', '=', 'solicitud.obra_id')
            ->where('solicitud.solicitud_aprobacion', $valor)
            ->where('solicitud.solicitud_estadopago', $estadoPago)
            ->orderBy('id', 'DESC')
            ->limit(1000)
            ->get();

        }

        // validamos que opciones maneja este usuario y dependiendo de esto, se muestra la informacion
        if ( $permisoUsuario[0]->compra_cuentas_x_pagar == 1 && $permisoUsuario[0]->ver_botones_compra_cuentas_x_pagar == 1) {
            return datatables()->of($query)
            ->addColumn('apro','sistema.solicitud.cuentas.btnAproRepro')
            ->addColumn('btn','sistema.solicitud.cuentas.btnCuenta')
            ->addColumn('pago','sistema.solicitud.cuentas.btnPago')
            ->rawColumns(['btn','apro','pago'])->toJson();
        } else {
            return datatables()->of($query)
            ->addColumn('btn','sistema.btnNull')
            ->addColumn('apro','sistema.solicitud.cuentas.btnAproRepro')
            ->addColumn('pago','sistema.solicitud.cuentas.btnPago')
            ->rawColumns(['btn','apro','pago'])->toJson();
        }
    }


    public function showCuenta($id)
    {

        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->compra_cuentas_x_pagar != 1 || $permisoUsuario[0]->aproRepro_compra_cuentas_x_pagar != 1 ){
            return redirect()->route("home");
        }
        //Se realiza la consulta
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
            'solicitud.solicitud_estadopago AS solicitud_estadopago',
            'solicitud.solicitud_comentario AS solicitud_comentario',
            'users.user_name AS nombre_aprobador',
            'solicitud.usuario_id AS usuario_id',
            'banco_proveedor.numero AS numero',
            'banco.banco_nombre AS banco_nombre',
            'banco_proveedor.tipodecuenta AS tipodecuenta',
            'obra.obra_codigo AS obra_codigo',
            'obra.obra_nombre AS obra_nombre',
            'obra.obra_fechainicio AS obra_fechainicio',
            'obra.obra_fechafin AS obra_fechafin',
            'obra.obra_observaciones AS obra_observaciones',
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
            'requisicion.requisicion_estado AS requisicion_estado',
            'pago.pago_fecha AS pago_fecha',
            'pago.pago_formapago AS pago_formapago',
            'pago.pago_numerocomprobante AS pago_numerocomprobante',
            'pago.pago_monto AS pago_monto',
            'pago.pago_descripcion AS pago_descripcion',
            'pago.cuenta_id AS cuenta_id'
        )
        ->leftJoin('obra', 'obra.id', '=', 'solicitud.obra_id')
        ->leftJoin('proveedor', 'proveedor.id', '=', 'solicitud.proveedor_id')
        ->leftJoin('requisicion', 'requisicion.id', '=', 'solicitud.requisicion_id')
        ->leftJoin('banco_proveedor', 'banco_proveedor.id', '=', 'solicitud.banco_proveedor_id')
        ->leftJoin('banco', 'banco.id', '=', 'banco_proveedor.banco_id')
        ->leftJoin('pago', 'pago.solicitud_id', '=', 'solicitud.id')
        // ->leftJoin('users', 'users.id', '=', 'solicitud.aprobador_id')
        ->leftJoin('users', function ($join) {
            $join->on('users.id', '=', 'solicitud.aprobador_id');
            // ->orOn('users.id', '=', 'solicitud.usuario_id');
        })
        ->where('solicitud.id', $id)
        ->first();

        //En base a la consulta se busca el nombre de quien creó la solicitud
        $usuario = User::select('user_name')->where('id', $solicitud->usuario_id )->first();


        if ($solicitud->solicitud_tipo == "1") {       //materiales

            $costo = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                'solicitud_detalle.sd_preciounitario AS sd_preciounitario',
                'solicitud_detalle.moneda AS moneda',
                'material.material_nombre AS nombre'
                )
                ->leftJoin('material', 'material.id', '=', 'solicitud_detalle.material_id')
                ->where('solicitud_id', $solicitud->id)->get();

        } elseif ($solicitud->solicitud_tipo == "2") { // servicios

            $costo = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                'solicitud_detalle.sd_preciounitario AS sd_preciounitario',
                'solicitud_detalle.moneda AS moneda',
                'servicio.servicio_nombre AS nombre'
                )
                ->leftJoin('servicio', 'servicio.id', '=', 'solicitud_detalle.servicio_id')
                ->where('solicitud_id', $solicitud->id)->get();

        } elseif ($solicitud->solicitud_tipo == "3") { //  viaticos

            $costo = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                'solicitud_detalle.sd_preciounitario AS sd_preciounitario',
                'solicitud_detalle.moneda AS moneda',
                'viatico.viatico_nombre AS nombre'
                )
                ->leftJoin('viatico', 'viatico.id', '=', 'solicitud_detalle.viatico_id')
                ->where('solicitud_id', $solicitud->id)->get();

        } elseif ($solicitud->solicitud_tipo == "4") { //    Caja Chica

            $costo = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                'solicitud_detalle.sd_preciounitario AS sd_preciounitario',
                'solicitud_detalle.moneda AS moneda',
                'caja.caja_nombre AS nombre'
                )
                ->leftJoin('caja', 'caja.id', '=', 'solicitud_detalle.caja_id')
                ->where('solicitud_id', $solicitud->id)->get();

        } elseif ($solicitud->solicitud_tipo == "5") { //    nomina

            $costo = Solicitud_detalle::select(
                'solicitud_detalle.id AS id',
                'solicitud_detalle.sd_cantidad AS sd_cantidad',
                'solicitud_detalle.sd_preciounitario AS sd_preciounitario',
                'solicitud_detalle.moneda AS moneda',
                'nomina.nomina_nombre AS nombre'
                )
                ->leftJoin('nomina', 'nomina.id', '=', 'solicitud_detalle.nomina_id')
                ->where('solicitud_id', $solicitud->id)->get();

        }
        //Si existe un costo ejecuta enviando el calculo

        $cuentaJHCP = Cuenta::select()->get();

        $cuenta = Cuenta::select(
            'cuenta.cuenta_tipo AS cuenta_tipo',
            'cuenta.cuenta_numero AS cuenta_numero',
            'banco.banco_nombre AS banco_nombre'
        )
        ->leftJoin('banco', 'banco.id', '=', 'cuenta.banco_id')
        ->where('cuenta.id', $solicitud->cuenta_id)
        ->first();

        if ($costo) {

            for ($i=0; $i < count( $costo ); $i++) {
                $num[] = $costo[$i]->sd_preciounitario * $costo[$i]->sd_cantidad;
            }

            if(isset($num)){
                $total = array_sum($num);
            } else {
                $total = array();
            }

        // if($cuentaJHCP == NULL){
        //     $cuentaJHCP = array();
        // }

            return view('sistema.solicitud.cuentas.consultar')->with(
                [
                    'permisoUsuario' => $permisoUsuario[0],
                    'solicitud' => $solicitud,
                    'costo' => $costo,
                    'usuario' => $usuario,
                    'total' => $total,
                    'cuenta' => $cuenta,
                    'cuentaJHCP' => $cuentaJHCP,
                    'id' => $id
                ]
            );

        } else { //Su no envia todo el costo en null

            return view('sistema.solicitud.cuentas.consultar')->with(
                [
                    'permisoUsuario' => $permisoUsuario[0],
                    'solicitud' => $solicitud,
                    'costo' => array(),
                    'usuario' => $usuario,
                    'total' => array(),
                    'cuenta' => array(),
                    'cuentaJHCP' => $cuentaJHCP,
                    'id' => $id
                ]
            );
        }


    }


    public function createCuenta(Request $request)
    {

        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->compra_cuentas_x_pagar != 1 || $permisoUsuario[0]->aproRepro_compra_cuentas_x_pagar != 1 ){
            return redirect()->route("home");
        }

        //Instanciamos la clase de Pago
        $pago = new Pago();
        //Agregamos los valores en los campos instanciados
        $pago->pago_fecha  = date('Y-m-d');
        $pago->pago_formapago  = $request->forma_pago;
        $pago->pago_numerocomprobante = $request->comprobante;
        $pago->pago_monto = $request->montoTotal;
        $pago->pago_descripcion = $request->comentario;
        $pago->orden_compra_id = null;
        $pago->solicitud_id = $request->dato;
        $pago->cuenta_id = $request->cuentaJHCP;
        $pago->cheque_id = null;
        //Guardamos esta informacion en la BD
        $resp1 = $pago->save();
        //Si se guarda, realiza la modificacion de "No pagado" a "Pagado"
        if($resp1){
            //Buscamos el ID de la solicitud para cambiar el estado
            $solicitud = Solicitud::find( $request->dato );
            //Realizamos el cambio de no pagado a pagado
            $solicitud->solicitud_estadopago = 0;
            //Guardamos este cambio
            $resp = $solicitud->save();

            //Retornamos a la vista principal
            return redirect()->route('cuentas.index')->with('respPago', $resp);
        } else {
            //Solo retornar a la vista con el mensaje del error
            return redirect()->route('cuentas.index')->with('respPago', $resp1);
        }

    }

    public function anularCuenta(Request $request)
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->compra_cuentas_x_pagar != 1 || $permisoUsuario[0]->aproRepro_compra_cuentas_x_pagar != 1 ){
            return redirect()->route("home");
        }
        //Buscamos el id asociado a la solicitud
        $anular = Solicitud::find( $request->dato );
        //cambiamos el estado a anulada
        $anular->solicitud_aprobacion = "Anulada";
        //Guardamos el cambio en la BD
        $resp = $anular->save();

        return redirect()->route('cuentas.index')->with('resp', $resp);

    }






}
