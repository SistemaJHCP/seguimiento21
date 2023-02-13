
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="shortcut icon" href="{{ asset('imagen/micro-logo.png') }}" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Sistema JHCP | Ver. 2.0</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('plugins/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('plugins/tema/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/plugins/fontawesome-free/css/all.css') }}">
  <!-- <link rel="stylesheet" href="{{ asset('plugins/plugins/fontawesome6/fontawesome.min.css') }}"> -->
  <link rel="stylesheet" href="{{ asset('plugins/plugins/sweetalert2/sweetalert2.css') }}">
  <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
  <script src="{{ asset('js/proccess.js') }}"></script>
</head>
<body class="hold-transition sidebar-mini sidebar-collapse">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="cerrar sesión" style="color:rgb(136, 25, 25);" class="fas fa-power-off"> Cerrar sesión</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
          </form>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
      
      <span class="brand-text font-weight-light">Sistema JHCP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image" style="margin-left: -14px;">
        @if (\Auth::user()->sexo == 'm')
                    <?php !$mensaje = "o";?>
                    <div style="width:44px; height:44px; background:#47b5c6 ;margin:10px; border-radius:44px;">
                      <center>
                        <!-- <lord-icon
                            src="https://cdn.lordicon.com/vusrdugn.json"
                            trigger="hover"
                            style="text-align:center;width:44px; height:44px">
                        </lord-icon> -->
                        <img src="{{ url('imagen/users.png') }}" alt="" style="text-align:center;width:44px; height:44px">
                      </center>
                    </div>
                @else
                    <?php !$mensaje = "a";?>
                    <div style="width:44px; height:44px; background:#47b5c6 ;margin:10px; border-radius:44px;">
                      <center>
                        <!-- <lord-icon
                            src="https://cdn.lordicon.com/qemhfpjm.json"
                            trigger="hover"
                            style="text-align:center;width:44px; height:44px">
                        </lord-icon> -->
                        <img src="{{ url('imagen/users2.png') }}" alt="" style="text-align:center;width:44px; height:44px">
                      </center>
                    </div>
                @endif
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->user_login }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


        @if( $permisoUsuario->maestro_btn == 1 )

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-wrench"></i>
              <p>
                Maestro
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              @if ($permisoUsuario->suministros == 1)
                <li class="nav-item">
                  <a href="{{ route('suministro.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p> Suministros </p></a>
                </li>
              @endif

              @if ($permisoUsuario->proveedores == 1)
                <li class="nav-item">
                  <a href="{{ route('proveedor.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p> Proveedores </p></a>
                </li>
              @endif
              @if ($permisoUsuario->cliente == 1)
                <li class="nav-item">
                  <a href="{{ route('cliente.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p> Clientes </p></a>
                </li>
              @endif
              <?php
                  if ($permisoUsuario->materiales == 1){
              ?>
                  <li class="nav-item">
                    <a href="{{ route('materiales.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p> Materiales </p></a>
                  </li>
              <?php
                  }
              ?>
              <?php
                  if ($permisoUsuario->servicio == 1){
              ?>
                  <li class="nav-item">
                    <a href="{{ route('servicio.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p> Servicio </p></a>
                  </li>
              <?php
                  }
              ?>
              <?php
                  if ($permisoUsuario->viatico == 1){
              ?>
                  <li class="nav-item">
                    <a href="{{ route('viatico.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p> Viático </p></a>
                  </li>
              <?php
                  }
              ?>
              <?php
                  if ($permisoUsuario->nomina == 1){
              ?>
                  <li class="nav-item">
                    <a href="{{ route('nomina.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p> Nómina </p></a>
                  </li>
              <?php
                  }
              ?>
              <?php
                  if ($permisoUsuario->ptc == 1){
              ?>
                  <li class="nav-item">
                    <a href="{{ route('maestro.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p> Maestro PTC </p></a>
                  </li>
              <?php
                  }
              ?>
            </ul>
          </li>
        @endif


        @if ($permisoUsuario->banco_btn == 1)
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-university"></i>
                <p>
                  Bancos
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">

          @if ($permisoUsuario->ban == 1)
            <li class="nav-item">
              <a href="{{ route('banco.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> Bancos </p></a>
            </li>
          @endif

          @if ($permisoUsuario->cuenta_emp == 1)
            <li class="nav-item">
              <a href="{{ route('cuenta.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> Cuentas JHCP </p></a>
            </li>
          @endif
        @endif
          </li>
        </ul>

        @if ($permisoUsuario->control_de_obras_btn == 1)
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tools"></i>
                <p>
                  Obras
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">

          @if ($permisoUsuario->ban == 1)
            <li class="nav-item">
              <a href="{{ route('banco.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> Bancos </p></a>
            </li>
          @endif

          @if ($permisoUsuario->cuenta_emp == 1)
            <li class="nav-item">
              <a href="{{ route('cuenta.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> Cuentas JHCP </p></a>
            </li>
          @endif
        @endif
          </li>
        </ul>






































          <!-- <li class="nav-header">LABELS</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Important</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Warning</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Informational</p>
            </a>
          </li>
        </ul> -->
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
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

  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
        Ver 3.0
    </div>
    <!-- Default to the left -->
    Sistema JHCP. <strong>Copyright &copy; 2014-{{ date('Y') }} </strong> Todos los derechos reservados
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="{{ asset('plugins/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('plugins/dist/js/adminlte.min.js') }}"></script>
@yield('css')
<script src="{{ asset('plugins/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('plugins/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('js/home.js') }}"></script>
@yield('js')
</body>
</html>
