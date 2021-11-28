<center>
    <a href="{{ route('proveedor.consultar', $id) }}"><button title="Consultar proveedor" id="consultar" class="btn btn-info fas fa-search"></button></a>
    <a href="{{ route('proveedor.modificar', $id) }}"><button title="Modificar proveedor"  id="modificar" class="btn btn-info fas fa-edit"></button></a>
    <button title="Desactivar un proveedor" value="{{ $id }}" id="desactivar" class="btn btn-info fas fa-times"></button>
</center>
