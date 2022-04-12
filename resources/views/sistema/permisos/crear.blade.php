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
                    <input type="text" name="nombrePermiso" id="nombrePermiso" placeholder="Ingrese el nombre del permiso a crear" class="form-control">
                    <input type="submit" value="enviar">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        
        <div class="accordion" id="accordionExample">
            <div class="card">
              <div class="card-header bg-info" id="headingOne">
                <h2 class="mb-0">
                  <button class="btn btn-link btn-block text-left" style="color:white;" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Botones a mostrar
                  </button>
                </h2>
              </div>

              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Maestro</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input"  name="maestro" id="maestro" autocomplete="off">
                            <label class="custom-control-label" for="maestro" id="msjMaestro"></label>
                        </div>
                        <label>Control de obra</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input"  name="obra" id="obra" autocomplete="off">
                            <label class="custom-control-label" for="obra" id="msjObra"></label>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                        <label>Requisición</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input"  name="requisicion" id="requisicion" autocomplete="off">
                            <label class="custom-control-label" for="requisicion" id="msjRequisicion"></label>
                        </div>
                        <label>Solicitud</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input"  name="solicitud" id="solicitud" autocomplete="off">
                            <label class="custom-control-label" for="solicitud" id="msjSolicitud"></label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Solicitud de pago</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input"  name="pago" id="pago" autocomplete="off">
                            <label class="custom-control-label" for="pago" id="msjPago"></label>
                        </div>
                        <label>Cuentas por pagar</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input"  name="cuentasx" id="cuentasx" autocomplete="off">
                            <label class="custom-control-label" for="cuentasx" id="mjsCuentasx"></label>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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
                                <input type="checkbox" class="custom-control-input"  name="crear-sum" id="crear-sum" autocomplete="off">
                                <label class="custom-control-label" for="crear-sum" id="msjCrear-sum"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar suministros</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="mod-sum" id="mod-sum" autocomplete="off">
                                <label class="custom-control-label" for="mod-sum" id="msjMod-sum"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="ver-sum" id="ver-sum" autocomplete="off">
                                <label class="custom-control-label" for="ver-sum" id="msjVer-sum"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar suministros</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="des-sum" id="des-sum" autocomplete="off">
                                <label class="custom-control-label" for="des-sum" id="msjDes-sum"></label>
                            </div>
                            <label>Reactivar suministros</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="Reac-sum" id="Reac-sum" autocomplete="off">
                                <label class="custom-control-label" for="Reac-sum" id="msjReac-sum"></label>
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
                                <label class="custom-control-label" for="prov" id="msj-prov"></label>
                            </div>
                            <label>Crear proveedores</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crear-prov" id="crear-prov" autocomplete="off">
                                <label class="custom-control-label" for="crear-prov" id="msjCrear-prov"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar proveedores</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="mod-prov" id="mod-prov" autocomplete="off">
                                <label class="custom-control-label" for="mod-prov" id="msjMod-prov"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="ver-prov" id="ver-prov" autocomplete="off">
                                <label class="custom-control-label" for="ver-prov" id="msjVer-prov"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar proveedores</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="des-prov" id="des-prov" autocomplete="off">
                                <label class="custom-control-label" for="des-prov" id="msjDes-prov"></label>
                            </div>
                            <label>Reactivar proveedores</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="Reac-prov" id="Reac-prov" autocomplete="off">
                                <label class="custom-control-label" for="Reac-prov" id="msjReac-prov"></label>
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
                                <label class="custom-control-label" for="cli" id="msj-cli"></label>
                            </div>
                            <label>Crear clientes</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crear-cli" id="crear-cli" autocomplete="off">
                                <label class="custom-control-label" for="crear-cli" id="msjCrear-cli"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar clientes</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="mod-cli" id="mod-cli" autocomplete="off">
                                <label class="custom-control-label" for="mod-cli" id="msjMod-cli"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="ver-cli" id="ver-cli" autocomplete="off">
                                <label class="custom-control-label" for="ver-cli" id="msjVer-cli"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar clientes</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="des-cli" id="des-cli" autocomplete="off">
                                <label class="custom-control-label" for="des-cli" id="msjDes-cli"></label>
                            </div>
                            <label>Reactivar clientes</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="Reac-cli" id="Reac-cli" autocomplete="off">
                                <label class="custom-control-label" for="Reac-cli" id="msjReac-cli"></label>
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
                                <label class="custom-control-label" for="mate" id="msj-mate"></label>
                            </div>
                            <label>Crear materiales</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crea-mMate" id="crear-mate" autocomplete="off">
                                <label class="custom-control-label" for="crear-mate" id="msjCrear-mate"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar materiales</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="mod-mate" id="mod-mate" autocomplete="off">
                                <label class="custom-control-label" for="mod-mate" id="msjMod-mate"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="ver-mate" id="ver-mate" autocomplete="off">
                                <label class="custom-control-label" for="ver-mate" id="msjVer-mate"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar materiales</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="des-mate" id="des-mate" autocomplete="off">
                                <label class="custom-control-label" for="des-mate" id="msjDes-mate"></label>
                            </div>
                            <label>Reactivar materiales</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="Reac-mate" id="Reac-mate" autocomplete="off">
                                <label class="custom-control-label" for="Reac-mate" id="msjReac-mate"></label>
                            </div>
                        </div>
                    </div> <!-- END -->

                    <br>
                    <div class="row bg-info" style="padding: 3px;"><div>Servicio</div></div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Servicio</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="serv" id="serv" autocomplete="off">
                                <label class="custom-control-label" for="serv" id="msj-serv"></label>
                            </div>
                            <label>Crear servicios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crear-serv" id="crear-serv" autocomplete="off">
                                <label class="custom-control-label" for="crear-serv" id="msjCrear-serv"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar servicios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="mod-serv" id="mod-serv" autocomplete="off">
                                <label class="custom-control-label" for="mod-serv" id="msjMod-serv"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="ver-serv" id="ver-serv" autocomplete="off">
                                <label class="custom-control-label" for="ver-serv" id="msjVer-serv"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar servicios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="des-serv" id="des-serv" autocomplete="off">
                                <label class="custom-control-label" for="des-serv" id="msjDes-serv"></label>
                            </div>
                            <label>Reactivar servicios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="Reac-serv" id="Reac-serv" autocomplete="off">
                                <label class="custom-control-label" for="Reac-serv" id="msjReac-serv"></label>
                            </div>
                        </div>
                    </div> <!-- END -->

                    <br>
                    <div class="row bg-info" style="padding: 3px;"><div>Viáticos</div></div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Viáticos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="viat" id="viat" autocomplete="off">
                                <label class="custom-control-label" for="viat" id="msj-viat"></label>
                            </div>
                            <label>Crear viáticos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crear-viat" id="crear-viat" autocomplete="off">
                                <label class="custom-control-label" for="crear-viat" id="msjCrear-viat"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar viáticos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="mod-viat" id="mod-viat" autocomplete="off">
                                <label class="custom-control-label" for="mod-viat" id="msjMod-viat"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="ver-viat" id="ver-viat" autocomplete="off">
                                <label class="custom-control-label" for="ver-viat" id="msjVer-viat"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar viáticos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="des-viat" id="des-viat" autocomplete="off">
                                <label class="custom-control-label" for="des-viat" id="msjDes-viat"></label>
                            </div>
                            <label>Reactivar viáticos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="Reac-viat" id="Reac-viat" autocomplete="off">
                                <label class="custom-control-label" for="Reac-viat" id="msjReac-viat"></label>
                            </div>
                        </div>
                    </div> <!-- END -->

                    <br>
                    <div class="row bg-info" style="padding: 3px;"><div>Usuarios</div></div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Usuarios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="usua" id="usua" autocomplete="off">
                                <label class="custom-control-label" for="usua" id="msj-usua"></label>
                            </div>
                            <label>Crear usuarios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crear-usua" id="crear-usua" autocomplete="off">
                                <label class="custom-control-label" for="crear-usua" id="msjCrear-usua"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar usuarios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="mod-usua" id="mod-usua" autocomplete="off">
                                <label class="custom-control-label" for="mod-usua" id="msjMod-usua"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="ver-usua" id="ver-usua" autocomplete="off">
                                <label class="custom-control-label" for="ver-usua" id="msjVer-usua"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar usuarios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="des-usua" id="des-usua" autocomplete="off">
                                <label class="custom-control-label" for="des-usua" id="msjDes-usua"></label>
                            </div>
                            <label>Reactivar usuarios</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="Reac-usua" id="Reac-usua" autocomplete="off">
                                <label class="custom-control-label" for="Reac-usua" id="msjReac-usua"></label>
                            </div>
                        </div>
                    </div> <!-- END -->


                    <br>
                    <div class="row bg-info" style="padding: 3px;"><div>Permisos</div></div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Permisos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="perm" id="perm" autocomplete="off">
                                <label class="custom-control-label" for="perm" id="msj-perm"></label>
                            </div>
                            <label>Crear permisos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crear-perm" id="crear-perm" autocomplete="off">
                                <label class="custom-control-label" for="crear-perm" id="msjCrear-perm"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar permisos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="mod-perm" id="mod-perm" autocomplete="off">
                                <label class="custom-control-label" for="mod-perm" id="msjMod-perm"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="ver-perm" id="ver-perm" autocomplete="off">
                                <label class="custom-control-label" for="ver-perm" id="msjVer-perm"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar permisos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="des-perm" id="des-perm" autocomplete="off">
                                <label class="custom-control-label" for="des-perm" id="msjDes-perm"></label>
                            </div>
                            <label>Reactivar permisos</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="Reac-perm" id="Reac-perm" autocomplete="off">
                                <label class="custom-control-label" for="Reac-perm" id="msjReac-perm"></label>
                            </div>
                        </div>
                    </div> <!-- END -->

                    <br>
                    <div class="row bg-info" style="padding: 3px;"><div>Maestro PTC</div></div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Maestro PTC</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="master" id="master" autocomplete="off">
                                <label class="custom-control-label" for="master" id="msj-master"></label>
                            </div>
                            <label>Crear PTC</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crear-master" id="crear-master" autocomplete="off">
                                <label class="custom-control-label" for="crear-master" id="msjCrear-master"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar PTC</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="mod-master" id="mod-master" autocomplete="off">
                                <label class="custom-control-label" for="mod-master" id="msjMod-master"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="ver-master" id="ver-master" autocomplete="off">
                                <label class="custom-control-label" for="ver-master" id="msjVer-master"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar PTC</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="des-master" id="des-master" autocomplete="off">
                                <label class="custom-control-label" for="des-master" id="msjDes-master"></label>
                            </div>
                            <label>Reactivar PTC</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="Reac-master" id="Reac-master" autocomplete="off">
                                <label class="custom-control-label" for="Reac-master" id="msjReac-master"></label>
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
                                <label class="custom-control-label" for="obras" id="msj-obras"></label>
                            </div>
                            <label>Crear obras</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crear-obras" id="crear-obras" autocomplete="off">
                                <label class="custom-control-label" for="crear-obras" id="msjCrear-obras"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar obras</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="mod-obras" id="mod-obras" autocomplete="off">
                                <label class="custom-control-label" for="mod-obras" id="msjMod-obras"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="ver-obras" id="ver-obras" autocomplete="off">
                                <label class="custom-control-label" for="ver-obras" id="msjVer-obras"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar obras</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="des-obras" id="des-obras" autocomplete="off">
                                <label class="custom-control-label" for="des-obras" id="msjDes-obras"></label>
                            </div>
                            <label>Reactivar obras</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="Reac-obras" id="Reac-obras" autocomplete="off">
                                <label class="custom-control-label" for="Reac-obras" id="msjReac-obras"></label>
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
                                <label class="custom-control-label" for="tipos" id="msj-tipos"></label>
                            </div>
                            <label>Crear tipos de obras</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crear-tipos" id="crear-tipos" autocomplete="off">
                                <label class="custom-control-label" for="crear-tipos" id="msjCrear-tipos"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar tipos de obras</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="mod-tipos" id="mod-tipos" autocomplete="off">
                                <label class="custom-control-label" for="mod-tipos" id="msjMod-tipos"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="ver-tipos" id="ver-tipos" autocomplete="off">
                                <label class="custom-control-label" for="ver-tipos" id="msjVer-tipos"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar tipos de obras</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="des-tipos" id="des-tipos" autocomplete="off">
                                <label class="custom-control-label" for="des-tipos" id="msjDes-tipos"></label>
                            </div>
                            <label>Reactivar tipos de obras</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="Reac-tipos" id="Reac-tipos" autocomplete="off">
                                <label class="custom-control-label" for="Reac-tipos" id="msjReac-tipos"></label>
                            </div>
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
                                <input type="checkbox" class="custom-control-input"  name="crear-personal" id="crear-personal" autocomplete="off">
                                <label class="custom-control-label" for="crear-personal" id="msjCrear-personal"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar personal</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="mod-personal" id="mod-personal" autocomplete="off">
                                <label class="custom-control-label" for="mod-personal" id="msjMod-personal"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="ver-personal" id="ver-personal" autocomplete="off">
                                <label class="custom-control-label" for="ver-personal" id="msjVer-personal"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar personal</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="des-personal" id="des-personal" autocomplete="off">
                                <label class="custom-control-label" for="des-personal" id="msjDes-personal"></label>
                            </div>
                            <label>Reactivar personal</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="Reac-personal" id="Reac-personal" autocomplete="off">
                                <label class="custom-control-label" for="Reac-personal" id="msjReac-personal"></label>
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
                            <label>Requisición</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="requisición" id="requisición" autocomplete="off">
                                <label class="custom-control-label" for="requisición" id="msj-requisición"></label>
                            </div>
                            <label>Crear requisición</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crear-requisición" id="crear-requisición" autocomplete="off">
                                <label class="custom-control-label" for="crear-requisición" id="msjCrear-requisición"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar requisición</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="mod-requisición" id="mod-requisición" autocomplete="off">
                                <label class="custom-control-label" for="mod-requisición" id="msjMod-requisición"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="ver-requisición" id="ver-requisición" autocomplete="off">
                                <label class="custom-control-label" for="ver-requisición" id="msjVer-requisición"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar requisición</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="des-requisición" id="des-requisición" autocomplete="off">
                                <label class="custom-control-label" for="des-requisición" id="msjDes-requisición"></label>
                            </div>
                            <label>Reactivar requisición</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="Reac-requisición" id="Reac-requisición" autocomplete="off">
                                <label class="custom-control-label" for="Reac-requisición" id="msjReac-requisición"></label>
                            </div>
                        </div>
                    </div> <!-- END -->
                  </div>
                </div>
            </div>
            <div class="card" id="opcionesSolicitud" style="display:none">
                <div class="card-header bg-info" id="solicitud">
                  <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" style="color:white;" type="button" data-toggle="collapse" data-target="#collapseSolicitud" aria-expanded="false" aria-controls="collapseSolicitud">
                      Solicitud
                    </button>
                  </h2>
                </div>
                <div id="collapseSolicitud" class="collapse" aria-labelledby="solicitud" data-parent="#accordionExample">
                  <div class="card-body">
                    {{-- <br> --}}
                    <div class="row">
                        <div class="col-md-4">
                            <label>Solicitud</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="solicitud" id="solicitud" autocomplete="off">
                                <label class="custom-control-label" for="solicitud" id="msj-solicitud"></label>
                            </div>
                            <label>Crear solicitud</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crear-solicitud" id="crear-solicitud" autocomplete="off">
                                <label class="custom-control-label" for="crear-solicitud" id="msjCrear-solicitud"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar solicitud</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="mod-solicitud" id="mod-solicitud" autocomplete="off">
                                <label class="custom-control-label" for="mod-solicitud" id="msjMod-solicitud"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="ver-solicitud" id="ver-solicitud" autocomplete="off">
                                <label class="custom-control-label" for="ver-solicitud" id="msjVer-solicitud"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar solicitud</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="des-solicitud" id="des-solicitud" autocomplete="off">
                                <label class="custom-control-label" for="des-solicitud" id="msjDes-solicitud"></label>
                            </div>
                            <label>Reactivar solicitud</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="Reac-solicitud" id="Reac-solicitud" autocomplete="off">
                                <label class="custom-control-label" for="Reac-solicitud" id="msjReac-solicitud"></label>
                            </div>
                        </div>
                    </div> <!-- END -->
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
                            <label>Solicitud de pago</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="pago" id="pago" autocomplete="off">
                                <label class="custom-control-label" for="pago" id="msj-pago"></label>
                            </div>
                            <label>Crear pago</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crear-pago" id="crear-pago" autocomplete="off">
                                <label class="custom-control-label" for="crear-pago" id="msjCrear-pago"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar pago</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="mod-pago" id="mod-pago" autocomplete="off">
                                <label class="custom-control-label" for="mod-pago" id="msjMod-pago"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="ver-pago" id="ver-pago" autocomplete="off">
                                <label class="custom-control-label" for="ver-pago" id="msjVer-pago"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar pago</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="des-pago" id="des-pago" autocomplete="off">
                                <label class="custom-control-label" for="des-pago" id="msjDes-pago"></label>
                            </div>
                            <label>Reactivar pago</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="Reac-pago" id="Reac-pago" autocomplete="off">
                                <label class="custom-control-label" for="Reac-pago" id="msjReac-pago"></label>
                            </div>
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
                                <label class="custom-control-label" for="CXP" id="msj-CXP"></label>
                            </div>
                            <label>Crear pago</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crear-CXP" id="crear-CXP" autocomplete="off">
                                <label class="custom-control-label" for="crear-CXP" id="msjCrear-CXP"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Modificar pago</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="mod-CXP" id="mod-CXP" autocomplete="off">
                                <label class="custom-control-label" for="mod-CXP" id="msjMod-CXP"></label>
                            </div>
                            <label>Ver botones</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="ver-CXP" id="ver-CXP" autocomplete="off">
                                <label class="custom-control-label" for="ver-CXP" id="msjVer-CXP"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Desactivar pago</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="des-CXP" id="des-CXP" autocomplete="off">
                                <label class="custom-control-label" for="des-CXP" id="msjDes-CXP"></label>
                            </div>
                            <label>Reactivar pago</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="Reac-CXP" id="Reac-CXP" autocomplete="off">
                                <label class="custom-control-label" for="Reac-CXP" id="msjReac-CXP"></label>
                            </div>
                        </div>
                    </div> <!-- END -->
                    <br>
                    <div class="row bg-info" style="padding: 3px;"><div>Conciliación</div></div><br>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <label>Conciliación</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="conciliacion" id="conciliacion" autocomplete="off">
                                <label class="custom-control-label" for="conciliacion" id="msj-conciliacion"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Crear conciliación</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="crear-conciliacion" id="crear-conciliacion" autocomplete="off">
                                <label class="custom-control-label" for="crear-conciliacion" id="msjCrear-conciliacion"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
  
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
