@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Conciliación <small></small></h1>
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
                <form action="{{ route('conciliacion.imprimir') }}" method="post">
                @csrf
                    <div class="form-group">
                        {{-- <label>Filtrado fecha por intervalo *</label>
                        <select name="filtrado" id="filtrado" class="form-control" required>
                            <option value="">Seleccione</option>
                            <option value="no">No</option>
                            <option value="si">Si</option>
                        </select> --}}
                        <label>Fecha inicial</label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" name="inicial" class="form-control datetimepicker-input" placeholder="Ingrese la fecha inicial" id="inicial" data-target="#reservationdate1"/>
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                        <label>Fecha final</label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" name="final" class="form-control datetimepicker-input" placeholder="Ingrese la fecha final" id="final" data-target="#reservationdate2"/>
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                        <label>Obra</label>
                        <select name="obra" id="obra" class="form-control">
                            <option value="">Seleccione</option>
                            @foreach ($obra as $o)
                            <option value="{{ $o->id }}">{{ $o->obra_codigo }} | {{ $o->obra_nombre }}</option>
                            @endforeach
                        </select>
                        <label>Estado de la solicitud</label>
                        <select name="estado" id="estado" class="form-control" required>
                            <option value="">Seleccione</option>
                            <option value="0">Pagada</option>
                            <option value="1">No pagada</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Calcular" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="img-fluid">
            <img src="{{ url('imagen/foto1.jpg') }}" class="img-fluid">
        </div>
    </div>
</div>
{{-- <a href="{{ route('conciliacion.imprimir') }}">Imprimir XLSX</a> --}}
@endsection
@section('js')
<script src="{{ asset("plugins/plugins/jquery-ui/jquery-ui.js") }}"></script>
<script src="{{ asset("plugins/plugins/select2/js/select2.full.min.js") }}"></script>
<script src="{{ asset("plugins/numeric/jquery.numeric.js") }}"></script>
<script src="{{ asset("js/conciliacion/conciliacion.js") }}"></script>
@endsection
@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('plugins/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
