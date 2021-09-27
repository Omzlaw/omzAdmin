<title>{{ config('chatify.name') }}</title>

{{-- Meta tags --}}
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="route" content="{{ $route }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="url" content="{{ url('').'/'.config('chatify.routes.prefix') }}" data-user="{{ Auth::user()->id }}">

{{-- scripts --}}
<script
  src="{{ asset('vendor/jquery/3.5.1/jquery.min.js') }}"></script>
<script src="{{ asset('js/chatify/font.awesome.min.js') }}"></script>
<script src="{{ asset('js/chatify/autosize.js') }}"></script>
{{-- <script src="{{ asset('js/app.js') }}"></script> --}}
<script src='{{ asset('vendor/nprogress/js/nprogress.js') }}'></script>

{{-- styles --}}
<link rel='stylesheet' href='{{ asset('vendor/nprogress/css/nprogress.css') }}'/>
<link href="{{ asset('css/chatify/style.css') }}" rel="stylesheet" />
<link href="{{ asset('css/chatify/'.$dark_mode.'.mode.css') }}" rel="stylesheet" />
{{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet" /> --}}

{{-- Messenger Color Style--}}
@include('Chatify::layouts.messengerColor')
