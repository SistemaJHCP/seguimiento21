@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Bancos <small></small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">Layout</li> --}}
    <li class="breadcrumb-item active">Inicio</li>
    <img src="{{url('imagen/bandera-panama.png') }}" width="30" height="20" alt="Sistema de Venezuela" style="margin-left: 10px; margin-top:4px;">
@endsection

@section('contenedor')
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Lista de bancos</h3><button  data-toggle="modal" data-target="#cargarNuevoBanco" type="button" class="btn btn-info float-right">Crear nuevo banco</button>
            </div>
            <!-- /.card-header -->
              <div class="card-body">
                  <table id="listaBancos" class="table table-bordered table-hover display responsive no-wrap">
                  <thead>
                  <tr>
                      <th>Rif / Ruc</th>
                      <th>Nombre de bancos</th>
                      <th>Acción</th>
                  </tr>
                  </thead>
                  <tbody>

                  </tbody>
                  <tfoot>
                  <tr>
                      <th>Rif / Ruc</th>
                      <th>Nombre de bancos</th>
                      <th>Acción</th>
                  </tr>
                  </tfoot>
                  </table>
              </div>
            <!-- /.card-body -->
        </div>


          <div class="modal fade" id="cargarNuevoBanco" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="cargarNuevoBancoLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="cargarNuevoBancoLabel">Cargar un nuevo banco</h5>
                  <button type="button" class="close" id="cerrarCruz" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <form action="{{ route('banco.guardar') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Ingrese el Rif / Ruc de banco</label>
                        <input type="text" name="rif" id="rif" class="form-control" placeholder="Rif / Ruc" maxlength="20" autocomplete="off">
                        <label>Ingrese el nombre del banco</label>
                        <input type="text" name="nombreBanco" id="nombreBanco" class="form-control" placeholder="Ingrese el nombre" maxlength="40" autocomplete="off">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="cerrarNuevo" data-dismiss="modal">Cerrar</button>
                        <input type="submit" class="btn btn-primary"  id="cargar" value="Cargar banco">
                      </div>
                </form>
                </div>

              </div>
            </div>
          </div>

          <div class="modal fade" id="modificarBanco" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modificarBancoLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modificarBancoLabel">Modificar un banco</h5>
                  <button type="button" class="close" id="cerrarCruz" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <form action="{{ route('banco.modificar') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Ingrese el Rif / Ruc de banco</label>
                        <input type="text" name="rif" id="rifMod" class="form-control" placeholder="Rif / Ruc" maxlength="20" disabled autocomplete="off">
                        <label>Ingrese el nombre del banco</label>
                        <input type="text" name="nombreBanco" id="nombreBancoMod" class="form-control" placeholder="Ingrese el nombre" maxlength="40" disabled autocomplete="off">
                        <input type="hidden" name="dato" id="dato">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="cerrarMod" data-dismiss="modal">Cerrar</button>
                        <input type="submit" class="btn btn-primary" id="modificarValor" value="Modificar">
                      </div>
                </form>
                </div>

              </div>
            </div>
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
<script src="{{ asset("plugins/plugins/jszip/jszip.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/pdfmake/pdfmake.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/pdfmake/vfs_fonts.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-buttons/js/buttons.html5.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-buttons/js/buttons.print.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-buttons/js/buttons.colVis.min.js") }}"></script>
<script src="{{ asset("js/banco/banco.js") }}"></script>
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
