@extends('layouts.app')

@section('titulo')
    <h1 class="m-0">Control <small>de gastos</small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">Layout</li> --}}
    <li class="breadcrumb-item active">Inicio</li>
    <img src="{{url('imagen/bandera-panama.png') }}" width="30" height="20" alt="Sistema de Venezuela" style="margin-left: 10px; margin-top:4px;">
@endsection

@section('contenedor')
<div class="row">
    <div class="col-md-4">
        <div class="card card-info card-outline">
            <div class="card-body">
                <div class="form-group">
                    <label>Seleccione una obra</label>
                    <select name="obra" class="form-control">
                        <option value="">Seleccione...</option>
                        @foreach ($obra as $ob)
                            <option value="{{ $ob->id }}">{{ $ob->obra_codigo }} | {{ $ob->obra_nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="card card-info card-outline">
            <div class="card-body">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card card-info card-outline">
            <div class="card-body">
                listado de obras
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')

@endsection
@section('css')

@endsection

