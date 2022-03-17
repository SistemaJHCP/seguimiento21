<center>
    @if ($solicitud_aprobacion == "Aprobada")
        <div style="background: green; padding:2px; color:aliceblue;border-radius:3px;">Aprobada</div>
    @elseif ($solicitud_aprobacion == "Anulada")
        <div style="background: rgb(94, 95, 94); padding:2px; color:aliceblue;border-radius:3px;">Anulada</div>
    @elseif ($solicitud_aprobacion == "Sin Respuesta")
        <div style="background: rgb(150, 124, 55); padding:2px; color:aliceblue;border-radius:3px;">Sin Respuesta</div>
    @elseif ($solicitud_aprobacion == "Rechazada")
        <div style="background: rgb(141, 27, 27); padding:2px; color:aliceblue;border-radius:3px;">Rechazada</div>
    @else
        {{$solicitud_aprobacion}}
    @endif
</center>
