@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Consultar <small>requisición Nro. {{ $requisicion->requisicion_codigo }}</small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item">Home</li> --}}
    <li class="breadcrumb-item">Consultar requisición</li>
    <li class="breadcrumb-item active">Inicio</li>
    <img src="{{url('imagen/bandera_vzla.png') }}" width="30" height="20" alt="Sistema de Venezuela" style="margin-left: 10px; margin-top:4px;">
@endsection

@section('contenedor')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-info">
              <h3 class="card-title">
                Usuario: {{ $requisicion->usuario_nombre }}
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body"> <a href="{{ route('requisicion.index') }}"><button class="float-right btn btn-info"><i class="fas fa-arrow-left"></i> Regresar</button></a>
                <dt>Tipo de requisición:</dt>
                <dd>{{ $requisicion->requisicion_tipo }}</dd>
                <dt>Fecha de inicio:</dt>
                <dd>{{ $requisicion->requisicion_fecha }}</dd>
                <dt>Fecha final:</dt>
                <dd>{{ $requisicion->requisicion_fechae }}</dd>
                <dt>Motivo:</dt>
                <dd>{{ $requisicion->requisicion_motivo }}</dd>
                <dt>Direccion:</dt>
                <dd>{{ $requisicion->requisicion_direccion }}</dd>
                <dt>Estado de la solicitud:</dt>
                <dd>{{ $requisicion->requisicion_estado }}</dd>
                <dt>Observación:</dt>
                <dd>{{ $requisicion->requisicion_observaciones }}</dd>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-6">
                <div class="info-box" data-toggle="modal" data-target="#consultarObra">
                    <span class="info-box-icon bg-info elevation-1"><i class="far fa-building"></i></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Consultar</span>
                      <span class="info-box-number">
                        OBRA
                        <small></small>
                      </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-6">
                <div class="info-box" data-toggle="modal" data-target="#consultarProveedor">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-tie"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Consultar</span>
                      <span class="info-box-number">
                        PROVEEDOR
                        <small></small>
                      </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                      <h3 class="card-title">
                        Solicitud de materiales
                      </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Cantidad</th>
                                    <th>Característica</th>
                                    <th>Material</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sol_det as $detalle)

                                @if ( $detalle->material_codigo )
                                    <tr>
                                        <td>{{ $detalle->sd_cantidad }}</td>
                                        <td>{{ $detalle->sd_caracteristicas }}</td>
                                        <td>{{ $detalle->material_nombre}}</td>
                                    </tr>
                                @endif
                                @if ( $detalle->servicio_codigo )
                                    <tr>
                                        <td>{{ $detalle->sd_cantidad }}</td>
                                        <td>{{ $detalle->sd_caracteristicas }}</td>
                                        <td>{{ $detalle->servicio_nombre}}</td>
                                    </tr>
                                @endif
                                @if ( $detalle->viatico_codigo )
                                    <tr>
                                        <td>{{ $detalle->sd_cantidad }}</td>
                                        <td>{{ $detalle->sd_caracteristicas }}</td>
                                        <td>{{ $detalle->viatico_nombre}}</td>
                                    </tr>
                                @endif


                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="consultarObra" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="consultarObraLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title" id="consultarObraLabel">Consultar obra</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:white;">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <dt>Código de la obra:</dt>
            <dd>{{ $requisicion->obra_codigo }}</dd>
            <dt>Nombre de la obra:</dt>
            <dd>{{ $requisicion->obra_nombre }}</dd>
            <dt>Monto:</dt>
            <dd>{{ $requisicion->obra_monto }}</dd>
            <dt>Porcentaje de ganancia:</dt>
            <dd>{{ $requisicion->obra_ganancia }}</dd>
            <dt>Fecha de inicio:</dt>
            <dd>{{ $requisicion->obra_fecha_inicio }}</dd>
            <dt>Fecha final:</dt>
            <dd>{{ $requisicion->obra_fecha_fin }}</dd>
            <dt>Observaciones:</dt>
            <dd>{{ $requisicion->obra_observaciones }}</dd>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>


<!-- Modal -->
<div class="modal fade" id="consultarProveedor" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="consultarProveedorLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title" id="consultarProveedorLabel">Consultar proveedor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:white;">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <dt>Código de proveedor:</dt>
            <dd>{{ $requisicion->proveedor_codigo }}</dd>
            <dt>Tipo de documento:</dt>
            <dd>{{ $requisicion->proveedor_tipo }}</dd>
            <dt>Cédula:</dt>
            <dd>{{ $requisicion->proveedor_rif }}</dd>
            <dt>Nombre del proveedor:</dt>
            <dd>{{ $requisicion->proveedor_nombre }}</dd>
            <dt>Teléfono del proveedor:</dt>
            <dd>{{ $requisicion->proveedor_telefono }}</dd>
            <dt>Observación:</dt>
            <dd>{{ $requisicion->proveedor_direccion }}</dd>
            <dt>Correo:</dt>
            <dd>{{ $requisicion->proveedor_correo }}</dd>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('js')

@endsection
@section('css')

@endsection
