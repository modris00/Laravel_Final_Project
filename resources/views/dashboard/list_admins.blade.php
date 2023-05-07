@extends('dashboard.parent')
@section('title', 'All Admins')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-info">All Supervisors <a type="button"
                                    href="{{ route('admins.create') }}" class="btn btn-outline-success btn-sm">Create New</a>
                            </h3>

                            {{-- <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right"
                                    placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div> --}}
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            {{-- <table class="table table-hover text-nowrap"> --}}
                            <table id="adminsTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        {{-- <th>Image</th> --}}
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile Number</th>
                                        <th>Address</th>
                                        <th>verified_at</th>
                                        <th>Actions</th>
                                        {{-- <th>Mobile</th> --}}
                                        {{-- <th>Address</th> --}}
                                        {{-- <th>Categories Count</th> --}}
                                        {{-- <th>Created At</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $admin)
                                        <tr id="the_row{{ $admin->id }}">
                                            <td><a href="{{ route('admins.show', $admin->id) }}">{{ $loop->index + 1 }}</a>
                                            </td>
                                            <td>
                                                @if ($admin->image)
                                                    {{-- <img class="img-circle img-bordered-sm" height="65" width="65"
                                                        src="{{ Storage::url($admin->image) }}" alt="user image"> --}}


                                                    {{-- <a href="{{ route('admins.show', $admin->id) }}" target="_blank">
                                                        <img class="img-circle img-bordered-sm" height="65"
                                                            width="65" src="{{ Storage::url($admin->image) }}"
                                                            alt="admin_image"></a> --}}

                                                    {{-- <a href="{{ Storage::url($admin->image) }}" target="_blank">
                                                        <img class="img-circle img-bordered-sm" height="65"
                                                            width="65" src="{{ Storage::url($admin->image) }}"
                                                            alt="admin_image"></a> --}}

                                                    <a href="{{ Storage::url($admin->image) }}" data-toggle="lightbox">
                                                        <img class="img-circle img-bordered-sm" height="65"
                                                            width="65" src="{{ Storage::url($admin->image) }}"
                                                            alt="admin_image"></a>
                                                @else
                                                    <a href="{{ asset('ucas/man.png') }}" data-toggle="lightbox">
                                                        <img class="img-circle img-bordered-sm" height="65"
                                                            width="65" src="{{ asset('ucas/man.png') }}"
                                                            alt="admin_image"></a>
                                                @endif
                                            </td>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>{{ $admin->fullMobile }}</td>
                                            <td>
                                                @if ($admin->address)
                                                    {{ $admin->address }}
                                                @else
                                                    <span style="color: gray;"><em>No Address</em></span>
                                                @endif
                                            </td>
                                            <td>{{ $admin->email_verified_at ?? '---' }}</td>

                                            <td class="d-flex">
                                                <a href="{{ route('admins.show', $admin->id) }}" class="mx-3">
                                                    <i class="fas fa-info-circle text-info"></i>
                                                </a>

                                                <a href="{{ route('admins.edit', $admin->id) }}" class="mr-2">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <button onclick="deleteAdmin('{{ $admin->id }}')" class="btn-delete">
                                                    <i class="fas fa-trash-alt text-danger"></i>
                                                </button>

                                                {{-- <form action="{{ route('admins.destroy', $admin->id) }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn-delete">
                                                        <i class="fas fa-trash-alt text-danger"></i>
                                                    </button>
                                                </form> --}}

                                            </td>
                                        </tr>
                                    @endforeach

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
@endsection

@section('scripts')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('ucas/plugins/datatables/jquery.dataTables.min.js') }}"></script>
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
            $('#adminsTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script>
        function deleteAdmin(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/ucas/dashboard/admins/${id}`)
                        .then(function(response) {
                            document.getElementById(`the_row${id}`).remove();
                            toastr.success(response.data.message);
                        }).catch(function(error) {
                            toastr.error(error.response.data.message);
                        });
                }
            })
            // axios.delete(`/ucas/dashboard/admins/${id}`)
            //     .then(function(response) {
            //         document.getElementById(`the_row${id}`).remove();
            //         toastr.success(response.data.message);
            //     }).catch(function(error) {
            //         toastr.error(error.response.data.message);
            //     });
        }
    </script>
@endsection

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('ucas/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('ucas/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('ucas/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <style>
        .btn-delete {
            border: 0px;
            background-color: inherit;
        }
    </style>
@endsection
