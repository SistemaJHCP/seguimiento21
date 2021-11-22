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
                    <form action="{{ route('obra.modificando', $obra->id) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Tipo</label>
                                    <select name="tipo" id="tipo" class="form-control" required>
                                        <option value="">Seleccione...</option>
                                        @foreach ($tipo as $t)
                                            <option value="{{ $t->id }}" {!! $obra->tipo_id == $t->id ? "selected" : "" !!}>{{ $t->tipo_nombre }}</option>
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
                                            <option value="{{ $c->id }}" {!! $obra->cliente_id == $c->id ? "selected" : "" !!}>{{ $c->cliente_nombre }}</option>
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
                                            <option value="{{ $v->id }}" {!! $obra->codventa_id == $v->id ? "selected" : "" !!}>{{ $v->codventa_codigo }}</option>
                                        @endforeach
                                        <option value="0" {!! $obra->codventa_id == 0 ? "selected" : "" !!}>No aplica</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="text" name="nombreObra" id="nombreObra" class="form-control" value="{{ $obra->obra_nombre }}" placeholder="Nombre de la obra" maxlength="100">
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="">Total planificado</label>
                                    <input type="text" name="total" id="total" class="form-control" value="{{ $obra->obra_monto }}" placeholder="Gasto planificado de la obra" maxlength="17">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Porcentaje de ganancia</label>
                                    <input type="number" name="porcentaje" id="porcentaje" class="form-control" value="{{ $obra->obra_ganancia }}" placeholder="Porcentaje de ganancia"  oninput="if(value.length>6)value=value.slice(0,6)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Fecha de inicio</label>
                                    <input type="text" name="fechaInicio" id="datepicker" value="{{ $obra->obra_fechainicio }}" class="form-control" placeholder="dd-mm-yyyy">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Fecha de culminación</label>
                                    <input type="text" name="fechaFin" id="datepicker2" value="{{ $obra->obra_fechafin }}" class="form-control" placeholder="dd-mm-yyyy">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Observaciones</label>
                                    <textarea name="observaciones" id="observaciones" class="form-control" placeholder="Indique aqui su observación" maxlength="200">{{ $obra->obra_observaciones }}</textarea>
                                    <div id="coordin"></div>
                                    <div id="cargooo"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <a href="{{ route('obra.index') }}" class="btn btn-info">Regresar</a>
                                <input type="submit" value="Cargar obra" class="btn btn-info float-right">
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
<script src="{{ asset("js/obra/modificar-obra.js") }}"></script>
<script>

    $.ajax({
        url: "../modificar-personal-3948/8330/" + {{ $obra->id }},
        type: 'GET',
        dataType: 'json'
    })
    .done(function(comp) {

    if (Array.isArray(comp)) {

        comp.forEach(element => {

            if (comp.op_cargo == 1) {
            var car = "Coordinador";
        } else {
            var car = "Residente";
        }

        $("#cargoPersonal").append('<div class="info-box"><span class="info-box-icon bg-info"><i class="fas fa-user-alt"></i></span><div class="info-box-content"><span class="info-box-text">' + element.personal_nombre + '</span><span class="info-box-number">' + car + '</span></div></div>');
        $("#coordin").append('<input type="hidden" name="responsable[]" value="' + element.personal_nombre + '">');
        $("#cargooo").append('<input type="hidden" name="cargoResponsable[]" value="' + car + '">');
        $("#personal").val("");
        $("#estudio").val("");
        $("#agregarResponsable").attr("disabled", false);
        });



    }


    })
    .fail( function(){
        console.log("fallo el ajax en el modulo de cargar coordinador / residente");
    })

</script>
@endsection
@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection
