@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Ver <small>PTC</small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
    <li class="breadcrumb-item">Ver PTC</li>
    <li class="breadcrumb-item active">Inicio</li>
@endsection

@section('contenedor')
<div class="row">
    <div class="col-md-2">

    </div>
    <div class="col-md-8">
        <div class="card mb-3" style="max-width: 740px;">
            <div class="row no-gutters">
              <div class="col-md-4">
                <img src="{{ url('imagen/verptc.jpg') }}" class="img-fluid" style="object-fit: cover;object-position: center center;height: 100%;">
              </div>
              <div class="col-md-8">
                <div class="card-body" style="text-align: justify;">
                  <h4 class="">Propuesta Técnica Comercial</h4>
                  <p class="card-text"><b>Código PTC:</b> {{ $ptc->codventa_codigo }}</p>
                  <hr>
                  <p class="card-text"><b>Nombre: </b>{{ $ptc->codventa_nombre }}</p>
                  <p class="card-text"><b>Código Interno: </b>{{ $ptc->codventa_codigo2 }}</p>
                  <p class="card-text"><b>Teléfono: </b>{{ $ptc->codventa_telefono }}</p>
                  <p class="card-text"><b>Dirección: </b>{{ $ptc->codventa_direccion }}</p>
                  <p class="card-text"><b>Correo: </b>{{ $ptc->codventa_correo }}</p>
                  @if ($ptc->codventa_estado == 1)
                    <p class="card-text"><div style="background:green; color:white; text-align: center;">Activo</div></p>
                  @else
                  <p class="card-text"><div style="background:rgb(185, 14, 14); color:white; text-align: center;">Inactivo</div></p>
                  @endif
                  <p class="card-text"><small class="text-muted"><b>Fecha de creación: {{ $ptc->created_at }}</b></small></p>
                  <p><a href="{{ route('maestro.index') }}"><button type="button" class="btn btn-info float-right"><i class="fas fa-arrow-left"></i> Regresar</button></a></p>
                </div>
              </div>
            </div>
          </div>
    </div>
    <div class="col-md-2"></div>
</div>
@endsection
@section('js')

@endsection
@section('css')

@endsection
