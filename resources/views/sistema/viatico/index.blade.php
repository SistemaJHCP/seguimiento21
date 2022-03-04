@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Viáticos <small></small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">Layout</li> --}}
    <li class="breadcrumb-item active">Inicio</li>
@endsection

@section('contenedor')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Datos de los viáticos</h3>
            </div>
            <!-- /.card-header -->
              <div class="card-body">
                  <table id="listaViaticos1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th style="width: 40px">Acción</th>
                  </tr>
                  </thead>
                  <tbody>

                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Acción</th>
                  </tr>
                  </tfoot>
                  </table>
              </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-box" data-toggle="modal" data-target="#mostrarViatico">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-taxi"></i></span>
            <div class="info-box-content" style="color:black;">
                <span class="info-box-text">CARGAR UN</span>
                <span class="info-box-number">
                VIATICO
                <small></small>
                </span>
            </div>
        <!-- /.info-box-content -->
        </div>
    </div>
</div>

<div class="modal fade" id="mostrarViatico" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="mostrarViaticoLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="mostrarViaticoLabel">Cargar un nuevo viático</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{ route('viatico.guardar') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="">Viático</label>
                <input type="text" name="viatico" id="viatico" class="form-control" maxlength="90" placeholder="Ingrese el nombre del viatico" minlength="3" autocomplete="off">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrar">Cerrar</button>
          <input type="submit" class="btn btn-primary" value="Cargar viatico" id="cargar" disabled>
        </div>
        </form>
      </div>
    </div>
</div>

<div class="modal fade" id="modMaterial" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modMaterialLabel">Modificar este servicio</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="#" method="post">
            @csrf
            <div class="form-group">
                <label for="">Servicio</label>
                <input type="text" name="materiaModl" id="materialMod" class="form-control" maxlength="90" placeholder="Ingrese el nombre del material" minlength="3" autocomplete="off">
                <input type="hidden" name="dato" id="dato">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrarMod">Cerrar</button>
          <input type="submit" class="btn btn-primary" value="Modificar Servicio" id="cargarMod">
        </div>
        </form>
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
<script src="{{ asset("plugins/numeric/jquery.numeric.js") }}"></script>
<script src="{{ asset('js/viatico/viatico.js') }}"></script>
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
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}">
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}">
@endsection
