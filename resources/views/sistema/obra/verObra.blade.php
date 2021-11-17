@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Consultar <small>obra</small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
    <li class="breadcrumb-item">Ver obra</li>
    <li class="breadcrumb-item active">Obra</li>
@endsection

@section('contenedor')
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="row" style="margin-bottom: 0px">
                <div class="col-8" style="border: 1px solid #7f7f7f;">
                    <div class="card-body">
                        <h3>Nro. {{ $obra->obra_codigo }}</h3><br>
                        <p class="card-text"><b>Tipo de trabajo: </b>{{ $obra->tipo_nombre }}</p>
                        <p class="card-text"><b>Cliente: </b>{{ $obra->cliente_nombre }}</p>
                        <p class="card-text"><b>Código PTC: </b>{{ $obra->codventa_nombre }}</p>
                        <p class="card-text"><b>Nombre: </b>{{ $obra->obra_nombre }}</p>
                        <p class="card-text"><b>Total planificado: </b>{{ $obra->obra_monto }}</p>
                        <p class="card-text"><b>Porcentaje de ganancia(%): </b>{{ $obra->obra_ganancia }}</p>
                        <p class="card-text"><b>Fecha de inicio: </b>{{ $obra->obra_fechainicio }}</p>
                        <p class="card-text"><b>Fecha finál: </b>{{ $obra->obra_fechafin }}</p>
                        <p class="card-text"><b>Descripción: </b>{{ $obra->obra_observaciones }}</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
                <div class="col-4"  id="img">
                    {{-- <img src="{{ url("imagen/verObra.jpg") }}" class="img-fluid"> --}}
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
</div>
@endsection
@section('js')

@endsection
@section('css')
<style>
    #img{
  /* Asignamos una altura mínima */
  min-height: 400px;
  
  background-image: url('{{ url("imagen/verObra.jpg") }}');
  background-size: cover;
  background-position: center;
}
</style>
@endsection
