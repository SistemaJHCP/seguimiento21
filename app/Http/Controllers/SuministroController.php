<?php

namespace App\Http\Controllers;
use App\Models\Suministro;
use App\Models\Permiso;
use Illuminate\Http\Request;

class SuministroController extends Controller
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

        if($permisoUsuario[0]->suministros != 1){
            return redirect()->route("home");
        }
        //Retornamos la respuesta de los permisos a la vsta principal
        return view("sistema.suministros.index")->with('permisoUsuario', $permisoUsuario[0]);
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

        if($permisoUsuario[0]->suministros != 1 || $permisoUsuario[0]->crear_suministros != 1){
            return redirect()->route("home");
        }
        //Validamos que se cumpla la cantidad de caracteres permitidos
        $request->validate([
            'suministro' => 'required|max:60|min:3'
        ]);
        //Se instancia la clase suministro para que guarde los uevos valores
        $sum = new Suministro();

        //Se valida el ultimo codigo en el sistema
        $codigo = Suministro::select("suministro_codigo")->orderBy("id", "desc")->limit(1)->get();
        //Si la variable codigo es mayor o igual a 1, ejecuta el conteo
        if(count($codigo) < 1){
            //Si es menor a 1
            $codigoSum = "SUM-1";
        } else {
            //Se extrae el numero y se le agrega un valor mas (xx + 1)
            preg_match_all('!\d+!', $codigo[0]->suministro_codigo, $cod);
            $cod = $cod[0][0] + 1;
            $codigoSum = "SUM-".$cod;
        }
        //Se almacena la informacion
        $sum->suministro_codigo = $codigoSum;
        $sum->suministro_nombre = $request->suministro;
        $sum->suministro_estado = 1;
        //Se guarda la informacion en la BD
        $resp = $sum->save();
        //Se retorna a la vista con la debida respuesta
        return redirect()->route("suministro.index")->with("sum", $resp);

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

    public function update(Request $request)
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->suministros != 1 || $permisoUsuario[0]->modificar_suministros != 1){
            return redirect()->route("home");
        }
        //Validamos que se cumpla la cantidad de caracteres permitidos
        $request->validate([
            'suministroMod' => 'required|max:60|min:3'
        ]);

        //Busca el suministro especificado por ID
        $sum = Suministro::find($request->dato);
        //Sustituye el valor del nombre del suministro
        $sum->suministro_nombre = $request->suministroMod;
        //se guarda la modificacion
        $sum->save();

        //Retorna a la vista con la respuesta
        return redirect()->route("suministro.index")->with('sum', $sum);

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
        //consultamos a la base de datos
        $query = Suministro::select()->where("suministro_estado", 1)->get();

        // validamos que opciones maneja este usuario y dependiendo de esto, se muestra la informacion
        if ($permisoUsuario[0]->suministros != 1 || $permisoUsuario[0]->ver_botones_suministros != 1) {
            return datatables()->of($query)
            ->addColumn('btn','sistema.btnNull')
            ->rawColumns(['btn'])->toJson();
        } else {
            return datatables()->of($query)
            ->addColumn('btn','sistema.suministros.btnSuministro')
            ->rawColumns(['btn'])->toJson();
        }
    }

    public function jq_modificar($id)
    {
        $sum = Suministro::find($id);
        return response()->json($sum);
    }

    public function js_deshabilitar($id)
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->suministros != 1 || $permisoUsuario[0]->desactivar_suministros != 1){
            return redirect()->route("home");
        }
        //uscamos el suministro con el ID
        $sum = Suministro::find($id);
        //Se cambia el estado de inactivo a activo
        $sum->suministro_estado = 0;
        //Se guarda el cambio
        $resp = $sum->save();

        //envia la respuesta via json
        return response()->json($resp);



    }

    public function js_habilitar($id)
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->suministros != 1 || $permisoUsuario[0]->reactivar_suministros != 1){
            return redirect()->route("home");
        }
        //uscamos el suministro con el ID
        $sum = Suministro::find($id);
        //Se cambia el estado de inactivo a activo
        $sum->suministro_estado = 1;
        //Se guarda el cambio
        $resp = $sum->save();

        //envia la respuesta via json
        return response()->json($resp);
    }

    public function indexDeshabilitados()
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->suministros != 1 || $permisoUsuario[0]->reactivar_suministros != 1){
            return redirect()->route("home");
        }
        return view("sistema.suministros.deshabilitado")->with('permisoUsuario', $permisoUsuario[0]);
    }


    public function jq_listaDes()
    {

        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );
        //consultamos a la base de datos
        $query = Suministro::select()->where("suministro_estado", 0)->get();

        // validamos que opciones maneja este usuario y dependiendo de esto, se muestra la informacion
        if ($permisoUsuario[0]->suministros != 1 || $permisoUsuario[0]->ver_botones_suministros != 1) {
            return datatables()->of($query)
            ->addColumn('btn','sistema.btnNull')
            ->rawColumns(['btn'])->toJson();
        } else {
            return datatables()->of($query)
            ->addColumn('btn','sistema.suministros.btnDeshabilitado')
            ->rawColumns(['btn'])->toJson();
        }
    }








}
