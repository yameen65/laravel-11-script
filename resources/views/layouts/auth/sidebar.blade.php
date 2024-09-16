<nav id="sidebar" class="sidebar">
    <a class="sidebar-brand" href="{{ route('auth') }}">
        <svg>
            <use xlink:href="#ion-ios-pulse-strong"></use>
        </svg>
        {{ config('app.name') }}
    </a>
    <div class="sidebar-content">
        <div class="sidebar-user">
            <img src="{{ auth()->user()->profile() }}" class="img-fluid rounded-circle mb-2"
                alt="{{ auth()->user()->full_name }}" />
            <div class="fw-bold">{{ auth()->user()->full_name }}</div>
            <small>{{ auth()->user()->email }}</small>
        </div>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Main
            </li>

            <li class="sidebar-item {{ request()->route()->getName() == 'auth' ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('auth') }}">
                    <i class="align-middle me-2 fas fa-fw fa-home"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-header">
                Menu
            </li>
            <li class="sidebar-item {{ Str::startsWith(request()->route()->getName(), 'users.') ? 'active' : '' }}">
                <a data-bs-target="#users" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle me-2 fas fa-fw fa-users"></i> <span class="align-middle">User
                        Interface</span>
                </a>
                <ul id="users" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item {{ request()->route()->getName() == 'users.index' ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('users.index') }}">All</a>
                    </li>
                    <li class="sidebar-item {{ request()->route()->getName() == 'users.create' ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('users.create') }}">Create</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-header">
                Role and Permissions
            </li>
            <li
                class="sidebar-item {{ Str::startsWith(request()->route()->getName(), 'roles.') ? 'active' : '' }} {{ Str::startsWith(request()->route()->getName(), 'permissions.') ? 'active' : '' }}">
                <a data-bs-target="#documentation" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle me-2 fas fa-fw fa-book"></i> <span class="align-middle">Roles And
                        Permission</span>
                </a>
                <ul id="documentation" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item  {{ request()->route()->getName() == 'roles.index' ? 'active' : '' }}"><a
                            class="sidebar-link" href="{{ route('roles.index') }}">Roles</a></li>
                    <li
                        class="sidebar-item {{ request()->route()->getName() == 'permissions.index' ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('permissions.index') }}">Permissions</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
