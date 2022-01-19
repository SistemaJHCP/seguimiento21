<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Permiso;



class MaterialController extends Controller
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

        if($permisoUsuario[0]->materiales != 1){
            return redirect()->route("home");
        }

        return view("sistema.materiales.index")->with('permisoUsuario', $permisoUsuario[0]);

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
        dd("stop");
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->materiales != 1 || $permisoUsuario[0]->crear_materiales != 1){
            return redirect()->route("home");
        }

        //Realizamos la validacion de que todos los pasos solicitados sean correctos
        $request->validate([
            'material' => 'required|max:90'
        ]);

        //Se realiza el calculo para crear e codigo
        $codigo = Material::select("material_codigo")->orderBy("id", "desc")->limit(1)->get();
        //Si la variable codigo es mayor o igual a 1, ejecuta el conteo
        if(count($codigo) < 1){
            //Si es menor a 1
            $codigoMAT = "MAT-1";
        } else {
            //Se extrae el numero y se le agrega un valor mas (xx + 1)
            preg_match_all('!\d+!', $codigo[0]->material_codigo, $cod);
            $cod = $cod[0][0] + 1;
            $codigoMAT = "MAT-".$cod;
        }

        //Se instancia la clase
        $mat = new Material();

        //Se sustituyen los valores en la instancia
        $mat->material_codigo = $codigoMAT;
        $mat->material_nombre = $request->material;
        //Se guarda en BD
        $resp = $mat->save();

        //Envia el resultado a la ruta de la vista
        return redirect()->route("materiales.index")->with('mat', $resp);
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
    public function update(Request $request)
    {

        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->materiales != 1 || $permisoUsuario[0]->modificar_materiales != 1){
            return redirect()->route("home");
        }
        //Validamos que se cumplan las condiciones para el envio
        $request->validate([
            'materiaModl' => 'required|max:90'
        ]);
        //Busca el material a modificar
        $mat = Material::find($request->dato);
        //Realiza la modificacion
        $mat->material_nombre = $request->materiaModl;

        //Se guarda la modificacion y se captura el resultado
        $resp = $mat->save();

        //Se retorna a la vista con la respuesta a mostrar
        return redirect()->route("materiales.index")->with('mat', $resp);
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

        if($permisoUsuario[0]->materiales != 1 || $permisoUsuario[0]->desactivar_materiales != 1){
            return redirect()->route("home");
        }

        //Busca el material a modificar
        $mat = Material::find($request->dato);
        //Se cambia el estado a inactivo
        $mat->material_estado = 0;
        //guardar la modificacion
        $resp = $mat->save();
        //Se envia la respuesta por Json
        return response()->json($resp);

    }

    public function jq_material()
    {

        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );
        $query = Material::select()->where("material_estado", 1)->get();
        // validamos que opciones maneja este usuario y dependiendo de esto, se muestra la informacion
        if ( $permisoUsuario[0]->materiales == 1 && $permisoUsuario[0]->ver_botones_materiales == 1) {
            return datatables()->of($query)
            ->addColumn('btn','sistema.materiales.btnMateriales')
            ->rawColumns(['btn'])->toJson();
        } else {
            return datatables()->of($query)
            ->addColumn('btn','sistema.btnNull')
            ->rawColumns(['btn'])->toJson();
        }

    }

    public function jq_modificar($id)
    {
        //Buscar en Materiales toda la informacion bajo ese ID
        $mat = Material::find($id);
        //enviar el resultado para poder ser mostrado por Json
        return response()->json($mat);

    }


}
