@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Consultar <small>solicitud Nro. {{ $solicitud->solicitud_numerocontrol }}</small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item">Home</li> --}}
    <li class="breadcrumb-item">Solicitudes de pago</li>
    <li class="breadcrumb-item active">Inicio</li>
    <img src="{{url('imagen/bandera-panama.png') }}" width="30" height="20" alt="Sistema de Venezuela" style="margin-left: 10px; margin-top:4px;">
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
                              <dl><a href="{{ route('sPagoIndex.index') }}"><button class="btn btn-info float-right"><i class="fas fa-arrow-left"></i> Regresar</button></a>
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
                                            <dd>Vi??ticos</dd>
                                        @elseif($solicitud->solicitud_tipo == 4)
                                            <dd>Caja chica</dd>
                                        @elseif($solicitud->solicitud_tipo == 5)
                                            <dd>N??mina</dd>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <dt>Forma de pago</dt>
                                        @if ($solicitud->solicitud_formapago == 1)
                                            <dd>Transferencia</dd>
                                        @elseif($solicitud->solicitud_formapago == 2)
                                            <dd>Cheque</dd>
                                        @elseif($solicitud->solicitud_formapago == 3)
                                            <dd>Vi??ticos</dd>
                                        @elseif($solicitud->solicitud_formapago == 4)
                                            <dd>Efectivo</dd>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <dt>??La solicitud incluye IVA?</dt>
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
                                @if ( $solicitud->solicitud_comentario != "Sin Comentarios" && $solicitud->solicitud_comentario != NULL )
                                    <div class="row" style="background:#17a2b8;color:white;">
                                        <div class="col-12">
                                            <dt>Comentario de presidencia</dt>
                                            <dd>{{ $solicitud->solicitud_comentario }}</dd>
                                        </div>
                                    </div>
                                @endif
                              </dl>
                            </div>
                            <!-- /.card-body -->
                          </div>
                          <!-- /.card -->
                    @if ($solicitud->solicitud_aprobacion == "Sin Respuesta" && $permisoUsuario->aprobacion_solicitud_pago == 1)
                        <div class="row">
                            <div class="col-6" id="validacion">
                                <button type="button" class="btn btn-info btn-lg btn-block" data-toggle="modal" data-target="#aprobarSolicitud">Aprobar</button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#negarSolicitud">Rechazar</button>
                            </div>
                        </div>
                        <br>
                    @endif
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
                                            <span class="info-box-text">Consultar requisici??n</span>
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
                                        <th class="bg-info">Precio unitario</th>
                                        <th class="bg-info">Precio total</th>
                                      </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ( $costo as $c)
                                        <tr>
                                            <td align="right">{{ $c->sd_cantidad }}</td>
                                            <td align="right">{{ $c->nombre }}</td>
                                            <td align="right">{{ $c->sd_preciounitario }} {{ $c->moneda }}</td>
                                            <td align="right">{{ $c->sd_cantidad * $c->sd_preciounitario }}  {{ $c->moneda }}</td>
                                        </tr>
                                    @endforeach
                                    @if ($total)
                                    <tr>
                                        <th colspan="3"><b>Monto total:</b></th>
                                        <th style="text-align:right;">{{ number_format( $total, 2 ) }}{{ $costo[0]->moneda }}</th>
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

<div class="modal fade" id="aprobarSolicitud" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="aprobarSolicitudLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="aprobarSolicitudLabel">??Aprueba la solicitud?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{ route('sPagoIndex.respuesta1') }}" method="post">
        @csrf
          <div class="row">
              <div class="col-4"><center><i class="far fa-thumbs-up" style="text-align:center; font-size:80px;color:rgb(7, 182, 7)"></i></center></div>
              <div class="col-8">
                    <input type="hidden" value="{{$solicitud->id}}" name="dato">
                    <input type="hidden" value="Aprobada" name="respuesta1">
                    <textarea name="comentario" class="form-control" placeholder="Agregue un comentario" maxlength="240"></textarea>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <input type="submit" id="apro" value="Aprobar solicitud" class="btn btn-info">
        </div>
        </form>
      </div>
    </div>
</div>

<div class="modal fade" id="negarSolicitud" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="aprobarSolicitudLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="aprobarSolicitudLabel">??Rechazar la solicitud?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('sPagoIndex.respuesta2') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-4"><center> <i class="fas fa-ban" style="text-align:center; font-size:80px;color:rgb(175, 45, 36)"></i></center></div>
                <div class="col-8">
                    <input type="hidden" value="{{$solicitud->id}}" name="dato">
                    <input type="hidden" value="Rechazada" name="respuesta1">
                    <textarea name="comentario" class="form-control" placeholder="Agregue un comentario" maxlength="240"></textarea>
                </div>
            </div>
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <input type="submit" id="recha" value="Rechazar solicitud" class="btn btn-danger">
            </div>
            </form>
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
            <dt>C??digo de la obra</dt>
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
                        <dt>C??digo de proveedor</dt>
                        <dd>{{ $solicitud->proveedor_codigo }}</dd>
                        <dt>Tipo de proveedor</dt>
                        <dd>{{ $solicitud->proveedor_tipo }}</dd>
                        <dt>Rif / C??dula</dt>
                        <dd>{{ $solicitud->proveedor_rif }}</dd>
                        <dt>Nombre de proveedor</dt>
                        <dd>{{ $solicitud->proveedor_nombre }}</dd>
                    </div>
                    <div class="col-6">

                        <dt>Nro. de tel??fono</dt>
                        <dd>{{ $solicitud->proveedor_telefono }}</dd>
                        <dt>Direcci??n</dt>
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
          <h5 class="modal-title" id="consultarRequerimientoModalLabel">Consultar requisici??n</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <dl>
              <dt>C??digo de requisici??n</dt>
              <dd>{{ $solicitud->requisicion_codigo }}</dd>
              <dt>Tipo de requisic??n</dt>
              <dd>{{ $solicitud->requisicion_tipo }}</dd>
              <dt>Fecha de Emisi??n</dt>
              <dd>{{ $solicitud->requisicion_fecha }}</dd>
              <dt>Fecha de Entrega</dt>
              <dd>{{ $solicitud->requisicion_fechae }}</dd>
              <dt>Motivo</dt>
              <dd>{{ $solicitud->requisicion_motivo }}</dd>
              <dt>Direcci??n</dt>
              <dd>{{ $solicitud->requisicion_direccion }}</dd>
              @if ($nombre != NULL)
              <dt>Solicitante</dt>
              <dd>{{ $nombre->user_name }}</dd>
              @endif
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
<script src="{{ asset("js/solicitud/consulta.js") }}"></script>
@endsection
@section('css')

@endsection
