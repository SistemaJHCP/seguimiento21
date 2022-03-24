@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Consultar <small>a un cliente</small></h1>
@endsection
@section('navegador')
    <li class="breadcrumb-item">Consultar</li>
    <li class="breadcrumb-item">Cliente</li>
    <li class="breadcrumb-item active">Inicio</li>
@endsection

@section('contenedor')
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="row no-gutters">
              <div class="col-md-4 col-sm-12">
                <img src="{{ url('imagen/cli1.jpg') }}" alt="..." class="img-fluid img-thumbnail">
              </div>
              <div class="col-md-8 col-sm-12">
                <div class="card-body">
                  <h3 class="m-0">{{ $cliente->cliente_nombre }}</h3>
                  <p class="card-text"><b>Código de cliente: </b>{{ $cliente->cliente_codigo }}</p>
                  <p class="card-text"><b>RIF / Cédula del cliente: </b>{{ $cliente->cliente_rif }}</p>
                  <p class="card-text"><b>Teléfono: </b>{{ $cliente->cliente_telefono }}</p>
                  <p class="card-text"><b>Correo: </b>{{ $cliente->cliente_correo }}</p>
                  <hr>
                  <p class="card-text"><b></b>{{ $cliente->cliente_direccion }}</p>
                  <p class="card-text"><small class="text-muted">Fecha de creación: {{ $cliente->created_at }}</small> <a href="{{ route('cliente.index') }}" class="btn btn-primary float-right"><i class="fas fa-arrow-left"></i> Regresar</a> </p>
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
