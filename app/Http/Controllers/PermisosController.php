<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permiso;

class PermisosController extends Controller
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
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->permisos_btn != 1){
            return redirect()->route("home");
        }
        //Redireccionamos a la vista para cargar obras
        return view('sistema.permisos.index')->with('permisoUsuario', $permisoUsuario[0]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->permisos_btn != 1 || $permisoUsuario[0]->crear_permisos != 1){
            return redirect()->route("home");
        }
        //Redireccionamos a la vista para cargar obras
        return view('sistema.permisos.crear')->with('permisoUsuario', $permisoUsuario[0]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $permisoUsuario = $this->permisos( \Auth::user()->permiso_id );

        if($permisoUsuario[0]->permisos_btn != 1 || $permisoUsuario[0]->crear_permisos != 1){
            return redirect()->route("home");
        }

        //Instanciamos la clase para agregar los valores
        $permisos = new Permiso();

        //los botones para activar las funciones
        $permisos->nombre_permiso = $request->nombrePermiso;
        $permisos->maestro_btn =  $request->maestro == "on" ? 1 : 0;
        $permisos->control_de_obras_btn =  $request->obra == "on" ? 1 : 0;
        $permisos->requisicion =  $request->requisicion == "on" ? 1 : 0;
        $permisos->solicitud =  $request->solicitud == "on" ? 1 : 0;
        $permisos->solicitud_pago  =  $request->pago == "on" ? 1 : 0;
        $permisos->cuentas_por_pagar_btn  =  $request->cuentasx == "on" ? 1 : 0;
        // $permisos->configuracion_btn  =  $request->configuracion == "on" ? 1 : 0;
        // $permisos->permisos_btn  =  $request->permisos_btn == "on" ? 1 : 0;

        //Suministros
        $permisos->suministros =  $request->sum == "on" ? 1 : 0;
        $permisos->crear_suministros =  $request->crearSum == "on" ? 1 : 0;
        $permisos->modificar_suministros =  $request->modSum == "on" ? 1 : 0;
        $permisos->ver_botones_suministros =  $request->verSum == "on" ? 1 : 0;
        $permisos->desactivar_suministros =  $request->desSum == "on" ? 1 : 0;
        $permisos->reactivar_suministros =  $request->reacSum == "on" ? 1 : 0;

        //proveedores
        $permisos->proveedores =  $request->prov == "on" ? 1 : 0;
        $permisos->crear_proveedores =  $request->crearProv == "on" ? 1 : 0;
        $permisos->modificar_proveedores =  $request->modProv == "on" ? 1 : 0;
        $permisos->ver_botones_proveedores =  $request->verProv == "on" ? 1 : 0;
        $permisos->desactivar_proveedores =  $request->desProv == "on" ? 1 : 0;
        $permisos->reactivar_proveedores =  $request->reacProv == "on" ? 1 : 0;

        //Cliente
        $permisos->cliente =  $request->cli == "on" ? 1 : 0;
        $permisos->crear_cliente =  $request->crearCli == "on" ? 1 : 0;
        $permisos->modificar_cliente =  $request->modCli == "on" ? 1 : 0;
        $permisos->ver_botones_cliente =  $request->verCli == "on" ? 1 : 0;
        $permisos->desactivar_cliente =  $request->desCli == "on" ? 1 : 0;
        $permisos->reactivar_cliente =  $request->reacCli == "on" ? 1 : 0;


        //Materiales
        $permisos->materiales =  $request->mate == "on" ? 1 : 0;
        $permisos->crear_materiales =  $request->crearMate == "on" ? 1 : 0;
        $permisos->ver_botones_materiales =  $request->verMate == "on" ? 1 : 0;
        $permisos->desactivar_materiales =  $request->desMate == "on" ? 1 : 0;
        // $permisos->desactivar_cliente =  $request->desCli == "on" ? 1 : 0;
        // $permisos->reactivar_cliente =  $request->reacCli == "on" ? 1 : 0;


        //Servicio
        $permisos->servicio =  $request->serv == "on" ? 1 : 0;
        $permisos->crear_servicio =  $request->crearServ == "on" ? 1 : 0;
        $permisos->ver_botones_servicio =  $request->verServ == "on" ? 1 : 0;
        $permisos->desactivar_servicio =  $request->desServ == "on" ? 1 : 0;
        // $permisos->modificar_servicio =  $request->modCli == "on" ? 1 : 0;
        // $permisos->reactivar_servicio =  $request->reacCli == "on" ? 1 : 0;


        //Viáticos
        $permisos->viatico =  $request->viat == "on" ? 1 : 0;
        $permisos->crear_viatico =  $request->crearViat == "on" ? 1 : 0;
        $permisos->ver_botones_viatico =  $request->verViat == "on" ? 1 : 0;
        $permisos->desactivar_viatico =  $request->desViat == "on" ? 1 : 0;
        // $permisos->modificar_viatico =  $request->modCli == "on" ? 1 : 0;
        // $permisos->reactivar_viatico =  $request->reacCli == "on" ? 1 : 0;


        //Usuarios
        $permisos->usuario =  $request->usua == "on" ? 1 : 0;
        $permisos->crear_usuario =  $request->crearUsuario == "on" ? 1 : 0;
        $permisos->modificar_usuario =  $request->modUsuario == "on" ? 1 : 0;
        $permisos->ver_botones_usuario =  $request->verUsuario == "on" ? 1 : 0;
        $permisos->desactivar_usuario =  $request->desUsuario == "on" ? 1 : 0;
        $permisos->reactivar_usuario =  $request->reacUsuario == "on" ? 1 : 0;


        //Permisos
        $permisos->permisos =  $request->perm == "on" ? 1 : 0;
        $permisos->crear_permisos =  $request->crearPerm == "on" ? 1 : 0;
        $permisos->modificar_permisos =  $request->modPerm == "on" ? 1 : 0;
        $permisos->ver_botones_permisos =  $request->verPerm == "on" ? 1 : 0;
        $permisos->desactivar_permisos =  $request->desPerm == "on" ? 1 : 0;
        $permisos->reactivar_permisos =  $request->reacPerm == "on" ? 1 : 0;


        //PTC
        $permisos->ptc =  $request->master == "on" ? 1 : 0;
        $permisos->crear_ptc =  $request->crearMaster == "on" ? 1 : 0;
        $permisos->modificar_ptc =  $request->modMaster == "on" ? 1 : 0;
        $permisos->ver_botones_ptc =  $request->verMaster == "on" ? 1 : 0;
        $permisos->desactivar_ptc =  $request->desMaster == "on" ? 1 : 0;
        $permisos->reactivar_ptc =  $request->ReacMaster == "on" ? 1 : 0;


        //Obra
        $permisos->obra =  $request->obras == "on" ? 1 : 0;
        $permisos->crear_obra =  $request->crearObras == "on" ? 1 : 0;
        $permisos->modificar_obra =  $request->modObras == "on" ? 1 : 0;
        $permisos->ver_botones_obra =  $request->verObras == "on" ? 1 : 0;
        $permisos->desactivar_obra =  $request->desObras == "on" ? 1 : 0;
        $permisos->reactivar_obra =  $request->ReacObras == "on" ? 1 : 0;


        //Tipos de obras
        $permisos->tipo =  $request->tipos == "on" ? 1 : 0;
        $permisos->crear_tipo =  $request->crearTipos == "on" ? 1 : 0;
        $permisos->modificar_tipo =  $request->modTipos == "on" ? 1 : 0;
        $permisos->ver_botones_tipo =  $request->verTipos == "on" ? 1 : 0;
        $permisos->desactivar_tipo =  $request->desTipos == "on" ? 1 : 0;
        // $permisos->reactivar_tipo =  $request->ReacTipos == "on" ? 1 : 0;


        //Personal
        $permisos->personal =  $request->personal == "on" ? 1 : 0;
        $permisos->crear_personal =  $request->crear_personal == "on" ? 1 : 0;
        $permisos->modificar_personal =  $request->modificar_personal == "on" ? 1 : 0;
        $permisos->ver_botones_personal =  $request->ver_botones_personal == "on" ? 1 : 0;
        $permisos->desactivar_personal =  $request->desactivar_personal == "on" ? 1 : 0;
        $permisos->reactivar_personal =  $request->reactivar_personal == "on" ? 1 : 0;


        //Requisicion
        $permisos->requisicion =  $request->Req == "on" ? 1 : 0;
        $permisos->crear_requisicion =  $request->crearRequisicion == "on" ? 1 : 0;
        $permisos->modificar_requisicion =  $request->modRequisicion == "on" ? 1 : 0;
        $permisos->ver_botones_requisicion =  $request->verRequisicion == "on" ? 1 : 0;
        $permisos->anular_requisicion =  $request->anularRequisicion == "on" ? 1 : 0;
        // $permisos->reactivar_requisicion =  $request->reactivar_personal == "on" ? 1 : 0;


        //Solicitud
        $permisos->solicitud =  $request->HacerSolicitud == "on" ? 1 : 0;
        $permisos->crear_solicitud =  $request->crearSolicitud == "on" ? 1 : 0;
        $permisos->modificar_solicitud =  $request->modSolicitud == "on" ? 1 : 0;
        $permisos->ver_botones_solicitud =  $request->verSolicitud == "on" ? 1 : 0;
        $permisos->anular_solicitud =  $request->anularSolicitud == "on" ? 1 : 0;
        // $permisos->reactivar_requisicion =  $request->reactivar_personal == "on" ? 1 : 0;












        dd( $request->all() );
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

        //Realizamos la consulta a la base de datos
        $query = Permiso::select('id', 'nombre_permiso')->get();

        return datatables()->of($query)
        ->addColumn('btn','sistema.permisos.btnPermiso')
        ->rawColumns(['btn'])
        ->make(true);


    }
}
