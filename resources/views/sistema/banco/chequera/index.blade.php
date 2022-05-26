@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Chequera <small></small></h1>
@endsection
@section('navegador')
    <li class="breadcrumb-item">Chequera</li>
    <li class="breadcrumb-item">Cuenta</li>
    <li class="breadcrumb-item active">Banco</li>
    <img src="{{url('imagen/bandera_vzla.png') }}" width="30" height="20" alt="Sistema de Venezuela" style="margin-left: 10px; margin-top:4px;">
@endsection

@section('contenedor')
<div class="row">
<div class="col-md-12">
    <div class="card-footer" style="">
        <div class="row">
          <div class="col-sm-3 col-6">
            <div class="description-block border-right" style="border-right: 1px solid #8d929f80 !important;"> <!-- Rosman -->
              <small class="text-muted">{{ $banco->banco_rif }}</small>
              <h5 class="description-header">Nombre de banco</h5>
              <span class="description-text">{{ $banco->banco_nombre }}</span><br>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-3 col-6">
            <div class="description-block border-right" style="border-right: 1px solid #8d929f80 !important;">
              <span class="description-percentage text-info"><i class="fas fa-money-check"></i></span>
              <h5 class="description-header">Nro. de cuenta</h5>
              <span class="description-text">{{ $banco->cuenta_numero }}</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-3 col-6">
            <div class="description-block border-right" style="border-right: 1px solid #8d929f80 !important;">
              <span class="description-percentage text-info"><i class="fas fa-money-bill"></i></span>
              <h5 class="description-header">Monto incial</h5>
              <span class="description-text">{{ $banco->cuenta_montoinicial }}</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-3 col-6">
            <div class="description-block">
              <span class="description-percentage text-info"><i class="fas fa-wallet"></i></span>
              <h5 class="description-header">Tipo de cuenta</h5>
              <span class="description-text">{{ $banco->cuenta_tipo }}</span>
            </div>
            <!-- /.description-block -->
          </div>
        </div>
        <!-- /.row -->
      </div>
</div>
<br><br>
</div>
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <a href="{{ route('cuenta.index') }}"><button type="button" class="btn btn-info float-left"><i class="fas fa-arrow-left"></i> Regresar</button></a> <button  data-toggle="modal" data-target="#cargarNuevaChequera" type="button" class="btn btn-info float-right">Cargar nueva chequera</button>
                </div>
                <!-- /.card-header -->
                  <div class="card-body">
                      <table id="listaChequeras" class="table table-bordered table-hover display responsive no-wrap">
                      <thead>
                      <tr>
                            <th>Código</th>
                            <th>Fecha</th>
                            <th>Cantidad</th>
                            <th>Correlativo</th>
                            <th>Emisión</th>
                            <th>Anulado</th>
                            <th>Acción</th>
                      </tr>
                      </thead>
                      <tbody>

                      </tbody>
                      <tfoot>
                      <tr>
                            <th>Código</th>
                            <th>Fecha</th>
                            <th>Cantidad</th>
                            <th>Correlativo</th>
                            <th>Emisión</th>
                            <th>Anulado</th>
                            <th>Acción</th>
                      </tr>
                      </tfoot>
                      </table>
                  </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="cargarNuevaChequera" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="cargarNuevaChequeraLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cargarNuevaChequeraLabel">Cargar nueva chequera</h5>
          <button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('chequera.crear') }}" method="post">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nro de cuenta</label>
                            <input type="text" name="fecha-cheque" id="fecha-cheque" class="form-control" value="{{ $banco->cuenta_numero }}" placeholder="{{ $banco->cuenta_numero }}" readonly>
                            <input type="hidden" name="dato" value="{{ $banco->id }}">
                            <label for="">Fecha de Entrega</label>
                            <div class="form-group">
                                <input type="text" name="fechaE" id="fechaE" class="form-control" placeholder="aaaa-mm-dd" maxlength="10" autocomplete="off" required autocomplete="off" readonly>
                            </div>
                            <label>Cantidad de cheques</label>
                            <input type="text" name="nroCheque" id="nroCheque" class="form-control" placeholder="Número de cheques" maxlength="4" required autocomplete="off">
                            <label>Correlativo</label>
                            <input type="text" name="correlativo" id="correlativo" class="form-control" placeholder="Número de primer cheque" maxlength="20" required autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" id="cerrar" data-dismiss="modal">Cerrar</button>
              <input type="submit" value="Cargar chequera" id="cargarChequera"class="btn btn-primary">
            </div>
        </form>
      </div>
    </div>
</div>


<div class="modal fade" id="modificarChaquera" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modificarChaqueraLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modificarChaqueraLabel">Modificar esta chequera</h5>
          <button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('chequera.modificar') }}" method="post">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nro de cuenta</label>
                            <input type="text" name="fecha-cheque" id="fecha-cheque" class="form-control" value="{{ $banco->cuenta_numero }}" placeholder="{{ $banco->cuenta_numero }}" readonly>
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="dato" value="{{ $banco->id }}">
                            <label for="">Fecha de Entrega</label>
                            <input type="text" name="fechaEMod" id="fechaEMod" class="form-control" placeholder="aaaa-mm-dd" maxlength="10" autocomplete="off" required autocomplete="off" disabled readonly>
                            <label>Cantidad de cheques</label>
                            <input type="text" name="nroChequeMod" id="nroChequeMod" class="form-control" placeholder="Número de cheques" maxlength="4" required autocomplete="off" disabled>
                            <label>Correlativo</label>
                            <input type="text" name="correlativoMod" id="correlativoMod" class="form-control" placeholder="Número de primer cheque" maxlength="20" required autocomplete="off" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" id="cerrar2" data-dismiss="modal">Cerrar</button>
              <input type="submit" value="Modificar chequera" id="modificaChequera" class="btn btn-primary">
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
<script src="{{ asset("plugins/plugins/datatables-buttons/js/buttons.html5.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-buttons/js/buttons.print.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-buttons/js/buttons.colVis.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/jquery-ui/jquery-ui.js") }}"></script>
<script src="{{ asset("plugins/plugins/select2/js/select2.full.min.js") }}"></script>
<script src="{{ asset("plugins/numeric/jquery.numeric.js") }}"></script>
<script src="{{ asset("js/requerimiento/crear.js") }}"></script>
<script src="{{ asset("js/banco/cheques/chequera.js") }}"></script>
<script>
    listar( {{ $id }} );
</script>
@if (Session::has('resp'))
{{ Session::has('resp') }}
    @if (Session::has('resp') == true)
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('plugins/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

