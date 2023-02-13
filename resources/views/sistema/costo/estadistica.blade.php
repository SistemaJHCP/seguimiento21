@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Estadistica <small></small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item">Home</li> --}}
    <li class="breadcrumb-item">Estadistica</li>
    <li class="breadcrumb-item active">Control de gastos</li>
    <img src="{{url('imagen/bandera_vzla.png') }}" width="30" height="20" alt="Sistema de Venezuela" style="margin-left: 10px; margin-top:4px;">
@endsection

@section('contenedor')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="historigrama-tab" data-toggle="tab" href="#historigrama" role="tab" aria-controls="historigrama" aria-selected="true">Histograma de gastos</a>
                    </li>
                    <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Gastos, anticipos y valuaciones</a>
                    </li>
                    <li class="nav-item" role="presentation">
                    <a class="nav-link" id="historico-tab" data-toggle="tab" href="#historico" role="tab" aria-controls="historico" aria-selected="false">Leyenda de datos</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active horizontal-scroll-contenedor" id="historigrama" role="tabpanel" aria-labelledby="historigrama-tab">
                        <div class="card-body">
                            <div id="chartdiv"></div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card-body" style="margin: 4px, 4px; padding: 4px; overflow-x: auto; white-space: nowrap;">
                            {{-- <div id="chartdiv2"></div> --}}
                            <canvas id="myChart" style="width:100%;max-width:700px;"></canvas>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="historico" role="tabpanel" aria-labelledby="historico-tab">
                        <div class="table-responsive" style="overflow: auto; max-height:400px;">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Semanas</th>
                                        <th>Fecha inicial</th>
                                        <th>Fecha final</th>
                                        <th>Gastos</th>
                                        <th>Valuacion</th>
                                        <th>Resultado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($arreglo as $arr)
                                    <tr>
                                        <td>{{ $arr['semana'] }}</td>
                                        <td>{{ $arr['fecha_inicial'] }}</td>
                                        @if ($arr['incremento'] <= $arr['fecha_final'])
                                            <td>{{ $arr['incremento'] }}</td>
                                        @else
                                            <td>{{ $arr['fecha_final'] }}</td>
                                        @endif
                                        <td>{{ $arr['gasto'] }}</td>
                                        <td>{{ $arr['valuacion'] }}</td>
                                        <td>{{ $arr['suma'] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-info card-outline">
            <div class="card-body">
                <div class="card-header">
                    <h3 class="card-title">Datos de la obra seleccionada</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                <table class="table">
                    <tbody>
                    <tr>
                        <td style="width:50px">Nro: </td><td>{{ $obra->obra_codigo }}</td>
                    </tr>
                    <tr>
                        <td style="width:50px">Cliente: </td><td>{{ $obra->cliente_nombre }}</td>
                    </tr>
                    <tr>
                        <td style="width:50px">Nombre: </td><td>{{ $obra->obra_nombre }}</td>
                    </tr>
                    <tr>
                        <td style="width:50px">Presupuesto: </td><td>{{ $obra->obra_monto }}</td>
                    </tr>
                    <tr>
                        <td style="width:50px">Anticipo: </td><td>{{ $obra->obra_anticipo }}</td>
                    </tr>
                    <tr>
                        <td style="width:50px" colspan="2">
                            <div class="row">
                                <div class="col-md-6" style="border:1px solid white; background: #17a2b8; color: white;">Inicio de obra:<br>{{ $obra->obra_fechainicio }}</div>
                                <div class="col-md-6" style="border:1px solid white; background: #17a2b8; color: white;">Fín de obra:<br>{{ ($obra->obra_fechafin) ? $obra->obra_fechafin : "-- Sin definir --" }}</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><a href="{{ route('costosObra.index')}}"><button type="button" class="btn btn-info btn-lg btn-block"><i class="fas fa-arrow-left"></i> Regresar</button></a></td>
                    </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/version/5.2.8/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/version/5.2.8/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/version/5.2.8/themes/Animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/version/5.2.8/locales/es_ES.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>


    <script src="{{ asset("js/costo/estadistica.js") }}"></script>
    <script>
        estadistica( {{ $obra->id }} );
        laguna( {{ $obra->id }} );
        $(".horizontal-scroll-contenedor").scrollLeft(200)
    </script>
@endsection
@section('css')
<style>
    #chartdiv {
      width: 100%;
      height: 400px;
    }

    #chartdiv2 {
      width: 100%;
      height: 400px;
    }
</style>
@endsection


