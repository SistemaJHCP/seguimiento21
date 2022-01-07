@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Crear  <small>Requisiciones </small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item">Home</li>--}}
    <li class="breadcrumb-item">Crear requisición</li>
    <li class="breadcrumb-item active">Inicio</li>
@endsection

@section('contenedor')
<form action="{{ route('requisicion.cargar') }}" method="post">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('requisicion.index') }}" class="float-right btn btn-info">Regresar</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Tipo</label>
                                <select name="tipo" id="tipo" class="form-control" required>
                                    <option value="">Seleccione...</option>
                                    <option value="Material">Material</option>
                                    <option value="Servicio">Servicio</option>
                                    <option value="Viatico">Viático</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Fecha de Emisión</label>
                                <input type="text" name="fechaI" id="fechaI" value="{!! date('Y-m-d'); !!}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Fecha de Entrega</label>
                                <input type="text" name="fechaE" id="fechaE" class="form-control" placeholder="aaaa-mm-dd" maxlength="10" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Proveedor Recomendado</label>
                                <select name="proveedorRec" id="proveedorRec" class="form-control select2" style="width: 100%;" required>
                                    <option value="">Seleccione...</option>
                                    @foreach ($proveedor as $p)
                                    <option value="{{ $p->id }}">{{ $p->proveedor_nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Obra Relacionada</label>
                                <select name="obra" id="obraRel927y2" class="form-control select3" required>
                                    <option value="">Seleccione...</option>
                                    @foreach ($obra as $o)
                                    <option value="{{ $o->id }}">{{ $o->obra_codigo }} - {{ $o->obra_nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="">Dirección</label>
                            <textarea name="direccion" id="direccion" class="form-control" required placeholder="Ingrese la dirección de la obra" maxlength="300"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#mostrarRequisiciones" id="selectRequis8ty" style="margin-top: 20px;margin-botton: 20px;">Seleccione requisiciones</button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div id="proovedorRelacionado"></div>
            <div id="obraRelacionada"></div>
        </div>

        <div class="modal fade" id="mostrarRequisiciones" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="mostrarRequisicionesLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="mostrarRequisicionesLabel">Indique los materiales</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                {{-- <form  method="post"> --}}
                @csrf
                    <div class="form-group">
                        <label for="">Cantidad</label>
                        <input type="text" id="cantidad" placeholder="Indique la cantidad" class="form-control" autocomplete="off"  maxlength="10">
                    </div>
                    <div class="form-group">
                        <label for="">Concepto o Descripción</label>
                        <select  id="sugsbjhs98yu" class="form-control">

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Especificaciones</label>
                        <textarea id="especificaciones" class="form-control" placeholder="Caracteristicas del material" autocomplete="off"  maxlength="180"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" id="cerrar" data-dismiss="modal">Cerrar</button>
                  <button type="button"  class="btn btn-primary" id="agregar" disabled>Agregar requisicion</button>
                </div>
                {{-- </form> --}}
              </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">

            <div class="card">
                <div class="card-header">
                    Motivo
                </div>
                <div class="card-body">
                    <textarea name="motivo" id="motivo" class="form-control" required  maxlength="300"></textarea>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    Observación
                </div>
                <div class="card-body">
                    <textarea name="observacion" id="observacion" class="form-control" required  maxlength="300"></textarea>
                </div>
            </div>
        </div>
        <div class="col-md-8">

            <div class="card card-row card-info">
                <div class="card-header">
                    Materiales
                </div>
                <div class="card-body">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                              <th>Tipo</th>
                              <th>Cantidad</th>
                              <th>Concepto</th>
                              <th>Especificación</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <div id="ctipo234"></div>
                    <div id="cantidad234"></div>
                    <div id="concrip234"></div>
                    <div id="especificaciones234"></div>
                </div>
                <div class="card-body">
                    <hr>
                    <input type="submit" value="Cargar requisición" id="cargarRequisicion" class="btn btn-info float-right" disabled>
                </div>
            </div>

        </div>
    </div>
</form>
<input type="hidden" name="">
@endsection
@section('js')
<script src="{{ asset("plugins/plugins/jquery-ui/jquery-ui.js") }}"></script>
<script src="{{ asset("plugins/plugins/select2/js/select2.full.min.js") }}"></script>
<script src="{{ asset("plugins/numeric/jquery.numeric.js") }}"></script>
<script src="{{ asset("js/requerimiento/crear.js") }}"></script>
@endsection
@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('plugins/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
