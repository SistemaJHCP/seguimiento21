@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Modificar <small>permiso de usuario</small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item">Home</li>--}}
    <li class="breadcrumb-item">Permisos</li>
    <li class="breadcrumb-item active">Inicio</li>
    <img src="{{url('imagen/bandera_vzla.png') }}" width="30" height="20" alt="Sistema de Venezuela" style="margin-left: 10px; margin-top:4px;">
@endsection

@section('contenedor')
<div class="row">
    <div class="col-md-5">
    <form action="{{ route('permisos.modificar', $id) }}" method="post">
    @csrf
        <div class="card card-info card-outline">
            <div class="card-body">
                <div class="form-group">
                    <label for="">Nombre del permiso</label>
                    <input type="text" name="nombrePermiso" id="nombrePermiso" placeholder="Ingrese el nombre del permiso a crear" value="{{ $permisos->nombre_permiso }}" class="form-control" maxlength="60" required>

                    <br><input type="submit" value="Modificar permisos" class="btn btn-info"> <a href="{{ route('permisos.index') }}"><button type="button" class="btn btn-info float-right"><i class="fas fa-arrow-left"></i> Regresar</button></a>
                </div>
            </div>
        </div>

        <div class="card card-info card-outline">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Maestro</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input"  name="maestro" id="maestro" autocomplete="off" {!! $permisos->maestro_btn == 1 ? ' checked' : "" !!}>
                            <label class="custom-control-label" for="maestro" id="msjMaestro"></label>
                        </div>
                        <label>Control de obra</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input"  name="obra" id="obra" autocomplete="off" {!! $permisos->control_de_obras_btn == 1 ? ' checked' : "" !!}>
                            <label class="custom-control-label" for="obra" id="msjObra"></label>
                        </div>
                        <label>Configuración</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input"  name="configuracion" id="configuracion" autocomplete="off" {!! $permisos->configuracion_btn == 1 ? ' checked' : "" !!}>
                            <label class="custom-control-label" for="configuracion" id="msjConfiguracion"></label>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                        <label>Requisición</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input"  name="requisicion" id="requisicion" autocomplete="off" {!! $permisos->requisicion == 1 ? ' checked' : "" !!}>
                            <label class="custom-control-label" for="requisicion" id="msjRequisicion"></label>
                        </div>
                        <label>Solicitud</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input"  name="solicitud" id="solicitud" autocomplete="off" {!! $permisos->solicitud == 1 ? ' checked' : "" !!}>
                            <label class="custom-control-label" for="solicitud" id="msjSolicitud"></label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Solicitud de pago</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input"  name="pago" id="pago" autocomplete="off" {!! $permisos->solicitud_pago == 1 ? ' checked' : "" !!}>
                            <label class="custom-control-label" for="pago" id="msjPago"></label>
                        </div>
                        <label>Cuentas por pagar</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input"  name="cuentasx" id="cuentasx" autocomplete="off" {!! $permisos->cuentas_por_pagar_btn == 1 ? ' checked' : "" !!}>
                            <label class="custom-control-label" for="cuentasx" id="mjsCuentasx"></label>
                        </div>
                    </div>
                  </div>
            </div>
        </div>


    </div>
    <div class="col-md-7">

        <div class="accordion" id="accordionExample">
            {{-- <div class="card">
              <div class="card-header bg-info" id="headingOne">
                <h2 class="mb-0">
                  <button class="btn btn-link btn-block text-left" style="color:white;" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Botones a mostrar
                  </button>
                </h2>
              </div>

              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">

                </div>
              </div>
            </div> --}}
            <div class="card" id="opcionesMaestro" style="{!! $permisos->maestro_btn != 1 ? ' display:none' : "" !!}">
              <div class="card-header bg-info" id="headingTwo">
                <h2 class="mb-0">
                  <button class="btn btn-link btn-block text-left collapsed" style="color:white;" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Maestro
                  </button>
                </h2>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="row bg-info" style="padding: 3px;"><div>Suministro</div></div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>suministros</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="sum" id="sum" autocomplete="off" {!! $permisos->suministros == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="sum" id="msjSum"></label>
                            </div>
                            <label>Crear suministros</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearSum" id="crearSum" autocomplete="off" {!! $permisos->crear_suministros == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="crearSum" id="msjcrearSum"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar suministros</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="modSum" id="modSum" autocomplete="off" {!! $permisos->modificar_suministros == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="modSum" id="msjmodSum"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verSum" id="verSum" autocomplete="off" {!! $permisos->ver_botones_suministros == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="verSum" id="msjverSum"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar suministros</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="desSum" id="desSum" autocomplete="off" {!! $permisos->desactivar_suministros == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="desSum" id="msjdesSum"></label>
                            </div>
                            <label>Reactivar suministros</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="reacSum" id="reacSum" autocomplete="off" {!! $permisos->reactivar_suministros == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="reacSum" id="msjreacSum"></label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row bg-info" style="padding: 3px;"><div>Proveedores</div></div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>proveedores</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="prov" id="prov" autocomplete="off" {!! $permisos->proveedores == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="prov" id="msjProv"></label>
                            </div>
                            <label>Crear proveedores</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearProv" id="crearProv" autocomplete="off" {!! $permisos->crear_proveedores == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="crearProv" id="msjcrearProv"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar proveedores</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="modProv" id="modProv" autocomplete="off" {!! $permisos->modificar_proveedores == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="modProv" id="msjmodProv"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verProv" id="verProv" autocomplete="off" {!! $permisos->ver_botones_proveedores == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="verProv" id="msjverProv"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar proveedores</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="desProv" id="desProv" autocomplete="off" {!! $permisos->desactivar_proveedores == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="desProv" id="msjdesProv"></label>
                            </div>
                            <label>Reactivar proveedores</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="reacProv" id="reacProv" autocomplete="off" {!! $permisos->reactivar_proveedores == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="reacProv" id="msjreacProv"></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-4">
                            <label>Banco</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="banco" id="banco" autocomplete="off" {!! $permisos->banco == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="banco" id="msjbanco"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Cargar datos bancarios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="cargarBancos" id="cargarBancos" autocomplete="off" {!! $permisos->crear_banco == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="cargarBancos" id="msjcargarBancos"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Des. datos bancarios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="desactivarBancos" id="desactivarBancos" autocomplete="off" {!! $permisos->desactivar_banco == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="desactivarBancos" id="msjdesactivarBancos"></label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row bg-info" style="padding: 3px;"><div>Clientes</div></div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Clientes</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="cli" id="cli" autocomplete="off" {!! $permisos->cliente == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="cli" id="msjCli"></label>
                            </div>
                            <label>Crear clientes</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearCli" id="crearCli" autocomplete="off" {!! $permisos->crear_cliente == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="crearCli" id="msjcrearCli"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar clientes</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="modCli" id="modCli" autocomplete="off" {!! $permisos->modificar_cliente == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="modCli" id="msjmodCli"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verCli" id="verCli" autocomplete="off" {!! $permisos->ver_botones_cliente == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="verCli" id="msjverCli"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar clientes</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="desCli" id="desCli" autocomplete="off" {!! $permisos->desactivar_cliente == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="desCli" id="msjdesCli"></label>
                            </div>
                            <label>Reactivar clientes</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="reacCli" id="reacCli" autocomplete="off" {!! $permisos->reactivar_cliente == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="reacCli" id="msjreacCli"></label>
                            </div>
                        </div>
                    </div> <!-- END -->

                    <br>
                    <div class="row bg-info" style="padding: 3px;"><div>Materiales</div></div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Materiales</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="mate" id="mate" autocomplete="off" {!! $permisos->materiales == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="mate" id="msjMate"></label>
                            </div>
                            <label>Crear materiales</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearMate" id="crearMate" autocomplete="off" {!! $permisos->crear_materiales == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="crearMate" id="msjcrearMate"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verMate" id="verMate" autocomplete="off" {!! $permisos->ver_botones_materiales == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="verMate" id="msjverMate"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar materiales</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="desMate" id="desMate" autocomplete="off" {!! $permisos->desactivar_materiales == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="desMate" id="msjdesMate"></label>
                            </div>
                        </div>
                    </div> <!-- END -->

                    <br>
                    <div class="row bg-info" style="padding: 3px;"><div>Servicio</div></div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Servicio</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="serv" id="serv" autocomplete="off" {!! $permisos->servicio == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="serv" id="msjServ"></label>
                            </div>
                            <label>Crear servicios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearServ" id="crearServ" autocomplete="off" {!! $permisos->crear_servicio == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="crearServ" id="msjcrearServ"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verServ" id="verServ" autocomplete="off" {!! $permisos->ver_botones_servicio == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="verServ" id="msjverServ"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar servicios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="desServ" id="desServ" autocomplete="off" {!! $permisos->desactivar_servicio == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="desServ" id="msjdesServ"></label>
                            </div>
                        </div>
                    </div> <!-- END -->

                    <br>
                    <div class="row bg-info" style="padding: 3px;"><div>Viáticos</div></div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Viáticos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="viat" id="viat" autocomplete="off" {!! $permisos->viatico == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="viat" id="msjViat"></label>
                            </div>
                            <label>Crear viáticos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearViat" id="crearViat" autocomplete="off" {!! $permisos->crear_viatico == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="crearViat" id="msjcrearViat"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verViat" id="verViat" autocomplete="off" {!! $permisos->ver_botones_viatico == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="verViat" id="msjverViat"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar viáticos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="desViat" id="desViat" autocomplete="off" {!! $permisos->desactivar_viatico == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="desViat" id="msjdesViat"></label>
                            </div>
                        </div>
                    </div> <!-- END -->

                    <br>
                    <div class="row bg-info" style="padding: 3px;"><div>Nómina</div></div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nómina</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="hacerNomina" id="hacerNomina" autocomplete="off" {!! $permisos->nomina == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="hacerNomina" id="msjHacerNomina"></label>
                            </div>
                            <label>Crear nómina</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearNomina" id="crearNomina" autocomplete="off" {!! $permisos->crear_nomina == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="crearNomina" id="msjcrearNomina"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar nómina</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="modNomina" id="modNomina" autocomplete="off" {!! $permisos->modificar_nomina == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="modNomina" id="msjmodNomina"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verNomina" id="verNomina" autocomplete="off" {!! $permisos->ver_boton_nomina == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="verNomina" id="msjverNomina"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar nómina</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="desNomina" id="desNomina" autocomplete="off" {!! $permisos->desactivar_nomina == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="desNomina" id="msjdesNomina"></label>
                            </div>
                            <label>Reactivar nómina</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="reacNomina" id="reacNomina" autocomplete="off" {!! $permisos->reactivar_nomina == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="reacNomina" id="msjreacNomina"></label>
                            </div>
                        </div>
                    </div> <!-- END -->

                    <br>
                    <div class="row bg-info" style="padding: 3px;"><div>Maestro PTC</div></div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Maestro PTC</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="master" id="master" autocomplete="off" {!! $permisos->ptc == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="master" id="msjMaster"></label>
                            </div>
                            <label>Crear PTC</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearMaster" id="crearMaster" autocomplete="off" {!! $permisos->crear_ptc == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="crearMaster" id="msjCrearMaster"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar PTC</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="modMaster" id="modMaster" autocomplete="off" {!! $permisos->modificar_ptc == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="modMaster" id="msjModMaster"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verMaster" id="verMaster" autocomplete="off" {!! $permisos->ver_botones_ptc == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="verMaster" id="msjVerMaster"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar PTC</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="desMaster" id="desMaster" autocomplete="off" {!! $permisos->desactivar_ptc == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="desMaster" id="msjDesMaster"></label>
                            </div>
                            <label>Reactivar PTC</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="ReacMaster" id="ReacMaster" autocomplete="off" {!! $permisos->reactivar_ptc == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="ReacMaster" id="msjReacMaster"></label>
                            </div>
                        </div>
                    </div> <!-- END -->


                </div>
              </div>
            </div>
            <div class="card" id="opcionesObras" style=" {!! $permisos->control_de_obras_btn!= 1 ? ' display:none' : "" !!}">
              <div class="card-header bg-info" id="controlObras">
                <h2 class="mb-0">
                  <button class="btn btn-link btn-block text-left collapsed" style="color:white;" type="button" data-toggle="collapse" data-target="#r-controlObras" aria-expanded="false" aria-controls="r-controlObras">
                    Control de obra
                  </button>
                </h2>
              </div>
              <div id="r-controlObras" class="collapse" aria-labelledby="controlObras" data-parent="#accordionExample">
                <div class="card-body">

                    <div class="row bg-info" style="padding: 3px;"><div>Obras</div></div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Obras</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="obras" id="obras" autocomplete="off" {!! $permisos->obra == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="obras" id="msjObras"></label>
                            </div>
                            <label>Crear obras</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearObras" id="crearObras" autocomplete="off" {!! $permisos->crear_obra == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="crearObras" id="msjCrearObras"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar obras</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="modObras" id="modObras" autocomplete="off" {!! $permisos->modificar_obra == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="modObras" id="msjModObras"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verObras" id="verObras" autocomplete="off" {!! $permisos->ver_botones_obra == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="verObras" id="msjVerObras"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar obras</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="desObras" id="desObras" autocomplete="off" {!! $permisos->desactivar_obra == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="desObras" id="msjDesObras"></label>
                            </div>
                            <label>Reactivar obras</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="ReacObras" id="ReacObras" autocomplete="off" {!! $permisos->reactivar_obra == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="ReacObras" id="msjReacObras"></label>
                            </div>
                        </div>
                    </div> <!-- END -->

                    <br>
                    <div class="row bg-info" style="padding: 3px;"><div>Tipos de obras</div></div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Tipos de obras</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="tipos" id="tipos" autocomplete="off" {!! $permisos->tipo == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="tipos" id="msjTipos"></label>
                            </div>
                            <label>Crear tipos de obras</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearTipos" id="crearTipos" autocomplete="off" {!! $permisos->crear_tipo == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="crearTipos" id="msjCrearTipos"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar tipos de obras</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="modTipos" id="modTipos" autocomplete="off" {!! $permisos->modificar_tipo == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="modTipos" id="msjModTipos"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verTipos" id="verTipos" autocomplete="off" {!! $permisos->ver_botones_tipo == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="verTipos" id="msjVerTipos"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar tipos de obras</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="desTipos" id="desTipos" autocomplete="off" {!! $permisos->desactivar_tipo == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="desTipos" id="msjDesTipos"></label>
                            </div>
                            {{-- <label>Reactivar tipos de obras</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="ReacTipos" id="ReacTipos" autocomplete="off">
                                <label class="custom-control-label" for="ReacTipos" id="msjReacTipos"></label>
                            </div> --}}
                        </div>
                    </div> <!-- END -->

                    <br>
                    <div class="row bg-info" style="padding: 3px;"><div>Personal</div></div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Personal</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="personal" id="personal" autocomplete="off" {!! $permisos->personal == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="personal" id="msj-personal"></label>
                            </div>
                            <label>Crear personal</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearPersonal" id="crearPersonal" autocomplete="off" {!! $permisos->crear_personal == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="crearPersonal" id="msjCrearPersonal"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar personal</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="modPersonal" id="modPersonal" autocomplete="off" {!! $permisos->modificar_personal == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="modPersonal" id="msjModPersonal"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verPersonal" id="verPersonal" autocomplete="off" {!! $permisos->ver_botones_personal == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="verPersonal" id="msjVerPersonal"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar personal</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="desPersonal" id="desPersonal" autocomplete="off" {!! $permisos->desactivar_personal == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="desPersonal" id="msjDesPersonal"></label>
                            </div>
                            <label>Reactivar personal</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="reacPersonal" id="reacPersonal" autocomplete="off" {!! $permisos->reactivar_personal == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="reacPersonal" id="msjReacPersonal"></label>
                            </div>
                        </div>
                    </div> <!-- END -->
                </div>
              </div>
            </div>
            <div class="card" id="opcionesRequisicion" style="{!! $permisos->requisicion != 1 ? 'display:none' : "" !!}">
                <div class="card-header bg-info" id="requisicion">
                  <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" style="color:white;" type="button" data-toggle="collapse" data-target="#collapseRequisicion" aria-expanded="false" aria-controls="collapseRequisicion">
                      Requisición
                    </button>
                  </h2>
                </div>
                <div id="collapseRequisicion" class="collapse" aria-labelledby="requisicion" data-parent="#accordionExample">
                  <div class="card-body">
                    {{-- <br> --}}
                    <div class="row">
                        <div class="col-md-4">
                            <label>Crear requisición</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearRequisicion" id="crearRequisicion" autocomplete="off" {!! $permisos->crear_requisicion == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="crearRequisicion" id="msjCrearRequisicion"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verRequisicion" id="verRequisicion" autocomplete="off" {!! $permisos->ver_botones_requisicion == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="verRequisicion" id="msjVerRequisicion"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar requisición</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="modRequisicion" id="modRequisicion" autocomplete="off" {!! $permisos->modificar_requisicion == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="modRequisicion" id="msjModRequisicion"></label>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <label>Anular requisición</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="anularRequisicion" id="anularRequisicion" autocomplete="off" {!! $permisos->anular_requisicion == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="anularRequisicion" id="msjanularRequisicion"></label>
                            </div>
                        </div>
                    </div> <!-- END -->
                  </div>
                </div>
            </div>
            <div class="card" id="opcionesSolicitud" style="{!! $permisos->solicitud != 1 ? 'display:none' : "" !!}">
                <div class="card-header bg-info" id="solicitud">
                  <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" style="color:white;" type="button" data-toggle="collapse" data-target="#collapseSolicitud1" aria-expanded="false" aria-controls="collapseSolicitud1">
                      Solicitud
                    </button>
                  </h2>
                </div>
                <div id="collapseSolicitud1" class="collapse" aria-labelledby="solicitud" data-parent="#accordionExample">
                  <div class="card-body">
                    {{-- <br> --}}
                    <div class="row">
                        <div class="col-md-4">
                            <label>Crear solicitud</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearSolicitud" id="crearSolicitud" autocomplete="off" {!! $permisos->crear_solicitud == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="crearSolicitud" id="msjCrearSolicitud"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verSolicitud" id="verSolicitud" autocomplete="off" {!! $permisos->ver_botones_solicitud == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="verSolicitud" id="msjVerSolicitud"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar solicitud</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="modSolicitud" id="modSolicitud" autocomplete="off" {!! $permisos->modificar_solicitud == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="modSolicitud" id="msjModSolicitud"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Anular solicitud</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="anularSolicitud" id="anularSolicitud" autocomplete="off" {!! $permisos->anular_solicitud == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="anularSolicitud" id="msjAnularSolicitud"></label>
                            </div>
                        </div>
                    </div> <!-- END -->
                    <br>
                    <div class="row bg-info">

                        <div class="col-md-4">
                            <label>Mostrar boton Materiales</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="btnMateriales" id="btnMateriales" autocomplete="off" {!! $permisos->material_solicitud_opcion == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="btnMateriales" id="msjbtnMateriales"></label>
                            </div>
                            <label>Mostrar boton Nómina</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="btnNomina" id="btnNomina" autocomplete="off" {!! $permisos->nomina_solicitud_opcion == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="btnNomina" id="msjbtnNomina"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Mostrar boton Servicios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="btnServicios" id="btnServicios" autocomplete="off" {!! $permisos->servicio_solicitud_opcion == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="btnServicios" id="msjbtnServicios"></label>
                            </div>
                            <label>Mostrar boton Caja Chica</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="brnCajaCh" id="brnCajaCh" autocomplete="off" disabled>
                                <label class="custom-control-label" for="brnCajaCh" id="msjbrnCajaCh"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Mostrar boton Viático</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="btnViatico" id="btnViatico" autocomplete="off" {!! $permisos->viatico_solicitud_opcion == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="btnViatico" id="msjbtnViatico"></label>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="card" id="opcionesPago" style="{!! $permisos->solicitud_pago != 1 ? 'display:none' : "" !!}">
                <div class="card-header bg-info" id="pago">
                  <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" style="color:white;" type="button" data-toggle="collapse" data-target="#solicitud-pago" aria-expanded="false" aria-controls="solicitud-pago">
                      Solicitud de pago
                    </button>
                  </h2>
                </div>
                <div id="solicitud-pago" class="collapse" aria-labelledby="pago" data-parent="#accordionExample">
                  <div class="card-body">
                    {{-- <br> --}}
                    <div class="row">
                        <div class="col-md-4">
                            <label>Aprobar pago</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="aprobarPago" id="aprobarPago" autocomplete="off" {!! $permisos->aprobacion_solicitud_pago == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="aprobarPago" id="msjaprobarPago"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Ver pagos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verPago" id="verPago" autocomplete="off" {!! $permisos->ver_solicitud_pago == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="verPago" id="msjverPago"></label>
                            </div>
                        </div>
                        <div class="col-md-4">

                        </div>
                    </div> <!-- END -->
                  </div>
                </div>
            </div>

            <div class="card" id="opcionesCXP" style="{!! $permisos->cuentas_por_pagar_btn != 1 ? 'display:none' : "" !!}">
                <div class="card-header bg-info" id="pago">
                  <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" style="color:white;" type="button" data-toggle="collapse" data-target="#cuentas_x_pagar" aria-expanded="false" aria-controls="cuentas_x_pagar">
                      Cuentas por pagar
                    </button>
                  </h2>
                </div>
                <div id="cuentas_x_pagar" class="collapse" aria-labelledby="CXP" data-parent="#accordionExample">
                  <div class="card-body">
                    <div class="row bg-info" style="padding: 3px;"><div>Solicitud de cuentas</div></div><br>
                    {{-- <br> --}}
                    <div class="row">
                        <div class="col-md-4">
                            <label>Cuentas por pagar</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="CXP" id="CXP" autocomplete="off" {!! $permisos->compra_cuentas_x_pagar == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="CXP" id="msjCXP"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Aprobar CXP</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="aprobarCXP" id="aprobarCXP" autocomplete="off" {!! $permisos->aproRepro_compra_cuentas_x_pagar == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="aprobarCXP" id="msjaprobarCXP"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verCXP" id="verCXP" autocomplete="off" {!! $permisos->ver_botones_compra_cuentas_x_pagar == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="verCXP" id="msjverCXP"></label>
                            </div>
                        </div>
                    </div> <!-- END -->
                    <br>
                    <div class="row bg-info" style="padding: 3px;"><div>Conciliación</div></div><br>

                    <div class="row">
                        <div class="col-md-4">
                            <label>Conciliación</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="conciliacion" id="conciliacion" autocomplete="off" {!! $permisos->conciliacion == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="conciliacion" id="msjConciliacion"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Crear archivo XLSX</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearConciliacion" id="crearConciliacion" autocomplete="off" {!! $permisos->crear_conciliacion == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="crearConciliacion" id="msjCrearConciliacion"></label>
                            </div>
                        </div>
                        <div class="col-md-4">

                        </div>
                    </div> <!-- END -->

                  </div>
                </div>
            </div>
            <div class="card" id="opcionesConfiguracion" style=" {!! $permisos->configuracion_btn != 1 ? 'display:none' : "" !!}">
                <div class="card-header bg-info" id="Configuracion">
                  <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" style="color:white;" type="button" data-toggle="collapse" data-target="#collapseConfiguracion" aria-expanded="false" aria-controls="collapseConfiguracion">
                      Configuración
                    </button>
                  </h2>
                </div>
                <div id="collapseConfiguracion" class="collapse" aria-labelledby="Configuracion" data-parent="#accordionExample">
                  <div class="card-body">
                    <div class="row bg-info" style="padding: 3px;"><div>Creación de usuarios</div></div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Usuarios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="ConfUsuario" id="ConfUsuario" autocomplete="off" {!! $permisos->usuario == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="ConfUsuario" id="msjConfUsuario"></label>
                            </div>
                            <label>Crear usuarios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearConfUsuario" id="crearConfUsuario" autocomplete="off" {!! $permisos->crear_usuario == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="crearConfUsuario" id="msjcrearConfUsuario"></label>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <label>Modificar usuarios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="modConfUsuario" id="modConfUsuario" autocomplete="off" {!! $permisos->modificar_usuario == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="modConfUsuario" id="msjModConfUsuario"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verConfUsuario" id="verConfUsuario" autocomplete="off" {!! $permisos->ver_botones_usuario == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="verConfUsuario" id="msjVerConfUsuario"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Deshabilitar usuarios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="desConfUsuario" id="desConfUsuario" autocomplete="off" {!! $permisos->desactivar_usuario == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="desConfUsuario" id="msjDesConfUsuario"></label>
                            </div>
                            <label>Reactivar usuarios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="ReacConfUsuario" id="ReacConfUsuario" autocomplete="off" {!! $permisos->reactivar_usuario == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="ReacConfUsuario" id="msjReacConfUsuario"></label>
                            </div>
                        </div>
                    </div> <!-- END -->
                    <br>
                    <div class="row bg-info" style="padding: 3px;"><div>Acceso a crear permisos</div></div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Permisos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="ConfPermisos" id="ConfPermisos" autocomplete="off" {!! $permisos->permisos_btn == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="ConfPermisos" id="msjConfPermisos"></label>
                            </div>
                            <label>Crear permisos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearConfPermisos" id="crearConfPermisos" autocomplete="off" {!! $permisos->crear_permisos == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="crearConfPermisos" id="msjcrearConfPermisos"></label>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <label>Modificar permisos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="modConfPermisos" id="modConfPermisos" autocomplete="off" {!! $permisos->modificar_permisos == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="modConfPermisos" id="msjModConfPermisos"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verConfPermisos" id="verConfPermisos" autocomplete="off" {!! $permisos->ver_boton_permisos == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="verConfPermisos" id="msjVerConfPermisos"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Deshabilitar permisos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="desConfPermisos" id="desConfPermisos" autocomplete="off" {!! $permisos->desactivar_permisos == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="desConfPermisos" id="msjDesConfPermisos"></label>
                            </div>
                            <label>Reactivar permisos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="ReacConfPermisos" id="ReacConfPermisos" autocomplete="off" {!! $permisos->reactivar_permisos == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="ReacConfPermisos" id="msjReacConfPermisos"></label>
                            </div>
                        </div>
                    </div> <!-- END -->
                    <br>
                    <div class="row bg-info" style="padding: 3px;"><div>Resultados estadisticos</div></div><br>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Consultar estadistica</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="estadistica" id="estadistica" autocomplete="off" {!! $permisos->estadistica == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="estadistica" id="msjestadistica"></label>
                            </div>
                        </div>
                    </div> <!-- END -->
                    <br>
                    <div class="row bg-info" style="padding: 3px;"><div>Bitácora</div></div><br>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Consultar bitácora</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="bitacora" id="bitacora" autocomplete="off" {!! $permisos->bitacora == 1 ? ' checked' : "" !!}>
                                <label class="custom-control-label" for="bitacora" id="msjbitacora"></label>
                            </div>
                        </div>
                    </div> <!-- END -->
                  </div>
                </div>
            </div>

        </div>
    </div>
    </form>
</div>
@endsection
@section('js')
<script src="{{ asset("js/permisos/crear-permiso.js") }}"></script>
@endsection
@section('css')

@endsection
