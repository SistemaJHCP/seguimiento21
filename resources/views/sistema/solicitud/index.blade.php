@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Listado <small> de solicitud</small></h1>
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
                <h3 class="card-title">Solicitudes</h3> <a href="{{ route('solicitud.crear') }}"><button style="margin-left:10px;" class="btn btn-info float-right">Nueva solicitud</button></a>
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
<script src="{{ asset("js/solicitud/solicitud.js") }}"></script>
@if (Session::has('resp'))
{{ Session::has('resp') }}
    @if (Session::has('resp') == 1)
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

@if (Session::has('mod'))
{{ Session::has('mod') }}
    @if (Session::has('mod') == 1)
    <script>
        Swal.fire(
        'Modificación procesada!',
        'La información fue modificada exitosamente!',
        'success'
        )
    </script>
    @else
    <script>
        Swal.fire(
        'No se cargo la información!',
        'Hubo un error al modificar los datos',
        'error'
        )
    </script>
    @endif
@endif

@if (Session::has('edit'))
    <script>
        Swal.fire(
        'No se cargo la información!',
        'Usted no creó esta solicitud',
        'error'
        )
    </script>
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
