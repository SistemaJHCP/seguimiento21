@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Obras <small>y valuaciones</small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">Layout</li> --}}
    <li class="breadcrumb-item active">Inicio</li>
    <img src="{{url('imagen/bandera_vzla.png') }}" width="30" height="20" alt="Sistema de Venezuela" style="margin-left: 10px; margin-top:4px;">
@endsection

@section('contenedor')
<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                Nro de Obra: {{ $obra->obra_codigo }}
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <dl class="row">
                <dt class="col-sm-4">Tipo de trabajo: </dt>
                <dd class="col-sm-8">{{ $obra->tipo_nombre }}</dd>
                <dt class="col-sm-4">Cliente: </dt>
                <dd class="col-sm-8">{{ $obra->cliente_nombre }}</dd>
                <dt class="col-sm-4">Código PTC: </dt>
                <dd class="col-sm-8">{{ $obra->codventa_nombre }}</dd>
                <dt class="col-sm-4">Nombre: </dt>
                <dd class="col-sm-8">{{ $obra->obra_nombre }}</dd>
                <dt class="col-sm-4">Total planificado: </dt>
                <dd class="col-sm-8">{{ $obra->obra_monto }}</dd>
                <dt class="col-sm-4">Porcentaje de ganancia(%): </dt>
                <dd class="col-sm-8">{{ $obra->obra_ganancia }}</dd>
                <dt class="col-sm-4">Fecha de inicio: </dt>
                <dd class="col-sm-8">{{ $obra->obra_fechainicio }}</dd>
                <dt class="col-sm-4">Fecha finál: </dt>
                <dd class="col-sm-8">{{ $obra->obra_fechafin }}</dd>
                <dt class="col-sm-4">Anticipo: </dt>
                <dd class="col-sm-8" style="color: green;font-weight: bold;">{{ $obra->obra_anticipo }}</dd>
                <dt class="col-sm-4">Descripción: </dt>
                <dd class="col-sm-8">{{ $obra->obra_observaciones }}</dd>
              </dl>
              @if ($permisoUsuario->valuacion)
              <button class="btn btn-info float-left" data-toggle="modal" data-target="#crearValuacion"><i class="fas fa-money-bill-wave-alt"> </i> Cargar valuación</button>
              @endif
              <a href="{{ route('obra.index') }}"><button class="btn btn-info float-right"><i class="fas fa-arrow-left"></i> Regresar</button></a>
            </div>
            <!-- /.card-body -->
          </div>
    </div>
    <div class="col-md-5">

        @if ( count($valuacion) >= 1 )

        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Valuaciones cargadas</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <ul class="products-list product-list-in-card pl-2 pr-2">
                
                @foreach ($valuacion as $val)
                <li class="item">
                    <div class="product-img">
                      <img src="{{url('imagen/moneyPNG.png') }}" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      Fecha: {{ $val->valuacion_fecha }}
                        <span class="badge badge-info float-right">{{ $val->valuacion_monto }}</span>
                      <span class="product-description">
                        {{ $val->observacion }}
                      </span><br>
                      <span class="product-description float-left">
                          <button class="btn btn-info" value="{{ $val->id }}"  id="capturarValuacion" data-toggle="modal" data-target="#modificarValuacion"><i class="fas fa-edit"></i></button>
                          <button class="btn btn-danger" value="{{ $val->id }}" id="desactivar"><i class="fas fa-times"> </i></button>
                        </span>
                    </div>
                  </li>
                  <?php $total[] = $val->valuacion_monto ?>
                @endforeach
                <!-- /.item -->
              </ul>
            </div>
            <div class="card-footer">
                <b class="float-right">Total: {{ array_sum($total) }}</b>
            </div>
            <!-- /.card-body -->
        </div>

      @else
      <div class="card d-none d-sm-block">
        <div class="card-body">
          <img src="{{ url('imagen/AA-2.jpg') }}" class="img-fluid">
        </div>
      </div>
      @endif
    </div>
</div>

<div class="modal fade" id="crearValuacion" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="crearValuacionLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('valuacion.crear') }}" method="post">
            @csrf
            <div class="modal-header">
            <h5 class="modal-title" id="crearValuacionLabel">Crear valuación</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Monto de la valuación</label>
                    <input type="text" name="valuacion" id="valuacion" class="form-control" placeholder="Ingrese el monto de la valuación" maxlength="20" autocomplete="off" required>
                    <label>Fecha</label>
                    <input type="text" name="fecha" id="fecha" class="form-control" placeholder="dd/mm/aaaa" readonly maxlength="10" autocomplete="off" required>
                    <label>Observación</label>
                    <input type="text" name="observacion" id="observacion" class="form-control" maxlength="180" placeholder="Ingrese la observación de las valuaciones" autocomplete="off" required>
                    <input type="hidden" name="dato" value="{{ $id }}">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="cerrar" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <input type="submit" name="cargarVal" id="cargarVal" value="Crear valuación" id="cargarVal" class="btn btn-primary" disabled>
            </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modificarValuacion" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modificarValuacionLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modificarValuacionLabel">Modificar valuacion</h5>
          <button type="button" class="close" id="closeMod" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('valuacion.modificar', $id) }}" method="post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Monto de la valuación</label>
                    <input type="text" name="valuacionMod" id="valuacionMod" class="form-control" placeholder="Ingrese el monto de la valuación" maxlength="20" autocomplete="off" disabled required>
                    <label>Fecha</label>
                    <input type="text" name="fechaMod" id="fechaMod" class="form-control" placeholder="dd/mm/aaaa" disabled maxlength="10" autocomplete="off" required>
                    <label>Observación</label>
                    <input type="text" name="observacionMod" id="observacionMod" class="form-control" maxlength="180" placeholder="Ingrese la observación de las valuaciones" autocomplete="off" disabled required>
                    <input type="hidden" name="datoKid" id="datoKid">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="cerrarMod" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <input type="submit" id="ValMod" value="Modificar valuación" class="btn btn-primary" disabled>
            </div>
        </form>
      </div>
    </div>
  </div>

@endsection
@section('js')
<script src="{{ asset("plugins/plugins/jquery-ui/jquery-ui.js") }}"></script>
<script src="{{ asset("plugins/plugins/select2/js/select2.full.min.js") }}"></script>
<script src="{{ asset("plugins/numeric/jquery.numeric.js") }}"></script>
<script src="{{ asset("js/obra/valuaciones.js") }}"></script>
@if (Session::has('resp'))
{{ Session::has('resp') }}
    @if (Session::has('resp'))
    <script>
        Swal.fire(
        'Solicitud procesada!',
        'La información fue cargada exitosamente!',
        'success'
        )
    </script>
    @else
    <script>
        Swal.fire(
        'No se cargo la información!',
        'No se pudo guardar en el sistema',
        'error'
        )
    </script>
    @endif
@endif
@endsection
@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('plugins/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

