@extends('layouts.app')

@section('titulo')
    <h1 class="m-0">Reactivar <small>PTC</small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item">Home</li> --}}
    <li class="breadcrumb-item">Reactivar</li>
    <li class="breadcrumb-item active">Inicio</li>
@endsection

@section('contenedor')
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Datos del PTC</h3> <a href="{{ route('maestro.index') }}"><button type="button" class="btn btn-info float-right"><i class="fas fa-arrow-left"></i> Regresar</button></a>
            </div>
            <!-- /.card-header -->
              <div class="card-body">
                  <table id="listaPTC" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                      <th>Código PTC</th>
                      <th>Nombre</th>
                      <th>Código</th>
                      <th style="width: 140px">Acción</th>

                  </tr>
                  </thead>
                  <tbody>

                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Código PTC</th>
                    <th>Nombre</th>
                    <th>Código</th>
                    <th>Acción</th>
                  </tr>
                  </tfoot>
                  </table>
              </div>
            <!-- /.card-body -->
          </div>
    </div>
    <div class="col-md-1"></div>
</div>
@endsection
@section('js')
<script src="{{ asset("plugins/plugins/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-responsive/js/dataTables.responsive.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-responsive/js/responsive.bootstrap4.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-buttons/js/dataTables.buttons.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-buttons/js/buttons.bootstrap4.min.js") }}"></script>
<script src="{{ asset("plugins/numeric/jquery.numeric.js") }}"></script>
<script src="{{ asset("js/maestro/reactivarPTC.js") }}"></script>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}">
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}">
@endsection
