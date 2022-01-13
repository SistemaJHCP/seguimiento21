@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Personal <small></small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">Layout</li> --}}
    <li class="breadcrumb-item active">Inicio</li>
@endsection

@section('contenedor')
    <div class="row">
        <div class="col-md-4">
            <div class="info-box" data-toggle="modal" data-target="#cargarPersonal">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-plus"></i></span>
                <div class="info-box-content" style="color:black;">
                    <span class="info-box-text">CARGAR </span>
                    <span class="info-box-number">
                    PERSONAL
                    <small></small>
                    </span>
                </div>
            <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Datos del tipo de obra</h3>
                </div>
                <!-- /.card-header -->
                  <div class="card-body">
                      <table id="listaPersonal" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                          <th>Código</th>
                          <th>Nombre del personal</th>
                          <th>profesión</th>
                          <th style="width: 140px">Acción</th>
                      </tr>
                      </thead>
                      <tbody>

                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Código</th>
                        <th>Nombre del personal</th>
                        <th>profesión</th>
                        <th style="width: 140px">Acción</th>
                      </tr>
                      </tfoot>
                      </table>
                  </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>



    <div class="modal fade" id="cargarPersonal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="cargarPersonalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="cargarPersonalLabel">Cargar personal</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="" method="post">
            @csrf
            <div class="form-group">
                <label for=""></label>
            </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary">Cargar personal</button>
            </form>
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
<script src="{{ asset("js/personal/personal.js") }}"></script>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}">
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}">
@endsection
