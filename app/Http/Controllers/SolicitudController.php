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
use App\Models\Cheque;
use App\Models\Pago;
use App\Models\Banco_proveedor;
use App\Models\Solicitud_detalle;
use App\Models\User;
use App\Models\Cuenta;
use App\Models\Valuacion;


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
        dd($request);
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
        $solicitud->moneda = $request->tipoMoneda; //Debes cambiar solicitud detalle tambien si deseas otra moneda
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
            'requisicion.requisicion_estado AS requisicion_estado',
            'requisicion.created_at AS fecha_requisicion_creacion',
            'solicitud.created_at AS fecha_solicitud_creacion'
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
        //Si la solicitud no esta "Sin respuesta, regresame al inicio"
        if($solicitud->solicitud_aprobacion != "Sin Respuesta"){
            return redirect()->route("home");
        }

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

        //Si el estado es distinto a "SIN RESPUESTA" retorna al inicio
        if($solicitud->solicitud_aprobacion != "Sin Respuesta"){
            return redirect()->route("home");
        }

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
        //Consultar el estado de la solicitud
        $Solicitud = Solicitud::find( $elim->solicitud_id );
        //Validamos que el estado de la aprobacion no sea distinta a SIN RESPUESTA
        if($Solicitud->solicitud_aprobacion != "Sin Respuesta"){
            return response()->json(false);
        }

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
        // capturamos la informacion traida por el datatable
        // $draw = $_GET['draw']; 
        $row = $_GET['start']; //Capturamos en una variable la primera paginacion de la datatables
        $rowperpage = $_GET['length']; // Rows display per page tomamos la cantidad de registros que cargara por pag, la defini en 10 registros
        $buscador = $_GET['search']['value']; //en caso de escribir en datatables algo, el sistema lo buscara

        //Realizamos la consulta a la base de datos
        $query = Solicitud::select(
            'solicitud.id AS id',
            'solicitud.usuario_id AS usuario_id',
            'solicitud.solicitud_numerocontrol AS solicitud_numerocontrol',
            DB::raw('(select SUM(solicitud_detalle.sd_cantidad * solicitud_detalle.sd_preciounitario) from solicitud_detalle WHERE solicitud.id = solicitud_detalle.solicitud_id) as suma'),
            'obra.obra_nombre AS obra_nombre',
            'proveedor.proveedor_nombre AS proveedor_nombre',
            'solicitud.solicitud_fecha AS fecha',
            'solicitud.solicitud_motivo AS solicitud_motivo',
            'solicitud.solicitud_aprobacion AS solicitud_aprobacion',
            'users.user_name AS nombre'
        )
        ->leftJoin('users','users.id', '=', 'solicitud.usuario_id')
        ->leftJoin('obra','obra.id', '=', 'solicitud.obra_id')
        ->leftJoin('proveedor','proveedor.id', '=', 'solicitud.proveedor_id')

        //Buscamos en donde se cumpla la condicion de lo escribo en el buscador y tambien que sea del usuario con el ID de autenticacion
        ->orWhere('solicitud.id', 'LIKE',  "%$buscador%")->where('solicitud.usuario_id', \Auth::user()->id) 
        ->orWhere('solicitud.solicitud_numerocontrol', 'LIKE', "%$buscador%")->where('solicitud.usuario_id', \Auth::user()->id) 
        ->orWhere('obra.obra_nombre', 'LIKE', "%$buscador%")->where('solicitud.usuario_id', \Auth::user()->id) 
        ->orWhere('proveedor.proveedor_nombre', 'LIKE', "%$buscador%")->where('solicitud.usuario_id', \Auth::user()->id) 
        ->orWhere('solicitud.solicitud_fecha', 'LIKE', "%$buscador%")->where('solicitud.usuario_id', \Auth::user()->id) 
        ->orWhere('solicitud.solicitud_motivo', 'LIKE', "%$buscador%")->where('solicitud.usuario_id', \Auth::user()->id) 
        ->orWhere('solicitud.solicitud_aprobacion', 'LIKE', "%$buscador%")->where('solicitud.usuario_id', \Auth::user()->id) 
        ->orWhere('users.user_name', 'LIKE', "%$buscador%")->where('solicitud.usuario_id', \Auth::user()->id) 

        ->orderBy('id', 'DESC') //Ordenmos en orden descendente
        ->offset($row) //paginamos segun nos indique la datatables
        ->limit(10) //limitamos a 10 registros por paginacion
        ->get();

        //Realizamos el conteo de la misma consulta arriba pero sin limitar, ya que debe enviarme la cantidad real de registros existentes
        $total = Solicitud::select(
        )
        ->leftJoin('users','users.id', '=', 'solicitud.usuario_id')
        ->leftJoin('obra','obra.id', '=', 'solicitud.obra_id')
        ->leftJoin('proveedor','proveedor.id', '=', 'solicitud.proveedor_id')

        ->orWhere('solicitud.id', 'LIKE',  "%$buscador%")->where('solicitud.usuario_id', \Auth::user()->id) 
        ->orWhere('solicitud.solicitud_numerocontrol', 'LIKE', "%$buscador%")->where('solicitud.usuario_id', \Auth::user()->id) 
        ->orWhere('obra.obra_nombre', 'LIKE', "%$buscador%")->where('solicitud.usuario_id', \Auth::user()->id) 
        ->orWhere('proveedor.proveedor_nombre', 'LIKE', "%$buscador%")->where('solicitud.usuario_id', \Auth::user()->id) 
        ->orWhere('solicitud.solicitud_fecha', 'LIKE', "%$buscador%")->where('solicitud.usuario_id', \Auth::user()->id) 
        ->orWhere('solicitud.solicitud_motivo', 'LIKE', "%$buscador%")->where('solicitud.usuario_id', \Auth::user()->id) 
        ->orWhere('solicitud.solicitud_aprobacion', 'LIKE', "%$buscador%")->where('solicitud.usuario_id', \Auth::user()->id) 
        ->orWhere('users.user_name', 'LIKE', "%$buscador%")->where('solicitud.usuario_id', \Auth::user()->id) 
        ->count();


        // validamos que opciones maneja este usuario y dependiendo de esto, se muestra la informacion
        if ( $permisoUsuario[0]->solicitud == 1 && $permisoUsuario[0]->ver_botones_solicitud == 1) {
            return datatables()->of($query)
            ->addColumn('btn','sistema.solicitud.btnSolicitud')
            ->addColumn('btn2','sistema.solicitud.aprobacion.btnAproRepro')
            ->setTotalRecords( $total )
            ->setFilteredRecords($total)
            ->skipPaging()
            ->rawColumns(['btn','btn2'])->toJson();
        } else { //si llega a este punto, no mostrara botones para interactuar con la informacion
            return datatables()->of($query)
            ->addColumn('btn','sistema.btnNull')
            ->addColumn('btn2','sistema.solicitud.aprobacion.btnAproRepro')
            ->setTotalRecords( $total )
            ->setFilteredRecords($total)
            ->skipPaging()
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
        ->whereNotIn('requisicion_estado', ['Anulada'])
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
            'requisicion.obra_id AS obra_id',
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
        ->whereNotIn('requisicion_estado', ['Anulada'])
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
            'banco_proveedor.tipodecuenta AS tipoCuenta',
            'solicitud.banco_proveedor_id AS banco_proveedor_id'
        )
        ->leftJoin('banco', 'banco_proveedor.banco_id', '=', 'banco.id')
        ->leftJoin('solicitud', 'solicitud.banco_proveedor_id', '=', 'banco_proveedor.id')
        ->where('banco_proveedor.proveedor_id', $id)
        ->where('banco_proveedor.estado', 1)
        ->distinct()
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

        //Validamos que no haya sido visto aun
        $solicitud = Solicitud::find($request->id);
        if($solicitud->solicitud_aprobacion != "Sin Respuesta"){
            return response()->json(false);
        }
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->solicitud != 1 || $permisoUsuario[0]->crear_solicitud != 1){
            return response()->json(false);
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

        $draw = $_GET['draw'];
        $row = $_GET['start'];
        $rowperpage = $_GET['length']; // Rows display per page
        // $columnIndex = $_GET['order'][0]['column']; // Column index
        // $columnName = $_GET['columns'][$columnIndex]['data']; // Column name
        // $columnSortOrder = $_GET['order'][0]['dir']; // asc or desc
        // $searchValue = mysqli_real_escape_string($con,$_GET['search']['value']); // Search value
        // dump( $draw . " | " . $row . " | " . $rowperpage . " | " . $columnIndex . " | " . $columnName . " | " . $columnSortOrder );
        $buscador = $_GET['search']['value'];

        //Realizamos la consulta a la base de datos

        $query = DB::select("select
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
        WHERE `solicitud`.`id` LIKE '%$buscador%' OR 
        `solicitud`.`solicitud_numerocontrol` LIKE '%$buscador%' OR 
        `solicitud`.`solicitud_fecha` LIKE '%$buscador%' OR 
        `solicitud`.`solicitud_estadopago` LIKE '%$buscador%' OR 
        `obra`.`obra_nombre` LIKE '%$buscador%' OR 
        `solicitud`.`solicitud_motivo` LIKE '%$buscador%' OR 
        `solicitud`.`solicitud_aprobacion` LIKE '%$buscador%' OR 
        `users`.`user_name` LIKE '%$buscador%' 
        order by `id` desc limit " . $_GET['start'] . ", 10");
        

        $total = Solicitud::select()
        ->leftJoin('users', 'users.id', '=', 'solicitud.usuario_id')
        ->leftJoin('obra', 'obra.id', '=', 'solicitud.obra_id')
        ->where('solicitud.id', 'like', '%'.$buscador.'%')
        ->orWhere('solicitud.solicitud_numerocontrol', 'like', '%'.$buscador.'%')
        ->orWhere('solicitud.solicitud_fecha', 'like', '%'.$buscador.'%')
        ->orWhere('solicitud.solicitud_estadopago', 'like', '%'.$buscador.'%')
        ->orWhere('obra.obra_nombre', 'like', '%'.$buscador.'%')
        ->orWhere('solicitud.solicitud_aprobacion', 'like', '%'.$buscador.'%')
        ->orWhere('solicitud.solicitud_motivo', 'like', '%'.$buscador.'%')
        ->orWhere('users.user_name', 'like', '%'.$buscador.'%')
        ->orderBy('solicitud.id', 'DESC')
        ->count();

        // dd($total);
        // $query = Solicitud::select(
        // 'solicitud.id as id',
        // 'solicitud.solicitud_numerocontrol as solicitud_numerocontrol',
        // 'solicitud.solicitud_fecha as fecha',
        // 'solicitud.solicitud_estadopago as pago',
        // DB::raw('(select SUM(solicitud_detalle.sd_cantidad * solicitud_detalle.sd_preciounitario) from solicitud_detalle WHERE solicitud.id = solicitud_detalle.solicitud_id) as suma'),
        // 'solicitud.moneda as moneda',
        // 'obra.obra_nombre as obra_nombre',
        // 'solicitud.solicitud_motivo as solicitud_motivo',
        // 'solicitud.solicitud_aprobacion as solicitud_aprobacion',
        // 'users.user_name as nombre'
        // )
        // ->leftJoin('users', 'users.id', '=', 'solicitud.usuario_id')
        // ->leftJoin('obra', 'obra.id', '=', 'solicitud.obra_id')
        // ->orderBy('solicitud.id', 'DESC')
        // ->get();

        // $results = array(
        //     "sEcho" => $draw,
        //     "iTotalRecords" => $total,
        //     "iTotalDisplayRecords" => $total,
        //     "aaData"=>$query
        // );



        // validamos que opciones maneja este usuario y dependiendo de esto, se muestra la informacion
        if ( $permisoUsuario[0]->solicitud_pago == 1 && $permisoUsuario[0]->ver_solicitud_pago == 1) {
            return datatables()->of($query)
            ->addColumn('btn','sistema.solicitud.aprobacion.btnConsultarAprobacion')
            ->addColumn('aproRepro', 'sistema.solicitud.aprobacion.btnAproRepro')
            ->addColumn('btn2','sistema.solicitud.aprobacion.btnPago')
            ->setTotalRecords( $total )
            ->setFilteredRecords($total)
            ->skipPaging()
            ->rawColumns(['btn', 'aproRepro', 'btn2'])->toJson();
        } else {
            return datatables()->of($query)
            ->addColumn('btn','sistema.btnNull')
            ->addColumn('aproRepro','sistema.solicitud.aprobacion.btnAproRepro')
            ->addColumn('btn2','sistema.solicitud.aprobacion.btnPago')
            ->setTotalRecords( $total )
            ->setFilteredRecords($total)
            ->skipPaging()
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

        if($solicitud->requisicion_id){
            // Buscamos la requisicion
            $seguimiento = Requisicion::find($solicitud->requisicion_id);
            $seguimiento->requisicion_estado = "Aprobada";
            $seguimiento->save();
        }

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

        if($solicitud->requisicion_id){
            // Buscamos la requisicion
            $seguimiento = Requisicion::find($solicitud->requisicion_id);
            $seguimiento->requisicion_estado = "Rechazada";
            $seguimiento->save();
        }

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

        // Capturamos los datos enviados por Datatables
        $draw = $_GET['draw'];
        $start = $_GET['start'];
        $buscador = $_GET['search']['value'];

        // Realizamos la consulta a la base de datos segun el ID que sea seleccionado al momento de presionar el boton de accion
        if($id == 1){
         // Traemos toda la informacion de la BD al presionar el boton "TODAS LAS SOLICITUDES"
        $query = DB::select("select
            `solicitud`.`id` as `id`,
            `solicitud`.`solicitud_numerocontrol` as `solicitud_numerocontrol`,
            `solicitud`.`solicitud_fecha` as `fecha`,
            `solicitud`.`solicitud_estadopago` as `pago`,
            (select SUM(solicitud_detalle.sd_cantidad * solicitud_detalle.sd_preciounitario) from solicitud_detalle WHERE solicitud.id = solicitud_detalle.solicitud_id) as `suma`,
            `solicitud`.`moneda` as `moneda`,
            `obra`.`obra_nombre` as `obra_nombre`,
            `solicitud`.`solicitud_motivo` as `solicitud_motivo`,
            `solicitud`.`solicitud_aprobacion` as `solicitud_aprobacion`,
            `users`.`user_name` as `nombre`,
            `proveedor`.`proveedor_nombre` as `proveedor_nombre`

            from `solicitud`
            left join `users` on `users`.`id` = `solicitud`.`usuario_id`
            left join `obra` on `obra`.`id` = `solicitud`.`obra_id`
            left join `proveedor` on `proveedor`.`id` = `solicitud`.`proveedor_id` 
            WHERE `solicitud`.`id` LIKE '%$buscador%' OR 
            `solicitud`.`solicitud_numerocontrol` LIKE '%$buscador%' OR 
            `solicitud`.`solicitud_fecha` LIKE '%$buscador%' OR 
            `solicitud`.`solicitud_estadopago` LIKE '%$buscador%' OR 
            `solicitud`.`moneda` LIKE '%$buscador%' OR 
            `obra`.`obra_nombre` LIKE '%$buscador%' OR 
            `solicitud`.`solicitud_motivo` LIKE '%$buscador%' OR 
            `solicitud`.`solicitud_aprobacion` LIKE '%$buscador%' OR 
            `users`.`user_name` LIKE '%$buscador%' OR 
            `proveedor`.`proveedor_nombre` LIKE '%$buscador%'
            order by `id` desc 
            LIMIT $start, 10");

            // Realizamos la cuenta de 
            $total =Solicitud::select()
            ->leftJoin('users','users.id', '=', 'solicitud.usuario_id')
            ->leftJoin('obra','obra.id', '=', 'solicitud.obra_id')
            ->leftJoin('proveedor','proveedor.id', '=', 'solicitud.proveedor_id')
            ->orWhere('solicitud.id', 'LIKE',  "%$buscador%")
            ->orWhere("solicitud.solicitud_numerocontrol", "LIKE", "%$buscador%")
            ->orWhere('solicitud.solicitud_fecha', 'LIKE',  "%$buscador%")
            ->orWhere('solicitud.solicitud_motivo', 'LIKE',  "%$buscador%")
            ->orWhere('solicitud.solicitud_aprobacion', 'LIKE',  "%$buscador%")
            ->orWhere('solicitud.solicitud_estadopago', 'LIKE',  "%$buscador%")
            ->orWhere('users.user_name', 'LIKE',  "%$buscador%")
            ->orWhere('obra.obra_nombre', 'LIKE',  "%$buscador%")
            ->orWhere('proveedor.proveedor_nombre', 'LIKE',  "%$buscador%")
            ->orderBy('id', 'DESC')
            ->count();

        } else {
            // De presionar cualquier otra opcion el valida cual es y realiza la consulta dependiendo de la solicitud
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
                DB::raw('(select SUM(solicitud_detalle.sd_cantidad * solicitud_detalle.sd_preciounitario) from solicitud_detalle WHERE solicitud.id = solicitud_detalle.solicitud_id) as suma'),
                'solicitud.solicitud_motivo AS solicitud_motivo',
                'solicitud.solicitud_aprobacion AS solicitud_aprobacion',
                'solicitud.solicitud_estadopago AS pago',
                'users.user_name AS nombre',
                'obra.obra_nombre AS obra_nombre',
                'proveedor.proveedor_nombre as proveedor_nombre'
            )
            ->leftJoin('users','users.id', '=', 'solicitud.usuario_id')
            ->leftJoin('obra','obra.id', '=', 'solicitud.obra_id')
            ->leftJoin('proveedor','proveedor.id', '=', 'solicitud.proveedor_id')
            
            
            ->Where('solicitud.id', 'LIKE',  "%$buscador%")->where('solicitud.solicitud_estadopago', $estadoPago)->where('solicitud.solicitud_aprobacion', $valor)
            ->orWhere("solicitud.solicitud_numerocontrol", "LIKE", "%$buscador%")->where('solicitud.solicitud_estadopago', $estadoPago)->where('solicitud.solicitud_aprobacion', $valor)
            ->orWhere('solicitud.solicitud_fecha', 'LIKE',  "%$buscador%")->where('solicitud.solicitud_estadopago', $estadoPago)->where('solicitud.solicitud_aprobacion', $valor)
            ->orWhere('solicitud.solicitud_motivo', 'LIKE',  "%$buscador%")->where('solicitud.solicitud_estadopago', $estadoPago)->where('solicitud.solicitud_aprobacion', $valor)
            ->orWhere('solicitud.solicitud_aprobacion', 'LIKE',  "%$buscador%")->where('solicitud.solicitud_estadopago', $estadoPago)->where('solicitud.solicitud_aprobacion', $valor)
            ->orWhere('solicitud.solicitud_estadopago', 'LIKE',  "%$buscador%")->where('solicitud.solicitud_estadopago', $estadoPago)->where('solicitud.solicitud_aprobacion', $valor)
            ->orWhere('users.user_name', 'LIKE',  "%$buscador%")->where('solicitud.solicitud_estadopago', $estadoPago)->where('solicitud.solicitud_aprobacion', $valor)
            ->orWhere('obra.obra_nombre', 'LIKE',  "%$buscador%")->where('solicitud.solicitud_estadopago', $estadoPago)->where('solicitud.solicitud_aprobacion', $valor)
            ->orWhere('proveedor.proveedor_nombre', 'LIKE',  "%$buscador%")->where('solicitud.solicitud_estadopago', $estadoPago)->where('solicitud.solicitud_aprobacion', $valor)
            ->orderBy('id', 'DESC')
            ->offset($start)
            ->limit(10)

            ->get();
            // Contamos las pagnaciones dependiend de la busqueda realizada
            $total =Solicitud::select()
            ->leftJoin('users','users.id', '=', 'solicitud.usuario_id')
            ->leftJoin('obra','obra.id', '=', 'solicitud.obra_id')
            ->leftJoin('proveedor','proveedor.id', '=', 'solicitud.proveedor_id')
            ->where('solicitud.id', 'LIKE',  "%$buscador%")->where('solicitud.solicitud_estadopago', $estadoPago)->where('solicitud.solicitud_aprobacion', $valor)
            ->orWhere("solicitud.solicitud_numerocontrol", "LIKE", "%$buscador%")->where('solicitud.solicitud_estadopago', $estadoPago)->where('solicitud.solicitud_aprobacion', $valor)
            ->orWhere('solicitud.solicitud_fecha', 'LIKE',  "%$buscador%")->where('solicitud.solicitud_estadopago', $estadoPago)->where('solicitud.solicitud_aprobacion', $valor)
            ->orWhere('solicitud.solicitud_motivo', 'LIKE',  "%$buscador%")->where('solicitud.solicitud_estadopago', $estadoPago)->where('solicitud.solicitud_aprobacion', $valor)
            ->orWhere('solicitud.solicitud_aprobacion', 'LIKE',  "%$buscador%")->where('solicitud.solicitud_estadopago', $estadoPago)->where('solicitud.solicitud_aprobacion', $valor)
            ->orWhere('solicitud.solicitud_estadopago', 'LIKE',  "%$buscador%")->where('solicitud.solicitud_estadopago', $estadoPago)->where('solicitud.solicitud_aprobacion', $valor)
            ->orWhere('users.user_name', 'LIKE',  "%$buscador%")->where('solicitud.solicitud_estadopago', $estadoPago)->where('solicitud.solicitud_aprobacion', $valor)
            ->orWhere('obra.obra_nombre', 'LIKE',  "%$buscador%")->where('solicitud.solicitud_estadopago', $estadoPago)->where('solicitud.solicitud_aprobacion', $valor)
            ->orWhere('proveedor.proveedor_nombre', 'LIKE',  "%$buscador%")->where('solicitud.solicitud_estadopago', $estadoPago)->where('solicitud.solicitud_aprobacion', $valor)
            ->orderBy('id', 'DESC')
            ->count();


        }

        // validamos que opciones maneja este usuario y dependiendo de esto, se muestra la informacion
        if ( $permisoUsuario[0]->compra_cuentas_x_pagar == 1 && $permisoUsuario[0]->ver_botones_compra_cuentas_x_pagar == 1) {
            return datatables()->of($query)
            ->addColumn('apro','sistema.solicitud.cuentas.btnAproRepro') //Agregamos la vista con los botones de aprobado o rechazada
            ->addColumn('btn','sistema.solicitud.cuentas.btnCuenta') // Agregamos la vista
            ->addColumn('pago','sistema.solicitud.cuentas.btnPago') // Agregamos la vista con la consulta de pagada o no pagada
            ->setTotalRecords( $total ) // Agregamos el monto total de la consulta
            ->setFilteredRecords($total) // Agregamos el monto total de la paginacion
            ->skipPaging() //Solicitamos que refresque la consulta cada vez que se realiza una paginacion
            ->rawColumns(['btn','apro','pago'])->toJson(); //Indicamos el nombre de los botones y enviamos la informacion via json
        } else {
            return datatables()->of($query)
            ->addColumn('btn','sistema.btnNull') //Agrega una vista la cual no tiene botones
            ->addColumn('apro','sistema.solicitud.cuentas.btnAproRepro') // Agregamos la vista con los botones de aprobado o rechazada
            ->addColumn('pago','sistema.solicitud.cuentas.btnPago') // Agregamos la vista con la consulta de pagada o no pagada
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

        $cuentaJHCP = Cuenta::select(
            'cuenta.id AS id',
            'cuenta.cuenta_numero AS cuenta_numero',
            'banco.banco_nombre AS banco_nombre'
            )
            ->leftJoin('banco', 'banco.id', '=', 'cuenta.banco_id')
            ->get();

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

        } else { //Si no envia todo el costo en null

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
        if($request->forma_pago == "Cheque"){
            $pago->cheque_id = $request->cheque;
        }else{
            $pago->cheque_id = null;
        }
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

            if ( $request->forma_pago == "Cheque" ) {
                //Buscamos el cheque asociado al id
                $estadoCheque = Cheque::find( $request->cheque );
                //Cambiamos el esta do a pagado
                $estadoCheque->cheque_estado = 2;
                $estadoCheque->save();
            }

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


 //--------------- Egresos ---------------------------

    public function costoObraIndex()
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        // if( $permisoUsuario[0]->compra_cuentas_x_pagar != 1 || $permisoUsuario[0]->aproRepro_compra_cuentas_x_pagar != 1 ){
        //     return redirect()->route("home");
        // }

        //Seleccione las obras por su nombre y su codigo
        $obra = Obra::select('id','obra_codigo', 'obra_nombre')->orderBy('id', 'DESC')->where('obra_estado', 1)->get();

        return view('sistema.costo.index')->with([
            'permisoUsuario' => $permisoUsuario[0],
            'obra' => $obra
        ]);

    }

//----------------- control de gastos -----------------------------------

    public function totalizacion()
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        // if( $permisoUsuario[0]->compra_cuentas_x_pagar != 1 || $permisoUsuario[0]->aproRepro_compra_cuentas_x_pagar != 1 ){
        //     return redirect()->route("home");
        // }


    }

    public function calcularSolicitud(Request $request)
    {

        $porcentaje = Solicitud::select(
            DB::raw('SUM(pago.pago_monto) AS monto_gasto'),
            'obra.obra_monto AS obra_monto',
            DB::raw('(obra.obra_monto - SUM(pago.pago_monto)) AS resta'),
            DB::raw('100 - ((SUM(pago.pago_monto) * 100 / obra.obra_monto) ) AS por_ganancia'),
            DB::raw('((SUM(pago.pago_monto) * 100 / obra.obra_monto)) AS por_gasto')
        )
        ->leftJoin('pago', 'pago.solicitud_id', '=', 'solicitud.id')
        ->leftJoin('obra', 'obra.id', '=', 'solicitud.obra_id')
        ->leftJoin('users', 'users.id', '=', 'solicitud.usuario_id')
        ->where('obra.id',$request->id)
        ->where('solicitud.solicitud_aprobacion', 'Aprobada')
        ->where('pago.pago_estado', 1)
        ->groupBy(['obra.obra_monto'])
        ->first();

        return response()->json( $porcentaje );

    }

    public function controlGasto( $id )
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        // if( $permisoUsuario[0]->solicitud != 1 ){
        //     return redirect()->route("home");
        // }

        ## Read value Rosman Rosman
        $draw = $_GET['draw'];
        $row = $_GET['start'];
        $rowperpage = $_GET['length']; // Rows display per page
        $columnIndex = $_GET['order'][0]['column']; // Column index
        $columnName = $_GET['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_GET['order'][0]['dir']; // asc or desc
        // $searchValue = mysqli_real_escape_string($con,$_GET['search']['value']); // Search value
        // dd( $draw . " | " . $row . " | " . $rowperpage . " | " . $columnIndex . " | " . $columnName . " | " . $columnSortOrder );


        //Realizamos la consulta a la base de datos
        $query = Solicitud::select(
            'solicitud.solicitud_numerocontrol AS solicitud_numerocontrol',
            'solicitud.solicitud_motivo AS solicitud_motivo',
            'solicitud.solicitud_fecha AS solicitud_fecha',
            'pago.pago_monto AS pago_monto',
            'users.user_name AS nombre_usuario',
            'obra.obra_nombre AS obra_nombre'
        )
        ->leftJoin('users','users.id', '=', 'solicitud.usuario_id')
        ->leftJoin('pago','solicitud.id', '=', 'pago.solicitud_id')
        ->leftJoin('obra','obra.id', '=', 'solicitud.obra_id')
        ->where('pago.pago_estado', 1)
        ->where('obra.id', $id)
        ->orderBy('solicitud.id', 'DESC')
        // ->offset($row)
        // ->limit(10, 313)
        ->get();

        return datatables()->of($query)
        // ->setTotalRecords(count( $query))
        ->toJson();


    }

    public function calcularEstadistica(Request $request)
    {

        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if( $permisoUsuario[0]->control_de_gasto != 1 || $permisoUsuario[0]->estadistica != 1 ){
            return redirect()->route("home");
        }

        // Definimos el id de la obra
        $id = $request->obra;

        //Consultamos los datos de la obra
        $datoObra = Obra::select(
            'obra.id AS id',
            'obra.obra_codigo AS obra_codigo',
            'obra.obra_nombre AS obra_nombre',
            'obra.obra_monto AS obra_monto',
            'obra.obra_anticipo AS obra_anticipo',
            'obra.obra_fechainicio AS obra_fechainicio',
            'obra.obra_fechafin AS obra_fechafin',
            'cliente.cliente_nombre AS cliente_nombre'
        )
        ->leftJoin('cliente', 'cliente.id', '=', 'obra.cliente_id')
        ->where('obra.id', $id)->first();

        // Consultamos los datos de la valuacion relacionados con esta obra
        $valuacion = Valuacion::select('valuacion_monto','observacion','valuacion_fecha')->where('obra_id', $id)->where('valuacion_estado', 1)->get();

        // Calculamos la fecha final de las solicitudes asociadas a esta obra, qu ya hayan sido aprobadas y pagadas
        $fi = Solicitud::select('solicitud_fecha AS fecha_inicio_solicitudes')
        ->where('obra_id', $id)
        ->where('solicitud_aprobacion', "Aprobada")
        ->where('solicitud_estadopago', 0)
        ->orderBy('id', 'ASC')
        ->first();

        // Si requiere que la fecha final sea en base a LA FECHA DE PAGO?
        // Calculamos la fecha final de las solicitudes asociadas a esta obra, qu ya hayan sido aprobadas y pagadas
        $ff = Pago::select('pago.pago_fecha AS fecha_fin_solicitudes')
        ->leftJoin('solicitud', 'solicitud.id', '=', 'pago.solicitud_id')
        ->where('solicitud.obra_id', $id)
        ->where('solicitud.solicitud_aprobacion', "Aprobada")
        ->where('solicitud.solicitud_estadopago', 0)
         ->orderBy('pago.id', 'DESC')
        ->first();

        // Inicio contador
        $i = 0;
        // Inicio contador de la valuacion
        $v = 0;

        // calculo de la fecha inicial
        // Si, la fecha de la obra es menor o igual a la fecha de la primera solicitud
        if($datoObra->obra_fechainicio <= $fi->fecha_inicio_solicitudes){
            // Fecha inicial va a ser igual a la fecha en que inicio la obra
            $fecha_inicial = $datoObra->obra_fechainicio;
        } else{
            // Sino
            // La fecha inicial sera el dia en que se realiza la primera solicitud
            $fecha_inicial = $fi->fecha_inicio_solicitudes;
        }

        // Suma es el valor del anticipo para comenzar la obra
        $suma = $datoObra->obra_anticipo;
        // Contador de semanas
        $dia = 1;
        // arreglo
        $arreglo= array();

        //Si la fecha final de la obra no existe, valida entonces que exista la fecha de la ultima solicitud
        if( !empty($ff->fecha_fin_solicitudes) ){
            // validamos que tengamos en existencia la ultima fecha en la solicitud
            if( $ff->fecha_fin_solicitudes >  $datoObra->obra_fechafin ){
                // Si no existe se coloca la ultima fecha en 
                $fecha_fin = $ff->fecha_fin_solicitudes;
            } else {
                // Si tienes informacion de la ultima solicitud, sera entonces el ultimo dia
                $fecha_fin = $datoObra->obra_fechafin;
            }

        } else {
            dump("error dydjd7d8ydyd7idj8 consulte a soporte tecnico (A Rosman Gonzalez)");
        }
        // Revisamos que existan valuaciones
        if( count($valuacion) > 1 ){

            // Si existen, entonces compara la fecha final de la obra o solicitud contra la echa final dictada por la valuacion
            $num = count($valuacion) - 1;

            if( $fecha_fin < $valuacion[$num]->valuacion_fecha ){
                $fecha_fin = $valuacion[$num]->valuacion_fecha;
            }

        }


        // sumar los 7 dias
        $incrementoDeDias = date('Y-m-d', strtotime($fecha_inicial."+ 6 days"));

        // Mientras la fecha inicial sea menor a la fecha incrementada en dias
        while($incrementoDeDias < $fecha_fin){

            // Calculo los gastos realizados entre esas semanas
            $calcular = Solicitud::select(
                DB::raw('SUM(pago.pago_monto) AS pago_monto')
            )
            ->leftJoin('pago', 'pago.solicitud_id', '=', 'solicitud.id')
            ->leftJoin('obra', 'obra.id', '=', 'solicitud.obra_id')
            ->whereBetween('pago.pago_fecha', [$fecha_inicial , $incrementoDeDias])
            ->where('obra.id', $id)
            ->first();
            
            // En caso de estar vacio el monto de pago
            if(empty($calcular->pago_monto)){
                // El monto de gastos es cero
                $monto = 0;
            } else {
                //Si no, el valor de la variable monto sera el valor del pago asociado al calculo
                $monto = $calcular->pago_monto;
            }

            // Si, al contar las valuaciones, su valor es mayor a uno?
            if(count($valuacion) > 1){
                // Entra aqui, en donde compara dos opciones; la fecha en que se realizo la valuacion debe de ser mayor o igual
                // a la inicial definida arriba, ya sea la fecha en que inicia la obra o la fecha en que se cargue la primera solicitud.
                if(  $valuacion[$v]->valuacion_fecha >= $fecha_inicial AND $valuacion[$v]->valuacion_fecha <= $incrementoDeDias  ){
                    $valuacionMonto = $valuacion[$v]->valuacion_monto;
                    $v = $v + 1;
                } else {
                    $valuacionMonto = 0;
                }
            } else {
                $valuacionMonto = 0;
            }

            $suma =  ($valuacionMonto - $monto) + $suma;

            $arreglo[] = array(
                'fecha_inicial' => $fecha_inicial,
                'fecha_final' => $fecha_fin,
                'semana' => "Semana ".$dia,
                'gasto' => $monto,
                'valuacion' => $valuacionMonto,
                'suma' => $suma,
                'incremento' => $incrementoDeDias
            );


            // dump($fecha_inicial . " | " . $incrementoDeDias  . " | " . $fecha_fin . " | Semana: " . $dia . " | " . $monto . " | " . $valuacionMonto . " | " . $suma);
            // la fecha inicial pasa a ser la fecha final de la anterior consulta mas un dia
            $fecha_inicial = date('Y-m-d', strtotime($incrementoDeDias."+ 1 days"));
            // La fecha final se vuelve a incrementar 6 dias
            $incrementoDeDias = date('Y-m-d', strtotime($fecha_inicial."+ 6 days"));

            $valuacionMonto = 0;

            $dia = $dia + 1;

        }

        if($fecha_inicial <= $fecha_fin){
            $calcular = Solicitud::select(
                DB::raw('SUM(pago.pago_monto) AS pago_monto')
            )
            ->leftJoin('pago', 'pago.solicitud_id', '=', 'solicitud.id')
            ->leftJoin('obra', 'obra.id', '=', 'solicitud.obra_id')
            ->whereBetween('pago.pago_fecha', [$fecha_inicial , $fecha_fin])
            ->where('obra.id', $id)
            ->first();
        }

        if(empty($calcular->pago_monto)){
            $monto = 0;
        } else {
            $monto = $calcular->pago_monto;
        }

        if(count($valuacion) >= 1){
            
            if(  $valuacion[$v]->valuacion_fecha >= $fecha_inicial AND $valuacion[$v]->valuacion_fecha <= $fecha_fin  ){
                $valuacionMonto = $valuacion[$v]->valuacion_monto;
            } else {
                $valuacionMonto = 0;
            }
        } else {
            $valuacionMonto = 0;

        }

        $suma =  ($valuacionMonto - $monto) + $suma;

        $arreglo[] = array(
            'fecha_inicial' => $fecha_inicial,
            'fecha_final' => $fecha_fin,
            'semana' => "Semana ".$dia,
            'gasto' => $monto,
            'valuacion' => $valuacionMonto,
            'suma' => $suma,
            'incremento' => $incrementoDeDias
        );

        // dump($fecha_inicial . " | " . $fecha_fin . " | Semana: " . $dia . " | " . $monto . " | " . $valuacionMonto . " | " . $suma);

        return view('sistema.costo.estadistica')->with([
            'permisoUsuario' => $permisoUsuario[0],
            'obra' => $datoObra,
            'id', $request->obra,
            'arreglo' => $arreglo
        ]);

    }

    public function histograma($id)
    {

        // Buscamos los datos de la obra asociada al ID
        $datoObra = Obra::select('id', 'obra_codigo', 'obra_anticipo', 'obra_fechainicio', 'obra_fechafin')->where('id', $id)->first();


        // Calculamos la fecha final de las solicitudes asociadas a esta obra, qu ya hayan sido apobadas y pagadas
        // Fecha de la ultima solicitud
        $ff = Solicitud::select('solicitud_fecha AS fecha_fin_solicitudes')
        ->where('obra_id', $id)
        ->where('solicitud_aprobacion', "Aprobada")
        ->where('solicitud_estadopago', 0)
        ->orderBy('id', 'DESC')
        ->first();

        // Fecha de la primera solicitud
        $fi = Solicitud::select('solicitud_fecha AS fecha_inicio_solicitudes')
        ->where('obra_id', $id)
        ->where('solicitud_aprobacion', "Aprobada")
        ->where('solicitud_estadopago', 0)
        ->orderBy('id', 'ASC')
        ->first();



        // calculo de la fecha inicial
        if($datoObra->obra_fechainicio <= $fi->fecha_inicio_solicitudes){
            $fecha_inicial = $datoObra->obra_fechainicio;
        } else{
            $fecha_inicial = $fi->fecha_inicio_solicitudes;
        }

        //Si la fecha final de la obra no existe, valida entonces que exista la fecha de la ultima solicitud
        if( empty($ff->fecha_fin_solicitudes) ){
            // validamos que tengamos en existencia la ultima fecha en la solicitud
            if( empty($ff->fecha_fin_solicitudes) ){
                // Si no existe se coloca la ultima fecha por dia
                $fecha_fin = date('Y-m-d');
            } else {
                // Si tienes informacion de la ultima solicitud, sera entonces el ultimo dia
                $fecha_fin = $ff->fecha_fin_solicitudes;
            }
        } else {
            // Si la obra si tiene fecha final, entonces esa sera la ultima fecha de la estadistica
            $fecha_fin = $datoObra->obra_fechafin;
        }

        // Compara si fecha fianl de la obra es menor a la fecha final de la solicitud
        if($datoObra->obra_fechafin <= $ff->fecha_fin_solicitudes){
            // Fecha final sera la fecha de la ultima solicitud
            $fecha_fin = $ff->fecha_fin_solicitudes;
        } else {
            // La final va a ser la fecha de cierre indicada en la obra
            $fecha_fin = $datoObra->obra_fechafin;
        }

        //Donde se guardara el array
        $array = array();
        // El contador para las semanas (semana 1, semana 2, etc)
        $cont = 1;

        //sumamos 6 dias desdee el dia de inicio hasta 6 dias mas
        $incrementoDeDias = date('Y-m-d', strtotime($fecha_inicial."+ 6 days"));

        // Si la fecha inicial es menor a la fecha final
        if($fecha_inicial < $fecha_fin){

            // Incremente 6 fias y comparamos si pasa a la fecha final
            if($incrementoDeDias < $fecha_fin){

                //Si no pasa la fecha incrementada a la fecha final has un bucle hasta que lo haga
                while($incrementoDeDias < $fecha_fin){
                    // Consulta en base al ID de la obra, la fecha, la fecha inicial la cual se incrementara
                    // y la fecha incrementada
                    $calcular = Solicitud::select(
                        DB::raw('SUM(pago.pago_monto) AS pago_monto')
                    )
                    ->leftJoin('pago', 'pago.solicitud_id', '=', 'solicitud.id')
                    ->leftJoin('obra', 'obra.id', '=', 'solicitud.obra_id')
                    ->whereBetween('solicitud.solicitud_fecha', [$fecha_inicial , $incrementoDeDias])
                    ->where('obra.id', $id)
                    ->first();

                    // Guardamos la informacion en un array, la semana seria numerada
                    $array[] = array('country' =>  "Semana " . $cont, 'value' => floatval($calcular->pago_monto));

                    // la fecha inicial pasa a ser la fecha final de la anterior consulta mas un dia
                    $fecha_inicial = date('Y-m-d', strtotime($incrementoDeDias."+ 1 days"));
                    // La fecha final se vuelve a incrementar 6 dias
                    $incrementoDeDias = date('Y-m-d', strtotime($fecha_inicial."+ 6 days"));
                    // incrementa un numero mas
                    $cont = $cont + 1;
                }

                if($fecha_inicial <= $fecha_fin){
                    $calcular = Solicitud::select(
                        DB::raw('SUM(pago.pago_monto) AS pago_monto')
                    )
                    ->leftJoin('pago', 'pago.solicitud_id', '=', 'solicitud.id')
                    ->leftJoin('obra', 'obra.id', '=', 'solicitud.obra_id')
                    ->whereBetween('solicitud.solicitud_fecha', [$fecha_inicial , $fecha_fin])
                    ->where('obra.id', $id)
                    ->first();
                }

                // Guardamos la informacion en un array, la semana seria numerada
                $array[] = array('country' =>  "Semana " . $cont, 'value' => floatval($calcular->pago_monto));
            // Nuevo codigo
            } else {

                    $calcular = Solicitud::select(
                        DB::raw('SUM(pago.pago_monto) AS pago_monto')
                    )
                    ->leftJoin('pago', 'pago.solicitud_id', '=', 'solicitud.id')
                    ->leftJoin('obra', 'obra.id', '=', 'solicitud.obra_id')
                    ->whereBetween('solicitud.solicitud_fecha', [$fecha_inicial , $fecha_fin])
                    ->where('obra.id', $id)
                    ->first();



                // Guardamos la informacion en un array, la semana seria numerada
                $array[] = array('country' =>  "Semana " . $cont, 'value' => floatval($calcular->pago_monto));

            }


        } else {

            if($fecha_inicial <= $fecha_fin){
                $calcular = Solicitud::select(
                    DB::raw('SUM(pago.pago_monto) AS pago_monto')
                )
                ->leftJoin('pago', 'pago.solicitud_id', '=', 'solicitud.id')
                ->leftJoin('obra', 'obra.id', '=', 'solicitud.obra_id')
                ->whereBetween('solicitud.solicitud_fecha', [$fecha_inicial , $fecha_fin])
                ->where('obra.id', $id)
                ->first();
            }

            // Guardamos la informacion en un array, la semana seria numerada
            $array[] = array('country' =>  "Semana " . $cont, 'value' => floatval($calcular->pago_monto));

        }

        return response()->json($array);

    }



    public function graficoGastos($id)
    {

        // Buscamos los datos de la obra asociada al ID
        $datoObra = Obra::select('id', 'obra_codigo', 'obra_anticipo', 'obra_fechainicio', 'obra_fechafin')->where('id', $id)->first();

        //Calculamos las valuaciones
        $valuacion = Valuacion::select('valuacion_monto','observacion','valuacion_fecha')->where('obra_id', $id)->where('valuacion_estado', 1)->get();
        // Calculamos la fecha final de las solicitudes asociadas a esta obra, qu ya hayan sido apobadas y pagadas

        $ff = Pago::select('pago.pago_fecha AS fecha_fin_solicitudes')
        ->leftJoin('solicitud', 'solicitud.id', '=', 'pago.solicitud_id')
        ->where('solicitud.obra_id', $id)
        ->where('solicitud.solicitud_aprobacion', "Aprobada")
        ->where('solicitud.solicitud_estadopago', 0)
         ->orderBy('pago.id', 'DESC')
        ->first();

        // Fecha de la primera solicitud
        $fi = Solicitud::select('solicitud_fecha AS fecha_inicio_solicitudes')
        ->where('obra_id', $id)
        ->where('solicitud_aprobacion', "Aprobada")
        ->where('solicitud_estadopago', 0)
        ->orderBy('id', 'ASC')
        ->first();



        // calculo de la fecha inicial
        if($datoObra->obra_fechainicio <= $fi->fecha_inicio_solicitudes){
            $fecha_inicial = $datoObra->obra_fechainicio;
        } else{
            $fecha_inicial = $fi->fecha_inicio_solicitudes;
        }


        //Si la fecha final de la obra no existe, valida entonces que exista la fecha de la ultima solicitud
        if( empty($ff->fecha_fin_solicitudes) ){
            // validamos que tengamos en existencia la ultima fecha en la solicitud
            if( empty($ff->fecha_fin_solicitudes) ){
                // Si no existe se coloca la ultima fecha por dia
                $fecha_fin = date('Y-m-d');
            } else {
                // Si tienes informacion de la ultima solicitud, sera entonces el ultimo dia
                $fecha_fin = $ff->fecha_fin_solicitudes;
            }
        } else {
            // Si la obra si tiene fecha final, entonces esa sera la ultima fecha de la estadistica
            $fecha_fin = $datoObra->obra_fechafin;
        }

        # ---------------------------------------

        // Compara si fecha fianl de la obra es menor a la fecha final de la solicitud
        if($datoObra->obra_fechafin <= $ff->fecha_fin_solicitudes){
            // Fecha final sera la fecha de la ultima solicitud
            $fecha_fin = $ff->fecha_fin_solicitudes;
        } else {
            // La final va a ser la fecha de cierre indicada en la obra
            $fecha_fin = $ff->fecha_fin_solicitudes;
        }

        // Ahora comparamos la fecha final que escoja el sistema contra la fecha final de la
        // valuacion en caso de existir

        #------------------------------------------
        if( count($valuacion) >= 1 ){

            // Contamos cuantas valuaciones existen
            $val = count($valuacion);
            // Si las valuaciones son 0 se identifica, de no ser asi se le resta un 1 al resultado
            if($val >= 1){
                $val = $val - 1;
            } else {
                //Sino, vale cero
                $val = 0;
            }

            // Si la fecha de valuacion es mayor a la fecha final calculada arriba, la valuacion sustituira
            // la fecha final
            if($valuacion[$val]->valuacion_fecha > $fecha_fin){
                $fecha_fin = $valuacion[$val]->valuacion_fecha;
            }
        }

        #------------------------------------------
        //Donde se guardara el array
        $array = array();
        // El contador para las semanas (semana 1, semana 2, etc)
        $cont = 1;
        //Inicio en cero un contador para las posiciones
        $i = 0;
        //Inicio en cero un contador unicamente valuaciones
        $v = 0;

        //sumamos 6 dias desdee el dia de inicio hasta 6 dias mas
        $incrementoDeDias = date('Y-m-d', strtotime($fecha_inicial."+ 6 days"));

        // Variable a usar para las sumatorias generales del while, el monto sera el anticipo o en caso de
        // no haber, valdra 0
        if($datoObra->obra_anticipo){
            $monto = $datoObra->obra_anticipo;
        } else {
            $monto = 0;
        }

            // Si los dias incrementados dan un numero mayor a la fecha final se reaiza la consulta
            // en base a la fecha inicial contra la fecha final
            if($incrementoDeDias <= $fecha_fin){
                
                // Se crea una variable a fin de no repetir el nombre de la fecha final
                $fecha_i = $fecha_inicial;
                // Mientras el incremento de dias sea menor a la fecha final, has este bucle
                while ($incrementoDeDias <= $fecha_fin) {
                    // Se realiza la consulta a la BD
                    $calcular = Pago::select(
                        DB::raw('SUM(pago.pago_monto) AS pago_monto')
                    )
                    ->leftJoin('solicitud', 'pago.solicitud_id', '=', 'solicitud.id')
                    ->whereBetween('pago.pago_fecha', [$fecha_i, $incrementoDeDias])
                    ->where('solicitud.obra_id', $id)
                    ->first();

                    
                    // Guardamos en una variable el monto de esa semana en negativo debido a que
                    // es un haber
                    $monto_consulta = -($calcular->pago_monto);
                    //Calculamos el monto menos el monto del pago
                    $monto =  $monto_consulta + $monto;
                    
                    // En caso de existir valuacion
                    if(count($valuacion) >= 1){

                        // Agregamos la valuacion en caso de que la fecha sea mayor a la fecha inicial y
                        // a su vez sea menor a la fecha incrementable
                        if( $valuacion[$v]->valuacion_fecha >= $fecha_i AND $valuacion[$v]->valuacion_fecha <= $incrementoDeDias ){
                            
                            // Monto va a avaler lo que valga la valuacio mas el propio monto
                            $monto = $valuacion[$v]->valuacion_monto + $monto;
                            
                            // Si solo hay una valuacion no hagas nada, sino suma uno
                            if(count($valuacion) >= 1) {
                                $v = $v;
                            } else {
                                $v = $v + 1;
                            }
                        } else {
                            // Si no, el monto es el mismo que el valor previo
                            $monto = $monto;
                        }
                    }
                    
                    $array[] = array('date' => $fecha_i, 'value' => floatval($monto));

                    // la fecha inicial pasa a ser la fecha final de la anterior consulta mas un dia
                    $fecha_i = date('Y-m-d', strtotime($incrementoDeDias."+ 1 days"));
                    // La fecha final se vuelve a incrementar 6 dias
                    $incrementoDeDias = date('Y-m-d', strtotime($fecha_i."+ 6 days"));


                }

                // al ser mayor el incremento de dias en comparacion a la fecha final solo quedan
                // don opciones, qie la fecha de incremento sea levemente menor a la fecha fin
                // o que sea exactamente igual asi que ahora se calculara la ultima fecha final
                // (los dias que quedan) menos el dia final, o si ambas fechas son igual
                if($fecha_i <= $fecha_fin){
                    // Realizamos la consulta en base a la ultima fecha de inicio que creo el bucle y la fecha final
                    $calcular = Pago::select(
                        DB::raw('SUM(pago.pago_monto) AS pago_monto')
                    )
                    ->leftJoin('solicitud', 'pago.solicitud_id', '=', 'solicitud.id')
                    ->whereBetween('pago.pago_fecha', [$fecha_i, $fecha_fin])
                    ->where('solicitud.obra_id', $id)
                    ->first();

                    // Guardamos en una variable el monto de esa semana en negativo debido a que es un haber
                    $monto_consulta = -($calcular->pago_monto);
                    $monto =  $monto_consulta + $monto;

                    // En caso de existir valuacion
                    if(count($valuacion) >= 1){

                        // Agregamos la valuacion en caso de que la fecha sea mayor a la fecha inicial y
                        // a su vez sea menor a la fecha incrementable
                        if( $valuacion[$i]->valuacion_fecha >= $fecha_i && $valuacion[$i]->valuacion_fecha <= $incrementoDeDias ){
                            // Monto va a avaler lo que valga la valuacio mas el propio monto
                            $monto = $valuacion[$i]->valuacion_monto + $monto;
                            $i = $i + 1;
                        }
                    }

                    // dump($monto . " fecha nicial: " . $fecha_i . " | fecha incrementada: " . $fecha_fin);
                    $array[] = array('date' => $fecha_i , 'value' => floatval($monto));

                }


            } else {
                // Se realiza la consulta a la BD
                $calcular = Pago::select(
                    DB::raw('SUM(pago.pago_monto) AS pago_monto')
                )
                ->leftJoin('solicitud', 'pago.solicitud_id', '=', 'solicitud.id')
                ->whereBetween('pago.pago_fecha', [$fecha_inicial, $fecha_fin])
                ->where('solicitud.obra_id', $id)
                ->first();

                // Guardamos en una variable el monto de esa semana en negativo debido a que es un haber
                $monto_consulta = -($calcular->pago_monto);
                $monto =  $monto_consulta + $monto;

                // En caso de existir valuacion
                if(count($valuacion) >= 1){

                    // Agregamos la valuacion en caso de que la fecha sea mayor a la fecha inicial y
                    // a su vez sea menor a la fecha incrementable
                    if( $valuacion[$i]->valuacion_fecha >= $fecha_inicial && $valuacion[$i]->valuacion_fecha <= $incrementoDeDias ){
                        // Monto va a avaler lo que valga la valuacio mas el propio monto
                        $monto = $valuacion[$i]->valuacion_monto + $monto;
                        $i = $i + 1;
                    }
                }

                $array[] = array("date" => $fecha_inicial , "value" => floatval($monto));


            }
        
        return response()->json( $array );

    }



}
