<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permiso;
use App\Models\Proveedor;
use App\Models\Suministro;

class ProveedoresController extends Controller
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

        if($permisoUsuario[0]->proveedores != 1){
            return redirect()->route("home");
        }

        //Ver suminsitro
        $suministro = Suministro::select()->where('suministro_estado', 1)->orderBy("suministro_nombre", "ASC")->get();

        //Retorna a la vista de la ruta principal con los permisos de usuario
        return view("sistema.proveedor.index")->with('permisoUsuario', $permisoUsuario[0])->with('suministro', $suministro);
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

        if($permisoUsuario[0]->proveedores != 1 || $permisoUsuario[0]->crear_proveedores != 1){
            return redirect()->route("home");
        }

        //validamos que request cumpla con las normas
        $request->validate([
            'tipo' => 'min:5|required',
            'identificacion' => 'required|min:5|max:9',
            'nombre' => 'required|min:3|max:50',
            'suministro' => 'required',
            'telefono' => 'required|min:3|max:11',
            'direccion' => 'required|min:1|max:200'
        ]);

        //Se instancia la clase proveedor
        $proveedor = new Proveedor();

        //Se valida el ultimo codigo en el sistema
        $codigo = Proveedor::select("proveedor_codigo")->orderBy("id", "desc")->limit(1)->get();
        //Si la variable codigo es mayor o igual a 1, ejecuta el conteo
        if(count($codigo) < 1){
            //Si es menor a 1
            $codigoPRO = "PRO-1";
        } else {
            //Se extrae el numero y se le agrega un valor mas (xx + 1)
            preg_match_all('!\d+!', $codigo[0]->proveedor_codigo, $cod);
            $cod = $cod[0][0] + 1;
            $codigoPRO = "PRO-".$cod;
        }

        //Se agrega la informacion capturada
        $proveedor->proveedor_codigo = $codigoPRO;
        $proveedor->proveedor_tipo = $request->tipo;
        $proveedor->proveedor_rif = $request->identificacion;
        $proveedor->proveedor_nombre = $request->nombre;
        $proveedor->suministro_id  = $request->suministro;
        $proveedor->proveedor_telefono = $request->telefono;
        $proveedor->proveedor_direccion = $request->direccion;
        $proveedor->proveedor_correo = $request->email;
        $proveedor->proveedor_contacto = $request->contacto;
        $proveedor->proveedor_estado = 1;

        //Se guarda la informacion capturada
        $resp =$proveedor->save();

        return redirect()->route('proveedor.index')->with('resp', $resp);

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

        if($permisoUsuario[0]->proveedores != 1 || $permisoUsuario[0]->ver_botones_proveedores != 1){
            return redirect()->route("home");
        }

        //buscar el id del proveedor
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

        //Enviar lo capturado a la vista
        return view('sistema.proveedor.verProveedor')->with('permisoUsuario', $permisoUsuario[0])->with('proveedor', $pro[0]);

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

        if($permisoUsuario[0]->proveedores != 1 || $permisoUsuario[0]->modificar_proveedores != 1){
            return redirect()->route("home");
        }
        //Ver suminsitro
        $suministro = Suministro::select()->where('suministro_estado', 1)->orderBy("suministro_nombre", "ASC")->get();

        //buscar el id del proveedor
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

        //Agregar todas las solicitudes a la vista
        return view('sistema.proveedor.modificar')->with('permisoUsuario', $permisoUsuario[0])->with('proveedor', $pro[0])->with('suministro', $suministro);


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

        if($permisoUsuario[0]->proveedores != 1 || $permisoUsuario[0]->modificar_proveedores != 1){
            return redirect()->route("home");
        }

        //validamos que request cumpla con las normas
        $request->validate([
            'tipo' => 'min:5|required',
            'identificacion' => 'required|min:5|max:9',
            'nombre' => 'required|min:3|max:50',
            'suministro' => 'required',
            'telefono' => 'required|min:3|max:11',
            'direccion' => 'required|min:1|max:200'
        ]);


        //Buscar el proveedor por el ID
        $pro = Proveedor::find($id);

        //sustituyo los valores
        $pro->proveedor_tipo = $request->tipo;
        $pro->proveedor_rif = $request->identificacion;
        $pro->proveedor_nombre = $request->nombre;
        $pro->proveedor_telefono = $request-> telefono;
        $pro->suministro_id = $request->suministro;
        $pro->proveedor_direccion = $request->direccion;
        $pro->proveedor_correo = $request->email;
        $pro->proveedor_contacto = $request->contacto;
        //Se guardan las modificaciones en la BD
        $resp = $pro->save();
        //Se retorna a la vista el resultado
        return redirect()->route('proveedor.index')->with('resp', $resp);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->proveedores != 1 || $permisoUsuario[0]->desactivar_proveedores != 1){
            return redirect()->route("home");
        }

        //Se buscar el proveedor segun el ID capturado
        $pro = Proveedor::find($request->id);
        //Se cmbia el valor de proveedor estado a 0 para que este inhabilitado
        $pro->proveedor_estado = 0;

        //Se guarda la informacion
        $resp = $pro->save();

        //Se retorna la respuesta a la vista mediante json
        return response()->json($resp);




    }

    public function jq_lista()
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );
        //Realizamos la consulta
        $query = Proveedor::select(
            'proveedor.id AS id',
            'proveedor.proveedor_codigo AS codigo',
            'proveedor.proveedor_tipo AS tipo',
            'proveedor.proveedor_rif AS rif',
            'proveedor.proveedor_nombre AS nombre',
            'proveedor.proveedor_telefono AS tlf',
            'proveedor.proveedor_correo AS correo',
            'proveedor.proveedor_contacto AS contacto',
            'suministro.suministro_nombre AS suministro'
        )
        ->leftJoin("suministro","suministro.id", "=", "proveedor.suministro_id")
        ->where("proveedor.proveedor_estado", 1)
        ->orderBy("proveedor.id", "DESC")
        ->get();
        // validamos que opciones maneja este usuario y dependiendo de esto, se muestra la informacion
        if ( $permisoUsuario[0]->proveedores == 1 && $permisoUsuario[0]->ver_botones_proveedores == 1) {
            return datatables()->of($query)
            ->addColumn('btn','sistema.proveedor.btnProveedores')
            ->rawColumns(['btn'])->toJson();
        } else {
            return datatables()->of($query)
            ->addColumn('btn','sistema.btnNull')
            ->rawColumns(['btn'])->toJson();
        }
    }


    public function deshabilitadas()
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->proveedores != 1 || $permisoUsuario[0]->desactivar_proveedores != 1){
            return redirect()->route("home");
        }
        //Retornamos a la vista
        return view('sistema.proveedor.deshabilitadas')->with('permisoUsuario', $permisoUsuario[0]);
    }



    public function jq_listaDeshabilitada()
    {

        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );
        //Realizamos la consulta
        $query = Proveedor::select(
            'proveedor.id AS id',
            'proveedor.proveedor_codigo AS codigo',
            'proveedor.proveedor_tipo AS tipo',
            'proveedor.proveedor_rif AS rif',
            'proveedor.proveedor_nombre AS nombre',
            'proveedor.proveedor_telefono AS tlf',
            'proveedor.proveedor_correo AS correo',
            'proveedor.proveedor_contacto AS contacto',
            'suministro.suministro_nombre AS suministro'
        )
        ->leftJoin("suministro","suministro.id", "=", "proveedor.suministro_id")
        ->where("proveedor.proveedor_estado", 0)
        ->orderBy("proveedor.id", "DESC")
        ->get();
        // validamos que opciones maneja este usuario y dependiendo de esto, se muestra la informacion
        if ( $permisoUsuario[0]->proveedores == 1 && $permisoUsuario[0]->ver_botones_proveedores == 1) {
            return datatables()->of($query)
            ->addColumn('btn','sistema.proveedor.btnDeshabilitados')
            ->rawColumns(['btn'])->toJson();
        } else {
            return datatables()->of($query)
            ->addColumn('btn','sistema.btnNull')
            ->rawColumns(['btn'])->toJson();
        }
    }


    public function reactivarProveedor(Request $request)
    {

        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->proveedores != 1 || $permisoUsuario[0]->reactivar_proveedores != 1){
            return redirect()->route("home");
        }
        //Buscamos al proveedor
        $proveedor = Proveedor::find( $request->id );
        //realizamos el cambio de estado
        $proveedor->proveedor_estado = 1;
        //Guardamos el cambio en la BD
        $resp = $proveedor->save();
        //Retornamos a la vista
        return response()->json($resp);

    }


}
