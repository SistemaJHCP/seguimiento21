@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Crear <small>nueva obra</small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
    <li class="breadcrumb-item">Nueva obra</li>
    <li class="breadcrumb-item active">Inicio</li>
@endsection

@section('contenedor')
<div class="row">
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Tipo</label>
                    <select name="tipo" id="" class="form-control" required>
                        <option value="">Seleccione...</option>
                        @foreach ($tipo as $t)
                            <option value="{{ $t->id }}">{{ $t->tipo_nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Cliente</label>
                    <select name="" id="" class="form-control" required>
                        <option value="">Seleccione...</option>
                        @foreach ($cli as $c)
                            <option value="{{ $c->id }}">{{ $c->cliente_nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Codventa</label>
                    <select name="" id="" class="form-control" required>
                        <option value="">Seleccione...</option>
                        @foreach ($cod as $v)
                            <option value="{{ $v->id }}">{{ $v->codventa_codigo }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre de la obra">
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="">Total planificado</label>
                            <input type="text" name="total" id="total" class="form-control" placeholder="Gasto planificado de la obra">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Porcentaje de ganancia</label>
                            <input type="text" name="total" id="total" class="form-control" placeholder="Porcentaje de ganancia">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Fecha de inicio</label>
                            <input type="text" name="fechaInicio" id="datepicker" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Fecha de culminación</label>
                            <input type="text" name="fechaFin" id="datepicker2" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">4</div>
</div>
@endsection
@section('js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(function(){
    $("#datepicker").datepicker({
        dateFormat: "dd-mm-yy"
    });
});
$(function(){
    $("#datepicker2").datepicker({
        dateFormat: "dd-mm-yy"
    });
});
</script>
@endsection
@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection
