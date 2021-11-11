<center>
    <a href="{{ route('maestro.consultar', $id) }}"><button title="Consultar un PTC" id="consultar" class="btn btn-info fas fa-search"></button></a>
    <a href="{{ route('maestro.modificar', $id) }}"><button title="Modificar datos del PTC"  id="modificar" class="btn btn-info fas fa-edit"></button></a>
    <button title="Desactivar un PTC" value="{{ $id }}" id="desactivar" class="btn btn-info fas fa-times"></button>
</center>
