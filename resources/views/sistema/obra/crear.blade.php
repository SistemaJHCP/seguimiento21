@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Crear <small>nueva obra</small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
    <li class="breadcrumb-item">Nueva obra</li>
    <li class="breadcrumb-item active">Inicio</li>
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
                        <form action="" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Tipo</label>
                                    <select name="tipo" id="" class="form-control" required>
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
                                    <select name="" id="" class="form-control" required>
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
                                    <select name="" id="" class="form-control" required>
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
                            <input type="text" name="nombreObra" id="nombreObra" class="form-control" placeholder="Nombre de la obra">
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="">Total planificado</label>
                                    <input type="text" name="total" id="total" class="form-control" placeholder="Gasto planificado de la obra">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Porcentaje de ganancia</label>
                                    <input type="text" name="total" id="total" class="form-control" placeholder="Porcentaje de ganancia">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Fecha de inicio</label>
                                    <input type="text" name="fechaInicio" id="datepicker" class="form-control" placeholder="dd-mm-yyyy">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Fecha de culminación</label>
                                    <input type="text" name="fechaFin" id="datepicker2" class="form-control" placeholder="dd-mm-yyyy">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Observaciones</label>
                                    <textarea name="observaciones" id="observaciones" class="form-control" placeholder="Indique aqui su observación"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>












                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
              Personal
            </div>
            <div class="card-body">
              <h5 class="card-title">Seleccione aqui</h5>
              <p class="card-text">al personal responsable de esta obra.</p>
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#staticBackdrop">
                Seleccione personal
              </button>
            </div>
        </div>
        <div id="cargoPersonal"></div>
        <div class="callout callout-info">
            <h5>Nombre de la persona</h5>
            <p>Cargo laboral.</p>
        </div>
        <div class="callout callout-info">
            <h5>Nombre de la persona</h5>
            <p>Cargo laboral.</p>
        </div>
        <div class="callout callout-info">
            <h5>Nombre de la persona</h5>
            <p>Cargo laboral.</p>
        </div>
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
                <select name="personal" id="estudio" class="form-control">
                    <option value="">Seleccione...</option>
                    <option value="">Coordinador</option>
                    <option value="">Residente</option>
                </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary">Agregar</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('js')
<script src="{{ asset("plugins/plugins/jquery-ui/jquery-ui.js") }}"></script>
<script src="{{ asset("js/obra/crear-obra.js") }}"></script>

@endsection
@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection
