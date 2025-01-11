<ul class="menu">
    <li class="sidebar-title">Menu</li>
    <li class="sidebar-item">
        <a href="/dashboard" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
        </a>
    </li>

    @canany(['list user', 'list role', 'list permission'])
        <li class="sidebar-title">User Management</li>
    @endcanany
    <li class="sidebar-item">
        @can('list user')
            <a href="/user" class='sidebar-link'>
                <i class="bi bi-person-fill-gear"></i>
                <span>User</span>
            </a>
        @endcan

        @can('list role')
            <a href="/role" class='sidebar-link'>
                <i class="bi bi-person-check-fill"></i>
                <span>Role</span>
            </a>
        @endcan

        @can('list permission')
            <a href="/permission" class='sidebar-link'>
                <i class="bi bi-card-checklist"></i>
                <span>Permission</span>
            </a>
        @endcan
    </li>

    @canany(['edit info app'])
        <li class="sidebar-title">Settings</li>
    @endcanany

    @can('edit info app')
        <li class="sidebar-item">
            <a href="/aplikasi" class='sidebar-link'>
                <i class="bi bi-gear-wide-connected"></i>
                <span>Aplikasi</span>
            </a>
        </li>
    @endcan



    <li class="sidebar-item">
        <a href="#" class="sidebar-link"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-power"></i>
            <span>Logout</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>


</ul>
