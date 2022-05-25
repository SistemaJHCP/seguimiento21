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
                @if ( $codigoActual->cheque_codigo < $limite - 1 )
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
<script src="{{ asset("js/banco/cheques/cheque.js") }}"></script>
<script>
    listar( {{ $id }} );
</script>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}">
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('plugins/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

