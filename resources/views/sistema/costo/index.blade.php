@extends('layouts.app')

@section('titulo')
    <h1 class="m-0">Control <small>de gastos</small></h1>
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
        <div class="card card-info card-outline">
            <div class="card-body">
                <div class="form-group">
                    <form action="{{ route('solicitud.estadistica') }}" method="post">
                    @csrf
                        <label>Seleccione una obra</label>
                        <select name="obra" id="tipo" class="form-control">
                            <option value="0">Seleccione...</option>
                            @foreach ($obra as $ob)
                                <option value="{{ $ob->id }}">{{ $ob->obra_codigo }} | {{ $ob->obra_nombre }}</option>
                            @endforeach
                        </select>
                        <br>
                        <input type="submit" value="Estadística" id="estadistic" class="btn btn-info" disabled>

                    </form>

                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Datos de la obra seleccionada</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <table class="table">
                <tbody>
                  <tr>
                      <td style="width:50px">Nro: </td><td><div id="numero">-------</div></td>
                  </tr>
                  <tr>
                    <td style="width:50px">Cliente: </td><td><div id="cliente">-------</div></td>
                  </tr>
                  <tr>
                      <td style="width:50px">Nombre: </td><td><div id="nombre">-------</div></td>
                  </tr>
                  <tr>
                      <td style="width:50px">Presupuesto: </td><td><div id="total">-------</div></td>
                  </tr>
                  <tr>
                    <td style="width:50px">Anticipo: </td><td><div id="anticipo">-------</div></td>
                  </tr>
                  <tr>
                      <td style="width:50px">Fecha inicio: </td><td><div id="fecha">-------</div></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>

          <br><br>
    </div>
    <div class="col-md-8">
        <div class="card card-info card-outline">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-money-bill-wave"></i></span>

                            <div class="info-box-content">
                              <span class="info-box-text">Gastos</span>
                              <span class="info-box-number"><div id="gasto1">--</div></span>
                            </div>
                            <! /.info-box-content >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-coins"></i></span>

                            <div class="info-box-content">
                              <span class="info-box-text">Ganancia real</span>
                              <span class="info-box-number"><div id="ganancia1">--</div></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-percent"></i></span>

                            <div class="info-box-content">
                              <span class="info-box-text"><span id="porGan">-- % ganancia</span></span>
                              <span class="info-box-text"><span id="porGas">-- % gastos</span></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <table id="listasolicitudesGastos" class="table table-bordered table-hover" style="font-size: 12px">
                            <thead>
                            <tr>
                              <th>Código</th>
                              <th>Motivo</th>
                              <th>Monto</th>
                              <th>Fecha</th>
                              <th>Usuario</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                            <tr>
                              <th>Código</th>
                              <th>Motivo</th>
                              <th>Monto</th>
                              <th>Fecha</th>
                              <th>Usuario</th>
                            </tr>
                            </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
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
<script src="{{ asset("plugins/plugins/jquery-ui/jquery-ui.js") }}"></script>
<script src="{{ asset("plugins/plugins/select2/js/select2.full.min.js") }}"></script>
<script src="{{ asset("plugins/numeric/jquery.numeric.js") }}"></script>
<script src="{{ asset("js/costo/costo-archivo.js") }}"></script>
<!-- Resources -->

@endsection
@section('css')
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('plugins/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

