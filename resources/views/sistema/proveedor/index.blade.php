@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Proveedores <small></small></h1>
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
              <h3 class="card-title">Totalidad de obras</h3><a href=""><button style="margin-left:10px;" class="btn btn-info float-right">Deshabilitadas</button></a> <a href=""><button style="margin-left:10px;" class="btn btn-info float-right">Nuevo</button></a>
            </div>
            <!-- /.card-header -->
              <div class="card-body">
                  <table id="listaProveedores" class="table table-bordered table-hover" style="font-size: 12px">
                  <thead>
                  <tr>
                      <th>Código</th>
                      <th>Tipo</th>
                      <th>Rif</th>
                      <th>Nombre</th>
                      <th>Teléfono</th>
                      <th>Correo</th>
                      <th>Contacto</th>
                      <th>Suministro</th>
                      <th style="width: 140px">Acción</th>
                  </tr>
                  </thead>
                  <tbody>

                  </tbody>
                  <tfoot>
                    <tr>
                        <th>Código</th>
                        <th>Tipo</th>
                        <th>Rif</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Contacto</th>
                        <th>Suministro</th>
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
@section('js')
<script src="{{ asset("plugins/plugins/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-responsive/js/dataTables.responsive.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-responsive/js/responsive.bootstrap4.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-buttons/js/dataTables.buttons.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-buttons/js/buttons.bootstrap4.min.js") }}"></script>
<script src="{{ asset("js/proveedores/proveedor.js") }}"></script>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}">
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}">
@endsection