<center>
    <a href="{{ route('proveedor.consultar', $id) }}"><button title="Consultar proveedor" id="consultar" class="btn btn-info fas fa-search btn-sm"></button></a>
    <a href="{{ route('proveedor.modificar', $id) }}"><button title="Modificar proveedor"  id="modificar" class="btn btn-info fas fa-edit btn-sm"></button></a>
    <a href="{{ route('proveedor.cuenta', $id) }}"><button title="Agregar cuenta bancaria"  id="modificar" class="btn btn-info fas fa-money-bill-wave btn-sm"></button></a>
    <button title="Desactivar un proveedor" value="{{ $id }}" id="desactivar" class="btn btn-info fas fa-times btn-sm"></button>
</center>
