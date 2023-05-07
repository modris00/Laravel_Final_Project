<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UCAS - Create a feedback</title>
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
            <div class="card-body register-card-body">
                <p class="login-box-msg">Send a feedback</p>
                <p class="login-box-msg">Already sent one? <a href="{{ route('feedbacks.search') }}">track it from
                        here</a></p>

                <form id="myform">
                    @csrf
                    {{-- <div class="input-group mb-3"> --}}
                    <div class="form-group">
                        <input type="text" class="form-control" id="std_name" placeholder="Student Full name">
                        {{-- <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div> --}}
                    </div>
                    {{-- <div class="input-group mb-3"> --}}
                    <div class="form-group">
                        <input type="email" class="form-control" id="std_email" placeholder="Student Email">
                        {{-- <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div> --}}
                    </div>
                    {{-- <div class="input-group mb-3"> --}}
                    <div class="form-group">
                        <input type="number" class="form-control" id="std_id" placeholder="Student ID">
                        {{-- <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div> --}}
                    </div>

                    {{-- <div class="input-group mb-3"> --}}
                    <div class="form-group">
                        <input type="text" class="form-control" id="feedback_title" placeholder="Feedback Title">
                        {{-- <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div> --}}
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="feedback_type">
                            <option selected disabled style="color: lightgray">Feedback type</option>
                            <option value="Complaint">Complaint</option>
                            <option value="Suggestion">Suggestion</option>
                        </select>
                    </div>
                    <div class="form-group">
                        {{-- <label>Feedback Message</label> --}}
                        <textarea class="form-control" id="feedback_message" rows="3" placeholder="Feedback Message ..."></textarea>
                    </div>
                    <div class="form-group">
                        {{-- <label for="exampleInputFile">Student Image</label> --}}
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="std_image">
                                <label class="custom-file-label" for="std_image">Choose student image</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="urgent">
                            <label class="custom-control-label" for="urgent">Urgent</label>
                        </div>
                    </div>

                    <div class="row">
                        {{-- <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label for="agreeTerms">
                                    I agree to the <a href="#">terms</a>
                                </label>
                            </div>
                        </div> --}}
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="button" onclick="send_feedback()"
                                class="btn btn-primary btn-block">Send</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                {{-- <div class="social-auth-links text-center">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i>
                        Sign up using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i>
                        Sign up using Google+
                    </a>
                </div>

                <a href="login.html" class="text-center">I already have a membership</a> --}}
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

        var mydata = new FormData();
        function send_feedback() {

            let x = 0;
            if (document.getElementById("std_image").files[0]) {
                mydata.append('std_image', document.getElementById("std_image").files[0]);
            }
            mydata.append('std_name', document.getElementById('std_name').value);
            mydata.append('std_email', document.getElementById('std_email').value);
            mydata.append('std_id', document.getElementById('std_id').value);
            mydata.append('feedback_title', document.getElementById('feedback_title').value);
            mydata.append('feedback_type', document.getElementById('feedback_type').value);
            mydata.append('feedback_message', document.getElementById('feedback_message').value);
            if (document.getElementById('urgent').checked) x = 1;
            mydata.append('urgent', x);

            axios.post('/ucas/feedbacks', mydata)
                .then(response => {
                    toastr.success(response.data.message);
                    // location.reload();

                    // mydata.forEach((value, key) => {
                    //     mydata.delete(key);
                    // });
                    mydata = new FormData();
                    // document.getElementById("myForm").reset();
                    document.getElementById("std_name").value = "";
                    document.getElementById("std_email").value = "";
                    document.getElementById("std_id").value = "";
                    document.getElementById("feedback_title").value = "";
                    document.getElementById("feedback_type").value = "";
                    document.getElementById("feedback_message").value = "";
                    document.getElementById("urgent").checked = false;
                    $("#std_image").val('');
                    // let fileInput = getElementById("std_image");
                    // fileInput.value = "";
                    // fileInput.outerHTML = fileInput.outerHTML;
                    // if (document.getElementById("std_image").files[0]) {
                    //     document.getElementById("std_image").files[0] =
                    //         null;
                    // }

                    // let inputs = document.querySelectorAll('form input');
                    // let mytextarea = document.querySelector('form textarea');
                    // let myselect = document.querySelector('form select');
                    // inputs.forEach(input => {
                    //     input.value = '';
                    // });
                    // textarea.value = '';
                }).catch(error => {
                    toastr.error(error.response.data.message);
                });

            // console.log(data);
        }
    </script>
</body>

</html>
