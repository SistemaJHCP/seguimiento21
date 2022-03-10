@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Solicitud  <small>de cuentas</small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item">Home</li> --}}
    <li class="breadcrumb-item">Cuentas por pagar</li>
    <li class="breadcrumb-item active">Inicio</li>
@endsection

@section('contenedor')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-2"><button class="btn btn-info btn-block d-none d-sm-none d-md-block menu2" value="1">Todas las solicitudes</button></div>
                    <div class="col-md-2"><button class="btn btn-info btn-block d-none d-sm-none d-md-block menu2" value="2">Sin respuesta </button></div>
                    <div class="col-md-2"><button class="btn btn-info btn-block d-none d-sm-none d-md-block menu2" value="3">Solicitud por pagar </button></div>
                    <div class="col-md-2"><button class="btn btn-info btn-block d-none d-sm-none d-md-block menu2" value="4">Solicitudes pagadas </button></div>
                    <div class="col-md-2"><button class="btn btn-info btn-block d-none d-sm-none d-md-block menu2" value="5">Rechazadas </button></div>
                    <div class="col-md-2">
                        <select class="d-block d-sm-block d-md-none menu float-right form-control">
                            <option value="">Seleccione...</option>
                            <option value="1">Todas las solicitudes</option>
                            <option value="2">Sin respuesta</option>
                            <option value="3">Solicitud por pagar</option>
                            <option value="4">Solicitudes pagadas</option>
                            <option value="5">Solicitudes rechazadas</option>
                            <option value="6">Solicitudes anuladas</option>
                        </select>
                        <button class="btn btn-info btn-block d-none d-sm-none d-md-block menu2" value="6">Anuladas </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="listaCuenta" class="table table-bordered table-hover" style="font-size: 12px">
                <thead>
                <tr>

                  <th>Código</th>
                  <th>Fecha</th>
                  <th>Nombre de la obra</th>
                  <th>Motivo de solicitud</th>
                  <th>Estado</th>
                  <th>Pago</th>
                  <th>Solicitante</th>
                  <th>Acción</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                <tr>

                  <th>Código</th>
                  <th>Fecha</th>
                  <th>Nombre de la obra</th>
                  <th>Motivo de solicitud</th>
                  <th>Estado</th>
                  <th>Pago</th>
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
<script src="{{ asset("js/solicitud/cuenta/cuenta.js") }}"></script>

@if (Session::has('respApro'))
    @if (Session::has('respApro'))
    <script>
        Swal.fire(
        'Sulicitud procesada!',
        'Se ha aprobado la solicitud!',
        'success'
        )
    </script>
    @else
    <script>
        Swal.fire(
        'No se cargo la información!',
        'No se pudo guardar en el sistema',
        'error'
        )
    </script>
    @endif
@endif

@if (Session::has('respNega'))
    @if (Session::has('respNega'))
    <script>
        Swal.fire(
        'Sulicitud procesada!',
        'Se ha rechazado la solicitud de manera exitosa!',
        'warning'
        )
    </script>
    @else
    <script>
        Swal.fire(
        'No se cargo la información!',
        'No se pudo guardar en el sistema',
        'error'
        )
    </script>
    @endif
@endif


@endsection
@section('css')
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}">
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}">
@endsection
