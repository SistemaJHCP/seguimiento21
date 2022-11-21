@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Bienvenido <small>al sistema</small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Layout</a></li> --}}
    <li class="breadcrumb-item active">Inicio</li>
    <img src="{{url('imagen/bandera-panama.png') }}" width="30" height="20" alt="Sistema de Venezuela" style="margin-left: 10px; margin-top:4px;">
@endsection

@section('contenedor')
<div class="row">

    <!-- /.col-md-6 -->
    <div class="col-lg-6">
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row no-gutters">
              <div class="col-md-4">
                @if (\Auth::user()->sexo == 'm')
                    <?php !$mensaje = "o";?>
                    <div style="width:160px; height:160px; background:#47b5c6 ;margin:10px; border-radius:160px;">
                      <center>
                        <lord-icon
                            src="https://cdn.lordicon.com/vusrdugn.json"
                            trigger="hover"
                            style="text-align:center;width:150px; height:150px">
                        </lord-icon>
                      </center>
                    </div>
                @else
                    <?php !$mensaje = "a";?>
                    <div style="width:160px; height:160px; background:#47b5c6 ;margin:10px; border-radius:160px;">
                      <center>
                        <lord-icon
                            src="https://cdn.lordicon.com/qemhfpjm.json"
                            trigger="hover"
                            style="text-align:center;width:150px; height:150px">
                        </lord-icon>
                      </center>
                    </div>
                @endif
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title"><b>Bienvenid{{ $mensaje }} {{ \Auth::user()->user_name }}</b></h5>
                  <p class="card-text">{{ \Auth::user()->email }}</p>
                  <p class="card-text"><small class="text-muted"><b>Nivel de acceso: </b>{{ $permisoUsuario->nombre_permiso }}</small></p>
                  <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#staticBackdrop"><i class="fas fa-key"></i> Cambiar su contraseña</button>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
              <div class="col-1"></div>
              <div class="col-10">
              <div class="info-box mb-3 bg-info">
                    <span class="info-box-icon"><i class="far fa-check-circle"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-number">Obras realizadas</span>
                      <span class="info-box-text"> <b>Total:</b> {{ $totalObras }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>

                  <div class="info-box mb-3 bg-info">
                    <span class="info-box-icon"><i class="far fa-calendar-alt"></i></i></span>

                    <div class="info-box-content">
                      <span class="info-box-number">Para el dia {{ date('Y-m-d') }}, se han realizado</span>
                      <span class="info-box-text">{{ $totalSolicitudesGeneral }}  solicitudes</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>

                  <div class="info-box mb-3 bg-info">
                    <span class="info-box-icon"><i class="far fa-comment"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-number">Se han aprobado un total de</span>
                      <span class="info-box-text">{{ $totalSolicitudes }} solicitudes</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
              </div>
              <div class="col-1"></div>
          </div>
    </div>
    <!-- /.col-md-6 -->

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Ultimas solicitudes cargadas</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0" style="overflow: scroll;max-height:450px;">
              <ul class="products-list product-list-in-card pl-2 pr-2">
                @foreach ($solicitud as $sol)
                    <li class="item">
                        <div class="product-img">
                        <i class="fas fa-clipboard-list" style="color:#17a2b8;font-size:40px;margin-left:10px;"></i>
                        </div>
                        <div class="product-info">
                        <b>Solicitud: </b>{{ $sol->numerocontrol }}
                            @if ($sol->aprobacion == "Aprobada")
                                <span class="badge badge-success float-right">Aprobada</span>
                            @elseif($sol->aprobacion == "Rechazada")
                                <span class="badge badge-danger float-right">Rechazada</span>
                            @elseif($sol->aprobacion == "Anulada")
                                <span class="badge badge-secondary float-right">Anulada</span>
                            @elseif($sol->aprobacion == "Sin Respuesta")
                                <span class="badge badge-warning float-right">Sin Respuesta</span>
                            @endif
                        <span class="product-description">
                            @if ($sol->requisicion_codigo != NULL)
                                <b>Requisición: </b>{{ $sol->requisicion_codigo }} | <b>Fecha solicitud: </b>{{ $sol->fecha }}
                            @else
                                <b>Requisición: </b>Sin asignar | <b>Fecha solicitud: </b>{{ $sol->fecha }}
                            @endif
                        </span>
                        </div>
                    </li>
                @endforeach
                <!-- /.item -->
              </ul>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">

            </div>
            <!-- /.card-footer -->
          </div>
    </div>
  </div>

  <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title" id="staticBackdropLabel">Cambie su contraseña</h5>
          <button type="button" class="close" style="color:white;" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-8">
            <form action="{{ route('home.clave') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Ingrese su contraseña</label>
                        <input type="password" name="clave" id="clave" placeholder="Ingrese su contraseña" class="form-control" maxlength="60">
                        <label>Repita su contraseña</label>
                        <input type="password" id="clave2" placeholder="Repita la contraseña" class="form-control" maxlength="60">
                    </div>

            </div>
            <div class="col-4">
                <i class="fas fa-unlock" style="font-size: 100px; padding:20px;color:#17a2b8;"></i>
            </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-info" id="cambiar" disabled>Cambiar contraseña</button>
        </div>
        </form>
      </div>
    </div>
  </div>


@endsection
@section('js')
<script src="https://cdn.lordicon.com/qjzruarw.js"></script>
<script src="{{ asset("js/base.js") }}"></script>
@if (Session::has('resp'))

    @if (Session::has('resp') == true)
    <script>
        Swal.fire(
        'Solicitud procesada!',
        'Se ha modificado su contraseña!',
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

@if (Session::has('no'))
    <script>
        alert("Usted no tiene acceso");
        var nombre = {{ \Auth::user()->user_name }}
        Swal.fire(
        nombre,
        'Se ha modificado su contraseña!',
        'error'
        )
    </script>
@endif
@endsection
