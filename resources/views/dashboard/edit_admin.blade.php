@extends('dashboard.parent')
@section('title', 'Edit supervisor data')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Edit Supervisor No. {{ $admin->id }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        {{-- <form method="POST" action="{{ route('admins.update', $admin->id) }}" enctype="multipart/form-data"> --}}
                        <form>
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Enter name" value="{{ $admin->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="text" class="form-control" name="email" id="email"
                                        placeholder="Enter email" value="{{ $admin->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Mobile Number</label>
                                    <input type="tel" class="form-control" name="mobile" id="mobile"
                                        placeholder="Enter mobile" value="{{ $admin->mobile }}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        value="{{ $admin->address }}" placeholder="Enter address">
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" name="image">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                @if ($admin->image)
                                    <a href="{{ Storage::url($admin->image) }}" data-toggle="lightbox">
                                        <img src="{{ Storage::url($admin->image) }}" width="100" height="100"
                                            alt="admin image"></a>
                                @else
                                    <div class="form-group">
                                        {{-- <a href="{{ asset('ucas/man.png') }}" target="_blank"> --}}
                                        <a href="{{ asset('ucas/man.png') }}" data-toggle="lightbox">
                                            <img src="{{ asset('ucas/man.png') }}" width="100" height="100"
                                                alt="admin image"></a>

                                    </div>
                                @endif

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                {{-- <button type="submit" class="btn btn-info">Submit</button> --}}
                                <button type="button" onclick="edit_admin('{{ $admin->id }}')"
                                    class="btn btn-info">Submit</button>
                                <a href="{{ route('admins.index') }}" class="btn btn-outline-secondary">Cancel</a>

                            </div>
                        </form>

                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    <script>
        function edit_admin(id) {

            let data1 = new FormData();

            data1.append("_method", "put");

            data1.append("name", document.getElementById("name").value);
            data1.append("email", document.getElementById("email").value);
            data1.append("mobile", document.getElementById("mobile").value);
            data1.append("address", document.getElementById("address").value);

            if (document.getElementById("image").files[0]) {
                data1.append("image", document.getElementById("image").files[0]);
            }

            // let settings = { headers: { 'content-type': 'multipart/form-data' } };

            axios.post(`/ucas/dashboard/admins/${id}`, data1).then(function(response) {
                toastr.success(response.data.message);
                window.location.href = "/ucas/dashboard/admins";
            }).catch(function(error) {
                toastr.error(error.response.data.message);
            });

            // axios.post(`/ucas/dashboard/admins/${id}`, data1).then(function(response) {
            //     toastr.success(response.data.message);
            // }).catch(function(error) {
            //     toastr.error(error.response.data.message);
            // });
        }
    </script>
@endsection
