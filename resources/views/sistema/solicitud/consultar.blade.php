@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Consultar <small>solicitud Nro. {{ $solicitud->solicitud_numerocontrol }}</small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item">Home</li> --}}
    <li class="breadcrumb-item">Listado</li>
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
                              <dl><a href="{{ route('solicitud.index') }}"><button class="btn btn-info float-right">Regresar</button></a>
                                <dt>Fecha de solicitud:</dt>
                                <dd>{{ $solicitud->solicitud_fecha }}</dd>
                                <dt>Motivo</dt>
                                <dd>{{ $solicitud->solicitud_motivo }}</dd>
                                <dt>Observaciones</dt>
                                <dd>{{ $solicitud->solicitud_observaciones }}</dd>
                                <dt>Estado de la solicitud</dt>
                                <dd>{{ $solicitud->solicitud_aprobacion }}</dd>
                                <dt>Tipo de la solicitud</dt>

                                    @if ($solicitud->solicitud_tipo == 1)
                                        <dd>Materiales</dd>
                                    @elseif($solicitud->solicitud_tipo == 2)
                                        <dd>Selvicios</dd>
                                    @elseif($solicitud->solicitud_tipo == 3)
                                        <dd>Viáticos</dd>
                                    @elseif($solicitud->solicitud_tipo == 4)
                                        <dd>Caja chica</dd>
                                    @elseif($solicitud->solicitud_tipo == 5)
                                        <dd>Nómina</dd>
                                    @endif

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

                                <dt>¿La solicitud incluye IVA?</dt>
                                @if ($solicitud->solicitud_iva == 1)
                                    <dd>No incluye IVA</dd>
                                @else
                                    <dd>Si incluye IVA</dd>
                                @endif

                              </dl>
                            </div>
                            <!-- /.card-body -->
                          </div>
                          <!-- /.card -->
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                @if ($solicitud->obra_codigo != NULL)
                                    <div class="info-box">
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
                                    <div class="info-box">
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
                                    <div class="info-box">
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
                                            <td>{{ $c->sd_preciounitario }}</td>
                                        </tr>
                                    @endforeach







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
@endsection
@section('js')

@endsection
@section('css')

@endsection
