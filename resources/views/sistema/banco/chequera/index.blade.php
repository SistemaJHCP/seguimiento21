@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Chequera <small></small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">Layout</li> --}}
    <li class="breadcrumb-item active">Inicio</li>
    <img src="{{url('imagen/bandera-panama.png') }}" width="30" height="20" alt="Sistema de Venezuela" style="margin-left: 10px; margin-top:4px;">
@endsection

@section('contenedor')
    <div class="row">
        <div class="col-md-5">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    <div  class="d-none d-lg-block d-print-block">
                        <img src="..." alt="imagen de banco">
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title">Cuenta</h5>
                      <p class="card-text">{{ $banco->cuenta_tipo }}</p>
                      <h5 class="card-title">Nro. de cuenta</h5>
                      <p class="card-text">{{ $banco->cuenta_numero }}</p>
                      <h5 class="card-title">Monto incial</h5>
                      <p class="card-text">{{ $banco->cuenta_montoinicial }}</p>
                      <h5 class="card-title">Nombre de banco</h5>
                      <p class="card-text">{{ $banco->banco_nombre }}</p>
                      <p class="card-text"><small class="text-muted">{{ $banco->banco_rif }}</small></p>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            2
        </div>
    </div>
@endsection
@section('js')

@endsection
@section('css')

@endsection

