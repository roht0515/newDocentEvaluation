<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  @section('meta')
  @show

  <title>Administrador</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  @section('styles')

  @endsection
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">

  <style>
    .navbar-upds {
      background-color: #0f4a7d !important;

    }

    .user-panel {
      border-bottom: 1px solid #C6C6C6 !important;
    }

    .brand-link {
      border-bottom: 1px solid #C6C6C6 !important;
    }
  </style>

  @section('style')

  @show
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="index3.html" class="nav-link">Inicio</a>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-power-off"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
              <i class="fas fa-sign-out-alt mr-2"></i>{{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Contain -->

    <aside class="main-sidebar sidebar-dark-primary navbar-upds elevation-4">
      <!-- Brand Logo -->
      <a href="{{url('/admin')}}" class="brand-link">
        <img src="{{ asset('images/icons/isologo-blanco.png') }}" alt="AdminLTE Logo"
          class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Administrador</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">{{ auth()->user()->username}}</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <li class="nav-header">MENU</li>
            <!-- /.Vicerrector evaluacion docente -->
            @if (auth()->user()->role=="Administrador Evaluacion")

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Diplomados
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('diplomats.list')}}" class="nav-link">

                    <i class="fas fa-list-alt nav-icon"></i>
                    <p>Lista</p>
                  </a>
                  <a href="{{route('modulesStudent.list')}}" class="nav-link">
                    <i class="fas fa-align-left nav-icon"></i>
                    <p>Modulos</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-address-card"></i>
                <p>
                  Personal
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('professors.list')}}" class="nav-link">
                    <i class="nav-icon fas fa-chalkboard-teacher"></i>
                    <p>Docentes</p>
                  </a>
                  <a href="{{route('students.list')}}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Estudiantes</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  Evaluaciones
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('evaluations.list')}}" class="nav-link">
                    <i class="fas fa-file nav-icon"></i>
                    <p>Evaluacion</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('categories.list')}}" class="nav-link">
                    <i class="fas fa-clone nav-icon"></i>
                    <p>Categorias</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="" class="nav-link">
                <i class="nav-icon fas fa-database"></i>
                <p>
                  Historial
                </p>
              </a>
            </li>
            @endif
            <!-- /.Secretario Gral -->
            @if (auth()->user()->role=="Administrador Secretaria")
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Secretaria
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('certificates.list')}}" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                      Certificados
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('certificates.listdiplomat')}}" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                      Diplomados
                    </p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Entregados
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('certificates.historyStudent')}}" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                      Certificados-Estudiantes
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('certificates.historyTutor')}}" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                      Certificados-Tutor
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('diplomats.historyTutor')}}" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                      Diplomados-Tutor
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('diplomats.historyStudent')}}" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                      Diplomados-Estudiantes
                    </p>
                  </a>
                </li>
              </ul>
            </li>
            @endif
            @if (auth()->user()->role =="Administrador")
            <!-- /.Administrador -->
            <li class="nav-item">
              <a href="{{ route('users.list') }}" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Usuarios
                </p>
              </a>
            </li>
            @endif

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <section class="content">
        <div class="container-fluid">

          @yield('content')

        </div>
      </section>

    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- ChartJS -->
  <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
  <!-- Sparkline -->
  <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
  <!-- JQVMap -->
  <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
  <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
  <!-- daterangepicker -->
  <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
  <!-- Summernote -->
  <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
  <!-- overlayScrollbars -->
  <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/adminlte.js') }}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('dist/js/demo.js') }}"></script>
  {{-- Plugins Jquery validaciones --}}
  <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
  {{-- Alertas --}}
  <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
  <!--CDNS A DESCARGART PERRO--->
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

  <script src="  https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

  <script>
    window.location.hash="no-back-button";
    window.location.hash="Again-No-back-button";//esta linea es necesaria para chrome
    window.onhashchange=function(){window.location.hash="no-back-button";}
  </script>
  @section('script')
  @show
</body>

</html>