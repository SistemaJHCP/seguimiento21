@extends('layouts.app')

<?php
    switch ($proveedor->proveedor_tipo) {
        case 'Natural':
            $t = "N";
            break;
        case 'Juridico':
            $t = "J";
        break;
        case 'Gubernamental':
            $t = "G";
        break;
        default:
            $t = "N";
            break;
    }
?>
@section('titulo')
    <h1 class="m-0"> Consultar <small>proveedor</small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item">Home</li> --}}
    <li class="breadcrumb-item">Consultar proveedor</li>
    <li class="breadcrumb-item active">Inicio</li>
    <img src="{{url('imagen/bandera_vzla.png') }}" width="30" height="20" alt="Sistema de Venezuela" style="margin-left: 10px; margin-top:4px;">
@endsection

@section('contenedor')
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="row no-gutters">
              <div class="col-md-4 d-none d-xl-block">
                <img src="{{ url('imagen/verPro.jpg') }}" alt="">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title"><b>Código:</b> {{ $proveedor->proveedor_codigo }}</h5>
                  <p class="card-text">
                      <b>Identificación: </b>{{ $t . "-" . $proveedor->proveedor_rif }} <br>
                      <b>Nombre: </b> {{ $proveedor->proveedor_nombre }}<br>
                      <b>Teléfono: </b> {{ $proveedor->proveedor_telefono }}<br>
                      <b>Correo: </b> {{ $proveedor->proveedor_correo }}<br>
                      <b>Contacto: </b> {{ $proveedor->proveedor_contacto }}<br>
                      <b>Suministro: </b> {{ $proveedor->suministro_nombre }}<br>
                      <b>Dirección: </b> {{ $proveedor->proveedor_direccion }}<br>
                  </p>
                  @if ( $proveedor->created_at)
                  <p class="card-text"><small class="text-muted">creado el: {{ $proveedor->created_at }}</small></p>
                  @endif
                  <p><a href="{{ route('proveedor.index') }}" class="btn btn-info float-right"><i class="fas fa-arrow-left"></i> Regresar</a></p>
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
