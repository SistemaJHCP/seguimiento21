@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Consultar <small>a un cliente</small></h1>
@endsection
@section('navegador')
    <li class="breadcrumb-item">Consultar</li>
    <li class="breadcrumb-item">Cliente</li>
    <li class="breadcrumb-item active">Inicio</li>
@endsection

@section('contenedor')
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Modificacion de un usuario</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="modal-body">
                <form action="{{ route('cliente.modificando', $cliente->id) }}" method="post">
                @csrf
                    <small style="color:red;">Todos los campos son obligatorios</small><br>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="inputState">Estado</label>
                                <select name="tipo" id="tipo" class="form-control">
                                  <option value="" <?php if($tipo == ""){ echo "selected";  } else { echo ''; }; ?> >N/A</option>
                                  <option value="J" <?php if($tipo == "J"){ echo "selected";  } else { echo ''; }; ?> >J</option>
                                  <option value="G" <?php if($tipo == "G"){ echo "selected";  } else { echo ''; }; ?> >G</option>
                                  <option value="V" <?php if($tipo == "V"){ echo "selected";  } else { echo ''; }; ?> >V</option>
                                  <option value="E" <?php if($tipo == "E"){ echo "selected";  } else { echo ''; }; ?> >E</option>
                                </select>
                              </div>
                            <div class="form-group col-md-10">
                              <label for="inputCity">Rif o cédula</label>
                              <input type="numeric" class="form-control" value="{{ $codigo }}" placeholder="Ingrese el número de cédula" id="codigo" minlength="6"  maxlength="9" name="codigo" required autocomplete="off">
                            </div>
                        </div>
                        <label for="">Nombre de cliente / empresa</label>
                        <input type="text" name="nombre" value="{{ $cliente->cliente_nombre }}" id="nombre" class="form-control" minlength="3" maxlength="50" placeholder="Indique el nombre del cliente" required autocomplete="off">
                        <label for="">Teléfono del cliente</label>
                        <input type="text" name="telefono" value="{{ $cliente->cliente_telefono }}" id="telefono" class="form-control" minlength="10" maxlength="13" placeholder="Indique un número telefónico" required autocomplete="off">
                        <label for="">Dirección del cliente / empresa</label>
                        <input type="text" name="direccion" value="{{ $cliente->cliente_direccion }}" id="direccion" class="form-control" minlength="1" maxlength="200" placeholder="Direccion de la empresa a registrar" required autocomplete="off">
                        <label for="">Correo del cliente / empresa</label>
                        <input type="text" name="correo" value="{{ $cliente->cliente_correo }}" id="correo" class="form-control" onkeyup="key();" minlength="7" maxlength="40" placeholder="Correo para contactar al cliente" required autocomplete="off">
                    </div>
                    <div class="form-group">
                      <button type="submit"  id="modificandoCli" class="btn btn-info float-right"><i class="fas fa-edit"></i> Modificar</button>
                      <a  class="btn btn-info" href="{{ route('cliente.index') }}"><i class="fas fa-arrow-left"></i> Regresar</a>
                    </div>
                </div>
          </div>
    </div>
    <div class="col-md-2"></div>
</div>
@endsection
@section('js')
<script src="{{ asset("js/clientes/modificarClientes.js") }}"></script>
@endsection
@section('css')

@endsection
@if (Session::has('cliente'))
{{ Session::has('cliente') }}
    @if (Session::has('cliente') == 1)
    <script>
        Swal.fire(
        'Sulicitud procesada!',
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

<script>
    Swal.fire(
    'Hubo un error!',
    'el formulario no esta correctamente cargado!',
    'error'
    )
</script>
@endif
