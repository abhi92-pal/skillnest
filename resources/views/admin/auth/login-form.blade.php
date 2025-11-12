<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Log In | Skillnest</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured School Management System ERP" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('atportal/assets/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('atportal/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"
        id="bs-default-stylesheet" />
    <link href="{{ asset('atportal/assets/css/app.min.css') }}" rel="stylesheet" type="text/css"
        id="app-default-stylesheet" />

    <link href="{{ asset('atportal/assets/css/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css"
        id="bs-dark-stylesheet" disabled />
    <link href="{{ asset('atportal/assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css"
        id="app-dark-stylesheet" disabled />

    <!-- icons -->
    <link href="{{ asset('atportal/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<body class="authentication-bg authentication-bg-pattern">

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-pattern">

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <div class="auth-logo">
                                    <a href="{{ url('/') }}" class="logo logo-dark text-center">
                                        <span class="logo-lg">
                                            <img src="{{ asset('assets/images/logo-sm.png') }}" alt=""
                                                height="80">
                                        </span>
                                    </a>
                                </div>
                                <p class="text-muted mb-4 mt-3">Enter your Username and password to access admin panel.
                                </p>
                            </div>

                            <form id="loginForm" class="form-horizontal m-t-30" action="{{ route('admin.login') }}"
                                method="POST">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="emailaddress">Username</label>
                                    <input id="emailaddress" type="text"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <span class="error text-danger email_error"></span>
                                    {{-- @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror --}}
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">
                                        <div class="input-group-append" data-password="false">
                                            <div class="input-group-text">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                        <span class="error text-danger password_error"></span>
                                        {{-- @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror --}}
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="remember"
                                            id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="custom-control-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-primary btn-block" type="submit"> Log In </button>
                                </div>

                            </form>

                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <div class="row mt-3">

                        <div class="col-12 text-center">
                            @if (Route::has('password.request'))
                                {{-- <p> <a href="{{ route('password.request') }}" class="text-white-50 ml-1">Forgot your password?</a></p> --}}
                            @endif
                            <p class="text-white-50">Support Helpline: <a href="#"
                                    class="text-white ml-1"><b>0000-062920</b></a></p>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <!-- Vendor js -->
    <script src="{{ asset('atportal/assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('atportal/assets/libs/parsleyjs/parsley.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('atportal/assets/js/app.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('form#loginForm').on('submit', function() {
                const submitBtn = $('.submit_btn');
                const submitBtnText = submitBtn.text();
                submitBtn.text('Please wait...').attr('disabled', true);

                var _this = $(this);
                $('.error').html('');
                var formData = new FormData(this);
                $.ajax({
                    method: 'POST',
                    data: formData,
                    url: $(this).attr('action'),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // window.location.href = response.redirect_url;
                        submitBtn.text(submitBtnText);
                    },
                    error: function(data) {
                        submitBtn.text(submitBtnText).attr('disabled', false);
                        var errors = response.responseJSON;
                        $.each(errors.errors, function(index, value) {
                            $('.' + index + '_error').text(value);
                            //$.notify(value, {type:"danger"});
                        });
                    }

                });
                return false;
            });
        });
    </script>

</body>

</html>
