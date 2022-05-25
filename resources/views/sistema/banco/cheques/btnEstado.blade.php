@if ( $cheque_estado == 1 )
<center>Activo</center>
@elseif ( $cheque_estado == 2 )
<center>Pagado</center>
@else
<center>Anulado</center>
@endif
