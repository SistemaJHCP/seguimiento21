<center>
    @if ($solicitud_aprobacion == "Sin Respuesta")
        <a href="#"><button title="Consultar esta obra" id="consultar" class="btn btn-info fas fa-search"></button></a>
        <a href="##"><button title="Modificar datos del PTC"  id="modificar" class="btn btn-info fas fa-edit"></button></a>
        <button title="Desactivar un PTC" value="{{ $id }}" id="desactivar" class="btn btn-info fas fa-times"></button>
    @else
        <button title="Consultar esta obra" id="consultar" class="btn btn-info fas fa-search"></button></a>
        <button title="Modificar datos del PTC" class="btn btn-secondary fas fa-edit"></button></a>
        <button title="Desactivar un PTC" class="btn btn-secondary fas fa-times"></button>
    @endif
</center>
