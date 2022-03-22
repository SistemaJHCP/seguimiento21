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
            <th style="background: #1798ac; color:white;text-align:center;width:20px;border: 1px solid white">Código de solicitud</th>
            <th style="background: #1798ac; color:white;text-align:center;width:20px;border: 1px solid white">Fecha</th>
            <th style="background: #1798ac; color:white;text-align:center;width:60px;border: 1px solid white">Motivo</th>
            <th style="background: #1798ac; color:white;text-align:center;width:20px;border: 1px solid white">Obra relacionada</th>
            <th style="background: #1798ac; color:white;text-align:center;width:20px;border: 1px solid white">Cantidad</th>
            <th style="background: #1798ac; color:white;text-align:center;width:20px;border: 1px solid white">Precio unitario</th>
            <th style="background: #1798ac; color:white;text-align:center;width:20px;border: 1px solid white">Monto total</th>
            <th style="background: #1798ac; color:white;text-align:center;width:20px;border: 1px solid white">Moneda</th>
            <th style="background: #1798ac; color:white;text-align:center;width:20px;border: 1px solid white">Material</th>
            <th style="background: #1798ac; color:white;text-align:center;width:20px;border: 1px solid white">solicitante</th>
            <th style="background: #0a6574; color:white;text-align:center;width:20px;border: 1px solid white">Estado</th>
            <th style="background: #0a6574; color:white;text-align:center;width:20px;border: 1px solid white">Fecha de pago</th>
            <th style="background: #0a6574; color:white;text-align:center;width:20px;border: 1px solid white">Tipo de transacción</th>
            <th style="background: #0a6574; color:white;text-align:center;width:20px;border: 1px solid white">Nro de comprobante</th>
            <th style="background: #0a6574; color:white;text-align:center;width:20px;border: 1px solid white">Banco</th>
            <th style="background: #0a6574; color:white;text-align:center;width:40px;border: 1px solid white">Descripción</th>
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
                <td>{{ $con->preciounitario * $con->cantidad }}</td> {{-- monto total --}}
                <td>{{ $con->moneda }}</td> {{-- moneda --}}
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
            @if ($con->caja_nombre != null)
            <td>{{ $con->caja_nombre }}</td> {{-- caja chica --}}
            @endif
                <td>{{ $con->nombre }}</td> {{-- solicitante --}}
            @if ($con->solicitud_estadopago == 0)
                <td>Pagado</td> {{-- Estado --}}
            @else
                <td>No pagado</td> {{-- Estado --}}
            @endif
                <td>{{ $con->pago_fecha }}</td> {{-- fecha de pago --}}
                <td>{{ $con->pago_formapago }}</td> {{-- forma de pago --}}
            @if ($con->pago_numerocomprobante != null)
                <td>{{ $con->pago_numerocomprobante }}</td> {{-- Nro de comprobante --}}
            @else
                <td>No aplica</td> {{-- Nro de comprobante --}}
            @endif
            @if ($con->banco_nombre != null)
                <td>{{ $con->banco_nombre }}</td> {{-- banco --}}
            @else
                <td>No aplica</td> {{-- banco --}}
            @endif
            @if ($con->pago_descripcion != null)
                <td>{{ $con->pago_descripcion }}</td> {{-- Descripcion de pago --}}
            @else
                <td>No aplica</td> {{-- banco --}}
            @endif
            </tr>
        @endforeach
    </tbody>
</table>
