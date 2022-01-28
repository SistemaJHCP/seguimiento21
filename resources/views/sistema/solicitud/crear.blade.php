@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Solicitud <small>de pago</small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item">Home</li> --}}
    <li class="breadcrumb-item">Crear solicitud</li>
    <li class="breadcrumb-item active">Inicio</li>
@endsection

@section('contenedor')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Seleccione las opciones pertinentes</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">1</div>
                    <div class="col-md-3">2</div>
                    <div class="col-md-3">3</div>
                    <div class="col-md-3">4</div>
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
