@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Modificar <small>PTC</small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
    <li class="breadcrumb-item">Modificar PTC</li>
    <li class="breadcrumb-item active">Inicio</li>
@endsection

@section('contenedor')
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="card">

                <div class="modal-content">
                  <div class="modal-header bg-info">
                    <h5 class="modal-title" id="crearPTCLabel">Crear una propuesta técnica comercial</h5>

                  </div>
                  <form action="{{ route('maestro.modificando', $ptc->id) }}" method="post">
                      @csrf
                      <div class="modal-body">
                          <div class="form-group">
                              <label>Código de PTC</label>
                              <input type="text" name="codigoPTC" id="codigoPTC" class="form-control" value="{{ $ptc->codventa_codigo }}" placeholder="Ingrese el código de PTC" maxlength="22" autocomplete="off">
                          </div>
                          <div class="form-group">
                              <label>Nombre</label>
                              <input type="text" name="nombrePTC" id="nombrePTC" class="form-control" value="{{ $ptc->codventa_nombre }}" placeholder="Ingrese las caracteristicas" maxlength="100" autocomplete="off">
                          </div>
                          <div class="form-group">
                            <label>Codigo interno</label>
                            <input type="text" name="" class="form-control" value="{{ $ptc->codventa_codigo2 }}" placeholder="Ingrese teléfono de contacto" maxlength="40" disabled>
                          </div>
                          <div class="form-group">
                              <label>Teléfono</label>
                              <input type="text" name="telefonoPTC" id="telefonoPTC" class="form-control" value="{{ $ptc->codventa_telefono }}" placeholder="Ingrese teléfono de contacto" maxlength="12" autocomplete="off">
                          </div>
                          <div class="form-group">
                              <label>Dirección</label>
                              <input type="text" name="direccionPTC" id="direccionPTC" class="form-control" value="{{ $ptc->codventa_direccion }}" placeholder="Ingrese la dirección" maxlength="220" autocomplete="off">
                          </div>
                          <div class="form-group">
                              <label>Correo electrónico</label>
                              <input type="text" name="correoPTC" id="correoPTC" class="form-control" value="{{ $ptc->codventa_correo }}" placeholder="Ingrese el correo electrónico" maxlength="60" autocomplete="off">
                          </div>
                      </div>
                      <div class="modal-footer">
                        <p><a href="{{ route('maestro.index') }}"><button type="button" class="btn btn-info float-right"><i class="fas fa-arrow-left"></i>  Regresar</button></a></p>
                          <input type="submit" id="cargar" class="btn btn-info" value="Modificar PTC">
                      </div>
                  </form>
                </div>

        </div>
    </div>
    <div class="col-md-2"></div>
</div>

@endsection
@section('js')
<script src="{{ asset("plugins/numeric/jquery.numeric.js") }}"></script>
<script src="{{ asset("js/maestro/modificarPTC.js") }}"></script>
@endsection
@section('css')

@endsection
