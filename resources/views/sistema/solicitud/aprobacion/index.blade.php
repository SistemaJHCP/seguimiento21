@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Solicitudes  <small>de pago</small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">Layout</li> --}}
    <li class="breadcrumb-item active">Inicio</li>
@endsection

@section('contenedor')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Solicitudes</h3>
            </div>
            <div class="card-body">
                <table id="listaSolicitud" class="table table-bordered table-hover" style="font-size: 12px">
                <thead>
                <tr>

                  <th>Código</th>
                  <th>Fecha</th>
                  <th>motivo</th>
                  <th>estado</th>
                  <th>Solicitante</th>
                  <th>Acción</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                <tr>

                  <th>Código</th>
                  <th>fecha</th>
                  <th>motivo</th>
                  <th>estado</th>
                  <th>Solicitante</th>
                  <th>Acción</th>
                </tr>
                </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset("plugins/plugins/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-responsive/js/dataTables.responsive.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-responsive/js/responsive.bootstrap4.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-buttons/js/dataTables.buttons.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-buttons/js/buttons.bootstrap4.min.js") }}"></script>
<script src="{{ asset("js/solicitud/aprobacion.js") }}"></script>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}">
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}">
@endsection
