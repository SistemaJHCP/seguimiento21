
@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Consultar cuenta <small></small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item">Home</li> --}}
    <li class="breadcrumb-item">Consulta de cuentas</li>
    <li class="breadcrumb-item active">Inicio</li>
@endsection
@section('contenedor')
<div class="row">
    <div class="col-md-5">
        <div class="card card-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-info">
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="{{ url('imagen/128x128.jpg') }}" alt="Imagen">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username"><b>Código: {{ $pro->proveedor_codigo }}</b></h3>
              <h5 class="widget-user-desc">{{ $pro->proveedor_nombre }}</h5>
            </div>
            <div class="card-footer p-0">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a href="#" class="nav-link" style="color: black">
                    <b>Rif: </b>{{ $pro->proveedor_tipo[0] }}-{{ $pro->proveedor_rif }}
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link" style="color: black">
                    <b>Teléfono: </b>{{ $pro->proveedor_telefono }}
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link" style="color: black">
                    <b>Dirección: </b>{{ $pro->proveedor_direccion }}
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
                <a href="{{ route('proveedor.index') }}"><button class="btn btn-info">Regresar</button></a>
                <button class="btn btn-info float-right" data-toggle="modal" data-target="#agregarCuenta">Agregar cuenta</button>
            </div>
          </div>

        </div>
    <div class="col-md-7">
        <div class="card-body">
            @foreach ($banco as $b)
                <div class="callout callout-info"  style="color: black">
                    <h5><b>Banco: </b>{{ $b->banco_nombre }}</h5><div class="float-right"><i style="color:#943838;font-size:24px;" class="far fa-trash-alt" id="deshabilitarCuenta" value="{{ $b->id }}"></i></div>

                    <p><b>Cuenta: </b>{{ $b->numero }}</p>
                    @if($b->tipodecuenta == 1)
                        Ahorro
                    @else
                        Corriente
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="modal fade" id="agregarCuenta" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="agregarCuentaLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="agregarCuentaLabel">Ingrese número de cuenta</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{ route('proveedor.guardarCuenta') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="">Seleccionar un banco</label>
                <select name="banco" id="banco" class="form-control" required>
                    <option value="">Seleccione...</option>
                    @foreach ($bancos as $ban)
                        <option value="{{ $ban->id }}">{{ $ban->banco_nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Cuenta</label>
                <input type="text" name="nroCuenta" id="nroCuenta" class="form-control" maxlength="20" placeholder="Agregar el número de cuenta" autocomplete="off" required>
                <input type="hidden" name="dato" value="{{ $dato }}">
            </div>
            <div class="form-group">
                <label for="">Indique el tipo de cuenta</label>
                <select name="tipo" id="tipo" class="form-control" required>
                    <option value="">Seleccione...</option>
                    <option value="1">Ahorro</option>
                    <option value="2">Corriente</option>
                </select>
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="cerrar" data-dismiss="modal">Cerrar</button>
            <input type="submit" name="agregar" class="btn btn-primary" id="agregar" value="Agregar cuenta bancaria" disabled>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@section('js')
<script src="{{ asset("plugins/numeric/jquery.numeric.js") }}"></script>
<script src="{{ asset("js/proveedores/cuenta.js") }}"></script>
@endsection
@section('css')

@endsection
