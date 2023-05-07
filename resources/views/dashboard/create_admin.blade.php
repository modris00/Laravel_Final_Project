@extends('dashboard.parent')
@section('title', 'Create a Supervisor')
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
                            <h3 class="card-title">Create A Supervisor</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        {{-- <form method="POST" action="{{ route('categories.store') }}"> --}}
                        <form>
                            @csrf
                            <div class="card-body">
                                {{-- @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">×</button>
                                        <h5><i class="icon fas fa-ban"></i> Validation Error!</h5>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif --}}
                                <div class="form-group">

                                </div>
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="text" class="form-control" id="email" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Enter password">
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Mobile Number</label>
                                    <input type="tel" class="form-control" id="mobile" placeholder="Enter mobile">
                                </div>
                                <div class="form-group">
                                    <label for="name">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter address">
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                {{-- <button type="submit" class="btn btn-info">Submit</button> --}}
                                <button type="button" onclick="createAdmin()" class="btn btn-info">Submit</button>
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
        function createAdmin() {
            let data = new FormData();
            if (document.getElementById("image").files[0]) {
                data.append('image', document.getElementById("image").files[0]);
            }
            data.append('name', document.getElementById('name').value);
            data.append('email', document.getElementById('email').value);
            data.append('password', document.getElementById('password').value);
            data.append('mobile', document.getElementById('mobile').value);
            data.append('address', document.getElementById('address').value);


            // const file = event.target.files[0];
            axios.post('/ucas/dashboard/admins', data)
                .then(function(response) {
                    toastr.success(response.data.message);
                    // data.forEach((value, key) => {
                    //     data.delete(key);
                    // });

                    // const inputs = document.querySelectorAll('form *');
                    // // const textarea = document.querySelector('form textarea');
                    // inputs.forEach(input => {
                    //     input.value = '';
                    // });
                    // // textarea.value = '';
                    window.location.href = "/ucas/dashboard/admins";
                }).catch(function(error) {
                    toastr.error(error.response.data.message);
                });
        }
    </script>
@endsection
