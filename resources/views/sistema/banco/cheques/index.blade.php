@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Chequera Nro. <small>  </small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">Layout</li> --}}
    <li class="breadcrumb-item active">Inicio</li>
    <img src="{{url('imagen/bandera_vzla.png') }}" width="30" height="20" alt="Sistema de Venezuela" style="margin-left: 10px; margin-top:4px;">
@endsection

@section('contenedor')
<div class="row">
    <div class="col-md-12">
        <div class="card-footer" style="">
            <div class="row">
              <div class="col-sm-3 col-6">
                <div class="description-block border-right" style="border-right: 1px solid #8d929f80 !important;"> <!-- Rosman -->
                  <small class="text-muted">{{ $chequera->banco_rif }}</small>
                  <h5 class="description-header">Nombre de banco</h5>
                  <span class="description-text">{{ $chequera->banco_nombre }}</span><br>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-3 col-6">
                <div class="description-block border-right" style="border-right: 1px solid #8d929f80 !important;">
                  <span class="description-percentage text-info"><i class="fas fa-money-check"></i></span>
                  <h5 class="description-header">Nro. de cuenta</h5>
                  <span class="description-text">{{ $chequera->cuenta_numero }}</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-3 col-6">
                  <div class="description-block border-right"  style="border-right: 1px solid #8d929f80 !important;">
                      <span class="description-percentage text-info"><i class="fas fa-wallet"></i></span>
                      <h5 class="description-header">Tipo de cuenta</h5>
                      <span class="description-text">{{ $chequera->cuenta_tipo }}</span>
                  </div>
                  <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-3 col-6">
                <div class="description-block">
                  <span class="description-percentage text-info"><i class="fas fa-money-bill"></i></span>
                  <h5 class="description-header">Correlativo</h5>
                  <span class="description-text">{{ $chequera->chequera_correlativo }}</span>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('chequera.index', $chequera->id_cuenta) }}"><button type="button" class="btn btn-info float-left"><i class="fas fa-arrow-left"></i> Regresar</button></a>
                @if ($codigoActual)
                    @if ( $codigoActual->cheque_codigo < $limite - 1 )
                        <button  data-toggle="modal" data-target="#cargarNuevaChequera" type="button" class="btn btn-info float-right"><i class="fas fa-plus-square"></i> Cargar nuevo cheque</button>
                    @endif
                @endif

                @if ( $chequera->emitido < 1 )
                    <button  data-toggle="modal" data-target="#cargarNuevaChequera" type="button" class="btn btn-info float-right"><i class="fas fa-plus-square"></i> Cargar nuevo cheque</button>
                 @endif
            </div>
            <!-- /.card-header -->
              <div class="card-body">
                  <table id="listaCheque" class="table table-bordered table-hover display responsive no-wrap">
                  <thead>
                  <tr>
                        <th>Código</th>
                        <th>Monto</th>
                        <th>Destinatario</th>
                        <th>Fecha</th>
                        <th>Código chequera</th>
                        <th>Estado</th>
                        <th>Acción</th>
                  </tr>
                  </thead>
                  <tbody>

                  </tbody>
                  <tfoot>
                  <tr>
                        <th>Código</th>
                        <th>Monto</th>
                        <th>Destinatario</th>
                        <th>Fecha</th>
                        <th>Código chequera</th>
                        <th>Estado</th>
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
    <form action="{{ route('cheque.crear') }}" method="post">
    @csrf
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="cargarNuevaChequeraLabel">Asignar un nuevo cheque</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php
                if ( empty($codigoActual) ) {
                    $codigo = $chequera->chequera_correlativo;
                } else {
                    $codigo = $codigoSiguiente;
                }
            ?>

            <div class="form-group">
                <label>Código de cheque</label>
                <input type="text" name="codigo" id="codigo" value="{{ $codigo }}" class="form-control" readonly required>
                <label>Destinatario de cheque</label>
                <input type="text" name="destinatario" id="destinatario" class="form-control" placeholder="Indique el nombre y apellido del destinatario"  maxlength="50" autocomplete="off" required>
                <label>Monto de cheque</label>
                <input type="text" name="monto" id="monto" class="form-control" placeholder="Indique el monto del cheque"  maxlength="17" autocomplete="off" required>
                <label>Fecha del cheque</label>
                <input type="text" name="fecha" id="fecha" class="form-control" placeholder="aaaa/mm/dd"  maxlength="10" autocomplete="off" required readonly>
                <input type="hidden" name="chequeraId" value="{{ $chequera->id }}">

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="cerrar" data-dismiss="modal">Cerrar</button>
            <input type="submit" id="aprobar" value="Cargar cheque" class="btn btn-primary" disabled>
          </div>
        </div>
      </div>
    </form>
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
<script src="{{ asset("plugins/numeric/jquery.numeric.js") }}"></script>
<script src="{{ asset("plugins/plugins/jquery-ui/jquery-ui.js") }}"></script>
<script src="{{ asset("plugins/plugins/select2/js/select2.full.min.js") }}"></script>
<script src="{{ asset("js/banco/cheques/cheque.js") }}"></script>
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

