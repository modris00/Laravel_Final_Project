<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UCAS - Show Feedback</title>
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

    <!-- DataTables -->
    {{-- <link rel="stylesheet" href="{{ asset('ucas/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('ucas/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('ucas/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}"> --}}

    <style>
        td {
            color: blue;
        }
    </style>
</head>

<!--you can add sidebar-collapse class to the body -->

<body class="hold-transition layout-top-nav">

    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                {{-- <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li> --}}
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('feedbacks.create') }}" class="nav-link">Create New Feedback</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('feedbacks.search') }}" class="nav-link">Go Back To Search Page</a>
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

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">UCAS Feedbacks</h1>
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
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Details of Feedback No {{ $feedback->id }}</h3>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        {{-- <thead>
                                            <th>test</th>
                                        </thead> --}}
                                        <tbody>
                                            <tr>
                                                {{-- <th>Image</th> --}}
                                                <th>Student Image</th>
                                                <td>

                                                    @if ($feedback->image)
                                                        {{-- <img class="img-circle img-bordered-sm" height="65" width="65"
                                                        src="{{ Storage::url($feedback->image) }}" alt="user image"> --}}
                                                        {{-- <img class="img-circle img-bordered-sm" height="65"
                                                            width="65" src="{{ asset('ucas/man.png') }}"
                                                            alt="std_image"> --}}

                                                        <a href="{{ Storage::url($feedback->image) }}"
                                                            data-toggle="lightbox">
                                                            <img class="img-circle img-bordered-sm" height="120"
                                                                width="120"
                                                                src="{{ Storage::url($feedback->image) }}"
                                                                alt="std_image"></a>
                                                    @else
                                                        {{-- <span>No image</span> --}}
                                                        <a href="{{ asset('ucas/man.png') }}" data-toggle="lightbox">
                                                            <img class="img-circle img-bordered-sm" height="120"
                                                                width="120" src="{{ asset('ucas/man.png') }}"
                                                                alt="std_image"></a>
                                                    @endif
                                                </td>


                                            </tr>
                                            <tr>
                                                {{-- <th>Image</th> --}}
                                                <th>Student ID:</th>
                                                <td>{{ $feedback->student_university_id }}</td>


                                            </tr>
                                            <tr>
                                                {{-- <th>Image</th> --}}
                                                <th>Student Name</th>
                                                <td>{{ $feedback->student_name }}</td>

                                            </tr>
                                            <tr>
                                                {{-- <th>Image</th> --}}
                                                <th>Student Email</th>
                                                <td>{{ $feedback->student_email }}</td>
                                            </tr>
                                            <tr>
                                                {{-- <th>Image</th> --}}
                                                <th>Feedback ID</th>
                                                <td>{{ $feedback->id }}</td>
                                            </tr>
                                            <tr>
                                                {{-- <th>Image</th> --}}
                                                <th>Feedback Title</th>
                                                <td>{{ $feedback->title }}</td>
                                            </tr>
                                            <tr>
                                                {{-- <th>Image</th> --}}
                                                <th>Feedback Message</th>
                                                <td>{{ $feedback->message }}</td>
                                            </tr>
                                            <tr>
                                                {{-- <th>Image</th> --}}
                                                <th>Feedback Response</th>
                                                <td>
                                                    {{-- {{ $feedback->response ? $feedback->response : '-' }} --}}
                                                    @if ($feedback->response)
                                                        <span
                                                            style="color: green; font-weight:bold">{{ $feedback->response }}</span>
                                                    @else
                                                        <span>-</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                {{-- <th>Image</th> --}}
                                                <th>Feedback Status</th>
                                                <td>
                                                    @if ($feedback->status == 'Open')
                                                        <span style="color: green">{{ $feedback->status }}</span>
                                                    @else
                                                        <span style="color: orange">{{ $feedback->status }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->



        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Made by Mohammed Risha
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

</body>

</html>
