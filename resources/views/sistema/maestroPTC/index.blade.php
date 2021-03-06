@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Maestro <small>PTC</small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Layout</a></li> --}}
    <li class="breadcrumb-item active">Inicio</li>
    <img src="{{url('imagen/bandera-panama.png') }}" width="30" height="20" alt="Sistema de Venezuela" style="margin-left: 10px; margin-top:4px;">
@endsection

@section('contenedor')
<div class="row">
    <div class="col-md-4">
        @if ($permisoUsuario->crear_ptc == 1)
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
        @endif
        @if ($permisoUsuario->reactivar_ptc == 1)
            <a href="{{ route('maestro.reactivar') }}">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-undo"></i></span>
                    <div class="info-box-content" style="color:black;">
                        <span class="info-box-text">REACTIVAR</span>
                        <span class="info-box-number">
                        PTC
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
              <h3 class="card-title">Datos del PTC</h3>
            </div>
            <!-- /.card-header -->
              <div class="card-body">
                  <table id="listaPTC" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                      <th>C??digo PTC</th>
                      <th>Nombre</th>
                      <th>C??digo</th>
                      <th style="width: 140px">Acci??n</th>

                  </tr>
                  </thead>
                  <tbody>

                  </tbody>
                  <tfoot>
                  <tr>
                    <th>C??digo PTC</th>
                    <th>Nombre</th>
                    <th>C??digo</th>
                    <th>Acci??n</th>
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
          <h5 class="modal-title" id="crearPTCLabel">Crear una propuesta t??cnica comercial</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('maestro.crear') }}" method="post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>C??digo de PTC</label>
                    <input type="text" name="codigoPTC" id="codigoPTC" style="text-transform: uppercase;" class="form-control" placeholder="Ingrese el c??digo de PTC" maxlength="22" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombrePTC" id="nombrePTC" class="form-control" placeholder="Ingrese las caracteristicas" maxlength="100" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Tel??fono</label>
                    <input type="text" name="telefonoPTC" id="telefonoPTC" class="form-control" placeholder="Ingrese tel??fono de contacto" maxlength="12" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Direcci??n</label>
                    <input type="text" name="direccionPTC" id="direccionPTC" class="form-control" placeholder="Ingrese la direcci??n" maxlength="220" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Correo electr??nico</label>
                    <input type="text" name="correoPTC" id="correoPTC" class="form-control" placeholder="Ingrese el correo electr??nico" maxlength="60" autocomplete="off">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="cerrar" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
        'Solicitud procesada!',
        'La informaci??n fue cargada exitosamente!',
        'success'
        )
    </script>
    @else
    <script>
        Swal.fire(
        'No se cargo la informaci??n!',
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
<script src="{{ asset("plugins/numeric/jquery.numeric.js") }}"></script>
<script src="{{ asset("js/maestro/ptc.js") }}"></script>
@endsection
@section('js')
<script>
@if (Session::has('resp'))
{{ Session::has('resp') }}
    @if (Session::has('resp') == 1)
    <script>
        Swal.fire(
        'Solicitud procesada!',
        'La informaci??n fue cargada exitosamente!',
        'success'
        )
    </script>
    @else
    <script>
        Swal.fire(
        'No se cargo la informaci??n!',
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
</script>
@endsection


