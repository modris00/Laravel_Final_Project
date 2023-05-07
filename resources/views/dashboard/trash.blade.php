@extends('dashboard.parent')
@section('title', 'Trash')
{{-- @section('style')
    <style>
        .modal-header {
            border-bottom: 0 none;
        }

        .modal-footer {
            border-top: 0 none;
        }

        /* .modal-content {
            background-color: red
        } */
    </style>
@endsection --}}

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-info">Trashed Feedbacks <a href="{{ route('feedbacks.index') }}"
                                    type="button" class="btn btn-outline-secondary btn-sm">Back</a></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="feedbacksTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student Image</th>

                                        <th>Student ID</th>
                                        <th>Feedback ID</th>

                                        <th>Actions</th>

                                        <th>Type</th>
                                        <th>Title</th>
                                        <th>Urgent</th>
                                        <th>Status</th>

                                        <th>Message</th>

                                        <th>Closed Date</th>
                                        <th>Response</th>

                                        <th>Student Name</th>
                                        <th>Student Email</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($feedbacks as $feedback)
                                        <tr id="trash_row{{ $feedback->id }}">
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>
                                                @if ($feedback->image)
                                                    {{-- <img class="img-circle img-bordered-sm" height="65" width="65"
                                                        src="{{ Storage::url($feedback->image) }}" alt="user image"> --}}

                                                    {{-- <a href="{{ Storage::url($feedback->image) }}" target="_blank">
                                                        <img class="img-circle img-bordered-sm" height="65"
                                                            width="65" src="{{ Storage::url($feedback->image) }}"
                                                            alt="std_image"></a> --}}

                                                    {{-- <a href="{{ route('feedbacks.show', $feedback->id) }}" target="_blank">
                                                        <img class="img-circle img-bordered-sm" height="65"
                                                            width="65" src="{{ Storage::url($feedback->image) }}"
                                                            alt="std_image"></a> --}}
                                                    <a href="{{ Storage::url($feedback->image) }}" data-toggle="lightbox">
                                                        <img class="img-circle img-bordered-sm" height="65"
                                                            width="65" src="{{ Storage::url($feedback->image) }}"
                                                            alt="std_image"></a>
                                                @else
                                                    {{-- <a href="{{ asset('ucas/man.png') }}" target="_blank">
                                                        <img class="img-circle img-bordered-sm" height="65"
                                                            width="65" src="{{ asset('ucas/man.png') }}"
                                                            alt="std_image"></a> --}}
                                                    {{-- <a href="{{ route('feedbacks.show', $feedback->id) }}" target="_blank">
                                                        <img class="img-circle img-bordered-sm" height="65"
                                                            width="65" src="{{ asset('ucas/man.png') }}"
                                                            alt="std_image"></a> --}}
                                                    <a href="{{ asset('ucas/man.png') }}" data-toggle="lightbox">
                                                        <img class="img-circle img-bordered-sm" height="65"
                                                            width="65" src="{{ asset('ucas/man.png') }}"
                                                            alt="std_image"></a>
                                                @endif
                                            </td>

                                            <td>{{ $feedback->student_university_id }}</td>
                                            <td>{{ $feedback->id }}</td>

                                            <td class="myActions">
                                                {{-- <button type="button" class="btn btn-primary btn-block"><i
                                                        class="fa fa-bell"></i> .btn-block</button> --}}

                                                {{-- <a type="button" class="btn btn-info btn-flat"
                                                    href="{{ route('feedbacks.edit', $feedback->id) }}">Respond</a> --}}


                                                {{-- <button type="button" onclick="updateStatusClose('{{ $feedback->id }}')"
                                                    class="btn btn-warning btn-flat"
                                                    {{ is_null($feedback->response) ? 'disabled' : '' }}><i
                                                        class="fas fa-lock"></i>
                                                </button> --}}

                                                {{-- @if ($feedback->status == 'Open')
                                                    <button type="button"
                                                        onclick="updateStatusClose('{{ $feedback->id }}')"
                                                        class="btn btn-warning btn-flat"
                                                        {{ is_null($feedback->response) ? 'disabled' : '' }}><i
                                                            class="fas fa-lock"></i>
                                                    </button>
                                                @else
                                                    <button type="button"
                                                        onclick="updateStatusOpen('{{ $feedback->id }}')"
                                                        class="btn btn-info btn-flat"><i class="fas fa-lock-open"></i>
                                                    </button>
                                                @endif --}}
                                                <button type="button" onclick="restore_feedback('{{ $feedback->id }}')"
                                                    class="btn btn-outline-info">
                                                    <i class="fas fa-trash-restore"></i>
                                                </button>
                                                <button onclick="forceDelete('{{ $feedback->id }}')"
                                                    class="btn btn-outline-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                {{-- <button type="button"  class="btn btn-warning btn-flat">To (Open)</button> --}}
                                                {{-- <a href="{{ route('feedbacks.edit', $feedback->id) }}">Edit</a> --}}
                                            </td>
                                            <td>{{ $feedback->type }}</td>
                                            <td>{{ $feedback->title }}</td>
                                            <td>
                                                @if ($feedback->urgent)
                                                    <span style="color:red; font-weight: bold">URGENT</span>
                                                @else
                                                    <span style="color:rgb(143, 241, 30);">Normal</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($feedback->status == 'Open')
                                                    <span style="color:orange;">{{ $feedback->status }}</span>
                                                @else
                                                    <span style="color:green;">{{ $feedback->status }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $feedback->message }}</td>
                                            <td>{{ $feedback->closed_date ?? '-' }}</td>
                                            {{-- <td>{{ $feedback->response ?? 'No Response Added' }}</td> --}}
                                            <td>
                                                @if (is_null($feedback->response))
                                                    <span style="color: gray;"><em>No Response Added</em></span>
                                                @else
                                                    <span class="text-success">{{ $feedback->response }}</span>
                                                @endif
                                            </td>

                                            <td>{{ $feedback->student_name }}</td>
                                            <td>{{ $feedback->student_email }}</td>

                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('ucas/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('ucas/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('ucas/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <style>
        .myActions {
            display: flex;
            flex-direction: row;
            align-items: center;
            /* justify-content: center; */
            /* row-gap: 2rem; */
            column-gap: 3px;
        }

        .btn-delete {
            border: 0px;
            background-color: inherit;
        }
    </style>

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
            $("#feedbacksTable").DataTable({
                "responsive": true,
                "lengthChange": false,
                "pageLength": 15,
                "autoWidth": false,
                "buttons": ["copy", "colvis"],
                // dom: 'ptp',

            }).buttons().container().appendTo('#feedbacksTable_wrapper .col-md-6:eq(0)');

        });
    </script>
    <script>
        function restore_feedback(id) {
            console.log(id);
            axios.put(`/ucas/dashboard/feedbacks/${id}/restore`)
                .then(function(response) {
                    toastr.success(response.data.message);
                    document.getElementById(`trash_row${id}`).remove();
                    // widnow.location.href= "/ucas/dashboard/feedbacks";
                    // location.reload();
                }).catch(function(error) {
                    toastr.error(error.response.data.message);

                });
        }

        function forceDelete(id) {
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
                    axios.delete(`/ucas/dashboard/feedbacks/${id}/force-delete`)
                        .then(function(response) {
                            document.getElementById(`trash_row${id}`).remove();
                            toastr.success(response.data.message);
                        }).catch(function(error) {
                            toastr.error(error.response.data.message);
                        });
                }
            })
        }
    </script>
@endsection
