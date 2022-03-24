<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Permiso;
use Illuminate\Http\Request;

class ClienteController extends Controller
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

        if($permisoUsuario[0]->cliente != 1){
            return redirect()->route("home");
        }


        return view("sistema.cliente.index")->with('permisoUsuario', $permisoUsuario[0]);
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

        if($permisoUsuario[0]->cliente != 1 || $permisoUsuario[0]->crear_cliente != 1){
            return redirect()->route("home");
        }
        //Realizamos la validacion de que todos los pasos solicitados sean correctos
        $request->validate([
            'tipo' => 'required',
            'codigo' => 'required|min:3|max:9',
            'nombre' => 'required|min:3|max:50',
            'telefono' => 'required|min:7|max:13',
            'direccion' => 'required|max:250',
            'correo' => 'required|max:40'
        ]);

        //Se valida el ultimo codigo en el sistema
        $codigo = Cliente::select("cliente_codigo")->orderBy("id", "desc")->limit(1)->get();
        //Si la variable codigo es mayor o igual a 1, ejecuta el conteo
        if(count($codigo) < 1){
            //Si es menor a 1
            $codigoCli = "CLI-1";
        } else {
            //Se extrae el numero y se le agrega un valor mas (xx + 1)
            preg_match_all('!\d+!', $codigo[0]->cliente_codigo, $cod);
            $cod = $cod[0][0] + 1;
            $codigoCli = "CLI-".$cod;
        }

        //Inicio la instancia
        $cliente = new Cliente();
        //inserto cada valor en los campos de la BD

        $cliente->cliente_codigo = $codigoCli;
        $cliente->cliente_rif = $request->tipo . "-" . $request->codigo;
        $cliente->cliente_nombre = $request->nombre;
        $cliente->cliente_telefono = $request->telefono;
        $cliente->cliente_direccion = $request->direccion;
        $cliente->cliente_correo = $request->correo;
        $cliente->cliente_estado = "1";

        //Se  almacena la informacion en la BD
        $cliente->save();
        //Si los guarda es TRUE, sino, es FALSE

        return redirect()->route('cliente.index')->with('cliente', $cliente);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Codventas  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->cliente != 1 || $permisoUsuario[0]->ver_botones_cliente != 1){
            return redirect()->route("home");
        }

        //Busca los datos de este ID en especifico
        $cliente = Cliente::findOrFail($id);
        //Inserta a la vista los permisos de usuario y los datos del cliente con ese ID
        return view("sistema.cliente.verCliente")->with('permisoUsuario', $permisoUsuario[0])->with("cliente", $cliente);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Codventas  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {

        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->modificar_cliente != 1){
            return redirect()->route("home");
        }

        //Busca al usuario con los datos
        $cliente = Cliente::find($id);
        //Retorna la vista con los datos solictados en el paso previo

        //realizo la separacion de caracteres para poder definir en caso tal cual es el primer caracter (J,G,V o E) y de no ser asi, solo me muestre los valores solicitados
        $tipo = $cliente->cliente_rif[0];
        if($tipo == "J" || $tipo == "G" || $tipo == "V" || $tipo == "E") {
            $tipo;
            $codigo = str_replace("-", "", $cliente->cliente_rif);
            $codigo = substr($codigo, 1);
        } else {
            $tipo == "";
            $codigo = $cliente->cliente_rif;
        }

        return view("sistema.cliente.modificarCliente")->with('permisoUsuario', $permisoUsuario[0])->with("cliente", $cliente)->with("tipo", $tipo)->with("codigo", $codigo);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Codventas  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->cliente != 1 || $permisoUsuario[0]->modificar_cliente != 1){
            return redirect()->route("home");
        }

        //Realizamos la validacion de que todos los pasos solicitados sean correctos
        $request->validate([
            'tipo' => 'required',
            'codigo' => 'required|min:3|max:9',
            'nombre' => 'required|min:3|max:50',
            'telefono' => 'required|min:7|max:13',
            'direccion' => 'required|max:250',
            'correo' => 'required|max:40'
        ]);

        //Buscar el ID de la persona a modificar
        $cliente = Cliente::findOrFail($id);

        //Se ingresan los valores capturados en el request y se sustituyen los valores de la busqueda
        $cliente->cliente_rif = $request->tipo . "-" . $request->codigo;
        $cliente->cliente_nombre = $request->nombre;
        $cliente->cliente_telefono = $request->telefono;
        $cliente->cliente_direccion = $request->direccion;
        $cliente->cliente_correo = $request->correo;

        $cliente->save();

        return redirect()->route('cliente.index')->with('cliente', $cliente);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Codventas  $cliente
     * @return \Illuminate\Http\Response
     */


    //-------------------------------------------------------------------------------------------

    public function js_listaClientes()
    {
        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );
        $query = Cliente::select()->where("cliente_estado", 1)->get();
        // validamos que opciones maneja este usuario y dependiendo de esto, se muestra la informacion
        if ( $permisoUsuario[0]->cliente == 1 && $permisoUsuario[0]->ver_botones_cliente == 1) {
            return datatables()->of($query)
            ->addColumn('btn','sistema.cliente.btnModificarCliente')
            ->rawColumns(['btn'])->toJson();
        } else {
            return datatables()->of($query)
            ->addColumn('btn','sistema.btnNull')
            ->rawColumns(['btn'])->toJson();
        }

    }

    public function jq_deshabilitar($id)
    {
        //Validamos los permisos, si no funciona simplemente no hara el proceso y arrojara error
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->cliente != 1 || $permisoUsuario[0]->desactivar_cliente != 1){
            return redirect()->route("home");
        }

        $cliente = Cliente::findOrFail($id);

        $cliente->cliente_estado = 0;
        $cliente->save();

        if ($cliente) {
            $cliente = true;
        } else {
            $cliente = false;
        }

        return response()->json($cliente);
    }

    public function reactivar()
    {
        return "Ya esta";
    }

}
