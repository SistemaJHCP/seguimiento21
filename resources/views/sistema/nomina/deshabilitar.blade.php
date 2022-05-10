@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Reactivar <small>una nómina</small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item">Home</li> --}}
    <li class="breadcrumb-item">Reactivar nómina</li>
    <li class="breadcrumb-item active">Inicio</li>
    <img src="{{url('imagen/bandera_vzla.png') }}" width="30" height="20" alt="Sistema de Venezuela" style="margin-left: 10px; margin-top:4px;">
@endsection

@section('contenedor')
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('nomina.index') }}"><button type="button" class="btn btn-info float-right"><i class="fas fa-arrow-left"></i> Regresar</button></a>
            </div>
            <div class="card-body">
                <table id="listaNominasDeshabilitadas" class="table table-bordered table-hover display responsive no-wrap">
                    <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre de nómina</th>
                        <th>Acción</th>

                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre de nómina</th>
                        <th>Acción</th>
                    </tr>
                    </tfoot>
                    </table>
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
<script src="{{ asset("js/nomina/deshabilitadas.js") }}"></script>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}">
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}">
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-buttons/css/buttons.bootstrap4.min.css") }}">
@endsection
