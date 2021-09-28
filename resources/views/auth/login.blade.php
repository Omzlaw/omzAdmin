<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{ asset('login-custom/google-fonts/roboto.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('login-custom/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('login-custom/css/owl.carousel.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('login-custom/css/bootstrap.min.css') }}">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('login-custom/css/style.css') }}">

    @include('layouts/pwa_tags')

    <title>Omz Admin - Login</title>


</head>

<body>


    <div class="d-lg-flex half">
        <div class="bg order-1 order-md-2"
            style="background-image: url('{{ asset('login-custom/images/bg_1.jpg') }}');"></div>
        <div class="contents order-2 order-md-1">

            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7">
                        <h3>Login to <strong>Omz Admin</strong></h3>
                        <p class="mb-4">Startup admin template for fast and rapid development.</p>
                        <form action="{{ url('/login') }}" method="post">
                            @csrf

                            <div class="form-group first">
                                <label for="username">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    placeholder="your-email@gmail.com" id="username" name="email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group last mb-3">
                                <label for="password">Password</label>
                                <input name="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Your Password" id="password">
                                @error('password')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="d-flex mb-5 align-items-center">
                                <label class="control control--checkbox mb-0"><span class="caption">Remember
                                        me</span>
                                    <input type="checkbox" checked="checked" name="remember" />
                                    <div class="control__indicator"></div>
                                </label>
                                <span class="ml-auto"><a href="{{ route('password.request') }}"
                                        class="forgot-pass">Forgot
                                        Password</a></span>
                            </div>

                            <input type="submit" value="Log In" class="btn btn-block btn-primary">

                            <p class="mt-3">
                                <a href="{{ route('register') }}" class="text-center"
                                    style="color: #F9AF48">Register a new
                                    membership</a>
                            </p>

                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>



    <script src="{{ asset('login-custom/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('login-custom/js/popper.min.js') }}"></script>
    <script src="{{ asset('login-custom/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('login-custom/js/main.js') }}"></script>
</body>

</html>
