@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Crear <small>nueva obra</small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
    <li class="breadcrumb-item">Nueva obra</li>
    <li class="breadcrumb-item active">Inicio</li>
    <img src="{{url('imagen/bandera-panama.png') }}" width="30" height="20" alt="Sistema de Venezuela" style="margin-left: 10px; margin-top:4px;">
@endsection

@section('contenedor')
<div class="row">
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      Datos a cargar
                    </div>
                    <div class="card-body">
                    <form action="{{ route('obra.creando') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Tipo</label>
                                    <select name="tipo" id="tipo" class="form-control" required>
                                        <option value="">Seleccione...</option>
                                        @foreach ($tipo as $t)
                                            <option value="{{ $t->id }}">{{ $t->tipo_nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Cliente</label>
                                    <select name="cliente" id="cliente" class="form-control" required>
                                        <option value="">Seleccione...</option>
                                        @foreach ($cli as $c)
                                            <option value="{{ $c->id }}">{{ $c->cliente_nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Codventa</label>
                                    <select name="codventa" id="codventa" class="form-control" required>
                                        <option value="">Seleccione...</option>
                                        @foreach ($cod as $v)
                                            <option value="{{ $v->id }}">{{ $v->codventa_codigo }}</option>
                                        @endforeach
                                        <option value="0">No aplica</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="text" name="nombreObra" id="nombreObra" autocomplete="off" class="form-control" placeholder="Nombre de la obra" maxlength="100">
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Total presupuestado</label>
                                    <input type="text" name="total" id="total" autocomplete="off" pattern="^[0-9]+(.[0-9]+)?$" class="form-control" placeholder="Costo de la obra" maxlength="17" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Anticipo</label>
                                    <input type="text" name="anticipo" id="anticipo" autocomplete="off" pattern="^[0-9]+(.[0-9]+)?$" class="form-control" placeholder="Monto del anticipo" maxlength="17" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Porcentaje de ganancia</label>
                                    <input type="text" name="porcentaje" id="porcentaje" autocomplete="off" pattern="^[0-9]+(.[0-9]+)?$" class="form-control" placeholder="Porcentaje de ganancia"  oninput="if(value.length>6)value=value.slice(0,6)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Fecha de inicio</label>
                                    <input type="text" name="fechaInicio" autocomplete="off" id="datepicker" class="form-control" placeholder="dd-mm-yyyy" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Fecha de culminaci??n</label>
                                    <input type="text" name="fechaFin" id="datepicker2" autocomplete="off" class="form-control" placeholder="dd-mm-yyyy">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Observaciones</label>
                                    <textarea name="observaciones" id="observaciones" autocomplete="off" class="form-control" placeholder="Indique aqui su observaci??n" maxlength="200"></textarea>
                                    <div id="coordin"></div>
                                    <div id="cargooo"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <a href="{{ route('obra.index') }}" class="btn btn-info">Regresar</a>
                                <input type="submit" id="agregar" value="Cargar una obra" class="btn btn-info float-right">
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
              Personal
            </div>
            <div class="card-body">
              <h5 class="card-title">Coordinador / residente </h5>
              <p class="card-text">Recuerde seleccionar al personal responsable de la obra.</p>
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#staticBackdrop">
                Seleccione personal
              </button>
              <i class="fas fa-trash-alt float-right" id="borrarTodo" style="color: #910e04;margin-top:-10px; font-size:26px;border:3px solid #910e04;padding:8px; border-radius:25px;"></i>
            </div>
        </div>
        <div id="cargoPersonal"></div>


    </div>
</div>


<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="form-group">
              <label for="">Seleccione personal</label>
              <select name="personal" id="personal" class="form-control">
                  <option value="">Seleccione...</option>
                  @foreach ($per as $p)
                    <option value="{{ $p->id }}">{{ $p->personal_nombre }}</option>
                  @endforeach
              </select>
          </div>
          <div class="form-group">
                <label for="">Cargo</label>
                <select name="cargoLab" id="estudio" class="form-control">
                    <option value="">Seleccione...</option>
                    <option value="1">Coordinador</option>
                    <option value="2">Residente</option>
                </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" id="agregarResponsable" class="btn btn-primary">Agregar</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('js')
<script src="{{ asset("plugins/plugins/jquery-ui/jquery-ui.js") }}"></script>
<script src="{{ asset("plugins/plugins/select2/js/select2.full.min.js") }}"></script>
<script src="{{ asset("plugins/numeric/jquery.numeric.js") }}"></script>
<script src="{{ asset("js/obra/crear-obra.js") }}"></script>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('plugins/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection
