@role('applicant')

    <li class="nav-item">
        <a href="{{ route('applicants.dashboard') }}"
            class="text-dark nav-link {{ Request::is('applicants_dashboard*') ? 'active' : '' }}">
            <span class="mr-3"><i class="fa fa-home"></i></span>
            <p>Dashboard</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('tickets.index') }}" class="text-dark nav-link {{ Request::is('tickets*') ? 'active' : '' }}">
            <span class="mr-3"><i class="fas fa-ticket-alt"></i></span>
            <p>Ticketing / Support</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('notifications.index') }}"
            class="text-dark nav-link {{ Request::is('notifications*') ? 'active' : '' }}">
            <span class="mr-3"><i class="fa fa-envelope"></i></span>
            <p>My Notifications</p>
        </a>
    </li>

@endrole



@role('operator')

    <li class="nav-item">
        <a href="{{ route('operators.dashboard') }}"
            class="text-dark nav-link {{ Request::is('operators_dashboard*') ? 'active' : '' }}">
            <span class="mr-3"><i class="fa fa-home"></i></span>
            <p>Dashboard</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('messenger') }}" class="text-dark nav-link {{ Request::is('messenger*') ? 'active' : '' }}">
            <span class="mr-3"><i class="fa fa-envelope"></i></span>
            <p>Messenger</p>
        </a>
    </li>

    <li class="nav-item has-submenu">
        <a class="text-dark nav-link" href="#"> <span class="mr-3"><i class="fa fa-id-card"></i></span>
            <p>License Management</p>
        </a>
        <ul class="submenu collapse">
            <li class="nav-item">
                <a href="{{ route('licenseChecklists.index') }}"
                    class="text-dark nav-link {{ Request::is('licenseChecklists*') ? 'active' : '' }}">
                    <span class="mr-3"><i class="fas fa-id-card-alt"></i></span>
                    <p>License Checklists</p>
                </a>
            </li>

        </ul>
    </li>



    <li class="nav-item has-submenu">
        <a class="text-dark nav-link" href="#"> <span class="mr-3"><i class="fa fa-cubes"></i></span>
            <p>Operator Management</p>
        </a>
        <ul class="submenu collapse">

            <li class="nav-item">
                <a href="{{ route('operators.index') }}"
                    class="text-dark nav-link {{ Request::is('operators*') ? 'active' : '' }}">
                    <span class="mr-3"><i class="fas fa-users-cog"></i></span>
                    <p>Details</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('operatorDirectors.index') }}"
                    class="text-dark nav-link {{ Request::is('operatorDirectors*') ? 'active' : '' }}">
                    <span class="mr-3"><i class="fas fa-gem"></i></span>
                    <p>Directors</p>
                </a>
            </li>


            <li class="nav-item">
                <a href="{{ route('operatorGames.index') }}"
                    class="text-dark nav-link {{ Request::is('operatorGames*') ? 'active' : '' }}">
                    <span class="mr-3"><i class="fas fa-dice"></i></span>
                    <p>Games</p>
                </a>
            </li>


            <li class="nav-item">
                <a href="{{ route('operatorLicenses.index') }}"
                    class="text-dark nav-link {{ Request::is('operatorLicenses*') ? 'active' : '' }}">
                    <span class="mr-3"><i class="fas fa-user-tag"></i></span>
                    <p>Licenses</p>
                </a>
            </li>


            <li class="nav-item">
                <a href="{{ route('operatorSchemes.index') }}"
                    class="text-dark nav-link {{ Request::is('operatorSchemes*') ? 'active' : '' }}">
                    <span class="mr-3"><i class="fas fa-dice-d20"></i></span>
                    <p>Schemes</p>
                </a>
            </li>


        </ul>
    </li>


    <li class="nav-item">
        <a href="{{ route('tickets.index') }}"
            class="text-dark nav-link {{ Request::is('tickets*') ? 'active' : '' }}">
            <span class="mr-3"><i class="fas fa-ticket-alt"></i></span>
            <p>Ticketing / Support</p>
        </a>
    </li>
@endrole

@role('superadministrator')

    <li class="nav-item">
        <a href="{{ route('home') }}" class="text-dark nav-link {{ Request::is('home*') ? 'active' : '' }}">
            <span class="mr-3"><i class="fa fa-home"></i></span>
            <p>Dashboard</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('messenger') }}" class="text-dark nav-link {{ Request::is('messenger*') ? 'active' : '' }}">
            <span class="mr-3"><i class="fa fa-envelope"></i></span>
            <p>Messenger</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('applicants.index') }}"
            class="text-dark nav-link {{ Request::is('applicants*') ? 'active' : '' }}">
            <span class="mr-3"><i class="fa fa-users"></i></span>
            <p>Applicants</p>
        </a>
    </li>


    <li class="nav-item">
        <a href="{{ route('broadcasts.index') }}"
            class="text-dark nav-link {{ Request::is('broadcasts*') ? 'active' : '' }}">
            <span class="mr-3"><i class="fa fa-bullhorn"></i></span>
            <p>Broadcasts</p>
        </a>
    </li>


    <li class="nav-item has-submenu">
        <a class="text-dark nav-link" href="#"> <span class="mr-3"><i class="fa fa-id-card"></i></span>
            <p>License Management</p>
        </a>
        <ul class="submenu collapse">
            <li class="nav-item">
                <a href="{{ route('licenseChecklists.index') }}"
                    class="text-dark nav-link {{ Request::is('licenseChecklists*') ? 'active' : '' }}">
                    <span class="mr-3"><i class="fas fa-id-card-alt"></i></span>
                    <p>License Checklists</p>
                </a>
            </li>


            <li class="nav-item">
                <a href="{{ route('licenseTypes.index') }}"
                    class="text-dark nav-link {{ Request::is('licenseTypes*') ? 'active' : '' }}">
                    <span class="mr-3"><i class="fas fa-address-book"></i></span>
                    <p>License Types</p>
                </a>
            </li>

        </ul>
    </li>


    <li class="nav-item">
        <a href="{{ route('gamesPlayed.index') }}"
           class="text-dark nav-link {{ Request::is('gamesPlayed*') ? 'active' : '' }}">
            <span class="mr-3"><i class="fa fa-gamepad"></i></span>
            <p>Games Played</p>
        </a>
    </li>

    <li class="nav-item has-submenu">
        <a class="text-dark nav-link" href="#"> <span class="mr-3"><i class="fa fa-cubes"></i></span>
            <p>Operator Management</p>
        </a>
        <ul class="submenu collapse">
            <li class="nav-item">
                <a href="{{ route('operators.index') }}"
                    class="text-dark nav-link {{ Request::is('operators*') ? 'active' : '' }}">
                    <span class="mr-3"><i class="fas fa-users-cog"></i></span>
                    <p>Operators</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('operatorDirectors.index') }}"
                    class="text-dark nav-link {{ Request::is('operatorDirectors*') ? 'active' : '' }}">
                    <span class="mr-3"><i class="fas fa-gem"></i></span>
                    <p>Operator Directors</p>
                </a>
            </li>


            <li class="nav-item">
                <a href="{{ route('operatorGames.index') }}"
                    class="text-dark nav-link {{ Request::is('operatorGames*') ? 'active' : '' }}">
                    <span class="mr-3"><i class="fas fa-dice"></i></span>
                    <p>Operator Games</p>
                </a>
            </li>


            <li class="nav-item">
                <a href="{{ route('operatorLicenses.index') }}"
                    class="text-dark nav-link {{ Request::is('operatorLicenses*') ? 'active' : '' }}">
                    <span class="mr-3"><i class="fas fa-user-tag"></i></span>
                    <p>Operator Licenses</p>
                </a>
            </li>


            <li class="nav-item">
                <a href="{{ route('operatorSchemes.index') }}"
                    class="text-dark nav-link {{ Request::is('operatorSchemes*') ? 'active' : '' }}">
                    <span class="mr-3"><i class="fas fa-dice-d20"></i></span>
                    <p>Operator Schemes</p>
                </a>
            </li>


            <li class="nav-item">
                <a href="{{ route('operatorTypes.index') }}"
                    class="text-dark nav-link {{ Request::is('operatorTypes*') ? 'active' : '' }}">
                    <span class="mr-3"><i class="fas fa-chess-king"></i></span>
                    <p>Operator Types</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('domainMonitoring') }}"
                    class="text-dark nav-link {{ Request::is('domainMonitoring*') ? 'active' : '' }}">
                    <span class="mr-3"><i class="fa fa-globe"></i></span>
                    <p>Domain Monitoring</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('monitoringLogs.index') }}"
                    class="text-dark nav-link {{ Request::is('monitoringLogs*') ? 'active' : '' }}">
                    <span class="mr-3"><i class="fa fa-history"></i></span>
                    <p>Monitoring Logs</p>
                </a>
            </li>
        </ul>
    </li>


    <li class="nav-item">
        <a href="{{ route('tickets.index') }}"
            class="text-dark nav-link {{ Request::is('tickets*') ? 'active' : '' }}">
            <span class="mr-3"><i class="fas fa-ticket-alt"></i></span>
            <p>Ticketing / Support</p>
        </a>
    </li>

    {{-- <li class="nav-item has-submenu">
    <a class="text-dark nav-link" href="#"> <span class="mr-3"><i class="fa fa-file"></i></span>
        <p>Ticketing/Support</p>
    </a>
    <ul class="submenu collapse">
        <li class="nav-item">
            <a href="{{ route('comments.index') }}"
                class="text-dark nav-link {{ Request::is('comments*') ? 'active' : '' }}">
                <span class="mr-3"><i class="far fa-comments"></i></span>
                <p>Comments</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('mailBoxes.index') }}"
                class="text-dark nav-link {{ Request::is('mailBoxes*') ? 'active' : '' }}">
                <span class="mr-3"><i class="fas fa-mail-bulk"></i></span>
                <p>Mail Boxes</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('tickets.index') }}"
                class="text-dark nav-link {{ Request::is('tickets*') ? 'active' : '' }}">
                <span class="mr-3"><i class="fas fa-ticket-alt"></i></span>
                <p>Tickets</p>
            </a>
        </li>
        
        
        <li class="nav-item">
            <a href="{{ route('ticketTypes.index') }}"
                class="text-dark nav-link {{ Request::is('ticketTypes*') ? 'active' : '' }}">
                <span class="mr-3"><i class="fas fa-clipboard-list"></i></span>
                <p>Ticket Types</p>
            </a>
        </li>
        
    </ul>
</li> --}}

    <li class="nav-item has-submenu">
        <a class="text-dark nav-link" href="#"> <span class="mr-3"><i class="fa fa-cog"></i></span>
            <p>Settings</p>
        </a>
        <ul class="submenu collapse">
            <li> <a href="{{ route('activityLogs.index') }}"
                    class="text-dark nav-link {{ Request::is('activityLogs*') ? 'active' : '' }} dropdown-item">
                    <span class="mr-3"><i class="fa fa-history"></i></span>
                    <p>Activity Logs</p>
                </a></li>
            <li> <a href="{!! route('roles-assignment.index') !!}"
                    class="text-dark nav-link {{ Request::is('roles-assignment*') ? 'active' : '' }} dropdown-item">
                    <span class="mr-3"><i class="fa fa-user-lock"></i></span>
                    <p class>Roles Assignment</p>
                </a></li>
            <li>
                @if (Route::current()->getName() == 'roles.index' || Route::current()->getName() == 'roles.edit' || Route::current()->getName() == 'roles.show' || Route::current()->getName() == 'roles.create')
                    <a href="{!! route('roles.index') !!}" class="text-dark nav-link active dropdown-item">
                        <span class="mr-3"><i class="fa fa-user-tag"></i></span>
                        <p>Roles</p>
                    </a>
                @else
                    <a href="{!! route('roles.index') !!}" class="text-dark nav-link dropdown-item">
                        <span class="mr-3"><i class="fa fa-user-tag"></i></span>
                        <p>Roles</p>
                    </a>
                @endif
            </li>
            <li> <a href="{!! route('permissions.index') !!}"
                    class="text-dark nav-link {{ Request::is('permissions*') ? 'active' : '' }} dropdown-item">
                    <span class="mr-3"><i class="fa fa-lock"></i></span>
                    <p>Permissions</p>
                </a></li>

            <li> <a href="{!! route('users.index') !!}"
                    class="text-dark nav-link {{ Request::is('users*') ? 'active' : '' }} dropdown-item">
                    <span class="mr-3"><i class="fa fa-users"></i></span>
                    <p>Users</p>
                </a></li>

            <li class="nav-item">
                <a href="{{ route('states.index') }}"
                    class="text-dark nav-link {{ Request::is('states*') ? 'active' : '' }}">
                    <span class="mr-3"><i class="fa fa-map-pin"></i></span>
                    <p>States</p>
                </a>
            </li>
        </ul>
    </li>
@endrole



