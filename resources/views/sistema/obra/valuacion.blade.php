@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Valuaciones <small>de una obra</small></h1>
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
              <button class="btn btn-info float-left" data-toggle="modal" data-target="#crearValuacion"><i class="fas fa-money-bill-wave-alt"> </i> Cargar valuación</button>
              <a href="{{ route('obra.index') }}"><button class="btn btn-info float-right"><i class="fas fa-arrow-left"></i> Regresar</button></a>
            </div>
            <!-- /.card-body -->
          </div>
    </div>
    <div class="col-md-5">
        @if ( !empty($valuacion) )
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
                      </span>
                      <span class="product-description float-left">
                          <button class="btn btn-info"><i class="fas fa-edit"></i></button>
                          <button class="btn btn-danger"><i class="fas fa-times"> </i></button>
                        </span>
                    </div>
                  </li>
                @endforeach



                <!-- /.item -->
              </ul>
            </div>
            <!-- /.card-body -->

          </div>
        @endif
    </div>
</div>

<div class="modal fade" id="crearValuacion" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="crearValuacionLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="crearValuacionLabel">Crear valuación</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Monto de la valuación</label>
                <input type="text" name="valuacion" id="valuacion" class="form-control" placeholder="Ingrese el monto de la valuación" maxlength="20">
                <label>Fecha</label>
                <input type="text" name="fecha" id="fecha" class="form-control" placeholder="dd/mm/aaaa" readonly maxlength="10">
                <label>Observación</label>
                <input type="text" name="observacion" id="observacion" class="form-control" maxlength="180">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Understood</button>
        </div>
      </div>
    </div>
  </div>


@endsection
@section('js')

@endsection
@section('css')

@endsection

