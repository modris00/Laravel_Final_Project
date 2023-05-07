<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - @yield('title')</title>

    <link rel="icon" href="{{ asset('ucas/favicon.png') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('ucas/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('ucas/dist/css/adminlte.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('ucas/plugins/toastr/toastr.min.css') }}">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="{{ asset('ucas/plugins/ekko-lightbox/ekko-lightbox.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('ucas/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

    <!-- DataTables -->
    {{-- <link rel="stylesheet" href="{{ asset('ucas/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('ucas/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('ucas/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}"> --}}

    {{-- <style>
        .modal-header {
            display: none;
            border-bottom: 0 none;
            /* background-color: red; */
        }

        .modal-footer {
            border-top: 0 none;
            /* background-color: red; */

        }

        /* .modal-body{
            padding: 0px;
            margin: 0px;
        } */

        /* .modal-content {
            background-color: red
        } */
    </style> --}}
    @yield('style')
</head>

<!--you can add sidebar-collapse class to the body -->

<body class="hold-transition sidebar-mini ">

    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('ucas.starter') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="dropdown_f"
                        data-toggle="dropdown">Feedbacks</a>
                    <ul aria-labelledby="dropdown_f" class="dropdown-menu border-0 shadow">
                        <li><a href="{{ route('feedbacks.index') }}" class="dropdown-item">Read </a></li>
                        {{-- <li><a href="#" class="dropdown-item">Some other action</a></li> --}}

                        {{-- <li class="dropdown-divider"></li> --}}
                    </ul>
                </li>
                <li class="nav-item d-none d-sm-inline-block dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="dropdown_s"
                        data-toggle="dropdown">Supervisors</a>
                    <ul aria-labelledby="dropdown_s" class="dropdown-menu border-0 shadow">
                        <li><a href="{{ route('admins.create') }}" class="dropdown-item">Create</a></li>
                        <li><a href="{{ route('admins.index') }}" class="dropdown-item">Read </a></li>

                        {{-- <li class="dropdown-divider"></li> --}}
                    </ul>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('ucas.starter') }}" class="brand-link">
                <img src="{{ asset('ucas/ucas-logo.png') }}" alt="AdminLTE Logo" class="brand-image"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">UCAS Dashboard</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        {{-- <img src="{{ asset('ucas/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                            alt="User Image"> --}}
                        @if (auth('supervisor')->user()->image)
                            <a href="{{ route('admins.show', auth('supervisor')->user()->id) }}" class="d-block">
                                <img src="{{ Storage::url(auth('supervisor')->user()->image) }}"
                                    class="img-circle elevation-1" alt="User Image">
                            </a>
                        @else
                            <a href="{{ route('admins.show', auth('supervisor')->user()->id) }}" class="d-block">
                                <img src="{{ asset('ucas/man.png') }}" class="img-circle elevation-1" alt="User Image">
                            </a>
                        @endif
                    </div>
                    <div class="info">
                        <a href="{{ route('admins.show', auth('supervisor')->user()->id) }}"
                            class="d-block">{{ auth('supervisor')->user()->name }}</a>

                    </div>
                </div>

                <!-- SidebarSearch Form -->
                {{-- <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div> --}}

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-child-indent" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                        {{-- <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Starter Pages
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Active Page</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Inactive Page</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Simple Link
                                    <span class="right badge badge-danger">New</span>
                                </p>
                            </a>
                        </li> --}}
                        <li class="nav-header">Feedbacks Center</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                {{-- <i class="fas fa-users"></i> --}}
                                <i class="nav-icon fas fa-comment text-primary"></i>
                                <p>
                                    Feedbacks
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: none;">
                                <li class="nav-item">
                                    <a href="{{ route('feedbacks.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-list-ol text-primary"></i>
                                        <p>Read</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- <br> --}}
                        <li class="nav-header">Human Resource</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                {{-- <i class="nav-icon fas fa-search"></i> --}}
                                {{-- <i class="fas fa-users"></i> --}}
                                <i class="nav-icon fas fa-users-cog text-success"></i>
                                <p>
                                    Supervisors
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: none;">
                                <li class="nav-item">
                                    <a href="{{ route('admins.create') }}" class="nav-link">
                                        <i class="nav-icon fas fa-plus text-success"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview" style="display: none;">
                                <li class="nav-item">
                                    <a href="{{ route('admins.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-list-ol text-success"></i>
                                        <p>Read</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-header">Settings</li>
                        <li class="nav-item">
                            <a href="{{ route('ucas.logout') }}" class="nav-link">
                                {{-- <i class="nav-icon far fa-circle text-danger"></i> --}}
                                <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                                <p class="text">Logout</p>
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
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">UCAS Dashboard</h1>
                        </div><!-- /.col -->
                        {{-- <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">UCAS Dashboard</li>
                            </ol>
                        </div> --}}
                        <!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            @yield('content')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Made By Mohammed Risha
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2022-2023 <a href="#">UCAS</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('ucas/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('ucas/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('ucas/dist/js/adminlte.min.js') }}"></script>

    {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
    <!-- Toastr -->
    <script src="{{ asset('ucas/plugins/toastr/toastr.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('ucas/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Ekko Lightbox -->
    <script src="{{ asset('ucas/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
    <script>
        $(function() {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: false
                });
            });
        })
    </script>

    <!-- DataTables  & Plugins -->
    {{-- <script src="{{ asset('ucas/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('ucas/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('ucas/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('ucas/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('ucas/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('ucas/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('ucas/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('ucas/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('ucas/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('ucas/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('ucas/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('ucas/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script> --}}

    @yield('scripts')
</body>

</html>
