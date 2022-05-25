<center>
    <a href="{{ route('cheque.index', $id) }}"><button class="btn btn-info" title="Consultar cheques"><i class="fas fa-money-check"></i></button></a>
    <button class="btn btn-info" title="Editar chequera"  data-toggle="modal" id="modCheq" data-target="#modificarChaquera" value="{{ $id }}"><i class="far fa-edit"></i></button>
    <button class="btn btn-danger" id="desactivar"title="Desactivar chequera" value="{{ $id }}"><i class="fas fa-trash-alt"></i></button>
</center>
