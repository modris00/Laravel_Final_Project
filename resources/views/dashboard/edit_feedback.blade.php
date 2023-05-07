@extends('dashboard.parent')
@section('title', 'Respond To Feedback')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Editing Feedback No {{ $feedback->id }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
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
                                {{-- <div class="row">
                                    <div class="col-6">
                                        <div class="card">

                                            <!-- /.card-header -->
                                            <div class="card-body table-responsive p-0">
                                                <table class="table table-bordered text-nowrap">
                                                    </thead>
                                                    <tbody class="font-weight-normal">
                                                        <tr>
                                                            <th colspan="2" class="text-center bg-light">Student Details</th>
                                                        </tr>
                                                        <tr>
                                                            <th style="width: 20px;">Name</th>
                                                            <td>gfgfd</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width: 20px;">Universiry ID: </th>
                                                            <td>1232112</td>
                                                        </tr>

                                                        <tr>
                                                            <th style="width: 20px;">Email</th>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="2" class="text-center bg-light">Feedback Details</th>
                                                        </tr>
                                                        <tr>
                                                            <th style="width: 20px;">Title</th>
                                                            <td>fdsfsd</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width: 20px;">Type</th>
                                                            <td>fdsf</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width: 20px;">Message</th>
                                                            <td class="text-break text-wrap">MessageMessageMessageMessageMessageMessageMessageMessage MessageMessageMessage MessageMessageMessageMessageMessageMessage MessageMessage</td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label class="font-weight-normal">Student Name</label>
                                        <input type="text" class="form-control" value="{{ $feedback->student_name }}"
                                            readonly>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="font-weight-normal">Email</label>
                                        <input type="email" class="form-control" value="{{ $feedback->student_email }}"
                                            readonly>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="font-weight-normal">ID</label>
                                        <input type="text" class="form-control"
                                            value="{{ $feedback->student_university_id }}" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label class="font-weight-normal">Feedback Title</label>
                                        <input type="text" class="form-control" value="{{ $feedback->title }}" readonly>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="font-weight-normal">Type</label>
                                        <input type="text" class="form-control" value="{{ $feedback->type }}" readonly>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="font-weight-normal">Is Urgent</label>
                                        <input type="text" class="form-control"
                                            value="{{ $feedback->urgent ? 'Yes' : 'No' }}" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-normal">Message</label>
                                    {{-- <input type="text" class="form-control" value="{{ $feedback->message }}" readonly> --}}
                                    <textarea class="form-control" cols="30" rows="4" readonly>{{ $feedback->message }}</textarea>
                                </div>

                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label class="font-weight-normal">Status</label>
                                        <input type="text" class="form-control" value="{{ $feedback->status }}" readonly>
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label class="font-weight-normal">Date of Close</label>
                                        <input type="text" class="form-control"
                                            value="{{ $feedback->closed_date ?? '---' }}" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Feedback Response</label>
                                    <textarea class="form-control" rows="3" id="feedback_response" placeholder="Enter feedback response">{{ $feedback->response }}</textarea>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="urgent" name="urgent"
                                            @checked($feedback->urgent)>
                                        <label class="custom-control-label" for="urgent" ">Urgent</label>
                                        </div>
                                    </div>

                                    {{-- <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="feedback_status"
                                            @checked($feedback->status == 'Closed')>
                                        <label class="custom-control-label" for="feedback_status">Make this feedback
                                            closed</label>
                                    </div>
                                </div> --}}

                                    {{-- <div class="form-group">
                                    <label for="feedback_response">Name</label>
                                    <input type="text" class="form-control" id="feedback_response" name="feedback_response"
                                        value="{{ old('user_name') }}" placeholder="Enter name">
                                </div> --}}

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="button" onclick="updateFeedback('{{ $feedback->id }}')"
                                        class="btn btn-info">Send Response</button>
                                    <a href="{{ route('feedbacks.index') }}" class="btn btn-outline-secondary">Cancel</a>
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
            function updateFeedback(id) {
                axios.put(`/ucas/dashboard/feedbacks/${id}`, {
                    'feedback_response': document.getElementById('feedback_response').value,
                    'urgent': document.getElementById('urgent').checked,

                }).then(function(response) {
                    toastr.success(response.data.message);
                    window.location.href = "/ucas/dashboard/feedbacks";

                }).catch(function(error) {
                    toastr.error(error.response.data.message);
                });
            }

            // function updateFeedback11111(id) {
            //     const feedback_response = document.getElementById('feedback_response').value;
            //     let date = null;
            //     let status = "Open";
            //     if (feedback_response != null && feedback_response != "") {
            //         const getLocalDateTimeString = () => {
            //             const now = new Date();
            //             const year = now.getFullYear();
            //             let month = now.getMonth() + 1;
            //             let day = now.getDate();
            //             let hours = now.getHours();
            //             let minutes = now.getMinutes();
            //             let seconds = now.getSeconds();

            //             if (month < 10) {
            //                 month = `0${month}`;
            //             }
            //             if (day < 10) {
            //                 day = `0${day}`;
            //             }
            //             if (hours < 10) {
            //                 hours = `0${hours}`;
            //             }
            //             if (minutes < 10) {
            //                 minutes = `0${minutes}`;
            //             }
            //             if (seconds <script 10) {
            //                 seconds = `0${seconds}`;
            //             }

            //             return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
            //         };
            //         date = getLocalDateTimeString();
            //         status = "Closed";
            //     }

            //     axios.put(`/ucas/dashboard/feedbacks/${id}`, {
            //         'feedback_response': feedback_response,
            //         'closed_date': date,
            //         'status': document.getElementById('feedback_status').checked,

            //     }).then(function(response) {
            //         toastr.success(response.data.message);


            //     }).catch(function(error) {
            //         toastr.error(error.response.data.message);
            //     });
            // }
        </script>
@endsection
