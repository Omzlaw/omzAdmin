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
<html>

<head>
    <meta charset="UTF-8">
    <title>@yield('page-title') - National Lottery Regulatory Commission</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
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

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bootstrap 4 -->
        <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <!-- JQVMap -->
        <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
        <!-- summernote -->
        <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">


        @yield('third_party_stylesheets')

        @stack('page_css')

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
        @include('layouts/pwa_tags')
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!-- Main Header -->
            <nav style="background-color:#86C127; color: #fff"
                class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li>
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

            <!-- Left side column. contains the logo and sidebar -->
            @include('layouts.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <section class="content">
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

        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous"></script> --}}
        <script src="{{ asset('vendor/jquery/3.5.1/jquery.min.js') }}">
        </script>

        <script src="{{ asset('vendor/jquery-ui/js/jquery-ui.min.js') }}">
        </script>

        {{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script> --}}
        <script src="{{ asset('vendor/popper/popper.min.js') }}">
        </script>

        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous">
    </script> --}}
        <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}">
        </script>

        {{-- <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script> --}}
        <script src="{{ asset('vendor/custom-file-input/custom-file-input.min.js') }}">
        </script>

        <!-- AdminLTE App -->
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.5/js/adminlte.min.js"
        integrity="sha512-++c7zGcm18AhH83pOIETVReg0dr1Yn8XTRw+0bWSIWAVCAwz1s2PwnSj4z/OOyKlwSXc4RLg3nnjR22q0dhEyA=="
        crossorigin="anonymous"></script> --}}
        <script src="{{ asset('vendor/admin-lte/3.0.5/js/adminlte.min.js') }}">
        </script>

        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"
        integrity="sha512-rmZcZsyhe0/MAjquhTgiUcb4d9knaFc7b5xAfju483gbEXTkeJRUMIPk6s3ySZMYUHEcjKbjLjyddGWMrNEvZg=="
        crossorigin="anonymous"></script> --}}
        <script src="{{ asset('vendor/moment.js/2.27.0/moment.min.js') }}">
            // <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"
            //     integrity="sha512-GDey37RZAxFkpFeJorEUwNoIbkTwsyC736KNSYucu1WJWFK9qTdzYub8ATxktr6Dwke7nbFaioypzbDOQykoRg="
            //     crossorigin="anonymous">
        </script>
        <script src="{{ asset('vendor/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js') }}">
        </script>

        {{-- <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script> --}}
        <script src="{{ asset('vendor/bootstrap4-toggle/js/bootstrap4-toggle.min.js') }}">
        </script>

        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous"></script> --}}
        <script src="{{ asset('vendor/select2/4.0.13/js/select2.min.js') }}">
        </script>

        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js"
        integrity="sha512-J+763o/bd3r9iW+gFEqTaeyi+uAphmzkE/zU8FxY6iAvD3nQKXa+ZAWkBI9QS9QkYEKddQoiy0I5GDxKf/ORBA=="
        crossorigin="anonymous"></script> --}}
        <script src="{{ asset('vendor/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js') }}">
        </script>

        <script src="{{ asset('js/forms/forms/repeater/jquery.repeater.min.js') }}"></script>


        <!-- jQuery -->
        {{-- <script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script> --}}
        <!-- jQuery UI 1.11.4 -->
        {{-- <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script> --}}
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- ChartJS -->
        <script src="{{ asset('plugins/chart.js/Chart.min.js')}}"></script>
        <!-- Sparkline -->
        <script src="{{ asset('plugins/sparklines/sparkline.js')}}"></script>
        <!-- JQVMap -->
        <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
        <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
        <!-- daterangepicker -->
        <script src="{{ asset('plugins/moment/moment.min.js')}}"></script>
        <script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
        <!-- Summernote -->
        <script src="{{ asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
        <!-- overlayScrollbars -->
        <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
        <!-- AdminLTE App -->
        {{-- <script src="{{ asset('dist/js/adminlte.js')}}"></script> --}}
        <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>


        <script type="text/javascript">
            document.getElementById('currentYear').innerText = new Date().getFullYear();
        </script>

        <script>
            $(function() {
                bsCustomFileInput.init();
            });

            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            });

            $(document).ready(function() {
                $('select').select2({
                    theme: "classic",
                });
            });
        </script>

        @stack('third_party_scripts')

        @stack('page_scripts')
    </body>

    </html>
