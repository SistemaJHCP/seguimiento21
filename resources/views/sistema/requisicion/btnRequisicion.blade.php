<center>
    @if ($requisicion_estado == "No Vista")
        <a href="{{ route('requisicion.ver', $id) }}"><button title="Consultar esta requisición" id="consultar" value="{{ $id }}" class="btn btn-info fas fa-search"></button></a>
        @if ($usuario_id == \Auth::user()->id)
            <a href="{{ route('requisicion.modificar', $id) }}"><button title="Modificar datos del PTC"  id="modificar" class="btn btn-info fas fa-edit"></button></a>
            <button title="Desactivar un PTC" value="{{ $id }}" id="desactivar" class="btn btn-info fas fa-times"></button>
        @else
            <button title="Modificar datos del PTC" class="btn btn-secondary fas fa-edit"></button></a>
            <button title="Desactivar un PTC" class="btn btn-secondary fas fa-times"></button>
        @endif

    @else
        <a href="{{ route('requisicion.ver', $id) }}"><button title="Consultar esta requisición" id="consultar" value="{{ $id }}" class="btn btn-info fas fa-search"></button></a>
        <button title="Modificar datos del PTC" class="btn btn-secondary fas fa-edit"></button></a>
        <button title="Desactivar un PTC" class="btn btn-secondary fas fa-times"></button>
    @endif
</center>
