@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Consultar <small>solicitud Nro. {{ $solicitud->solicitud_numerocontrol }}</small></h1>
@endsection
@section('navegador')
    <li class="breadcrumb-item">Solicitud de cuentas</li>
    <li class="breadcrumb-item">Cuentas por pagar</li>
    <li class="breadcrumb-item active">Inicio</li>
@endsection

@section('contenedor')
<div class="row">
    <div class="col-md-12">
        <div class="card card-info card-outline">

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-info">
                              <h3 class="card-title">
                                <i class="far fa-address-book"></i>
                                Description
                              </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                              <dl><a href="{{ route('cuentas.index') }}"><button class="btn btn-info float-right">Regresar</button></a>
                                <dt>Fecha de solicitud:</dt>
                                <dd>{{ $solicitud->solicitud_fecha }}</dd>
                                <dt>Motivo</dt>
                                <dd>{{ $solicitud->solicitud_motivo }}</dd>
                                <dt>Observaciones</dt>
                                <dd>{{ $solicitud->solicitud_observaciones }}</dd>
                                <div class="row">
                                    <div class="col-6">
                                        <dt>Estado de la solicitud</dt>
                                        <dd>{{ $solicitud->solicitud_aprobacion }}</dd>
                                    </div>
                                    <div class="col-6">
                                        <dt>Tipo de la solicitud</dt>

                                        @if ($solicitud->solicitud_tipo == 1)
                                            <dd>Materiales</dd>
                                        @elseif($solicitud->solicitud_tipo == 2)
                                            <dd>Servicios</dd>
                                        @elseif($solicitud->solicitud_tipo == 3)
                                            <dd>Viáticos</dd>
                                        @elseif($solicitud->solicitud_tipo == 4)
                                            <dd>Caja chica</dd>
                                        @elseif($solicitud->solicitud_tipo == 5)
                                            <dd>Nómina</dd>
                                        @endif
                                    </div>
                                </div>
                                @if ( $solicitud->solicitud_comentario != "Sin Comentarios" && $solicitud->solicitud_comentario != NULL )
                                    <div class="row" style="background:#17a2b8;color:white;">
                                        <div class="col-12">
                                            <dt>Comentario de presidencia</dt>
                                            <dd>{{ $solicitud->solicitud_comentario }}</dd>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-6">
                                        <dt>Forma de pago</dt>
                                        @if ($solicitud->solicitud_formapago == 1)
                                            <dd>Transferencia</dd>
                                        @elseif($solicitud->solicitud_formapago == 2)
                                            <dd>Cheque</dd>
                                        @elseif($solicitud->solicitud_formapago == 3)
                                            <dd>Viáticos</dd>
                                        @elseif($solicitud->solicitud_formapago == 4)
                                            <dd>Efectivo</dd>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <dt>¿La solicitud incluye IVA?</dt>
                                        @if ($solicitud->solicitud_iva == 1)
                                            <dd>No incluye IVA</dd>
                                        @else
                                            <dd>Si incluye IVA</dd>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    @if ( $solicitud->nombre_aprobador )
                                        <div class="col-6">
                                            <dt>Respuesta de:</dt>
                                            <dd>{{ $solicitud->nombre_aprobador }}</dd>
                                        </div>
                                    @endif
                                    @if ($usuario)
                                        <div class="col-6">
                                            <dt>Solicitante:</dt>
                                            <dd>{{ $usuario->user_name }}</dd>
                                        </div>
                                    @endif
                                </div>
                              </dl>
                            </div>
                            <!-- /.card-body -->
                          </div>
                          <!-- /.card -->
                        @if ($solicitud->solicitud_aprobacion ==  "Aprobada" || $solicitud->solicitud_estadopago)
                            <button type="button" data-toggle="modal" data-target="#staticBackdrop" class="btn btn-info  btn-lg btn-block"><i class="fas fa-money-bill-wave"></i> Realizar pago</button>

                            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog  modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header bg-info">
                                      <h5 class="modal-title" id="staticBackdropLabel">Realizar pago</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                            @if ($total)
                                            <h1 style="margin-top:20px;"><center><b>{{ number_format( $total, 2 ) }} {{ $costo[0]->moneda }}</b></center></h1>
                                            <br>
                                            <h3><center>fecha: {{ $solicitud->solicitud_fecha }}</center></h3><br>
                                            @endif

                                        </div>
                                        <div class="col-md-7">
                                        <form action="{{ route('cuentas.crear') }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label>Forma de pago</label>
                                                <select name="forma_pago" id="forma_pago" class="form-control" required>
                                                    <option value="">Seleccione...</option>
                                                    <option value="Transferencia">Transferencia</option>
                                                    <option value="Deposito">Depósito</option>
                                                    <option value="Cheque">Cheque</option>
                                                    <option value="Efectivo">Efectivo</option>
                                                </select>
                                                <label>Cuentas de JHCP</label>
                                                <select name="cuentaJHCP" id="cuentaJHCP" class="form-control" required>
                                                    <option value="">Seleccione...</option>
                                                    @foreach ($cuenta as $cuentas)
                                                    <option value="{{ $cuentas->cuenta_numero }}">{{ $cuentas->cuenta_numero }}</option>
                                                    @endforeach
                                                </select>
                                                <label>Comprobante</label>
                                                <input type="text" name="comprobante" id="comprobante" class="form-control" autocomplete="off" maxlength="20" placeholder="Agregue el numero de referencia.">
                                                <label>Cheque</label>
                                                <select name="cheque" id="cheque" class="form-control" disabled>
                                                    <option value="">Seleccione...</option>
                                                </select>
                                                <label>Comentarios</label>
                                                <textarea name="comentario" id="comentario" maxlength="240" placeholder="Agregue un comentario" class="form-control"></textarea>
                                            </div>

                                        </div>
                                    </div>
                                    </div>
                                    <input type="hidden" name="solicitud" value="{{ $solicitud->solicitud_numerocontrol }}">
                                    <input type="hidden" name="montoTotal" value="{{ number_format( $total, 2 ) }}">
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" id="cerrar" data-dismiss="modal">Cerrar</button>
                                      <input type="submit" value="Realizar pago" class="btn btn-info">
                                    </div>
                                    </form>
                                  </div>
                                </div>
                              </div>

                         @endif
                        <br>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                @if ($solicitud->obra_codigo != NULL)
                                    <div class="info-box"  data-toggle="modal" data-target="#consultaObraModal">
                                        <span class="info-box-icon bg-info elevation-1"><i class="far fa-building"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Consultar<br>obra</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                @if ($solicitud->proveedor_codigo != NULL)
                                    <div class="info-box" data-toggle="modal" data-target="#consultarProveedorModal">
                                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-tools"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Consultar<br>proveedor</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                @if ($solicitud->requisicion_codigo != NULL)
                                    <div class="info-box" data-toggle="modal" data-target="#consultarRequerimientoModal">
                                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-clipboard-check"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Consultar requisición</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered">
                                    <thead>
                                      <tr>
                                        <th class="bg-info">Cantidad</th>
                                        <th class="bg-info">Nombre</th>
                                        <th class="bg-info">Precio</th>
                                      </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ( $costo as $c)
                                        <tr>
                                            <td>{{ $c->sd_cantidad }}</td>
                                            <td>{{ $c->nombre }}</td>
                                            <td>{{ $c->sd_preciounitario }} {{ $c->moneda }}</td>
                                        </tr>
                                    @endforeach
                                    @if ($total)
                                    <tr>
                                        <th colspan="2"><b>Monto total:</b></th>
                                        <th>{{ number_format( $total, 2 ) }} {{ $costo[0]->moneda }}</th>
                                    </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="consultaObraModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="consultaObraModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="consultaObraModalLabel">Consultar Obra</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <dl>
            <dt>Código de la obra</dt>
            <dd>{{ $solicitud->obra_codigo }}</dd>
            <dt>Nombre de la obra</dt>
            <dd>{{ $solicitud->obra_nombre }}</dd>
            <dt>Fecha de inicio</dt>
            @if ($solicitud->obra_fechainicio == null)
            <dd>No se ha anexado una fecha</dd>
            @else
            <dd>{{ $solicitud->obra_fechainicio }}</dd>
            @endif
            <dt>Fecha final</dt>
            @if ($solicitud->obra_fechafin == null)
            <dd>Sin asignar</dd>
            @else
            <dd>{{ $solicitud->obra_fechafin }}</dd>
            @endif
            <dt>Observaciones</dt>
            @if ($solicitud->obra_observaciones == null)
            <dd>No se agregaron observaciones</dd>
            @else
            <dd>{{ $solicitud->obra_observaciones }}</dd>
            @endif
            </dl>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="consultarProveedorModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="consultarProveedorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="consultarProveedorModalLabel">Consultar proveedor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <dl>
                <div class="row">
                    <div class="col-6">
                        <dt>Código de proveedor</dt>
                        <dd>{{ $solicitud->proveedor_codigo }}</dd>
                        <dt>Tipo de proveedor</dt>
                        <dd>{{ $solicitud->proveedor_tipo }}</dd>
                        <dt>Rif / Cédula</dt>
                        <dd>{{ $solicitud->proveedor_rif }}</dd>
                        <dt>Nombre de proveedor</dt>
                        <dd>{{ $solicitud->proveedor_nombre }}</dd>
                    </div>
                    <div class="col-6">

                        <dt>Nro. de teléfono</dt>
                        <dd>{{ $solicitud->proveedor_telefono }}</dd>
                        <dt>Dirección</dt>
                        <dd>{{ $solicitud->proveedor_direccion }}</dd>
                        <dt>Correo</dt>
                        <dd>{{ $solicitud->proveedor_correo }}</dd>
                    </div>
                </div>
                @if ( $solicitud->numero )
                <div class="row">
                    <div class="col-12">
                        <div class="info-box mb-3 bg-info">
                            <span class="info-box-icon"><i class="fas fa-money-bill"></i></span>
                        <div class="info-box-content">
                            <span class="">Nro. {{ $solicitud->numero }}</span>
                            <span class="">Cuenta:
                                @if ($solicitud->tipodecuenta == 1)
                                    Corriente
                                @elseif ($solicitud->tipodecuenta == 2)
                                    Ahorro
                                @else
                                    Tarjeta
                                @endif
                            </span>
                            <span class="info-box-number"><b>Banco: </b>{{ $solicitud->banco_nombre }}</span>
                        </div>
                        </div>
                    </div>
                </div>
                @endif
            </dl>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="consultarRequerimientoModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="consultarRequerimientoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="consultarRequerimientoModalLabel">Consultar requisición</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <dl>
              <dt>Código de requisición</dt>
              <dd>{{ $solicitud->requisicion_codigo }}</dd>
              <dt>Tipo de requisicón</dt>
              <dd>{{ $solicitud->requisicion_tipo }}</dd>
              <dt>Fecha de Emisión</dt>
              <dd>{{ $solicitud->requisicion_fecha }}</dd>
              <dt>Fecha de Entrega</dt>
              <dd>{{ $solicitud->requisicion_fechae }}</dd>
              <dt>Motivo</dt>
              <dd>{{ $solicitud->requisicion_motivo }}</dd>
              <dt>Dirección</dt>
              <dd>{{ $solicitud->requisicion_direccion }}</dd>
              <dt>Estado</dt>
              <dd>{{ $solicitud->requisicion_estado }}</dd>
          </dl>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('js')
<script src="{{ asset("plugins/numeric/jquery.numeric.js") }}"></script>
<script src="{{ asset("js/solicitud/cuenta/realizarPago.js") }}"></script>
@endsection
@section('css')

@endsection