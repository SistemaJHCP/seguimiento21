<a href="{{ route("cliente.consultar", $id) }}"><button title="Consultar un cliente" id="consultar" class="btn btn-info fas fa-search" data-toggle="modal" data-target="#editarUsuario"></button></a>
<a href="{{ route("cliente.modificar", $id) }}"><button title="Modificar datos del cliente"  id="modificar" class="btn btn-info fas fa-edit"></button></a>
<button title="Desactivar un cliente" value="{{ $id }}" id="desactivar" class="btn btn-info fas fa-times"></button>



