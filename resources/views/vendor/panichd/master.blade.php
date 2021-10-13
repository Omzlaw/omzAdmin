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
        body {
            padding-top: 0em !important;
        }

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

        .panicd-nav-items>ul>li>a.nav-link>span {
            color: #fff
        }

        .panicd-nav-items>ul>li>a.nav-link {
            color: #fff
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

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        <nav style="background-color:#86C127; color: #fff"
            class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <ul class="nav navbar-nav mr-auto">
                    <div class="panicd-nav-items">
                        @yield('panichd_nav')
                    </div>
                </ul>
            </ul>



            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown user-menu">
                    <a href="#"
                        class="nav-link dropdown-toggle @if ($unread_notifications_count > 0) text-danger
                            
                        @endif"
                        data-toggle="dropdown">
                        <span><i class="text-white fa fa-bell"></i>
                            @if ($unread_notifications_count == 0)
                                <small></small>
                            @else
                                <small>{{ $unread_notifications_count }}</small>
                            @endif
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <li class="dropdown-menu-header">
                            <div class="dropdown-header d-flex">
                                <h4 class="notification-title mb-0 mr-auto">Notifications</h4>
                                @if ($unread_notifications_count == 0)
                                    <div class="badge badge-pill badge-light-primary"></div>
                                @else
                                    <div class="badge badge-pill badge-light-primary">
                                        {{ $unread_notifications_count }}
                                        New</div>
                                @endif

                            </div>
                        </li>
                        <li class="scrollable-container media-list p-3">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                </div>
                                <div class="media-body">
                                    @if ($unread_notifications_count > 0)
                                        @foreach ($notifications as $notification)
                                            <a title="View"
                                                href="{{ route('notifications.show', [$notification->id]) }}"
                                                class='btn btn-default btn-xs'>
                                                <p class="text-danger"><span
                                                        class="">{{ substr($notification->data, 0, 10) }}...</p>
                                        </a>

                                            @endforeach

                                        @else

                                            <p class="
                                                        text-success"><span
                                                            class="">No new
                                                    Notification</span>

                                            </p>
                                        @endif
                                    </div>
                                </div>
                        </li>
                        <li class="
                                                            dropdown-menu-footer">
                                                            <a class="btn btn-primary btn-block"
                                                                href="{{ route('notifications.index') }}">Read all
                                                                notifications</a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        @if (isset(Auth::user()->profile_picture_path))
                            <img src="{{ asset(Auth::user()->profile_picture_path) }}"
                                class="user-image img-circle elevation-2" alt="User Image">
                        @else
                            <img src="{{ asset('images/user.png') }}" class="user-image img-circle elevation-2"
                                alt="User Image">
                        @endif
                        <span class="text-white d-none d-md-inline">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header pt-3" style="background-color: #fff">
                            @if (isset(Auth::user()->profile_picture_path))
                                <img height="100" width="100" src="{{ asset(Auth::user()->profile_picture_path) }}"
                                    class="user-image img-circle elevation-2" alt="User Image">
                            @else
                                <img height="100" width="100" src="{{ asset('images/user.png') }}"
                                    class="user-image img-circle elevation-2" alt="User Image">
                            @endif
                            <p class="text-dark">
                                {{ Auth::user()->name }}
                                <small class="text-dark">Member since {{ Auth::user()->created_at }}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer" style="">
                            <a href="{{ route('users.show', Auth::user()->id) }}"
                                class="btn btn-default btn-flat">Profile</a>
                            <a href="#" class="btn btn-default btn-flat float-right"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Sign out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        @include('layouts.sidebar')


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content p-3">
                @yield('panichd_errors')
                @yield('content')
            </section>
        </div>


        <!-- Main Footer -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; <span id="currentYear"></span> <a href="#"><span style="color: #86C127">National
                        Lottery Regulatory Commission |NLRC|</span></a>.</strong> All Rights
            Reserved.
        </footer>

    </div>


    <!-- Scripts -->

    @yield('footer')
    <script src="{{ asset('vendor/admin-lte/3.0.5/js/adminlte.min.js') }}">
    </script>

    <script type="text/javascript">
        document.getElementById('currentYear').innerText = new Date().getFullYear();
    </script>

    <script>
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
    </script>

    @stack('third_party_scripts')

    @stack('page_scripts')

</body>

</html>
