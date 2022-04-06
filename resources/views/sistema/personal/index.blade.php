@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Personal <small></small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">Layout</li> --}}
    <li class="breadcrumb-item active">Inicio</li>
    <img src="{{url('imagen/bandera-panama.png') }}" width="30" height="20" alt="Sistema de Venezuela" style="margin-left: 10px; margin-top:4px;">
@endsection

@section('contenedor')
    <div class="row">
        <div class="col-md-4">
            @if ( $permisoUsuario->crear_personal == 1 )
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
            @endif
            @if ( $permisoUsuario->reactivar_personal == 1 )
            <a href="{{ route('personal.reactivar') }}">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content" style="color:black;">
                        <span class="info-box-text">REACTIVAR </span>
                        <span class="info-box-number">
                        PERSONAL
                        <small></small>
                        </span>
                    </div>
                <!-- /.info-box-content -->
                </div>
            </a>
            @endif
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Datos del personal</h3>
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
                      <tbody  style="text-transform: capitalize !important;">

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
                <span aria-hidden="true" id="cerrarCruz">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('personal.crear') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="">Nombre del personal</label>
                <input type="text" name="personal" id="personal" class="form-control" maxlength="80" placeholder="Ingrese el nombre del personal">
            </div>
            <div class="form-group">
                <label for="">Indique su profesion</label>
                <select name="profesion" id="profesion" class="form-control">
                    <option value="">Seleccione...</option>
                    @foreach ($profesion as $p)
                        <option value="{{ $p->profesion }}">{{ $p->profesion }}</option>
                    @endforeach
                </select>
            </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" id="cerrar" data-dismiss="modal">Cerrar</button>
              <input type="submit" class="btn btn-primary" id="agregar" value="Cargar personal" disabled>
            </form>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="modificarPersonal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modificarPersonalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modificarPersonalLabel">Modificar al personal</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" id="cerrarCruzMod">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('personal.modificar') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="">Modificar el nombre del personal</label>
                <input type="text" name="personalMod" id="personalMod" disabled class="form-control" maxlength="80" placeholder="Ingrese el nombre del personal">
                <input type="hidden" name="dato" id="dato">
            </div>
            <div class="form-group">
                <label for="">Indique su profesion</label>
                <select name="profesionMod" id="profesionMod" class="form-control" disabled>
                    <option value="">Seleccione...</option>
                    @foreach ($profesion as $p)
                        <option value="{{ $p->profesion }}">{{ $p->profesion }}</option>
                    @endforeach
                </select>
            </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" id="cerrarMod" data-dismiss="modal">Cerrar</button>
              <input type="submit" class="btn btn-primary" id="agregarMod" value="Modificar un personal" disabled>
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
@section('css')
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}">
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}">
@endsection
