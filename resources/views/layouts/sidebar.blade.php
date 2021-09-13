<style>
    .custom-sidebar-bg {
        background-color: #232820;
    }

    .nav-sidebar>.nav-item>.nav-link.active {
        background-color: #eb212d !important;
    }


    .brand-link .brand-image {
        margin-left: .3rem;
    }

</style>
<aside class="main-sidebar sidebar-dark-primary custom-sidebar-bg elevation-4">
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }} Logo"
            class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light"><strong>OMZ</strong><span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>

</aside>
