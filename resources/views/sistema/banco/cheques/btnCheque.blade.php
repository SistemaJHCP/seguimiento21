@if ( $cheque_estado == 1 || $cheque_estado == 2 )
    <center><div class="btn btn-danger" id="anular" stork="{{ $cheque_codigo }}" value="{{ $id }}" title="Anular cheque"><i class="fas fa-ban"></i></div></center>
@else
    <center><div class="btn btn-secondary" title="Ya ha sido anulado este cheque"><i class="fas fa-ban"></i></div></center>
@endif
