@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Proveedores <small></small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">Layout</li> --}}
    <li class="breadcrumb-item active">Inicio</li>
@endsection

@section('contenedor')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Proveedores de la empresa</h3><a href="#"><button style="margin-left:10px;" class="btn btn-info float-right">Deshabilitadas</button></a> <a href="#"><button style="margin-left:10px;"  data-target="#nuevoProveedor" data-toggle="modal" class="btn btn-info float-right">Nuevo</button></a>
            </div>
            <!-- /.card-header -->
              <div class="card-body">
                  <table id="listaProveedores" class="table table-bordered table-hover" style="font-size: 12px">
                  <thead>
                  <tr>
                      <th>Código</th>
                      <th>Tipo</th>
                      <th>Rif</th>
                      <th>Nombre</th>
                      <th>Teléfono</th>
                      <th>Correo</th>
                      <th>Contacto</th>
                      <th>Suministro</th>
                      <th style="width: 140px">Acción</th>
                  </tr>
                  </thead>
                  <tbody>

                  </tbody>
                  <tfoot>
                    <tr>
                        <th>Código</th>
                        <th>Tipo</th>
                        <th>Rif</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Contacto</th>
                        <th>Suministro</th>
                        <th>Acción</th>
                    </tr>
                  </tfoot>
                  </table>
              </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<div class="modal fade" id="nuevoProveedor" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Crear un nuevo proveedor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{ route('proveedor.crear') }}" method="post">
            @csrf
            <div class="form-group">
                <div class="form-row">
                    <div class="form-group col-2">
                        <label for="inputState">Estado</label>
                        <select name="tipo" id="tipo" class="form-control" required autocomplete="on">
                          <option value="Natural">N</option>
                          <option value="Juridico">J</option>
                          <option value="Gubernamental">G</option>
                        </select>
                      </div>
                    <div class="form-group col-10">
                      <label for="inputCity">Identificación</label>
                      <input type="text" class="form-control" placeholder="Ingrese el número de cédula" id="cedula" minlength="5"  maxlength="9" name="identificacion" required autocomplete="on">
                    </div>
                </div>
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Ingrese el nombre del proveedor" class="form-control" minlength="3" maxlength="50" required autocomplete="on">
                </div>
                <div class="form-group">
                    <label>Tipo de Suministro</label>
                    <select name="suministro" id="suministro" required class="form-control">
                        <option value="" required>Seleccione...</option>
                        @foreach ($suministro as $sum)
                            <option value="{{ $sum->id }}">{{ $sum->suministro_nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Teléfono</label>
                    <input type="text" name="telefono" id="telefono" class="form-control" minlength="3" maxlength="11" placeholder="Ingrese el número del proveedor" required autocomplete="on">
                </div>
                <div class="form-group">
                    <label>Dirección</label>
                    <input type="text" name="direccion" id="direccion" class="form-control" maxlength="200" placeholder="Ingrese la dirección del proveedor" required autocomplete="on">
                </div>
                <div class="form-group">
                    <label>Correo Electrónico</label>
                    <input type="email" name="email" id="email" class="form-control" maxlength="60" placeholder="Ingrese la dirección del proveedor" autocomplete="on">
                </div>
                <div class="form-group">
                    <label>Persona de Contacto</label>
                    <input type="text" name="contacto" id="contacto" class="form-control" maxlength="200" placeholder="Ingrese la dirección del proveedor" autocomplete="on">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" id="cerrar" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <input type="submit" id="crear" class="btn btn-primary" value="Cargar proveedor" disabled>
        </div>
        </form>
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
<script src="{{ asset("plugins/numeric/jquery.numeric.js") }}"></script>
<script src="{{ asset("js/proveedores/proveedor.js") }}"></script>
@if (Session::has('resp'))
{{ Session::has('resp') }}
    @if (Session::has('resp') == 1)
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
@section('css')
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}">
<link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}">
@endsection
