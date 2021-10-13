<?php

$user = Auth::user();
$notifications = $user->unreadNotifications->take(5);
$unread_notifications_count = $user->unreadNotifications()->count();
$unread_messages = $user
    ->receivedMessages()
    ->where('seen', '=', 0)
    ->count();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page') - National Lottery Regulatory Commission</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" />
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" />
    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
    integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
    crossorigin="anonymous" /> --}}
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/all.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-icons/css/bootstrap-icons.css') }}">

    {{-- <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
    rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap4-toggle/css/bootstrap4-toggle.min.css') }}" />

    <!-- AdminLTE -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.5/css/adminlte.min.css"
    integrity="sha512-rVZC4rf0Piwtw/LsgwXxKXzWq3L0P6atiQKBNuXYRbg2FoRbSTIY0k2DxuJcs7dk4e/ShtMzglHKBOJxW8EQyQ=="
    crossorigin="anonymous" /> --}}
    <link rel="stylesheet" href="{{ asset('vendor/admin-lte/3.0.5/css/adminlte.min.css') }}" />

    <!-- iCheck -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css"
    integrity="sha512-8vq2g5nHE062j3xor4XxPeZiPjmRDh6wlufQlfC6pdQ/9urJkU07NM0tEREeymP++NczacJ/Q59ul+/K2eYvcg=="
    crossorigin="anonymous" /> --}}
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css') }}" />

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
    integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
    crossorigin="anonymous" /> --}}

    <link rel="stylesheet" href="{{ asset('vendor/select2/4.0.13/css/select2.min.css') }}" />

    {{-- <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
    integrity="sha512-aEe/ZxePawj0+G2R+AaIxgrQuKT68I28qh+wgLrcAJOz3rxCP+TwrK5SPN+E5I+1IQjNtcfvb96HDagwrKRdBw=="
    crossorigin="anonymous" /> --}}
    <link rel="stylesheet"
        href="{{ asset('vendor/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css') }}" />

    <link src="{{ asset('vendor/jquery-ui/css/jquery-ui.min.css') }}" />

    <style>
        .btn-primary {
            background-color: #86C127 !important;
            border-color: #86C127 !important;
        }

        @font-face {
            font-family: 'Icomoon';
            src: url({{ asset('fonts/Icomoon/icomoon.ttf') }});
        }

        * {
            font-family: 'sans-serif';
        }

        .dropdown-item.active,
        .dropdown-item:active {
            color: #fff;
            text-decoration: none;
            background-color: #005C20;

        }

        a.dt-button.dropdown-item.buttons-columnVisibility {
            margin-bottom: 2px;
        }

    </style>

    @section('page', config('app.name', 'Laravel'))

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
	
	@yield('panichd_assets')
</head>
<body>
    <header id="panichd_header">
        <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
            <div class="navbar-header">
                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav mr-auto">
                    @yield('panichd_nav')
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a class="nav-link" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <a class="dropdown-item" href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>

                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
    </header>
	<div id="panichd_content" class="container-fluid">
		@yield('panichd_errors')
        @yield('content')
	</div>

    <!-- Scripts -->
    
	@yield('footer')
</body>
</html>
