<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->

<html lang="es">
<head>
  <link rel="shortcut icon" href="{{ asset('imagen/micro-logo.png') }}" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Sistema JHCP | Ver. 1.0</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset("plugins/plugins/fontawesome-free/css/all.min.css") }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset("plugins/tema/dist/css/adminlte.min.css") }}">
  <link rel="stylesheet" href="{{ asset("plugins/plugins/fontawesome-free/css/all.css") }}">
  {{-- <link rel="stylesheet" href="{{ asset("plugins/plugins/fontawesome6/fontawesome.min.css") }}"> --}}
  <link rel="stylesheet" href="{{ asset("plugins/plugins/sweetalert2/sweetalert2.css") }}">
  <link rel="stylesheet" href="{{ asset("css/estilos.css") }}">
  <script src="{{ asset('js/proccess.js') }}"></script>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="{{ route('home') }}" class="navbar-brand">
        <img src="{{ url("imagen/logo-mini.png") }}" alt="JHCP Group" class="brand-image" style="opacity: .8; width:120px;">
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav ml-auto">
            <?php
            if( $permisoUsuario->maestro_btn == 1 ){
            ?>
            <li class="nav-item dropdown">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Maestros</a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <?php
                  if ($permisoUsuario->suministros == 1){
              ?>
                  <li><a href="{{ route('suministro.index') }}" class="dropdown-item">Suministros </a></li>
              <?php
                  }
              ?>
              <?php
                  if ($permisoUsuario->proveedores == 1){
              ?>
                  <li><a href="{{ route("proveedor.index") }}" class="dropdown-item">Proveedores </a></li>
              <?php
                  }
              ?>
              <?php
                  if ($permisoUsuario->cliente == 1){
              ?>
                  <li><a href="{{ route("cliente.index") }}" class="dropdown-item">Clientes </a></li>
              <?php
                  }
              ?>

              <?php
                  if ($permisoUsuario->materiales == 1){
              ?>
                  <li><a href="{{ route('materiales.index') }}" class="dropdown-item">Materiales </a></li>
              <?php
                  }
              ?>

              <?php
                  if ($permisoUsuario->servicio == 1){
              ?>
                  <li><a href="{{ route("servicio.index") }}" class="dropdown-item">Servicio</a></li>
              <?php
                  }
              ?>

              <?php
                  if ($permisoUsuario->viatico == 1){
              ?>
                  <li><a href="{{ route("viatico.index") }}" class="dropdown-item">Viático</a></li>
              <?php
                  }
              ?>

              <?php
                  if ($permisoUsuario->nomina == 1){
              ?>
                  <li><a href="{{ route("nomina.index") }}" class="dropdown-item">Nómina</a></li>
              <?php
                  }
              ?>

              <?php
                  if ($permisoUsuario->ptc == 1){
              ?>
                  <li><a href="{{ route("maestro.index") }}" class="dropdown-item">Maestro PTC</a></li>
              <?php
                  }
              ?>
              </ul>
          </li>
            <?php
            }
            ?>

        @if ($permisoUsuario->banco_btn == 1)
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Bancos</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            <?php
                if ($permisoUsuario->ban == 1){
            ?>
                <li><a href="{{ route('banco.index') }}" class="dropdown-item">Cargar bancos</a></li>
            <?php
                }
            ?>
            <?php
                if ($permisoUsuario->cuenta_emp == 1){
            ?>
                <li><a href="{{ route('cuenta.index') }}" class="dropdown-item">Cuentas JHCP</a></li>
            <?php
                }
            ?>
            </ul>
        </li>
        @endif



            <?php
            if ($permisoUsuario->control_de_obras_btn == 1) {
            ?>
            <li class="nav-item">
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Control de obras</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <?php
                        if ($permisoUsuario->obra == 1){
                    ?>
                        <li><a href="{{ route('obra.index') }}" class="dropdown-item">Obras </a></li>
                    <?php
                        }
                    ?>
                    <?php
                        if ($permisoUsuario->tipo == 1){
                    ?>
                        <li><a href="{{ route('tipo.index') }}" class="dropdown-item">Tipo de obra</a></li>
                    <?php
                        }
                    ?>
                    <?php
                        if ($permisoUsuario->personal == 1){
                    ?>
                        <li><a href="{{ route('personal.index') }}" class="dropdown-item">Personal  </a></li>
                    <?php
                        }
                    ?>
                    </ul>
                </li>
            </li>
            <?php
            }
            ?>
            <?php
            if ($permisoUsuario->requisicion == 1){
            ?>
                <li class="nav-item">
                    <li class="nav-item">
                        <a id="dropdownSubMenu1" href="{{ route('requisicion.index') }}" class="nav-link">Requisición</a>
                    </li>
                </li>
            <?php
            }
            ?>
            <?php
            if ($permisoUsuario->solicitud == 1){
            ?>
                <li class="nav-item">
                    <li class="nav-item">
                        <a id="dropdownSubMenu1" href="{{ route('solicitud.index') }}" class="nav-link">Solicitud</a>
                    </li>
                </li>
            <?php
            }
            ?>

            <?php
            if ($permisoUsuario->solicitud_pago == 1){
            ?>
                <li class="nav-item">
                    <li class="nav-item">
                        <a id="dropdownSubMenu1" href="{{ route('sPagoIndex.index') }}" class="nav-link">Solicitudes de pago</a>
                    </li>
                </li>
            <?php
            }
            ?>
    @if ($permisoUsuario->cuentas_por_pagar_btn == 1)
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Cuentas por pagar</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            <?php
                if ($permisoUsuario->compra_cuentas_x_pagar  == 1){
            ?>
                <li><a href="{{ route('cuentas.index') }}" class="dropdown-item">Solicitud de cuentas </a></li>
            <?php
                }
            ?>
            <?php
                if ($permisoUsuario->conciliacion == 1){
            ?>
                <li><a href="{{ route('conciliacion.index') }}" class="dropdown-item">Conciliación</a></li>
            <?php
                }
            ?>
            <?php
                if ($permisoUsuario->control_de_gasto == 1){
            ?>
                <li><a href="{{ route('costosObra.index') }}" class="dropdown-item">Control de gastos</a></li>
            <?php
                }
            ?>
            </ul>
        </li>
    @endif

    <?php
    if ($permisoUsuario->configuracion_btn == 1) {
    ?>
    <li class="nav-item">
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Configuración</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            <?php
                if ($permisoUsuario->usuario == 1){
            ?>
                <li><a href="{{ route('usuario.index') }}" class="dropdown-item">Usuarios </a></li>
            <?php
                }
            ?>
            <?php
                if ($permisoUsuario->permisos_btn == 1){
            ?>
                <li><a href="{{ route('permisos.index') }}" class="dropdown-item">Permisos </a></li>
            <?php
                }
            ?>

            </ul>
        </li>
    </li>
    <?php
    }
    ?>





          {{-- <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Dropdown</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="#" class="dropdown-item">Some action </a></li>
              <li><a href="#" class="dropdown-item">Some other action</a></li>

              <li class="dropdown-divider"></li>

              <!-- Level two dropdown-->
              <li class="dropdown-submenu dropdown-hover">
                <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Hover for action</a>
                <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                  <li>
                    <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
                  </li>

                  <!-- Level three dropdown-->
                  <li class="dropdown-submenu">
                    <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">level 2</a>
                    <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                      <li><a href="#" class="dropdown-item">3rd level</a></li>
                      <li><a href="#" class="dropdown-item">3rd level</a></li>
                    </ul>
                  </li>
                  <!-- End Level three -->

                  <li><a href="#" class="dropdown-item">level 2</a></li>
                  <li><a href="#" class="dropdown-item">level 2</a></li>
                </ul>
              </li>
              <!-- End Level two -->
            </ul>
          </li> --}}
          <li class="user-footer" style="margin-top:8px;">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="cerrar sesión" style="color:rgb(136, 25, 25);">Cerrar sesión</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                    </form>
          </li>
        </ul>

        {{-- <!-- SEARCH FORM -->
        <form class="form-inline ml-0 ml-md-3">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form> --}}
      </div>

      <!-- Right navbar links -->
      {{-- <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="{{ url("plugins/dist/img/user1-128x128.jpg") }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="{{ url("plugins/dist/img/user8-128x128.jpg") }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="{{ url("plugins/dist/img/user3-128x128.jpg") }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul> --}}
    </div>
  </nav>
  <!-- /.navbar -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background: rgb(135, 182, 143)"> {{-- Rosman --}}
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
                @yield("titulo")
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                @yield("navegador")
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        @yield("contenedor")
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
        Ver. 1.0
    </div>
    <!-- Default to the left -->
    Sistema JHCP. <strong>Copyright &copy; 2014-{{ date('Y') }} </strong> Todos los derechos reservados
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset("plugins/plugins/jquery/jquery.min.js") }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset("plugins/plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset("plugins/dist/js/adminlte.min.js") }}"></script>
@yield('css')
<script src="{{ asset("plugins/plugins/sweetalert2/sweetalert2.min.js") }}"></script>
<script src="{{ asset("plugins/plugins/toastr/toastr.min.js") }}"></script>
<script src="{{ asset('js/home.js') }}"></script>
@yield('js')
</body>
</html>

