@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Maestro <small>PTC</small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Layout</a></li> --}}
    <li class="breadcrumb-item active">Inicio</li>
@endsection

@section('contenedor')
<div class="row">
    <div class="col-md-4">
        <div class="info-box" data-toggle="modal" data-target="#crearPTC">
            <span class="info-box-icon bg-info elevation-1"><i class="far fa-address-book"></i></span>
            <div class="info-box-content" style="color:black;">
                <span class="info-box-text">CARGAR UNA</span>
                <span class="info-box-number">
                PTC
                <small></small>
                </span>
            </div>
        <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Datos del PTC</h3>
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
</div>

<div class="modal fade" id="crearPTC" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="crearPTCLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="crearPTCLabel">Crear una propuesta técnica comercial</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('maestro.crear') }}" method="post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Código de PTC</label>
                    <input type="text" name="codigoPTC" id="codigoPTC" class="form-control" placeholder="Ingrese el código de PTC" maxlength="22">
                </div>
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombrePTC" id="nombrePTC" class="form-control" placeholder="Ingrese las caracteristicas" maxlength="100">
                </div>
                <div class="form-group">
                    <label>Teléfono</label>
                    <input type="text" name="telefonoPTC" id="telefonoPTC" class="form-control" placeholder="Ingrese teléfono de contacto" maxlength="40">
                </div>
                <div class="form-group">
                    <label>Dirección</label>
                    <input type="text" name="direccionPTC" id="direccionPTC" class="form-control" placeholder="Ingrese la dirección" maxlength="220">
                </div>
                <div class="form-group">
                    <label>Correo electrónico</label>
                    <input type="text" name="correoPTC" id="correoPTC" class="form-control" placeholder="Ingrese el correo electrónico" maxlength="60">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <input type="submit" id="cargar" class="btn btn-primary" value="Cargar una PTC" disabled>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@section('js')
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}">
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}">
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
<script src="{{ asset("plugins/plugins/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-responsive/js/dataTables.responsive.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-responsive/js/responsive.bootstrap4.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-buttons/js/dataTables.buttons.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-buttons/js/buttons.bootstrap4.min.js") }}"></script>
<script src="{{ asset("js/maestro/ptc.js") }}"></script>
@endsection


