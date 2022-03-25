@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Opciones <small>de clientes</small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
    <li class="breadcrumb-item" style="color: black;">Clientes</li>
    <li class="breadcrumb-item active">Inicio</li>
@endsection

@section('contenedor')
<div class="row">
<div class="col-md-4">
    @if ($permisoUsuario->crear_cliente == 1)
        <div class="info-box"  data-toggle="modal" data-target="#crearCliente">
            <span class="info-box-icon bg-info elevation-1"><i class="far fa-user-circle"></i></span>

            <div class="info-box-content" style="color:black;">
                <span class="info-box-text">CARGAR DATOS</span>
                <span class="info-box-number">
                DE UN CLIENTE
                <small></small>
                </span>
            </div>
        <!-- /.info-box-content -->
        </div>
    @endif
    @if ($permisoUsuario->reactivar_cliente == 1)
    <a href="{{ route('cliente.reactivar') }}">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="far fa-check-circle"></i></span>

            <div class="info-box-content" style="color:black;">
                <span class="info-box-text">CLIENTES</span>
                <span class="info-box-number">
                DESACTIVADOS
                <small></small>
                </span>
            </div>
        <!-- /.info-box-content -->
        </div>
    </a>
    @endif

</div>
<div class="col-md-8">
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Datos de clientes</h3>
        </div>
        <!-- /.card-header -->
          <div class="card-body">
              <table id="listaClientes" class="table table-bordered table-hover">
              <thead>
              <tr>
                  <th>Código de cliente</th>
                  <th>RIF</th>
                  <th>Nombre</th>
                  <th style="width: 140px">Acción</th>

              </tr>
              </thead>
              <tbody>

              </tbody>
              <tfoot>
              <tr>
                  <th>Nombre de usuario</th>
                  <th>Correo</th>
                  <th>Correo</th>
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
<div class="modal fade" id="crearCliente" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="crearClienteLabel">Cargar un nuevo cliente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{ route("cliente.crear") }}" method="post">
        @csrf
            <small style="color:red;">Todos los campos son obligatorios</small><br>
            <div class="form-group">
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="inputState">Estado</label>
                        <select name="tipo" id="tipo" class="form-control" required autocomplete="off">
                          <option value="J" selected>J</option>
                          <option value="G">G</option>
                          <option value="V">V</option>
                          <option value="E">E</option>
                        </select>
                      </div>
                    <div class="form-group col-md-10">
                      <label for="inputCity">Rif o cédula</label>
                      <input type="numeric" class="form-control" placeholder="Ingrese el número de cédula" id="codigo" minlength="6"  maxlength="9" name="codigo" required autocomplete="off">
                    </div>
                </div>
                <label for="">Nombre de cliente / empresa</label>
                <input type="text" name="nombre" id="nombre" class="form-control" minlength="3" maxlength="50" placeholder="Indique el nombre del cliente" required autocomplete="off">
                <label for="">Teléfono del cliente</label>
                <input type="text" name="telefono" id="telefono" class="form-control" minlength="10" maxlength="13" placeholder="Indique un número telefónico" required autocomplete="off">
                <label for="">Dirección del cliente / empresa</label>
                <input type="text" name="direccion" id="direccion" class="form-control" minlength="1" maxlength="200" placeholder="Direccion de la empresa a registrar" required autocomplete="off">
                <label for="">Correo del cliente / empresa</label>
                <input type="text" name="correo" id="correo" class="form-control" minlength="7" maxlength="40" placeholder="Correo para contactar al cliente" required autocomplete="off">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="cerrar" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <input type="submit" id="cargarCliente" class="btn btn-primary" value="Cargar cliente" disabled>
        </div>
        </form>
      </div>
    </div>
  </div>

@endsection
@section('css')
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}">
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}">
@endsection
@section('js')
<script src="{{ asset("plugins/plugins/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-responsive/js/dataTables.responsive.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-responsive/js/responsive.bootstrap4.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-buttons/js/dataTables.buttons.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/datatables-buttons/js/buttons.bootstrap4.min.js") }}"></script>
<script src="{{ asset("plugins/numeric/jquery.numeric.js") }}"></script>
<script src="{{ asset("js/clientes/clientes.js") }}"></script>

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
