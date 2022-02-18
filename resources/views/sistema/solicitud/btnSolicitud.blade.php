<center>
    @if ($solicitud_aprobacion == "Sin Respuesta")
        <a href="{{ route('solicitud.consultar', $id) }}"><button title="Consultar esta solicitud" id="consultar" class="btn btn-info fas fa-search"></button></a>
        <a href="{{ route('solicitud.modificar',$id) }}"><button title="Modificar datos del PTC"  id="modificar" class="btn btn-info fas fa-edit"></button></a>
        <button title="Desactivar un PTC" value="{{ $id }}" id="desactivar" class="btn btn-info fas fa-times"></button>
    @else
        <a href="{{ route('solicitud.consultar', $id) }}"><button title="Consultar esta solicitud" id="consultar" class="btn btn-info fas fa-search"></button></a></a>
        <button title="Modificar datos del PTC" class="btn btn-secondary fas fa-edit"></button></a>
        <button title="Desactivar un PTC" class="btn btn-secondary fas fa-times"></button>
    @endif
</center>
