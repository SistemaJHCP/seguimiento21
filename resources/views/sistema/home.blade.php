@extends('layouts.app')

@section('titulo')
    <h1 class="m-0"> Bienvenido <small>al sistema</small></h1>
@endsection
@section('navegador')
    {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Layout</a></li> --}}
    <li class="breadcrumb-item active">Inicio</li>
@endsection

@section('contenedor')
<div class="row">

    <!-- /.col-md-6 -->
    <div class="col-lg-6">
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row no-gutters">
              <div class="col-md-4">
                @if (\Auth::user()->sexo == 'm')
                    <center><img src="{{ url('imagen/users.png') }}" class="img-responsive" width="170" height="156" style="padding: 10px; text-align:center;" ></center>
                @else
                    <center><img src="{{ url('imagen/users2.png') }}" class="img-responsive" width="170" height="156" style="padding: 10px; text-align:center;" ></center>
                @endif
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title"><b>Bienvenido {{ \Auth::user()->user_name }}</b></h5>
                  <p class="card-text">{{ \Auth::user()->email }}</p>
                  <p class="card-text"><small class="text-muted">Nivel de acceso: {{ $permisoUsuario->nombre_permiso }}</small></p>
                  <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#staticBackdrop"><i class="fas fa-key"></i> Cambiar su contraseña</button>
                </div>
              </div>
            </div>
          </div>

      <div class="card card-primary card-outline">
        <div class="card-header">
          <h5 class="card-title m-0">Featured</h5>
        </div>
        <div class="card-body">
          <h6 class="card-title">Special title treatment</h6>

          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
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
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-info">Cambiar contraseña</button>
        </div>
      </div>
    </div>
  </div>


@endsection
