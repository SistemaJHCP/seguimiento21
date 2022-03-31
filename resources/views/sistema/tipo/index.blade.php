@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Tipo <small> de obra</small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item">Home</li> --}}
    <li class="breadcrumb-item">Tipo de obra</li>
    <li class="breadcrumb-item active">Inicio</li>
@endsection

@section('contenedor')
<div class="row">
    <div class="col-md-4">
        @if ( $permisoUsuario->crear_tipo == 1 )
        <div class="info-box" data-toggle="modal" data-target="#staticBackdrop">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-building"></i></span>
            <div class="info-box-content" style="color:black;">
                <span class="info-box-text">CARGAR EL</span>
                <span class="info-box-number">
                TIPO DE OBRA
                <small></small>
                </span>
            </div>
        <!-- /.info-box-content -->
        </div>
        @endif
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Datos del tipo de obra</h3>
            </div>
            <!-- /.card-header -->
              <div class="card-body">
                  <table id="listaTipo" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                      <th>Código</th>
                      <th>Tipo</th>
                      <th style="width: 140px">Acción</th>
                  </tr>
                  </thead>
                  <tbody>

                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Código</th>
                    <th>Tipo</th>
                    <th style="width: 140px">Acción</th>
                  </tr>
                  </tfoot>
                  </table>
              </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Cargar el tipo de obra</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" id="cerrarCruz">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{ route('tipo.crear') }}" method="post">
            @csrf
            <div class="group">
                <label for="">Ingrese el nombre del tipo de obra</label>
                <input type="text" name="tipo" id="tipo" class="form-control" maxlength="80" placeholder="Ingrese el nombre" required autocomplete="off">
            </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrar">Cerrar</button>
          <input type="submit" value="Cargar tipo" class="btn btn-primary" id="agregar" disabled>
        </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="modificar" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Modificar el tipo de obra</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" id="cerrarCruzMod">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{ route('tipo.modificar') }}" method="post">
            @csrf
            <div class="group">
                <label for="">Ingrese el nombre del tipo de obra</label>
                <input type="text" name="tipoMod" id="tipoMod" class="form-control" maxlength="80" placeholder="espere por favor...." required autocomplete="off" disabled>
                <input type="hidden" name="dato" id="dato">
            </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrarMod">Cerrar</button>
          <input type="submit" value="Modificar tipo" class="btn btn-primary" id="agregarMod" disabled>
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
<script src="{{ asset("js/tipo/tipo.js") }}"></script>
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
