@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Solicitud <small>de pago</small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item">Home</li> --}}
    <li class="breadcrumb-item">Crear solicitud</li>
    <li class="breadcrumb-item active">Inicio</li>
@endsection

@section('contenedor')
<div class="row">
    <div class="col-md-12">
        <form action="{{ route('solicitud.cargarSolicitud') }}" method="post">
        @csrf
        <div class="card card-info card-outline">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-7"><h3 class="card-title"><label for="">Seleccione las opciones pertinentes</label></h3></div>
                    <div class="col-md-5">
                        <select name="tipoSolicitud" id="opciones" class="form-control">
                            <option value="">Seleccione el tipo de solicitud</option>
                            <option value="5">Nómina</option>
                            <option value="1">Materiales</option>
                            <option value="2">Servicios</option>
                            <option value="3">Viáticos</option>
                            {{-- <option value="4">Caja chica</option> --}}
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        {{-- <div class="row">
                            <div class="col-12">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input bg-info" id="customSwitch1" name="dolar">
                                    <label class="custom-control-label float-right" for="customSwitch1">Monto en Bolivares</label><br><br>
                                </div>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Fecha de Solicitud *</label>
                                    <input type="text" name="fecha" id="fecha" value="{{ date('Y-m-d') }}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Pagos Especiales *</label>
                                    <select name="pagos" id="pagos" class="form-control">
                                        <option value="">Seleccione...</option>
                                        <option value="1">Emergencia</option>
                                        <option value="2">Viernes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Obra Relacionada *</label>
                                    <select name="obra" id="obra" class="form-control">
                                        <option value="">Seleccione...</option>
                                        @foreach ($obra as $o)
                                            <option value="{{ $o->id }}">{{ $o->obra_codigo }} - {{ $o->obra_nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Proveedor *</label>
                                    <select name="proveedor" id="proveedor" class="form-control">
                                        <option value="">Seleccione...</option>
                                        @foreach ($proveedor as $p)
                                            <option value="{{ $p->id }}">{{ $p->proveedor_nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Forma de Pago *</label>
                                    <select name="forma_pago" id="forma_pago" class="form-control">
                                        <option value="">Seleccione...</option>
                                        <option value="1">Transferencia</option>
                                        <option value="2">Depósito</option>
                                        <option value="3">Cheque</option>
                                        <option value="4">Efectivo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Número de Cuenta</label>
                                    <select name="numero_cuenta" id="numero_cuenta" class="form-control" disabled>
                                        <option value="">Seleccione...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>¿Monto incluye IVA? *</label>
                                    <select name="iva" id="iva" class="form-control">
                                        <option value="">Seleccione...</option>
                                        <option value="1">No</option>
                                        <option value="2">Si</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Requisicion *</label>
                                    <select name="requisicion" id="requisicion" class="form-control" disabled>
                                        <option value="">Seleccione...</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row" style="min-height: 90px;">
                    <div class="col-md-4">
                        <div id="botonObra"></div>
                    </div>
                    <div class="col-md-4">
                        <div id="botonProveedor"></div>
                    </div>
                    <div class="col-md-4">
                        <div id="botonRequisicion"></div>
                        {{-- <div class="info-box" id="consultarReq" data-toggle="modal" data-target="#consultarRequisicion">
                            <span class="info-box-icon bg-info"><i class="far fa-list-alt"></i></span>

                            <div class="info-box-content" >
                                <span class="info-box-text">Consultar</span>
                                <span class="info-box-number">REQUISICION</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card card-info card-outline">
                    <div class="card-header">
                      <h5 class="card-title">Motivo</h5>
                    </div>
                    <div class="card-body">
                        <textarea name="motivo" id="motivo" class="form-control"></textarea>
                    </div>
                </div>

                <div class="card card-info card-outline">
                    <div class="card-header">
                      <h5 class="card-title">Observaciones</h5>
                    </div>
                    <div class="card-body">
                        <textarea name="observacion" id="observacion" class="form-control"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-info card-outline">
                    <div class="card-header">
                      <h5 class="card-title">Cargar la solicitud</h5><button type="button" id="btn-agregar" class="btn btn-info float-right"  data-toggle="modal" data-target="#agregarListaSolicitud" disabled>Agregar lista de solicitud</button>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table" id="tableListado">
                            <thead >
                                <tr>
                                  <th>Cantidad</th>
                                  <th>Concepto</th>
                                  <th>Precio Unitario</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                    <div id="cant1"></div>
                    <div id="concep1"></div>
                    <div id="prec1"></div>
                    <div class="card-footer">
                        <div id="limpiador" class="float-left" style="color: #6b1022; border:3px solid #6b1022; padding-left:7px; padding-right:7px; font-size:22px; border-radius:130px;"><i class="fas fa-trash" style="color: #6b1022"></i></div>
                        <input type="submit" value="Cargar solicitud" class="btn btn-info float-right" id="cargarLaSolicitud" disabled>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="agregarListaSolicitud" data-backdrop="static" data-keyboard="false" style="overflow:hidden;" aria-labelledby="agregarListaSolicitudLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="agregarListaSolicitudLabel">Listado de solicitud</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="">Cantidad</label>
                    <input type="text" name="cantidad" id="cantidadSelect" class="form-control"autocomplete="off" placeholder="Ingrese la cantidad">
                    <label for="">Concepto</label>
                    <select name="concepto" id="conceptoSelect" class="form-control">
                        <option value="">Seleccione...</option>
                    </select>
                    <label for="">Precio unitario</label>
                    <input type="text" name="precioUnitario" id="precioUnitarioSelect" class="form-control"autocomplete="off" placeholder="Ingrese en monto">
                </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" id="agregar132">Agregar</button>
            </div>
          </div>
        </div>
    </div>

      <div class="modal fade" id="consultarObra" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="consultarObraLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="consultarObraLabel">Datos de la obra</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div id="infoObra">Espere...</div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="consultarProveedor" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="consultarProveedorLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="consultarProveedorLabel">Datos de proovedor</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div id="infoProveedor">Espere...</div>
                <br>
                <div id="datosBancos"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

    <div class="modal fade" id="consultarRequisicion" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="consultarRequisicionLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="consultarRequisicionLabel">Datos de la requisición</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                  <div class="col-md-6">
                    <div id="infoRequisicion"></div>
                  </div>
                  <div class="col-md-6">
                    <div class="card card-row card-info">
                        <div class="card-header">
                            Materiales
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table" id="tableDesplegable">
                                <thead >
                                    <tr>
                                      <th>Cantidad</th>
                                      <th>Concepto</th>
                                      <th>Especificación</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <div id="cantidad234"></div>
                            <div id="concrip234"></div>
                            <div id="especificaciones234"></div>
                        </div>
                        {{-- <div class="card-body">
                            <hr>
                            <i style="color:#6b1022; border:3px solid #6b1022; border-radius:25px; font-size:15px; padding:8px;" id="borrarTodo"  class="fas fa-trash"></i>
                            <input type="submit" value="Cargar requisición" id="cargarRequisicion" class="btn btn-info float-right" disabled>
                        </div> --}}
                    </div>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
    </div>

    </form>
</div>
@endsection
@section('js')
<script src="{{ asset("plugins/plugins/jquery-ui/jquery-ui.js") }}"></script>
<script src="{{ asset("plugins/plugins/select2/js/select2.full.min.js") }}"></script>
<script src="{{ asset("plugins/numeric/jquery.numeric.js") }}"></script>
<script src="{{ asset("js/solicitud/crear.js") }}"></script>
@endsection
@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('plugins/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/solicitud/crear.css') }}">
@endsection
