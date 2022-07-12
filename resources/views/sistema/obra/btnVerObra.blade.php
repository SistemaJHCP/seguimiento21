<center>
    <a href="{{ route("obra.ver", $id) }}"><button title="Consultar esta obra" id="consultar" class="btn btn-info fas fa-search"></button></a>
    <a href="{{ route("obra.modificar", $id) }}"><button title="Modificar datos de la obra"  id="modificar" class="btn btn-info fas fa-edit"></button></a>
    <a href="{{ route('obra.valuacion.index', $id) }}"><button title="Agregar valuación a la obra"  id="modificar" class="btn btn-info fas fa-money-bill-wave-alt"></button></a>
    <button title="Desactivar una obra" value="{{ $id }}" id="desactivar" class="btn btn-info fas fa-times"></button>
</center>
