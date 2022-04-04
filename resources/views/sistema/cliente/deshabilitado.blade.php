@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Rehabilitar <small>cliente</small></h1>
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
    <div class="col-md-8">    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Datos de clientes</h3><a href="{{ route('cliente.index') }}"><button type="button" class="btn btn-info float-right"><i class="fas fa-arrow-left"></i> Regresar</button></a>
        </div>
        <!-- /.card-header -->
          <div class="card-body">
              <table id="listaClientes" class="table table-bordered table-hover">
              <thead>
              <tr>
                  <th>Código de cliente</th>
                  <th>RIF</th>
                  <th>Nombre</th>
                  <th>Acción</th>

              </tr>
              </thead>
              <tbody>

              </tbody>
              <tfoot>
              <tr>
                  <th>Código de cliente</th>
                  <th>RIF</th>
                  <th>Nombre</th>
                  <th>Acción</th>
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
<script src="{{ asset("plugins/numeric/jquery.numeric.js") }}"></script>
<script src="{{ asset("js/clientes/rehabilitar.js") }}"></script>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}">
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}">
@endsection
