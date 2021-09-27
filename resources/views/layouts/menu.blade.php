<li class="nav-item">
    <a href="{{ route('home') }}" class="text-white nav-link {{ Request::is('home*') ? 'active' : '' }}">
        <span class="mr-3"><i class="fa fa-home"></i></span>
        <p>Dashboard</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('messenger') }}"
        class="text-white nav-link {{ Request::is('messenger*') ? 'active' : '' }}">
        <span class="mr-3"><i class="fa fa-envelope"></i></span>
        <p>Messenger</p>
    </a>
</li>

@role('superadministrator')
<li class="nav-item">
    <a href="{!! route('users.index') !!}"
        class="text-white nav-link {{ Request::is('users*') ? 'active' : '' }} dropdown-item">
        <span class="mr-3"><i class="fa fa-users"></i></span>
        <p>Users</p>
    </a>
</li>

<li class="nav-item">
    <a href="{!! route('roles-assignment.index') !!}"
        class="text-white nav-link {{ Request::is('roles-assignment*') ? 'active' : '' }} dropdown-item">
        <span class="mr-3"><i class="fa fa-user-lock"></i></span>
        <p>Roles Assignment</p>
    </a>
</li>

<li class="nav-item">
    @if (Route::current()->getName() == 'roles.index' || Route::current()->getName() == 'roles.edit' || Route::current()->getName() == 'roles.show' || Route::current()->getName() == 'roles.create')
        <a href="{!! route('roles.index') !!}" class="text-white nav-link active dropdown-item">
            <span class="mr-3"><i class="fa fa-user-tag"></i></span>
            <p>Roles</p>
        </a>
    @else
        <a href="{!! route('roles.index') !!}" class="text-white nav-link dropdown-item">
            <span class="mr-3"><i class="fa fa-user-tag"></i></span>
            <p>Roles</p>
        </a>
    @endif
</li>

<li class="nav-item">
    <a href="{!! route('permissions.index') !!}"
        class="text-white nav-link {{ Request::is('permissions*') ? 'active' : '' }} dropdown-item">
        <span class="mr-3"><i class="fa fa-lock"></i></span>
        <p>Permissions</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('activityLogs.index') }}"
        class="text-white nav-link {{ Request::is('activityLogs*') ? 'active' : '' }}">
        <span class="mr-3"><i class="fa fa-history"></i></span>
        <p>Activity Logs</p>
    </a>
</li>

@endrole
