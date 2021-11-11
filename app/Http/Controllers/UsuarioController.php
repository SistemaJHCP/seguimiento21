<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Permiso;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class UsuarioController extends Controller
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
        $permiso = Permiso::select("id","nombre_permiso")->get();

        if($permisoUsuario[0]->usuario != 1){
            return redirect()->route("home");
        }

        return view('sistema.usuarios.index')->with('permisos', $permiso)->with('permisoUsuario', $permisoUsuario[0]);
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
        $permiso = Permiso::select("id","nombre_permiso")->get();

        if($permisoUsuario[0]->usuario != 1 || $permisoUsuario[0]->crear_usuario != 1){
            return redirect()->route("home");
        }

        //Se realiza la validacion de que todos los datos esten correctos

        $request->validate([
            'nameUser' => 'required|max:50',
            'complete_name' => 'required|max:50',
            'email' => 'required|email|max:50|unique:users',
            'password' => 'required|max:50',
            'levelAccess' => 'required'
        ]);

        // Se procede a guardar en la BD, todos los caracteres en minusculas

        $user = new User();

        $user->user_login = strtolower($request['nameUser']);
        $user->user_name = strtolower($request['complete_name']);
        $user->email = strtolower($request['email']);
        $user->password = bcrypt($request['password']);
        $user->permiso_id = $request['levelAccess'];

        //Se guardan
        $user->save();
        //Si los guarda es TRUE, sino, es FALSE
        if($user){
            $user = true;
        } else {
            $user = false;
        }
        //Retorna y avisa a la vista si guardo o no
        return redirect()->route('usuario.index')->with('user', $user);
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
        if( $permisoUsuario[0]->usuario != 1 || $permisoUsuario[0]->modificar_usuario != 1)
        {
            return redirect()->route("home");
        }

        //Se realiza la validacion de que todos los datos esten correctos

        $request->validate([
            'nameUser' => 'required|max:50',
            'complete_name' => 'required|max:50',
            'password' => 'required|max:50',
            'levelAccess' => 'required'
        ]);

        //buscas por el ID a quien vas a modificar
        $user = User::findOrFail($request->guia);

        //sustituyes sus valores
        $user->user_login = strtolower($request['nameUser']);
        $user->user_name = strtolower($request['complete_name']);
        $user->password = bcrypt($request['password']);
        $user->permiso_id = $request['levelAccess'];

        //Se guardan
        $user->save();
        //Si los guarda es TRUE, sino, es FALSE
        if($user){
            $user = true;
        } else {
            $user = false;
        }
        //Retorna y avisa a la vista si guardo o no
        return redirect()->route('usuario.index')->with('user', $user);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function desactivate(Request $request ,$id)
    {

        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );
        if( $permisoUsuario[0]->usuario != 1 || $permisoUsuario[0]->desactivar_usuario != 1)
        {
            return redirect()->route("home");
        }

        $user = User::find($id);
        $user->status = "0";
        $user->save();

        if ($user) {
            $user = true;
        } else {
            $user = false;
        }

        return response()->json($user);

    }

    public function inhabilitado()
    {
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );
        return view("sistema.usuarios.deshabilitados")->with('permisoUsuario', $permisoUsuario[0]);
    }


    // --------------------------- solicitudes desde jquery ---------------------------------------

    public function jq_listar_usuarios()
    {

        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );
        $query = User::where("status", 1)->get();

        if ( $permisoUsuario[0]->usuario == 1 && $permisoUsuario[0]->ver_botones_usuario == 1) {
            return datatables()->of($query)
            ->addColumn('btn','sistema.usuarios.btnModificarUsuario')
            ->rawColumns(['btn'])->toJson();
        } else {
            return datatables()->of($query)
            ->addColumn('btn','sistema.btnNull')
            ->rawColumns(['btn'])->toJson();
        }

    }

    public function jq_consultarUsuariosModificar(Request $request, $id)
    {
        $user = User::select()->where('id', $id)->get();
        return response()->json($user);
    }



    public function jq_listaInhabilitado()
    {

        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );
        $query = User::where("status", 0)->get();

        if ( $permisoUsuario[0]->usuario == 1 && $permisoUsuario[0]->reactivar_usuario == 1) {
            return datatables()->of($query)
            ->addColumn('btn','sistema.usuarios.btnInhabilitado')
            ->rawColumns(['btn'])->toJson();
        } else {
            return datatables()->of($query)
            ->addColumn('btn','sistema.btnNull')
            ->rawColumns(['btn'])->toJson();
        }
    }


    public function jq_reactivar(Request $request, $id){

        //Validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );
        if( $permisoUsuario[0]->usuario != 1 || $permisoUsuario[0]->reactivar_usuario != 1)
        {
            return redirect()->route("home");
        }

        $user = User::find($id);
        $user->status = "1";
        $user->save();

        if ($user) {
            $user = true;
        } else {
            $user = false;
        }

        return response()->json($user);

    }

}
