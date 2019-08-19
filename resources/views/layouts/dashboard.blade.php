<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Paraba</title>
  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <!-- Styles  sb-admin -->
  <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sb-admin-2.css') }}">
  <!-- Styles  tadatable -->
  <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/vanillatoasts.css') }}">
  <!-- Tempusdominus DateTime Picker-->
  <link rel="stylesheet" href="{{ asset('css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- Custom Style by Amilkar -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-info sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-tachometer-alt"></i>
        </div>
        <div class="sidebar-brand-text mx-3">PARABA <sup>ADM</sup></div>
      </a>
      <!-- Divider -->
      <div class="sidebar-heading">
        Ajustes
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <i class="fas fa-fw fa-user-cog"></i>
          <span>Parametros</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Catálogos:</h6>
            <a class="collapse-item" href="{{ route('country') }}">Países</a>
            <a class="collapse-item" href="{{ route('document_type') }}"">Tipos de Documento</a>
            <a class="collapse-item" href="{{ route('occupation') }}"">Ocupaciones</a>
            <a class="collapse-item" href="{{ route('language') }}"">Idiomas</a>
            <hr class="sidebar-divider">
            <a class="collapse-item" href="{{ route('tag') }}"">Etiquetas</a>
            <a class="collapse-item" href="{{ route('transport_type') }}"">Tipos de Transporte</a>
            <a class="collapse-item" href="{{ route('location_type') }}"">Tipos de Ubicación</a>
          </div>
        </div>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Turtistas
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-user"></i>
          <span>Usuarios</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Usuarios:</h6>
            <a class="collapse-item" href="#">Turistas registrados</a>
            <a class="collapse-item" href="#">Registro de Ubicación</a>
          </div>
        </div>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Contenido
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
          <i class="fas fa-fw fa-newspaper"></i>
          <span>Árticulos</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Árticulos:</h6>
            <a class="collapse-item" href="#">Trasnporte</a>
            <a class="collapse-item" href="#">Sitios Turitisticos</a>
            <a class="collapse-item" href="#">Anuncios</a>
          </div>
        </div>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
    <!-- End of Sidebar -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          @yield('title_dashboard')
          <!-- Topbar Navbar User -->
          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                <i class="fas fa-user text-gray-600"></i>
                <!--<img class="img-profile rounded-circle" src="/images/user.jpg">-->
              </a>
              <!-- Dropdown - User Information-->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Salir
                </a>
              </div>
            </li>

          </ul>
        </nav>
        <!-- End of Topbar -->
        <!-- Begin Page Content -->
        <div class="container-fluid">
          @yield('content')
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Paraba 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro que quieres cerrar la sesión?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Seleccionaste "Salir" presiona aceptar para cerrar la sesión actual.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
              {{ __('Aceptar') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </div>
      </div>
    </div>
  </div>
 
  <script src="{{ asset('js/assets/jquery-3.3.1.js') }}"></script>
  <script src="{{ asset('js/assets/popper.min.js') }}"></script>
  <!--Admin-->
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('js/sb-admin-2.js') }}"></script>
  <!--Alert-->
  <script src="{{ asset('js/assets/push.js') }}"></script>
  <script src="{{ asset('js/assets/vanillatoasts.js') }}"></script>
  <!--Date Tables-->
  <script src="{{ asset('js/assets/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('js/assets/dataTables.bootstrap4.min.js') }}"></script>
  <!--Export Print DateTables-->
  <script src="{{ asset('js/assets/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('js/assets/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('js/assets/jszip.min.js') }}"></script>
  <script src="{{ asset('js/assets/pdfmake.min.js') }}"></script>
  <script src="{{ asset('js/assets/vfs_fonts.js') }}"></script>
  <script src="{{ asset('js/assets/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('js/assets/buttons.print.min.js') }}"></script>
  <script src="{{ asset('js/assets/buttons.colVis.min.js') }}"></script>
  <!--Tempusdominus DateTime Picker-->
  <script src="{{ asset('js/assets/moment.js') }}"></script>
  <script src="{{ asset('js/assets/es.js') }}"></script>
  <script src="{{ asset('js/assets/tempusdominus-bootstrap-4.js') }}"></script>
  <!--Config-->
  <script src="{{ asset('js/scripts/main.js') }}"></script>

  @yield('scripts')
</body>
</html>
