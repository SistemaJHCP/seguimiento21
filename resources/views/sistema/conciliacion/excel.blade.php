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
            <th style="background: #1798ac; color:white;text-align:center;width:20px;">ID del elemento</th>
            <th style="background: #1798ac; color:white;text-align:center;width:20px;">ID del elemento</th>
        </tr>
    </thead>
    <tbody>
        {{-- @foreach ($conciliacion as $con)
            <tr>
                <td>{{ $con->id }}</td>
            </tr>
        @endforeach --}}
    </tbody>
</table>
