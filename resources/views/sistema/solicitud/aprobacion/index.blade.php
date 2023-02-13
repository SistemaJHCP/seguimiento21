@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Solicitudes  <small>de pago</small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">Layout</li> --}}
    <li class="breadcrumb-item active">Inicio</li>
    <img src="{{url('imagen/bandera_vzla.png') }}" width="30" height="20" alt="Sistema de Venezuela" style="margin-left: 10px; margin-top:4px;">
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
                  <th>Obra</th>
                  <th>Fecha</th>
                  <th>Motivo</th>
                  <th>Estado</th>
                  <th>Pago</th>
                  <th>Solicitante</th>
                  <th class="float-right">Monto</th>
                  <th>Acción</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                <tr>

                  <th>Código</th>
                  <th>Obra</th>
                  <th>fecha</th>
                  <th>Motivo</th>
                  <th>Estado</th>
                  <th>Pago</th>
                  <th>Solicitante</th>
                  <th>Monto</th>
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
<script src="{{ asset("plugins/plugins/toastr/toastr.min.js") }}"></script>
<script src="{{ asset("js/solicitud/aprobacion.js") }}"></script>

@if (Session::has('respApro'))
    @if (Session::has('respApro'))
    <script>
        $(document).Toasts('create', {
            class: 'bg-success',
            title: 'Solicitud aprobada',
            body: 'Se ha aprobado la solicitud.',
            autohide: true,
            delay: 1600,
        });
    </script>
    @else
    <script>
        $(document).Toasts('create', {
            class: 'bg-danger',
            title: 'Hubo un problema',
            body: 'hubo un error en guardar la información.',
            autohide: true,
            delay: 1600,
        });
    </script>
    @endif
@endif

@if (Session::has('respNega'))
    @if (Session::has('respNega'))
    <script>
        $(document).Toasts('create', {
            class: 'bg-warning',
            title: 'Solicitud rechazada',
            body: 'No fue aprobada esta solicitud.',
            autohide: true,
            delay: 1600,
        });
    </script>
    @else
    <script>
        $(document).Toasts('create', {
            class: 'bg-danger',
            title: 'Hubo un problema',
            body: 'hubo un error en guardar la información.',
            autohide: true,
            delay: 1600,
        });
    </script>
    @endif
@endif


@endsection
@section('css')
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}">
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}">
@endsection
