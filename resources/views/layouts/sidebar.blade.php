<style>
    .custom-sidebar-bg {
        background-color: #232820;
    }

    .nav-sidebar>.nav-item>.nav-link.active {
        background-color: #eb212d !important;
    }

    a.nav-link.active.dropdown-item {
        background-color: #eb212d !important;
    }

    a.nav-link.dropdown-item:hover {
        background-color: #eb212d !important;
    }


    .brand-link .brand-image {
        margin-left: .3rem;
    }

    .brand-link {
        border-bottom: none !important;
        text-align: center;
    }

    .brand-image {
        margin-top: 10px !important;
        text-align: center;
        height: 2rem !important;
        border-style: none;
    }

    .brand-link .brand-image {
        float: none !important;
    }

    .sidebar li .submenu {
        list-style: none;
        margin: 0;
        padding: 0;
        padding-left: 1rem;
        padding-right: 1rem;
    }

</style>
<aside class="main-sidebar sidebar-dark-primary custom-sidebar-bg elevation-4">


    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }} Logo"
            class="brand-image img-circle elevation-3">
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>

</aside>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.sidebar .nav-link').forEach(function(element) {

            element.addEventListener('click', function(e) {

                let nextEl = element.nextElementSibling;
                let parentEl = element.parentElement;

                if (nextEl) {
                    e.preventDefault();
                    let mycollapse = new bootstrap.Collapse(nextEl);

                    if (nextEl.classList.contains('show')) {
                        mycollapse.hide();
                    } else {
                        mycollapse.show();
                        // find other submenus with class=show
                        var opened_submenu = parentEl.parentElement.querySelector(
                            '.submenu.show');
                        // if it exists, then close all of them
                        if (opened_submenu) {
                            new bootstrap.Collapse(opened_submenu);
                        }
                    }
                }
            }); // addEventListener
        }) // forEach
    });
</script>
