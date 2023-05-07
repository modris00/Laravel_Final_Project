<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UCAS - Feedback Search</title>
    <link rel="icon" href="{{ asset('ucas/favicon.png') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('ucas/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('ucas/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('ucas/dist/css/adminlte.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('ucas/plugins/toastr/toastr.min.css') }}">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="#">UCAS</a>
        </div>

        <div class="card">
            <div class="card-body register-card-body" id="the_body">
                @if ($errors->any())
                    <ul class="bg-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <p class="login-box-msg h4">Track your feedback</p>
                <p class="login-box-msg h6"><em>You want to send a new one? <a
                            href="{{ route('feedbacks.create') }}">Click
                            Here</em>
                    </a></p>

                <form action="{{ route('feedbacks.single') }}" method="GET">
                    {{-- <form method="get" action="/ucas/feedbacks"> --}}
                    {{-- <form> --}}
                    @csrf
                    {{-- <input type="hidden" name="id" id="id" value="1"> --}}
                    <div class="form-group">
                        <input type="number" class="form-control" id="feedback_id" name="feedback_id"
                            placeholder="Enter feedback id">
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Get
                                Feedback</button>
                            {{-- <button type="button" onclick="get_feedback(document.getElementById('feedback_id').value)"
                                class="btn btn-primary btn-block">Get Feedback</button> --}}
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="{{ asset('ucas/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('ucas/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('ucas/dist/js/adminlte.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('ucas/plugins/toastr/toastr.min.js') }}"></script>
    <!--axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>

    <!-- -->
    <script>
        // document.querySelector("form").addEventListener("submit", function(event) {
        //     event.preventDefault();
        //     var id = document.querySelector("input[name='feedback_id']").value;
        //     this.action = this.action.replace(/\d+$/, id);
        //     this.submit();
        // });



        function get_feedback(id) {
            // feedback_id: document.getElementById('feedback_id').value,
            axios.get(`/ucas/feedbacks/${id}`)
                .then(function(response) {
                    // toastr.success(response.data.message);
                    // window.location.href = `/ucas/feedbacks/${id}`;
                    console.log(response);

                }).catch(function(error) {
                    // toastr.error(error.response.data.message);
                });
        }

        // function get_feedback(id) {
        //     axios.get(`/ucas/feedbacks/${id}`, {
        //         feedback_id: document.getElementById('feedback_id').value,
        //     }).then(response => {
        //         toastr.success("success");
        //         console.log(response.data);
        //         console.log(response.data.feedback.student_email);

        //         // // Create a table element
        //         const table = document.createElement('table');

        //         // Create table rows for each item in the response data

        //         const row = document.createElement('tr');
        //         const nameCell = document.createElement('td');
        //         const emailCell = document.createElement('td');
        //         // const mobileCell = document.createElement('td');
        //         const idCell = document.createElement('td');


        //         let item = response.data.feedback;

        //         // Set the text content of each cell to the corresponding item data
        //         nameCell.textContent = item.student_name;
        //         emailCell.textContent = item.student_email;
        //         // mobileCell.textContent = item.mobile;
        //         idCell.textContent = item.student_university_id;

        //         // Append the cells to the row
        //         row.appendChild(nameCell);
        //         row.appendChild(emailCell);
        //         // row.appendChild(mobileCell);
        //         row.appendChild(idCell);

        //         // Append the row to the table
        //         table.appendChild(row);

        //         // Select the div with the "card-body" class
        //         const cardBody = document.querySelector('#the_body');
        //         // Append the table to the card-body
        //         cardBody.appendChild(table);
        //     }).catch(function(error) {
        //         // toastr.error(error.response.data.message);
        //         alert('error');
        //     });
        // }
    </script>
</body>

</html>
