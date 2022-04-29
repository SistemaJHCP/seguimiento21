@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Usuarios <small>del sistema</small></h1>
@endsection
@section('navegador')
    <li class="breadcrumb-item active">Usuarios</li>
    <img src="{{url('imagen/bandera-panama.png') }}" width="30" height="20" alt="Sistema de Venezuela" style="margin-left: 10px; margin-top:4px;">
@endsection

@section('contenedor')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <div class="info-box" data-toggle="modal" data-target="#crearUsuario">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-plus"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">CREAR UN</span>
                        <span class="info-box-number">
                        USUARIO
                        <small></small>
                        </span>
                    </div>
                <!-- /.info-box-content -->
                </div>
                <a href="{{ route('usuario.inhabilitados') }}">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users-slash"></i></span>

                        <div class="info-box-content" style="color:black;">
                            <span class="info-box-text">CONSULTAR USUARIOS</span>
                            <span class="info-box-number">
                            DESHABILITADOS
                            <small></small>
                            </span>
                        </div>
                    <!-- /.info-box-content -->
                    </div>
                </a>
            </div>
            <div class="col-sm-12 col-md-8">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Usuarios activos en el sistema</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                    <table id="listaUsuarios" class="table table-bordered table-hover display responsive no-wrap">
                    <thead>
                    <tr>
                        <th>Nombre de usuario</th>
                        <th>Correo</th>
                        <th>Acción</th>

                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Nombre de usuario</th>
                        <th>Correo</th>
                        <th>Acción</th>
                    </tr>
                    </tfoot>
                    </table>
                </div>
              <!-- /.card-body -->
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="crearUsuario" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background:#17a2b8;color:white;">
              <h5 class="modal-title" id="staticBackdropLabel"><center>Crear un usuario</center></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white;">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('usuario.cargarUsuario') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                      <label for="">Nombre de usuario</label>
                      <input type="text" name="nameUser" id="nameUser" class="form-control" placeholder="minimo 3 caracteres, máximo 50" maxlength="50"  autocomplete="off" required>

                      <label for="">Ingrese su nombre y apellido</label>
                      <input type="text" name="complete_name" id="complete_name" class="form-control" placeholder="minimo 3 caracteres, máximo 50" maxlength="50"  autocomplete="off" required>

                      <label for="">Ingrese su correo empresarial</label>
                      <input type="text" name="email" id="email" class="form-control" placeholder="minimo 6 caracteres, máximo 50" maxlength="50"  autocomplete="off" required>

                      <label for="">Ingrese su género</label>
                      <select name="sexo" id="sexo" class="form-control" required>
                          <option value="">Seleccione...</option>
                          <option value="m">Masculino</option>
                          <option value="f">Femenino</option>
                      </select>

                      <label for="">Ingrese su contraseña</label>
                      <input type="password" name="password" id="password" class="form-control" placeholder="minimo 6 caracteres, máximo 50" maxlength="30"  autocomplete="off" required>

                      <label for="">Repita la contraseña</label>
                      <input type="password" name="password2" id="password2" class="form-control" placeholder="Repita la contraseña escrita arriba" maxlength="30"  autocomplete="off" required>

                      <label for="">Nombre de usuario</label>
                      <select name="levelAccess" id="levelAccess" class="form-control" autocomplete="off" required>
                          <option value="">Seleccione...</option>
                          @foreach ($permisos as $p)
                            <option value="{{ $p->id }}">{{ $p->nombre_permiso }}</option>
                          @endforeach
                      </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="cargar" id="cargar" class="btn btn-primary" value="Agregar al usuario" disabled>
                </div>
            </form>
          </div>
        </div>
      </div>


      <div class="modal fade" id="editarUsuario" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background:#17a2b8;color:white;">
              <h5 class="modal-title" id="staticBackdropLabel"><center>Modificar un usuario</center></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white;">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('usuario.modificandoUsuario') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                      <label for="">Nombre de usuario</label>
                      <input type="text" name="nameUser" id="nameUser2" class="form-control" placeholder="minimo 3 caracteres, máximo 50" maxlength="50"  autocomplete="off" required>

                      <label for="">Ingrese su nombre y apellido</label>
                      <input type="text" name="complete_name" id="complete_name2" class="form-control" placeholder="minimo 3 caracteres, máximo 50" maxlength="50"  autocomplete="off" required>

                      <label for="">Ingrese su correo empresarial</label>
                      <input type="text" name="email" id="email2" class="form-control" disabled placeholder="minimo 6 caracteres, máximo 50" maxlength="50"  autocomplete="off" required>

                      <label for="">Ingrese su género</label>
                      <select name="sexo" id="sexo2" class="form-control" required>
                          <option value="">Seleccione...</option>
                          <option value="m">Masculino</option>
                          <option value="f">Femenino</option>
                      </select>

                      <label for="">Ingrese su contraseña</label>
                      <input type="password" name="password" id="password22" class="form-control" placeholder="minimo 6 caracteres, máximo 50" maxlength="30"  autocomplete="off" required>

                      <label for="">Repita la contraseña</label>
                      <input type="password" name="password2" id="password222" class="form-control" placeholder="Repita la contraseña escrita arriba" maxlength="30"  autocomplete="off" required>

                      <label for="">Nivel de permisología</label>
                      <select name="levelAccess" id="levelAccess2" class="form-control" autocomplete="off" required>
                          <option value="">Seleccione...</option>
                          @foreach ($permisos as $p)
                            <option value="{{ $p->id }}">{{ $p->nombre_permiso }}</option>
                          @endforeach
                      </select>
                      <input type="hidden" name="guia" id="guia" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrar2">Cerrar</button>
                    <input type="submit" name="modificar" id="modificar" class="btn btn-primary" value="Modificar al usuario" disabled>
                </div>
            </form>
          </div>
        </div>
      </div>





@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}">
    <link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}">
    <link rel="stylesheet" href="{{ asset("plugins/plugins/datatables-buttons/css/buttons.bootstrap4.min.css") }}">
    <link rel="stylesheet" href="{{ asset("plugins/plugins/fontawesome-free/css/all.css") }}">
@endsection
@section('js')
    <script src="{{ asset("plugins/plugins/datatables/jquery.dataTables.min.js") }}"></script>
    <script src="{{ asset("plugins/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") }}"></script>
    <script src="{{ asset("plugins/plugins/datatables-responsive/js/dataTables.responsive.min.js") }}"></script>
    <script src="{{ asset("plugins/plugins/datatables-responsive/js/responsive.bootstrap4.min.js") }}"></script>
    <script src="{{ asset("plugins/plugins/datatables-buttons/js/dataTables.buttons.min.js") }}"></script>
    <script src="{{ asset("plugins/plugins/datatables-buttons/js/buttons.bootstrap4.min.js") }}"></script>
    <script src="{{ asset("plugins/plugins/jszip/jszip.min.js") }}"></script>
    <script src="{{ asset("plugins/plugins/pdfmake/pdfmake.min.js") }}"></script>
    <script src="{{ asset("plugins/plugins/pdfmake/vfs_fonts.js") }}"></script>
    <script src="{{ asset("plugins/plugins/datatables-buttons/js/buttons.html5.min.js") }}"></script>
    <script src="{{ asset("plugins/plugins/datatables-buttons/js/buttons.print.min.js") }}"></script>
    <script src="{{ asset("plugins/plugins/datatables-buttons/js/buttons.colVis.min.js") }}"></script>
    <script src="{{ asset("js/usuarios/usuario.js") }}"></script>
    @if (Session::has('user'))

        @if (Session::has('user'))
        <script>
            Swal.fire(
            'Solicitud procesada!',
            'La información fue cargada exitosamente!',
            'success'
            )
        </script>
        @else
        <script>
            Swal.fire(
            'No se cargo la información!',
            'No se pudo guardar en el sistema',
            'error'
            )
        </script>
        @endif

    @endif


    @if (count($errors) > 0)
    {{-- Este es el mensaje de error desde la validacion --}}
        <script>
            Swal.fire(
            'Hubo un error!',
            'el formulario no esta correctamente cargado!',
            'error'
            )
        </script>
    @endif

@endsection


