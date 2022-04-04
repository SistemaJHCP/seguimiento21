<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permiso;
use App\Models\Solicitud;
use App\Models\Obra;
use App\Models\User;


class HomeController extends Controller
{

    public function permisos($p)
    {
        //Se encarga de validar los permisos que se manejan en el sistema,
        //saber a que areas del sistema se puede ingresar
        $permiso = Permiso::select()->where('id', $p )->get();
        return $permiso;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Consultamos las ultimas 15 solicitudes activas
        $solicitud = Solicitud::select(
            "solicitud.solicitud_numerocontrol AS numerocontrol",
            "solicitud.solicitud_aprobacion AS aprobacion",
            "solicitud.solicitud_fecha AS fecha",
            "requisicion.requisicion_codigo"
        )
        ->leftJoin('requisicion', 'requisicion.id', '=', 'solicitud.requisicion_id')
        ->limit(15)
        ->orderBy('solicitud_fecha', 'DESC')
        ->get();
        //Contamos el total de obras
        $totalObras = Obra::select()->count();
        //Contamos el total de solicitudes
        $totalSolicitudesGeneral = Solicitud::select()->count();
        //Contamos el total de solicitudes aprobadas
        $totalSolicitudes = Solicitud::select()->where('solicitud_aprobacion', 'Aprobada')->count();

        //validamos los permisos
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );
        //Retornamos a la vista toda la informacion
        return view('sistema.home')->with('permisoUsuario', $permisoUsuario[0])
        ->with('solicitud', $solicitud)
        ->with('totalObras', $totalObras)
        ->with('totalSolicitudes', $totalSolicitudes)
        ->with('totalSolicitudesGeneral', $totalSolicitudesGeneral)
        ;
    }

    public function cambiarClave(Request $request){
        $request->validate([
            'clave' => 'required|max:60',
        ]);

        //Se busca al usuario por su ID
        $cambio = User::find( \Auth::user()->id );
        //se sustituye su clave con la debida encriptacion bcrypt
        $cambio->password = bcrypt($request->clave);
        //Guardamos este cambio
        $resp = $cambio->save();
        //Retornamos la respuesta a la vista
        return redirect()->route('home')->with('resp', $resp);
    }

}
