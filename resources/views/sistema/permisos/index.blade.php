@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Permisos <small>de usuarios</small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">Layout</li> --}}
    <li class="breadcrumb-item active">Inicio</li>
    <img src="{{url('imagen/bandera_vzla.png') }}" width="30" height="20" alt="Sistema de Venezuela" style="margin-left: 10px; margin-top:4px;">
@endsection
@section('contenedor')
<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Datos del personal</h3> <a href="{{ route('permisos.crear') }}"><button class="float-right btn btn-info">Crear permisos</button></a>
        </div>
        <!-- /.card-header -->
          <div class="card-body">
              <table id="listaPermisos" class="table table-bordered table-hover">
              <thead>
              <tr>
                  <th>ID</th>
                  <th>Nombre del permiso</th>
                  <th>Accion</th>
              </tr>
              </thead>
              <tbody  style="text-transform: capitalize !important;">

              </tbody>
              <tfoot>
              <tr>
                <th>ID</th>
                <th>Nombre del permiso</th>
                <th>Accion</th>
              </tr>
              </tfoot>
              </table>
          </div>
        <!-- /.card-body -->
    </div>
</div>
<div class="col-md-2"></div>
</div>



@endsection
@section('js')
<script src="{{ asset("plugins/plugins/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-responsive/js/dataTables.responsive.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-responsive/js/responsive.bootstrap4.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-buttons/js/dataTables.buttons.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-buttons/js/buttons.bootstrap4.min.js") }}"></script>
<script src="{{ asset("js/permisos/permiso.js") }}"></script>
@if (Session::has('resp'))

    @if (Session::has('resp'))
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


@endif
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}">
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}">
@endsection
