@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Usuarios <small>Inhabilitados</small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
    <li class="breadcrumb-item">Inhabilitados</li>
    <li class="breadcrumb-item">Inicio</li>
@endsection

@section('contenedor')
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Usuarios desactivados</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="listaDeshabilitar" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>Nombre de usuario</th>
                      <th>Correo</th>
                      <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Nombre de usuario</th>
                        <th>Correo</th>
                        <th>Acción</th>
                    </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
        </div>
    </div>
</div>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}">
    <link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}">
    <link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-buttons/css/buttons.bootstrap4.min.css") }}">
    <link rel="stylesheet" href="{{ asset("plugins/plugins/fontawesome-free/css/all.css") }}">
@endsection
@section('js')
    <script src="{{ asset("plugins/plugins/datatables/jquery.dataTables.min.js") }}"></script>
    <script src="{{ asset("plugins/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") }}"></script>
    <script src="{{ asset("plugins/plugins/datatables-responsive/js/dataTables.responsive.min.js") }}"></script>
    <script src="{{ asset("plugins/plugins/datatables-responsive/js/responsive.bootstrap4.min.js") }}"></script>
    <script src="{{ asset("plugins/plugins/datatables-buttons/js/dataTables.buttons.min.js") }}"></script>
    <script src="{{ asset("plugins/plugins/datatables-buttons/js/buttons.bootstrap4.min.js") }}"></script>
    <script src="{{ asset("js/usuarios/deshabilitar.js") }}"></script>
@endsection
