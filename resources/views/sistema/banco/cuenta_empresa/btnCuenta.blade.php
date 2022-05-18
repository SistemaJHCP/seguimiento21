<center>
    <a href="{{ route('chequera.index', $id) }}"><button type="button" title="Chequeras JHCP" class="btn btn-success"><i class="fas fa-money-check-alt"></i></button></a>
    <button type="button" title="Modificar cuenta JHCP" class="btn btn-info"  data-toggle="modal" data-target="#modificarBanco" id="modificar"value="{{ $id }}"><i class="far fa-edit"></i></button>
    <button type="button" title="Desactivar cuenta JHCP" class="btn btn-danger" id="deshabilitar"value="{{ $id }}"><i class="far fa-times-circle"></i></button>
</center>
