@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Nómina <small></small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">Layout</li> --}}
    <li class="breadcrumb-item active">Inicio</li>
    <img src="{{url('imagen/bandera-panama.png') }}" width="30" height="20" alt="Sistema de Panamá" style="margin-left: 10px; margin-top:4px;">
@endsection

@section('contenedor')
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-4">
        @if ( $permisoUsuario->crear_suministros )
            <div class="info-box" data-toggle="modal" data-target="#crearSuministro">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file-invoice"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">CARGAR UNA</span>
                    <span class="info-box-number">
                    NOMINA
                    <small></small>
                    </span>
                </div>
            <!-- /.info-box-content -->
            </div>
        @endif
        @if ( $permisoUsuario->reactivar_suministros )
            <a href="{{ route("nomina.deshabilitadas") }}">
                <div class="info-box">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-arrow-alt-circle-left"></i></span>

                    <div class="info-box-content" style="color:black;">
                        <span class="info-box-text">CONSULTAR NOMINAS</span>
                        <span class="info-box-number">
                        DESHABILITADAS
                        <small></small>
                        </span>
                    </div>
                <!-- /.info-box-content -->
                </div>
            </a>
        @endif
        </div>
        <div class="col-sm-12 col-md-8">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Lista de nómina</h3>
                </div>
                <!-- /.card-header -->
                  <div class="card-body">
                      <table id="listaNominas" class="table table-bordered table-hover display responsive no-wrap">
                      <thead>
                      <tr>
                          <th>Codigo</th>
                          <th>Nombre de nómina</th>
                          <th>Acción</th>

                      </tr>
                      </thead>
                      <tbody>

                      </tbody>
                      <tfoot>
                      <tr>
                          <th>Codigo</th>
                          <th>Nombre de nómina</th>
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

<div class="modal fade" id="crearSuministro" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Agregue una nómina</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{ route("nomina.guardar") }}" method="post">
            @csrf
            <div class="form-group">
                <label for="">Nombre de esta nómina</label>
                <input type="text" name="nomina" id="nombreNomina" class="form-control" maxlength="60" autocomplete="off" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="cerrar" data-dismiss="modal">Cerrar</button>
          <input type="submit" class="btn btn-primary" id="agregarNomina" value="Agregar" disabled>
        </div>
        </form>
      </div>
    </div>
</div>

<div class="modal fade" id="modificarNomina" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Modificar esta nómina</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{ route("nomina.modificar") }}" method="post">
            @csrf
            <div class="form-group">
                <label for="">Nombre de la nomina</label>
                <input type="text" name="nominaMod" id="nombreNominaMod" class="form-control" maxlength="60" autocomplete="off" placeholder="ESPERE......" required>
                <input type="hidden" name="dato" id="dato">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="cerrarMod" data-dismiss="modal">Cerrar</button>
          <input type="submit" class="btn btn-primary" id="agregarNominaMod" value="Modificar" disabled>
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
<script src="{{ asset("plugins/plugins/jszip/jszip.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/pdfmake/pdfmake.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/pdfmake/vfs_fonts.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-buttons/js/buttons.html5.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-buttons/js/buttons.print.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-buttons/js/buttons.colVis.min.js") }}"></script>
<script src="{{ asset("js/nomina/nomina.js") }}"></script>
@if (Session::has('sum'))
{{ Session::has('sum') }}
    @if (Session::has('sum') == true)
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
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-buttons/css/buttons.bootstrap4.min.css") }}">
@endsection
