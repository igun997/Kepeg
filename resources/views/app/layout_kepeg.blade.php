<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>@yield("title")</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{url("assets/plugins/fontawesome-free/css/all.min.css")}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url("assets/dist/css/adminlte.min.css")}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="{{url("assets/plugins/datatables/dataTables.bootstrap4.min.css")}}">
  @yield("css")
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-danger">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>

    </ul>

    <!-- SEARCH FORM -->


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">

      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">

      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4 sidebar-light-danger">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{url("assets/img/logo_doc.png")}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">SIMPEG</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          @if(verify("level","admin"))
          <li class="nav-item">
            <a href="{{route("admin")}}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Data Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route("divisi")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bagian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route("gol")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Golongan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route("pegawai")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pegawai</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route("admin.data")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Administrator</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{route("cuti")}}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Kelola Cuti Pegawai
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route("pensiun")}}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Kelola Pensiun Pegawai
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route("mutasi")}}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Kelola Mutasi Pegawai
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route("kenaikan")}}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Kelola Kenaikan Golongan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route("laporan")}}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Laporan
              </p>
            </a>
          </li>
      	  @elseif(verify("level","atasan"))
          <li class="nav-item">
            <a href="{{route("admin")}}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
      	  <li class="nav-item">
            <a href="{{route("cuti")}}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Kelola Cuti Pegawai
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route("pensiun")}}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Kelola Pensiun Pegawai
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route("mutasi")}}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Kelola Mutasi Pegawai
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route("kenaikan")}}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Kelola Kenaikan Golongan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route("laporan")}}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Laporan
              </p>
            </a>
          </li>
      	  @elseif(verify("level","pegawai"))
          <li class="nav-item">
            <a href="{{route("pengawai.home")}}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
      	  <li class="nav-item">
            <a href="{{route("cuti_pegawai")}}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Cuti Pegawai
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route("pensiun_pegawai")}}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Pensiun Pegawai
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route("mutasi_pegawai")}}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Mutasi Pegawai
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route("kenaikan_pegawai")}}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Kenaikan Golongan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route("pengawai.akun")}}" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Akun
              </p>
            </a>
          </li>
          @endif

          <li class="nav-item">
            <a href="{{url("logout")}}" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">

    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          @yield("content")
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      SIstem Informasi Kepegawaian
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019 </strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{url("assets/plugins/jquery/jquery.min.js")}}"></script>
<!-- Bootstrap 4 -->
<script src="{{url("assets/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{url("assets/dist/js/adminlte.min.js")}}"></script>
<script src="{{url("assets/plugins/chart.js/Chart.min.js")}}"></script>
<script src="{{url("assets/plugins/datatables/jquery.dataTables.min.js")}}"></script>
<script src="{{url("assets/plugins/datatables/dataTables.bootstrap4.min.js")}}"></script>
@yield("js")
</body>
</html>
