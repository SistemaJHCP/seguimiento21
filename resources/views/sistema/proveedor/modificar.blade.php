@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Modificar <small>proveedor</small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item">Home</li> --}}
    <li class="breadcrumb-item">Modificar proveedor</li>
    <li class="breadcrumb-item active">Inicio</li>
    <img src="{{url('imagen/bandera_vzla.png') }}" width="30" height="20" alt="Sistema de Venezuela" style="margin-left: 10px; margin-top:4px;">
@endsection

@section('contenedor')
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Modifique los datos del proveedor</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="modal-body">
            <form action="{{ route('proveedor.modificando', $proveedor->id) }}" method="post">
                @csrf
                <div class="form-group">
                    <div class="form-row">
                        <div class="form-group col-2">
                            <label for="inputState">Estado</label>
                            <select name="tipo" id="tipo" class="form-control" required autocomplete="on">
                              <option value="Natural" <?php if($proveedor->proveedor_tipo == "Natural"){ echo "selected";} ?> >N</option>
                              <option value="Juridico" <?php if($proveedor->proveedor_tipo == "Juridico"){ echo "selected";} ?> >J</option>
                              <option value="Gubernamental" <?php if($proveedor->proveedor_tipo == "Gubernamental"){ echo "selected";} ?> >G</option>
                            </select>
                          </div>
                        <div class="form-group col-10">
                          <label for="inputCity">Identificación</label>
                          <input type="text" class="form-control" placeholder="Ingrese el número de cédula" id="cedula" value="{{ $proveedor->proveedor_rif }}" minlength="5"  maxlength="9" name="identificacion" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" id="nombre" placeholder="Ingrese el nombre del proveedor" value="{{ $proveedor->proveedor_nombre }}" class="form-control" minlength="3" maxlength="50" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Tipo de Suministro</label>
                        <select name="suministro" id="suministro" required class="form-control">
                            <option value="" required>Seleccione...</option>
                            @foreach ($suministro as $sum)
                                <option value="{{ $sum->id }}" <?php if($proveedor->suministro_id == $sum->id){ echo "selected";} ?> >{{ $sum->suministro_nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Teléfono</label>
                        <input type="text" name="telefono" id="telefono" value="{{ $proveedor->proveedor_telefono }}" class="form-control" minlength="3" maxlength="11" placeholder="Ingrese el número del proveedor" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" name="direccion" id="direccion" value="{{ $proveedor->proveedor_direccion }}" class="form-control" maxlength="200" placeholder="Ingrese la dirección del proveedor" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Correo Electrónico</label>
                        <input type="email" name="email" id="email" value="{{ $proveedor->proveedor_correo }}" class="form-control" maxlength="60" placeholder="Ingrese la dirección del proveedor" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Persona de Contacto</label>
                        <input type="text" name="contacto" id="contacto" value="{{ $proveedor->proveedor_contacto }}" class="form-control" maxlength="200" placeholder="Ingrese la dirección del proveedor" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{ route('proveedor.index') }}"><button type="button" id="cerrar" class="btn btn-info" data-dismiss="modal">Regresar</button></a>
                <input type="submit" id="modificar" class="btn btn-info" value="Modificar proveedor">
            </div>
            </form>
            </div>
        </div>

    </div>
    <div class="col-md-2"></div>
</div>
@endsection
@section('js')
<script src="{{ asset("plugins/numeric/jquery.numeric.js") }}"></script>
<script src="{{ asset("js/proveedores/modificar.js") }}"></script>

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

@endsection
