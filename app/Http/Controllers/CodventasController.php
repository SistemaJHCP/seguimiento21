<?php

namespace App\Http\Controllers;

use App\Models\Codventas;
use Illuminate\Http\Request;
use App\Models\Permiso;
use Codventa;

class CodventasController extends Controller
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

        if($permisoUsuario[0]->ptc != 1){
            return redirect()->route("home");
        }
        return view("sistema.maestroPTC.index")->with('permisoUsuario', $permisoUsuario[0]);
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

        if($permisoUsuario[0]->ptc != 1 || $permisoUsuario[0]->crear_ptc != 1){
            return redirect()->route("home");
        }

        //Realizamos la validacion de que todos los pasos solicitados sean correctos
        $request->validate([
            'codigoPTC' => 'required|min:3|max:23',
            'nombrePTC' => 'required|min:3|max:100',
            'telefonoPTC' => 'required|min:3|max:40',
            'direccionPTC' => 'required|min:7|max:220',
            'correoPTC' => 'required|max:60'
        ]);

        //Se valida el ultimo codigo de asignacion en el sistema desde la BD
        $codigo = Codventas::select("codventa_codigo2")->orderBy("id", "desc")->limit(1)->get();

        //Instanciamos para poder tomar los valores
        $cod = new Codventas();

        //Si la variable codigo es mayor o igual a 1, ejecuta el conteo
        if(count($codigo) < 1){
            //Si es menor a 1
            $codigoCli = "PTR-1";
        } else {
            //Se extrae el numero y se le agrega un valor mas (xx + 1)
            preg_match_all('!\d+!', $codigo, $cod1);
            $cod1 = $cod1[0][1] + 1;
            $codigoCli = "PTR-".$cod1;
        }

        //Insertamos los nuevos valores en cada uno de los campos
        $cod->codventa_codigo = $request->codigoPTC;
        $cod->codventa_nombre = $request->nombrePTC;
        $cod->codventa_codigo2 = $codigoCli;
        $cod->codventa_telefono = $request->telefonoPTC;
        $cod->codventa_direccion = $request->direccionPTC;
        $cod->codventa_correo = $request->correoPTC;
        $cod->codventa_estado = "1";

        $cod->save();
        if($cod){
            return redirect()->route("maestro.index")->with('resp', 1);
        } else {
            return redirect()->route("maestro.index")->with('resp', 0);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Codventas  $codventas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->ptc != 1 || $permisoUsuario[0]->ver_botones_ptc != 1){
            return redirect()->route("home");
        }
        //Se buscan los datos del PTC solicitado
        $ptc = Codventas::findOrFail($id);
        //Se retorna a la vista con la informacion capturada en las consultas
        return view("sistema.maestroPTC.ver")->with("permisoUsuario", $permisoUsuario[0])->with("ptc", $ptc);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Codventas  $codventas
     * @return \Illuminate\Http\Response
     */
    public function edit(Codventas $id)
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->ptc != 1 || $permisoUsuario[0]->modificar_ptc != 1){
            return redirect()->route("home");
        }

        //Se buscan los datos del PTC solicitado
        $ptc2 = Codventas::find($id);

        //Se retorna a la vista con la informacion capturada en las consultas
        return view("sistema.maestroPTC.modificar")->with("permisoUsuario", $permisoUsuario[0])->with("ptc", $ptc2[0]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Codventas  $codventas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->ptc != 1 || $permisoUsuario[0]->modificar_ptc != 1){
            return redirect()->route("home");
        }

        //Realizamos la validacion de que todos los pasos solicitados sean correctos
        $request->validate([
            'codigoPTC' => 'required|min:3|max:23',
            'nombrePTC' => 'required|min:3|max:100',
            'telefonoPTC' => 'required|min:3|max:40',
            'direccionPTC' => 'required|min:7|max:220',
            'correoPTC' => 'required|max:60'
        ]);
        //Busca los valores en la base de datos
        $cod = Codventas::findOrFail($id);
        //Inserta los valores en los campos permitidos
        $cod->codventa_codigo = $request->codigoPTC;
        $cod->codventa_nombre = $request->nombrePTC;
        $cod->codventa_telefono = $request->telefonoPTC;
        $cod->codventa_direccion = $request->direccionPTC;
        $cod->codventa_correo = $request->correoPTC;
        //Se realiza el guardado de la informacion
        $resp = $cod->save();

        //Si lo guarda, es true, si no, es false
        if ($resp) {
            $resp = true;
        } else {
            $resp = false;
        }


        //Retorna a la ruta indicada
        return redirect()->route("maestro.index")->with('resp', $resp);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Codventas  $codventas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Codventas $codventas)
    {
        //
    }

//------------------------------------------------------------------------

    public function jq_listaPTC()
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );
        $query = Codventas::select()->where("codventa_estado", 1)->get();

        // validamos que opciones maneja este usuario y dependiendo de esto, se muestra la informacion
        if ( $permisoUsuario[0]->ptc == 1 && $permisoUsuario[0]->ver_botones_ptc == 1) {
            return datatables()->of($query)
            ->addColumn('btn','sistema.maestroPTC.btnPTC')
            ->rawColumns(['btn'])->toJson();
        } else {
            return datatables()->of($query)
            ->addColumn('btn','sistema.btnNull')
            ->rawColumns(['btn'])->toJson();
        }
    }


    public function jq_desactivar($id){
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->ptc != 1 || $permisoUsuario[0]->desactivar_ptc != 1){
            return redirect()->route("home");
        }

        //Buscas el PTC a deshabilitar
        $ptc = Codventas::findOrFail($id);
        //Cambiamos el estado del PTC a 0 para que el sistema lo tome como desactivado
        $ptc->codventa_estado = 0;

        //Se guarda el resultado en la base de datos
        $res = $ptc->save();
        //Se envia la respuesta a la vista por medio de json
        return response()->json($res);

    }


}
