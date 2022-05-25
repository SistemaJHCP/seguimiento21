@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Cuentas <small>bancarias de JHCP</small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">Layout</li> --}}
    <li class="breadcrumb-item active">Inicio</li>
    <img src="{{url('imagen/bandera_vzla.png') }}" width="30" height="20" alt="Sistema de Venezuela" style="margin-left: 10px; margin-top:4px;">
@endsection

@section('contenedor')
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Lista de cuentas de JHCP</h3><button  data-toggle="modal" data-target="#cargarNuevaCuentaJHCP" type="button" class="btn btn-info float-right">Cargar nueva cuenta JHCP</button>
            </div>
            <!-- /.card-header -->
              <div class="card-body">
                  <table id="listaEmpresa" class="table table-bordered table-hover display responsive no-wrap">
                  <thead>
                  <tr>
                      <th>Tipo de cuenta</th>
                      <th>Número de cuenta</th>
                      <th>Monto inicial</th>
                      <th>Banco</th>
                      <th>Acción</th>
                  </tr>
                  </thead>
                  <tbody>

                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Tipo de cuenta</th>
                    <th>Número de cuenta</th>
                    <th>Monto inicial</th>
                    <th>Banco</th>
                    <th>Acción</th>
                  </tr>
                  </tfoot>
                  </table>
              </div>
            <!-- /.card-body -->
          </div>


          <div class="modal fade" id="cargarNuevaCuentaJHCP" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="cargarNuevaCuentaJHCPLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="cargarNuevaCuentaJHCPLabel">Cargar información de cuentas de JHCP</h5>
                  <button type="button" class="close" id="cerrarCruz" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <form action="{{ route('cuenta.guardar') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Seleccione el tipo de cuenta</label>
                        <select name="tipo_cuenta" id="tipo_cuenta" class="form-control" required>
                            <option value="">Seleccione...</option>
                            <option value="Corriente">Corriente</option>
                            <option value="Ahorro">Ahorro</option>
                            <option value="Tarjeta">Tarjeta</option>
                        </select>
                        <label>Número de cuenta</label>
                        <input type="text" name="num_cuenta" id="num_cuenta" class="form-control" placeholder="Ingrese el número de cuenta" maxlength="20" autocomplete="off" required>
                        <label>Indique el monto inicial</label>
                        <input type="text" name="monto_inicial" id="monto_inicial" class="form-control" placeholder="Ingrese el monto inicial" maxlength="14" autocomplete="off" required>
                        <label>Seleccione el banco</label>
                        <select name="nombre_banco" id="nombre_banco" class="form-control" required>
                            <option value="">Seleccione...</option>
                            @foreach ($banco_nombres as $ban)
                                <option value="{{ $ban->id }}">{{ $ban->banco_nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="cerrarCuenta" data-dismiss="modal">Cerrar</button>
                        <input type="submit" class="btn btn-primary"  id="cargar" value="Cargar cuenta">
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
                    <form action="{{ route('cuenta.guardando') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Seleccione el tipo de cuenta</label>
                            <select name="tipo_cuenta" id="tipo_cuenta_MOD" class="form-control" required disabled>
                                <option value="">Seleccione...</option>
                                <option value="Corriente">Corriente</option>
                                <option value="Ahorro">Ahorro</option>
                                <option value="Tarjeta">Tarjeta</option>
                            </select>
                            <label>Número de cuenta</label>
                            <input type="text" name="num_cuenta" id="num_cuenta_MOD" class="form-control" placeholder="Ingrese el número de cuenta" maxlength="20" autocomplete="off" required disabled>
                            <label>Indique el monto inicial</label>
                            <input type="text" name="monto_inicial" id="monto_inicial_MOD" class="form-control" placeholder="Ingrese el monto inicial" maxlength="14" autocomplete="off" required disabled>
                            <label>Seleccione el banco</label>
                            <select name="nombre_banco" id="nombre_banco_MOD" class="form-control" required disabled>
                                <option value="">Seleccione...</option>
                                @foreach ($banco_nombres as $ban)
                                    <option value="{{ $ban->id }}">{{ $ban->banco_nombre }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="dato" id="dato">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="cerrarCuentaMod" data-dismiss="modal">Cerrar</button>
                            <input type="submit" class="btn btn-primary"  id="modificarCuent" value="Modificar cuenta">
                          </div>
                    </form>
                </div>

              </div>
            </div>
          </div>

    </div>
    <div class="col-md-1"></div>
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
<script src="{{ asset("plugins/numeric/jquery.numeric.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-buttons/js/buttons.html5.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-buttons/js/buttons.print.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-buttons/js/buttons.colVis.min.js") }}"></script>
<script src="{{ asset("js/banco/empresa/empresa.js") }}"></script>
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
