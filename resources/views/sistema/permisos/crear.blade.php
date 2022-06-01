@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Crear <small>permiso de usuario</small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item">Home</li>--}}
    <li class="breadcrumb-item">Permisos</li>
    <li class="breadcrumb-item active">Inicio</li>
    <img src="{{url('imagen/bandera-panama.png') }}" width="30" height="20" alt="Sistema de Venezuela" style="margin-left: 10px; margin-top:4px;">
@endsection

@section('contenedor')
<div class="row">
    <div class="col-md-5">
    <form action="{{ route('permisos.cargar') }}" method="post">
    @csrf
        <div class="card card-info card-outline">
            <div class="card-body">
                <div class="form-group">
                    <label for="">Nombre del permiso</label>
                    <input type="text" name="nombrePermiso" id="nombrePermiso" placeholder="Ingrese el nombre del permiso a crear" class="form-control" maxlength="60" required autocomplete="off">

                    <br><input type="submit" id="cargarPermisos" value="Crear permisos" class="btn btn-info"> <a href="{{ route('permisos.index') }}"><button type="button" class="btn btn-info float-right"><i class="fas fa-arrow-left"></i> Regresar</button></a>
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
                                <input type="checkbox" class="custom-control-input"  name="maestro" id="maestro" autocomplete="off">
                                <label class="custom-control-label" for="maestro" id="msjMaestro"></label>
                            </div>
                            <label>Requisición</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="requisicion" id="requisicion" autocomplete="off">
                                <label class="custom-control-label" for="requisicion" id="msjRequisicion"></label>
                            </div>
                            <label>Cuentas por pagar</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="cuentasx" id="cuentasx" autocomplete="off">
                                <label class="custom-control-label" for="cuentasx" id="mjsCuentasx"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Bancos</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input"  name="Bancos" id="Bancos" autocomplete="off">
                            <label class="custom-control-label" for="Bancos" id="msjBancos"></label>
                        </div>
                        <label>Solicitud</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input"  name="solicitud" id="solicitud" autocomplete="off">
                            <label class="custom-control-label" for="solicitud" id="msjSolicitud"></label>
                        </div>
                        <label>Configuración</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input"  name="configuracion" id="configuracion" autocomplete="off">
                            <label class="custom-control-label" for="configuracion" id="msjConfiguracion"></label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Control de obra</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input"  name="obra" id="obra" autocomplete="off">
                            <label class="custom-control-label" for="obra" id="msjObra"></label>
                        </div>

                        <label>Solicitud de pago</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input"  name="pago" id="pago" autocomplete="off">
                            <label class="custom-control-label" for="pago" id="msjPago"></label>
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
            <div class="card" id="opcionesMaestro" style="display:none">
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
                                <input type="checkbox" class="custom-control-input"  name="sum" id="sum" autocomplete="off">
                                <label class="custom-control-label" for="sum" id="msjSum"></label>
                            </div>
                            <label>Crear suministros</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearSum" id="crearSum" autocomplete="off">
                                <label class="custom-control-label" for="crearSum" id="msjcrearSum"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar suministros</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="modSum" id="modSum" autocomplete="off">
                                <label class="custom-control-label" for="modSum" id="msjmodSum"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verSum" id="verSum" autocomplete="off">
                                <label class="custom-control-label" for="verSum" id="msjverSum"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar suministros</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="desSum" id="desSum" autocomplete="off">
                                <label class="custom-control-label" for="desSum" id="msjdesSum"></label>
                            </div>
                            <label>Reactivar suministros</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="reacSum" id="reacSum" autocomplete="off">
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
                                <input type="checkbox" class="custom-control-input"  name="prov" id="prov" autocomplete="off">
                                <label class="custom-control-label" for="prov" id="msjProv"></label>
                            </div>
                            <label>Crear proveedores</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearProv" id="crearProv" autocomplete="off">
                                <label class="custom-control-label" for="crearProv" id="msjcrearProv"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar proveedores</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="modProv" id="modProv" autocomplete="off">
                                <label class="custom-control-label" for="modProv" id="msjmodProv"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verProv" id="verProv" autocomplete="off">
                                <label class="custom-control-label" for="verProv" id="msjverProv"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar proveedores</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="desProv" id="desProv" autocomplete="off">
                                <label class="custom-control-label" for="desProv" id="msjdesProv"></label>
                            </div>
                            <label>Reactivar proveedores</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="reacProv" id="reacProv" autocomplete="off">
                                <label class="custom-control-label" for="reacProv" id="msjreacProv"></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-4">
                            <label>Banco</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="banco" id="banco" autocomplete="off">
                                <label class="custom-control-label" for="banco" id="msjbanco"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Cargar datos bancarios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="cargarBancos" id="cargarBancos" autocomplete="off">
                                <label class="custom-control-label" for="cargarBancos" id="msjcargarBancos"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Des. datos bancarios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="desactivarBancos" id="desactivarBancos" autocomplete="off">
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
                                <input type="checkbox" class="custom-control-input"  name="cli" id="cli" autocomplete="off">
                                <label class="custom-control-label" for="cli" id="msjCli"></label>
                            </div>
                            <label>Crear clientes</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearCli" id="crearCli" autocomplete="off">
                                <label class="custom-control-label" for="crearCli" id="msjcrearCli"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar clientes</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="modCli" id="modCli" autocomplete="off">
                                <label class="custom-control-label" for="modCli" id="msjmodCli"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verCli" id="verCli" autocomplete="off">
                                <label class="custom-control-label" for="verCli" id="msjverCli"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar clientes</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="desCli" id="desCli" autocomplete="off">
                                <label class="custom-control-label" for="desCli" id="msjdesCli"></label>
                            </div>
                            <label>Reactivar clientes</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="reacCli" id="reacCli" autocomplete="off">
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
                                <input type="checkbox" class="custom-control-input"  name="mate" id="mate" autocomplete="off">
                                <label class="custom-control-label" for="mate" id="msjMate"></label>
                            </div>
                            <label>Crear materiales</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearMate" id="crearMate" autocomplete="off">
                                <label class="custom-control-label" for="crearMate" id="msjcrearMate"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            {{-- <label>Modificar materiales ****</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="modMate" id="modMate" autocomplete="off" disabled>
                                <label class="custom-control-label" for="modMate" id="msjmodMate"></label>
                            </div> --}}
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verMate" id="verMate" autocomplete="off">
                                <label class="custom-control-label" for="verMate" id="msjverMate"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar materiales</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="desMate" id="desMate" autocomplete="off">
                                <label class="custom-control-label" for="desMate" id="msjdesMate"></label>
                            </div>
                            {{-- <label>Reactivar materiales ****</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="reacMate" id="reacMate" autocomplete="off" disabled>
                                <label class="custom-control-label" for="reacMate" id="msjreacMate"></label>
                            </div> --}}
                        </div>
                    </div> <!-- END -->

                    <br>
                    <div class="row bg-info" style="padding: 3px;"><div>Servicio</div></div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Servicio</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="serv" id="serv" autocomplete="off">
                                <label class="custom-control-label" for="serv" id="msjServ"></label>
                            </div>
                            <label>Crear servicios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearServ" id="crearServ" autocomplete="off">
                                <label class="custom-control-label" for="crearServ" id="msjcrearServ"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            {{-- <label>Modificar servicios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="modServ" id="modServ" autocomplete="off">
                                <label class="custom-control-label" for="modServ" id="msjmodServ"></label>
                            </div> --}}
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verServ" id="verServ" autocomplete="off">
                                <label class="custom-control-label" for="verServ" id="msjverServ"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar servicios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="desServ" id="desServ" autocomplete="off">
                                <label class="custom-control-label" for="desServ" id="msjdesServ"></label>
                            </div>
                            {{-- <label>Reactivar servicios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="reacServ" id="reacServ" autocomplete="off">
                                <label class="custom-control-label" for="reacServ" id="msjreacServ"></label>
                            </div> --}}
                        </div>
                    </div> <!-- END -->

                    <br>
                    <div class="row bg-info" style="padding: 3px;"><div>Viáticos</div></div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Viáticos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="viat" id="viat" autocomplete="off">
                                <label class="custom-control-label" for="viat" id="msjViat"></label>
                            </div>
                            <label>Crear viáticos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearViat" id="crearViat" autocomplete="off">
                                <label class="custom-control-label" for="crearViat" id="msjcrearViat"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            {{-- <label>Modificar viáticos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="modViat" id="modViat" autocomplete="off">
                                <label class="custom-control-label" for="modViat" id="msjmodViat"></label>
                            </div> --}}
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verViat" id="verViat" autocomplete="off">
                                <label class="custom-control-label" for="verViat" id="msjverViat"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar viáticos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="desViat" id="desViat" autocomplete="off">
                                <label class="custom-control-label" for="desViat" id="msjdesViat"></label>
                            </div>
                            {{-- <label>Reactivar viáticos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="reacViat" id="reacViat" autocomplete="off">
                                <label class="custom-control-label" for="reacViat" id="msjreacViat"></label>
                            </div> --}}
                        </div>
                    </div> <!-- END -->

                    <br>
                    <div class="row bg-info" style="padding: 3px;"><div>Nómina</div></div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nómina</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="hacerNomina" id="hacerNomina" autocomplete="off">
                                <label class="custom-control-label" for="hacerNomina" id="msjHacerNomina"></label>
                            </div>
                            <label>Crear nómina</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearNomina" id="crearNomina" autocomplete="off">
                                <label class="custom-control-label" for="crearNomina" id="msjcrearNomina"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar nómina</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="modNomina" id="modNomina" autocomplete="off">
                                <label class="custom-control-label" for="modNomina" id="msjmodNomina"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verNomina" id="verNomina" autocomplete="off">
                                <label class="custom-control-label" for="verNomina" id="msjverNomina"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar nómina</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="desNomina" id="desNomina" autocomplete="off">
                                <label class="custom-control-label" for="desNomina" id="msjdesNomina"></label>
                            </div>
                            <label>Reactivar nómina</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="reacNomina" id="reacNomina" autocomplete="off">
                                <label class="custom-control-label" for="reacNomina" id="msjreacNomina"></label>
                            </div>
                        </div>
                    </div> <!-- END -->

                    {{-- <br>
                    <div class="row bg-info" style="padding: 3px;"><div>Usuarios</div></div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Usuarios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="usua" id="usua" autocomplete="off">
                                <label class="custom-control-label" for="usua" id="msjUsua"></label>
                            </div>
                            <label>Crear usuarios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearUsuario" id="crearUsuario" autocomplete="off">
                                <label class="custom-control-label" for="crearUsuario" id="msjcrearUsuario"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar usuarios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="modUsuario" id="modUsuario" autocomplete="off">
                                <label class="custom-control-label" for="modUsuario" id="msjmodUsuario"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verUsuario" id="verUsuario" autocomplete="off">
                                <label class="custom-control-label" for="verUsuario" id="msjverUsuario"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar usuarios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="desUsuario" id="desUsuario" autocomplete="off">
                                <label class="custom-control-label" for="desUsuario" id="msjdesUsuario"></label>
                            </div>
                            <label>Reactivar usuarios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="reacUsuario" id="reacUsuario" autocomplete="off">
                                <label class="custom-control-label" for="reacUsuario" id="msjreacUsuario"></label>
                            </div>
                        </div>
                    </div> <!-- END --> --}}


                    {{-- <br>
                    <div class="row bg-info" style="padding: 3px;"><div>Permisos</div></div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Permisos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="perm" id="perm" autocomplete="off">
                                <label class="custom-control-label" for="perm" id="msjPerm"></label>
                            </div>
                            <label>Crear permisos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearPerm" id="crearPerm" autocomplete="off">
                                <label class="custom-control-label" for="crearPerm" id="msjcrearPerm"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar permisos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="modPerm" id="modPerm" autocomplete="off">
                                <label class="custom-control-label" for="modPerm" id="msjmodPerm"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verPerm" id="verPerm" autocomplete="off">
                                <label class="custom-control-label" for="verPerm" id="msjverPerm"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar permisos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="desPerm" id="desPerm" autocomplete="off">
                                <label class="custom-control-label" for="desPerm" id="msjdesPerm"></label>
                            </div>
                            <label>Reactivar permisos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="reacPerm" id="reacPerm" autocomplete="off">
                                <label class="custom-control-label" for="reacPerm" id="msjreacPerm"></label>
                            </div>
                        </div>
                    </div> <!-- END --> --}}

                    <br>
                    <div class="row bg-info" style="padding: 3px;"><div>Maestro PTC</div></div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Maestro PTC</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="master" id="master" autocomplete="off">
                                <label class="custom-control-label" for="master" id="msjMaster"></label>
                            </div>
                            <label>Crear PTC</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearMaster" id="crearMaster" autocomplete="off">
                                <label class="custom-control-label" for="crearMaster" id="msjCrearMaster"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar PTC</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="modMaster" id="modMaster" autocomplete="off">
                                <label class="custom-control-label" for="modMaster" id="msjModMaster"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verMaster" id="verMaster" autocomplete="off">
                                <label class="custom-control-label" for="verMaster" id="msjVerMaster"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar PTC</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="desMaster" id="desMaster" autocomplete="off">
                                <label class="custom-control-label" for="desMaster" id="msjDesMaster"></label>
                            </div>
                            <label>Reactivar PTC</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="ReacMaster" id="ReacMaster" autocomplete="off">
                                <label class="custom-control-label" for="ReacMaster" id="msjReacMaster"></label>
                            </div>
                        </div>
                    </div> <!-- END -->


                </div>
              </div>
            </div>

            <div class="card" id="opcionesBancos" style="display:none">
                <div class="card-header bg-info" id="headingTwo">
                  <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" style="color:white;" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Bancos
                    </button>
                  </h2>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                  <div class="card-body">

                    <div class="row bg-info" style="padding: 3px;"><div>Cargar bancos</div></div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Cargar bancos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="cargarBancoEmp" id="cargarBancoEmp" autocomplete="off">
                                <label class="custom-control-label" for="cargarBancoEmp" id="msjcargarBancoEmp"></label>
                            </div>
                            <label>Crear bancos empresa</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearBancoEmp" id="crearBancoEmp" autocomplete="off">
                                <label class="custom-control-label" for="crearBancoEmp" id="msjcrearBancoEmp"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modif. bancos empresa</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="modBancoEmp" id="modBancoEmp" autocomplete="off">
                                <label class="custom-control-label" for="modBancoEmp" id="msjmodBancoEmp"></label>
                            </div>
                            <label>Ver bancos empresa</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verBancoEmp" id="verBancoEmp" autocomplete="off">
                                <label class="custom-control-label" for="verBancoEmp" id="msjverBancoEmp"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar bancos empresa</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="desBancoEmp" id="desBancoEmp" autocomplete="off">
                                <label class="custom-control-label" for="desBancoEmp" id="msjdesBancoEmp"></label>
                            </div>
                        </div>
                    </div><br>

                      <div class="row bg-info" style="padding: 3px;"><div>Cuentas JHCP</div></div><br>
                      <div class="row">
                          <div class="col-md-4">
                              <label>Cuentas</label>
                              <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input"  name="CuentaEmp" id="CuentaEmp" autocomplete="off">
                                  <label class="custom-control-label" for="CuentaEmp" id="msjCuentaEmp"></label>
                              </div>
                              <label>Crear cuentas</label>
                              <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input"  name="crearCuentaEmp" id="crearCuentaEmp" autocomplete="off">
                                  <label class="custom-control-label" for="crearCuentaEmp" id="msjcrearCuentaEmp"></label>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <label>Modificar cuentas</label>
                              <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input"  name="modCuentaEmp" id="modCuentaEmp" autocomplete="off">
                                  <label class="custom-control-label" for="modCuentaEmp" id="msjmodCuentaEmp"></label>
                              </div>
                              <label>Ver botones</label>
                              <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input"  name="verCuentaEmp" id="verCuentaEmp" autocomplete="off">
                                  <label class="custom-control-label" for="verCuentaEmp" id="msjverCuentaEmp"></label>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <label>Desactivar cuentas</label>
                              <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input"  name="desCuentaEmp" id="desCuentaEmp" autocomplete="off">
                                  <label class="custom-control-label" for="desCuentaEmp" id="msjdesCuentaEmp"></label>
                              </div>
                          </div>
                      </div>
                      <br>
                      <div class="row bg-info" style="padding: 3px;"><div>Chequera</div></div><br>
                      <div class="row">
                          <div class="col-md-4">
                              <label>Chequera</label>
                              <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input"  name="chequera" id="chequera" autocomplete="off">
                                  <label class="custom-control-label" for="chequera" id="msjChequera"></label>
                              </div>
                              <label>Crear chequera</label>
                              <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input"  name="crearChequera" id="crearChequera" autocomplete="off">
                                  <label class="custom-control-label" for="crearChequera" id="msjcrearChequera"></label>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <label>Modificar chequera</label>
                              <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input"  name="modChequera" id="modChequera" autocomplete="off">
                                  <label class="custom-control-label" for="modChequera" id="msjmodChequera"></label>
                              </div>
                              <label>Ver botones</label>
                              <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input"  name="verChequera" id="verChequera" autocomplete="off">
                                  <label class="custom-control-label" for="verChequera" id="msjverChequera"></label>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <label>Desactivar chequera</label>
                              <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input"  name="desChequera" id="desChequera" autocomplete="off">
                                  <label class="custom-control-label" for="desChequera" id="msjdesChequera"></label>
                              </div>
                          </div>
                      </div>

                      <br>
                      <div class="row bg-info" style="padding: 3px;"><div>Cheque</div></div><br>
                      <div class="row">
                          <div class="col-md-4">
                              <label>Cheque</label>
                              <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input"  name="Cheque" id="Cheque" autocomplete="off">
                                  <label class="custom-control-label" for="Cheque" id="msjCheque"></label>
                              </div>
                              <label>Anular Cheque</label>
                              <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input"  name="anularCheque" id="anularCheque" autocomplete="off">
                                  <label class="custom-control-label" for="anularCheque" id="msjanularCheque"></label>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <label>Ver botones</label>
                              <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input"  name="verCheque" id="verCheque" autocomplete="off">
                                  <label class="custom-control-label" for="verCheque" id="msjverCheque"></label>
                              </div>
                          </div>
                          <div class="col-md-4">
                            <label>Crear Cheque</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearCheque" id="crearCheque" autocomplete="off">
                                <label class="custom-control-label" for="crearCheque" id="msjcrearCheque"></label>
                            </div>
                          </div>
                      </div> <!-- END -->


                  </div>
                </div>
            </div>


            <div class="card" id="opcionesObras" style="display:none">
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
                                <input type="checkbox" class="custom-control-input"  name="obras" id="obras" autocomplete="off">
                                <label class="custom-control-label" for="obras" id="msjObras"></label>
                            </div>
                            <label>Crear obras</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearObras" id="crearObras" autocomplete="off">
                                <label class="custom-control-label" for="crearObras" id="msjCrearObras"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar obras</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="modObras" id="modObras" autocomplete="off">
                                <label class="custom-control-label" for="modObras" id="msjModObras"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verObras" id="verObras" autocomplete="off">
                                <label class="custom-control-label" for="verObras" id="msjVerObras"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar obras</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="desObras" id="desObras" autocomplete="off">
                                <label class="custom-control-label" for="desObras" id="msjDesObras"></label>
                            </div>
                            <label>Reactivar obras</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="ReacObras" id="ReacObras" autocomplete="off">
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
                                <input type="checkbox" class="custom-control-input"  name="tipos" id="tipos" autocomplete="off">
                                <label class="custom-control-label" for="tipos" id="msjTipos"></label>
                            </div>
                            <label>Crear tipos de obras</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearTipos" id="crearTipos" autocomplete="off">
                                <label class="custom-control-label" for="crearTipos" id="msjCrearTipos"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar tipos de obras</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="modTipos" id="modTipos" autocomplete="off">
                                <label class="custom-control-label" for="modTipos" id="msjModTipos"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verTipos" id="verTipos" autocomplete="off">
                                <label class="custom-control-label" for="verTipos" id="msjVerTipos"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar tipos de obras</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="desTipos" id="desTipos" autocomplete="off">
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
                                <input type="checkbox" class="custom-control-input"  name="personal" id="personal" autocomplete="off">
                                <label class="custom-control-label" for="personal" id="msj-personal"></label>
                            </div>
                            <label>Crear personal</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearPersonal" id="crearPersonal" autocomplete="off">
                                <label class="custom-control-label" for="crearPersonal" id="msjCrearPersonal"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar personal</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="modPersonal" id="modPersonal" autocomplete="off">
                                <label class="custom-control-label" for="modPersonal" id="msjModPersonal"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verPersonal" id="verPersonal" autocomplete="off">
                                <label class="custom-control-label" for="verPersonal" id="msjVerPersonal"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar personal</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="desPersonal" id="desPersonal" autocomplete="off">
                                <label class="custom-control-label" for="desPersonal" id="msjDesPersonal"></label>
                            </div>
                            <label>Reactivar personal</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="reacPersonal" id="reacPersonal" autocomplete="off">
                                <label class="custom-control-label" for="reacPersonal" id="msjReacPersonal"></label>
                            </div>
                        </div>
                    </div> <!-- END -->
                </div>
              </div>
            </div>
            <div class="card" id="opcionesRequisicion" style="display:none">
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
                                <input type="checkbox" class="custom-control-input"  name="crearRequisicion" id="crearRequisicion" autocomplete="off">
                                <label class="custom-control-label" for="crearRequisicion" id="msjCrearRequisicion"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verRequisicion" id="verRequisicion" autocomplete="off">
                                <label class="custom-control-label" for="verRequisicion" id="msjVerRequisicion"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar requisición</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="modRequisicion" id="modRequisicion" autocomplete="off">
                                <label class="custom-control-label" for="modRequisicion" id="msjModRequisicion"></label>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <label>Anular requisición</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="anularRequisicion" id="anularRequisicion" autocomplete="off">
                                <label class="custom-control-label" for="anularRequisicion" id="msjanularRequisicion"></label>
                            </div>
                            {{-- <label>Reactivar requisición</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="ReacRequisición" id="ReacRequisición" autocomplete="off">
                                <label class="custom-control-label" for="ReacRequisición" id="msjReacRequisición"></label>
                            </div> --}}
                        </div>
                    </div> <!-- END -->
                  </div>
                </div>
            </div>
            <div class="card" id="opcionesSolicitud" style="display:none">
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
                                <input type="checkbox" class="custom-control-input"  name="crearSolicitud" id="crearSolicitud" autocomplete="off">
                                <label class="custom-control-label" for="crearSolicitud" id="msjCrearSolicitud"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verSolicitud" id="verSolicitud" autocomplete="off">
                                <label class="custom-control-label" for="verSolicitud" id="msjVerSolicitud"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar solicitud</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="modSolicitud" id="modSolicitud" autocomplete="off">
                                <label class="custom-control-label" for="modSolicitud" id="msjModSolicitud"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Anular solicitud</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="anularSolicitud" id="anularSolicitud" autocomplete="off">
                                <label class="custom-control-label" for="anularSolicitud" id="msjAnularSolicitud"></label>
                            </div>
                            {{-- <label>Reactivar solicitud</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="ReacSolicitud" id="ReacSolicitud" autocomplete="off">
                                <label class="custom-control-label" for="ReacSolicitud" id="msjReacSolicitud"></label>
                            </div> --}}
                        </div>
                    </div> <!-- END -->
                    <br>
                    <div class="row bg-info">

                        <div class="col-md-4">
                            <label>Mostrar boton Materiales</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="btnMateriales" id="btnMateriales" autocomplete="off">
                                <label class="custom-control-label" for="btnMateriales" id="msjbtnMateriales"></label>
                            </div>
                            <label>Mostrar boton Nómina</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="btnNomina" id="btnNomina" autocomplete="off">
                                <label class="custom-control-label" for="btnNomina" id="msjbtnNomina"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Mostrar boton Servicios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="btnServicios" id="btnServicios" autocomplete="off">
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
                                <input type="checkbox" class="custom-control-input"  name="btnViatico" id="btnViatico" autocomplete="off">
                                <label class="custom-control-label" for="btnViatico" id="msjbtnViatico"></label>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="card" id="opcionesPago" style="display:none">
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
                                <input type="checkbox" class="custom-control-input"  name="aprobarPago" id="aprobarPago" autocomplete="off">
                                <label class="custom-control-label" for="aprobarPago" id="msjaprobarPago"></label>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <label>Ver pagos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verPago" id="verPago" autocomplete="off">
                                <label class="custom-control-label" for="verPago" id="msjverPago"></label>
                            </div>
                        </div>
                        <div class="col-md-4">

                        </div>
                    </div> <!-- END -->
                  </div>
                </div>
            </div>

            <div class="card" id="opcionesCXP" style="display:none">
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
                                <input type="checkbox" class="custom-control-input"  name="CXP" id="CXP" autocomplete="off">
                                <label class="custom-control-label" for="CXP" id="msjCXP"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Aprobar CXP</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="aprobarCXP" id="aprobarCXP" autocomplete="off">
                                <label class="custom-control-label" for="aprobarCXP" id="msjaprobarCXP"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verCXP" id="verCXP" autocomplete="off">
                                <label class="custom-control-label" for="verCXP" id="msjverCXP"></label>
                            </div>
                            {{-- <label>Desactivar pago</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="desCXP" autocomplete="off">
                                <label class="custom-control-label" for="desCXP" id="msjDesCXP"></label>
                            </div> --}}
                        </div>
                    </div> <!-- END -->
                    <br>
                    <div class="row bg-info" style="padding: 3px;"><div>Conciliación</div></div><br>

                    <div class="row">
                        <div class="col-md-4">
                            <label>Conciliación</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="conciliacion" id="conciliacion" autocomplete="off">
                                <label class="custom-control-label" for="conciliacion" id="msjConciliacion"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Crear archivo XLSX</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearConciliacion" id="crearConciliacion" autocomplete="off">
                                <label class="custom-control-label" for="crearConciliacion" id="msjCrearConciliacion"></label>
                            </div>
                        </div>
                        <div class="col-md-4">

                        </div>
                    </div> <!-- END -->

                  </div>
                </div>
            </div>
            <div class="card" id="opcionesConfiguracion" style="display:none">
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
                                <input type="checkbox" class="custom-control-input"  name="ConfUsuario" id="ConfUsuario" autocomplete="off">
                                <label class="custom-control-label" for="ConfUsuario" id="msjConfUsuario"></label>
                            </div>
                            <label>Crear usuarios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearConfUsuario" id="crearConfUsuario" autocomplete="off">
                                <label class="custom-control-label" for="crearConfUsuario" id="msjcrearConfUsuario"></label>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <label>Modificar usuarios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="modConfUsuario" id="modConfUsuario" autocomplete="off">
                                <label class="custom-control-label" for="modConfUsuario" id="msjModConfUsuario"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verConfUsuario" id="verConfUsuario" autocomplete="off">
                                <label class="custom-control-label" for="verConfUsuario" id="msjVerConfUsuario"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Deshabilitar usuarios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="desConfUsuario" id="desConfUsuario" autocomplete="off">
                                <label class="custom-control-label" for="desConfUsuario" id="msjDesConfUsuario"></label>
                            </div>
                            <label>Reactivar usuarios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="ReacConfUsuario" id="ReacConfUsuario" autocomplete="off">
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
                                <input type="checkbox" class="custom-control-input"  name="ConfPermisos" id="ConfPermisos" autocomplete="off">
                                <label class="custom-control-label" for="ConfPermisos" id="msjConfPermisos"></label>
                            </div>
                            <label>Crear permisos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crearConfPermisos" id="crearConfPermisos" autocomplete="off">
                                <label class="custom-control-label" for="crearConfPermisos" id="msjcrearConfPermisos"></label>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <label>Modificar permisos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="modConfPermisos" id="modConfPermisos" autocomplete="off">
                                <label class="custom-control-label" for="modConfPermisos" id="msjModConfPermisos"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="verConfPermisos" id="verConfPermisos" autocomplete="off">
                                <label class="custom-control-label" for="verConfPermisos" id="msjVerConfPermisos"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Deshabilitar permisos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="desConfPermisos" id="desConfPermisos" autocomplete="off">
                                <label class="custom-control-label" for="desConfPermisos" id="msjDesConfPermisos"></label>
                            </div>
                            <label>Reactivar permisos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="ReacConfPermisos" id="ReacConfPermisos" autocomplete="off">
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
                                <input type="checkbox" class="custom-control-input"  name="estadistica" id="estadistica" autocomplete="off">
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
                                <input type="checkbox" class="custom-control-input"  name="bitacora" id="bitacora" autocomplete="off">
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
