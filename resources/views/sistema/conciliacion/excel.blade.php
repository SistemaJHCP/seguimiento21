<table>
    <tr>
        <td><b>Empresa: &nbsp;</b> JHCP CONSTRUCCION, C.A.</td>
    </tr>
    <tr>
        <td><b>Rif:&nbsp; </b>J-31599959-5</td>
    </tr>
    <tr>
        <td><b>Impreso por:&nbsp; </b>{{ \Auth::user()->user_name }}</td>
    </tr>
</table>
<div><b>Empresa: </b>JHCP CONSTRUCCION, C.A.</div>
<div><b>Rif: </b>J-31599959-5</div>
<div><b>Impreso por: </b>{{ \Auth::user()->user_name }}</div>

<table>
    <thead>
        <tr>
            <th style="background: #1798ac; color:white;text-align:center;width:20px;">Código de solicitud</th>
            <th style="background: #1798ac; color:white;text-align:center;width:20px;">Fecha</th>
            <th style="background: #1798ac; color:white;text-align:center;width:20px;">Motivo</th>
            <th style="background: #1798ac; color:white;text-align:center;width:20px;">Obra relacionada</th>
            <th style="background: #1798ac; color:white;text-align:center;width:20px;">Cantidad</th>
            <th style="background: #1798ac; color:white;text-align:center;width:20px;">Precio unitario</th>
            <th style="background: #1798ac; color:white;text-align:center;width:20px;">Material</th>
            <th style="background: #1798ac; color:white;text-align:center;width:20px;">Moneda</th>
            <th style="background: #1798ac; color:white;text-align:center;width:20px;">solicitante</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($conciliacion as $con)
            <tr>
                <td>{{ $con->solicitud_numerocontrol }}</td> {{-- Codigo de solicitud --}}
                <td>{{ $con->solicitud_fecha }}</td> {{-- Fecha --}}
                <td>{{ $con->solicitud_motivo }}</td> {{-- Motivo --}}
                <td>{{ $con->obra_nombre }}</td> {{-- Obra --}}
                <td>{{ $con->cantidad }}</td> {{-- Cantidad --}}
                <td>{{ $con->preciounitario }}</td> {{-- precio unitario --}}
            @if ($con->material_nombre != null)
                <td>{{ $con->material_nombre }}</td> {{-- Material --}}
            @endif
            @if ($con->nomina_nombre != null)
                <td>{{ $con->nomina_nombre }}</td> {{-- nomina --}}
            @endif
            @if ($con->servicio_nombre != null)
                <td>{{ $con->servicio_nombre }}</td> {{-- servicio --}}
            @endif
            @if ($con->viatico_nombre != null)
                <td>{{ $con->viatico_nombre }}</td> {{-- viatico --}}
            @endif
                <td>{{ $con->moneda }}</td> {{-- moneda --}}
                <td>{{ $con->user_name }}</td> {{-- solicitante --}}
            </tr>
        @endforeach
    </tbody>
</table>
