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
            return redirect()->route('requisicion.crear')->with('resp', 1);
        } else {
            return redirect()->route('requisicion.crear')->with('resp', 0);
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

    public function jq_consultarTipo($valor)
    {

        //Dependendo de la seleccion, muestra todo lo referente a material, servicio o viatico
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

}
