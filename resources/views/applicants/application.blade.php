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

    {{-- @include('layouts/pwa_tags') --}}
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" />

    <title>New Application - National Lottery Regulatory Commission</title>

    <style>
        .control input:checked~.control__indicator {
            background: #86C127 !important;
        }

    </style>


</head>

<body>


    <div class="d-lg-flex half">
        <div class="bg order-1 order-md-2"
            style="background-image: url('{{ asset('login-custom/images/bg_2.jpg') }}');"></div>
        <div class="contents order-2 order-md-1">

            <div class="container p-3">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7">
                        <h3>Apply<strong></strong></h3>
                        <p class="mb-4">National Lottery Regulatory Commission.</p>
                        {!! Form::open(['route' => 'applicants.application_store', 'files' => true]) !!}

                        <div class="row mb-3" style="height: 26em; overflow-y:auto">
                            @include('adminlte-templates::common.errors')

                            <div class="form-group first col-sm-12">
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    placeholder="John Doe" id="name" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group second col-sm-6">
                                <label for="name">RCN</label>
                                <input type="text" class="form-control @error('RC_number') is-invalid @enderror"
                                    placeholder="123456" id="RC_number" name="RC_number"
                                    value="{{ old('RC_number') }}">
                                @error('RC_number')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group fourth col-sm-6">
                                <label for="name">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    placeholder="08000000000" id="phone" name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group third col-sm-12">
                                <label for="name">Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    placeholder="Central Business District, Abuja." id="address" name="address"
                                    value="{{ old('address') }}">
                                @error('address')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group fifth col-sm-12">
                                <label for="name">Website</label>
                                <input type="text" class="form-control @error('website') is-invalid @enderror"
                                    placeholder="www.demo.com" id="website" name="website"
                                    value="{{ old('website') }}">
                                @error('website')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group sixth col-sm-12">
                                <label for="username">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    placeholder="your-email@gmail.com" id="username" name="email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group last mb-3 col-sm-6">
                                <label for="password">Password</label>
                                <input name="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Your Password" id="password">
                                @error('password')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group last mb-3 col-sm-6">
                                <label for="password">Confirm Password</label>
                                <input name="password_confirmation" type="password" class="form-control"
                                    placeholder="Your Password" id="password_confirmation">
                            </div>



                            <div class="form-group last">
                                <div class="form-group d-flex mb-5 align-items-center col-sm-12">
                                    <label class="control control--checkbox mb-0"><span class="caption">Accept
                                            Terms</span>
                                        <input class="form-control @error('accept_terms') is-invalid @enderror"
                                            type="checkbox" checked="checked" name="accept_terms" />
                                        <div class="control__indicator"></div>
                                    </label>
                                </div>
                                @error('accept_terms')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>


                        </div>


                        <input style="background-color: #86C127; border-color: #86C127;" type="submit" value="Submit"
                            class="btn btn-block btn-primary">

                        <p class="mt-3">
                            Already Applied?
                            <a href="{{ route('login') }}" class="text-center" style="color: #86C127">Login</a>
                        </p>

                        {!! Form::close() !!}

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
