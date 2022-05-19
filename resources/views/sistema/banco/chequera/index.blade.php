@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Chequera <small></small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">Layout</li> --}}
    <li class="breadcrumb-item active">Inicio</li>
    <img src="{{url('imagen/bandera-panama.png') }}" width="30" height="20" alt="Sistema de Venezuela" style="margin-left: 10px; margin-top:4px;">
@endsection

@section('contenedor')
<div class="row">
<div class="col-md-12">
    <div class="card-footer" style="">
        <div class="row">
          <div class="col-sm-3 col-6">
            <div class="description-block border-right">
              <span class="description-percentage text-info"><i class="fas fa-university"></i></span>
              <h5 class="description-header">Nombre de banco</h5>
              <span class="description-text">{{ $banco->banco_nombre }}</span><br>
              <small class="text-muted">{{ $banco->banco_rif }}</small>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-3 col-6">
            <div class="description-block border-right">
              <span class="description-percentage text-info"><i class="fas fa-money-check"></i></span>
              <h5 class="description-header">Nro. de cuenta</h5>
              <span class="description-text">{{ $banco->cuenta_numero }}</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-3 col-6">
            <div class="description-block border-right">
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
                      <table id="listaBancos" class="table table-bordered table-hover display responsive no-wrap">
                      <thead>
                      <tr>
                            <th>Código</th>
                            <th>Fecha</th>
                            <th>Cantidad</th>
                            <th>Chequera</th>
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
                            <th>Chequera</th>
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

@endsection
@section('css')

@endsection

