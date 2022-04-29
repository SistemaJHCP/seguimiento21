@extends('layouts.app')

@section('titulo')
    <h1 class="m-0">Obras</h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Layout</a></li> --}}
    <li class="breadcrumb-item active">Inicio</li>
    <img src="{{url('imagen/bandera-panama.png') }}" width="30" height="20" alt="Sistema de Venezuela" style="margin-left: 10px; margin-top:4px;">
@endsection

@section('contenedor')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Totalidad de obras</h3><a href="{{ route('obra.reactivar') }}"><button style="margin-left:10px;" class="btn btn-info float-right">Deshabilitadas</button></a> <a href="{{ route('obra.crear') }}"><button style="margin-left:10px;" class="btn btn-info float-right">Nuevo</button></a>
            </div>
            <!-- /.card-header -->
              <div class="card-body">
                  <table id="listaObras" class="table table-bordered table-hover" style="font-size: 12px">
                  <thead>
                  <tr>
                      <th>Control</th>
                      <th>Tipo</th>
                      <th>Cliente</th>
                      <th>Codventa</th>
                      <th>Nombre</th>
                      <th>Inicio</th>
                      <th>Fín</th>
                      <th>Monto</th>
                      <th style="width: 140px">Acción</th>

                  </tr>
                  </thead>
                  <tbody>

                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Control</th>
                    <th>Tipo</th>
                    <th>Cliente</th>
                    <th>Codventa</th>
                    <th>Nombre</th>
                    <th>Inicio</th>
                    <th>Fín</th>
                    <th>Monto</th>
                      <th>Acción</th>
                  </tr>
                  </tfoot>
                  </table>
              </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}">
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}">
@endsection
@section('js')
<script src="{{ asset("plugins/plugins/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-responsive/js/dataTables.responsive.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-responsive/js/responsive.bootstrap4.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-buttons/js/dataTables.buttons.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-buttons/js/buttons.bootstrap4.min.js") }}"></script>
<script src="{{ asset("js/obra/obra.js") }}"></script>

@if (Session::has('obra'))

    @if (Session::has('obra'))
    <script>
        Swal.fire(
        'Solicitud procesada!',
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

