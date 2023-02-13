@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Requisiciones <small></small></h1>
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
                <h3 class="card-title">Todas las requisiciones</h3>
                @if ($permisoUsuario->crear_requisicion == 1)
                <a href="{{ route('requisicion.crear') }}"><button style="margin-left:10px;" class="btn btn-info float-right">Nueva requisición</button></a>
                @endif
            </div>
            <div class="card-body">
                <table id="listaObras" class="table table-bordered table-hover" style="font-size: 12px">
                <thead>
                <tr>

                    <th>Código</th>
                    <th>Tipo</th>
                    <th>Emisión</th>
                    <th>Entrega</th>
                    <th>Obra</th>
                    <th>Motivo</th>
                    <th>Estado</th>
                    <th>Creado por</th>
                    <th style="width: 140px">Acción</th>

                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                <tr>

                  <th>Código</th>
                  <th>Tipo</th>
                  <th>Emisión</th>
                  <th>Entrega</th>
                  <th>Obra</th>
                  <th>Motivo</th>
                  <th>Estado</th>
                  <th>Creado por</th>
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
<script src="{{ asset("js/requerimiento/requerimientos.js") }}"></script>
@if (Session::has('resp'))
{{ Session::has('resp') }}
    @if (Session::has('resp') == true)
    <script>
        Swal.fire(
        'Sulicitud procesada!',
        'La información fue cargada exitosamente!',
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


@if (count($errors) > 0)
{{-- Este es el mensaje de error desde la validacion --}}
<script>
    Swal.fire(
    'Hubo un error!',
    'el formulario no esta correctamente cargado!',
    'error'
    )
</script>
@endif
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}">
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}">
@endsection
