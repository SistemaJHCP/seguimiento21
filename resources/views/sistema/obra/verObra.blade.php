@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Consultar <small>obra</small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
    <li class="breadcrumb-item">Ver obra</li>
    <li class="breadcrumb-item active">Obra</li>
    <img src="{{url('imagen/bandera-panama.png') }}" width="30" height="20" alt="Sistema de Venezuela" style="margin-left: 10px; margin-top:4px;">
@endsection

@section('contenedor')
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="row" style="margin-bottom: 30px">
                <div class="col-md-8">

                    <div class="card">
                        <div class="card-body">
                            <h3>Nro. {{ $obra->obra_codigo }}  <a href="{{ route('obra.index') }}" style="font-size: 17px;" class="float-right btn btn-info">Regresar</a></h3><br>
                            <p class="card-text"><b>Tipo de trabajo: </b>{{ $obra->tipo_nombre }}</p>
                            <p class="card-text"><b>Cliente: </b>{{ $obra->cliente_nombre }}</p>
                            <p class="card-text"><b>Código PTC: </b>{{ $obra->codventa_codigo }}</p>
                            <p class="card-text"><b>Nombre: </b>{{ $obra->obra_nombre }}</p>
                            <p class="card-text"><b>Total planificado: </b>{{ $obra->obra_monto }}</p>
                            <p class="card-text"><b>Porcentaje de ganancia(%): </b>{{ $obra->obra_ganancia }}</p>
                            <p class="card-text"><b>Fecha de inicio: </b>{{ $obra->obra_fechainicio }}</p>
                            <p class="card-text"><b>Fecha finál: </b>{{ $obra->obra_fechafin }}</p>
                            <p class="card-text"><b>Descripción: </b>{{ $obra->obra_observaciones }}</p>

                            @foreach ($personal as $p)
                                <div class="info-box">
                                    <span class="info-box-icon bg-info"><i class="fas fa-user-alt"></i></span>

                                    <div class="info-box-content">
                                    <span class="info-box-text">{{ $p->personal_nombre }}</span>
                                    <span class="info-box-number">
                                        @if ($p->op_cargo == 1)
                                            Coordinador
                                        @else
                                            Residente
                                        @endif
                                    </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- /.card-body -->
                      </div>

                </div>
                <div class="col-md-4" id="img">

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
