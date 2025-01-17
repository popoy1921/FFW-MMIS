<nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow">

    <a class="navbar-brand mr-0 mr-md-2 company-logo" href="{{ route('union-point-person.profile')}}">
        <img src="{{ asset('images/company-logo.png') }}" />
        <span class="d-inline-block">MMIS</span>
    </a>

    @if ((int)auth()->user()->role_id === 4)
    <!-- Topbar Navbar for Union-Point-Person -->
    <ul id="navbar-for-union" class="navbar-nav ml-auto">

        <!-- Nav Item - Menus (Visible only on large screens) -->
        <li class="nav-item d-none d-lg-inline active" id="nav-local-unions">
            <a class="nav-link" href="{{ route('union-point-person.profile')}}">
                <span class="mr-2">Local Union Details</span>
            </a>
        </li>
        
        <!-- Nav Item - Menus (Visible only on small screens) -->
        <li class="nav-item dropdown no-arrow d-lg-none " id="nav-menus">
            <a class="nav-link dropdown-toggle" href="#" id="menuDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2">Menus</span>
                <small class="fas fa-angle-down text-gray-600 ml-1"></small>
            </a>
            <!-- Dropdown - Menus -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="menuDropdown">
                <a class="dropdown-item active" href="{{ route('union-point-person.profile')}}">
                    <span>Local Union Details</span>
                </a>
            </div>
        </li>
    </ul>
    @elseif ((int)auth()->user()->role_id === 3)
    <!-- Topbar Navbar for Federation-Point-Person -->
    <ul id="navbar-for-federation" class="navbar-nav ml-auto">

        <!-- Nav Item - Menus (Visible only on large screens) -->
        <li class="nav-item d-none d-lg-inline {{ $top_menu === 'trade_federation' ? 'active' : '' }}" id="nav-local-unions">
            <a class="nav-link " href="{{ route('federation-point-person.profile') }}">
                <span class="mr-2">Trade Federation Details</span>
            </a>
        </li>
        <li class="nav-item d-none d-lg-inline" id="nav-local-unions">
            <a class="nav-link " href="#">
                <span class="mr-2">Local Unions</span>
            </a>
        </li>
        
        <!-- Nav Item - Menus (Visible only on small screens) -->
        <li class="nav-item dropdown no-arrow d-lg-none " id="nav-menus">
            <a class="nav-link dropdown-toggle" href="#" id="menuDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2">Menus</span>
                <small class="fas fa-angle-down text-gray-600 ml-1"></small>
            </a>
            <!-- Dropdown - Menus -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="menuDropdown">
                <a class="dropdown-item {{ $top_menu === 'trade_federation' ? 'active' : '' }}" href="{{ route('federation-point-person.profile') }}">
                    <span>Trade Federations Details</span>
                </a>
                <a class="dropdown-item" href="#">
                    <span>Local Unions</span>
                </a>
            </div>
        </li>
    </ul>
    @elseif ((int)auth()->user()->role_id === 2)
    <!-- Topbar Navbar for Admin -->
    <ul id="navbar-for-admin" class="navbar-nav ml-auto">

        <!-- Nav Item - Menus (Visible only on large screens) -->
        <li class="nav-item d-none d-lg-inline {{ $top_menu === 'local_union' ? 'active' : '' }}" id="nav-local-unions">
            <a class="nav-link " href="{{ route('admin.local-unions') }}">
                <span class="mr-2">Local Unions</span>
            </a>
        </li>
        <li class="nav-item d-none d-lg-inline" id="nav-local-unions">
            <a class="nav-link " href="#">
                <span class="mr-2">Trade Federations</span>
            </a>
        </li>
        <li class="nav-item d-none d-lg-inline" id="nav-local-unions">
            <a class="nav-link " href="#">
                <span class="mr-2">Users</span>
            </a>
        </li>
        
        <!-- Nav Item - Menus (Visible only on small screens) -->
        <li class="nav-item dropdown no-arrow d-lg-none " id="nav-menus">
            <a class="nav-link dropdown-toggle" href="#" id="menuDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2">Menus</span>
                <small class="fas fa-angle-down text-gray-600 ml-1"></small>
            </a>
            <!-- Dropdown - Menus -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="menuDropdown">
                <a class="dropdown-item {{ $top_menu === 'local_union' ? 'active' : '' }}" href="{{ route('admin.local-unions') }}">
                    <span>Local Unions</span>
                </a>
                <a class="dropdown-item" href="#">
                    <span>Trade Federations</span>
                </a>
                <a class="dropdown-item" href="#">
                    <span>Users</span>
                </a>
            </div>
        </li>
    </ul>
    @elseif ((int)auth()->user()->role_id === 1)
    <!-- Topbar Navbar for Super-Admin -->
    <ul id="navbar-for-super-admin" class="navbar-nav ml-auto">

        <!-- Nav Item - Menus (Visible only on large screens) -->
        <li class="nav-item d-none d-lg-inline active" id="nav-local-unions">
            <a class="nav-link " href="{{ route('super-admin.users') }}">
                <span class="mr-2">Users</span>
            </a>
        </li>
        
        <!-- Nav Item - Menus (Visible only on small screens) -->
        <li class="nav-item dropdown no-arrow d-lg-none " id="nav-menus">
            <a class="nav-link dropdown-toggle" href="#" id="menuDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2">Menus</span>
                <small class="fas fa-angle-down text-gray-600 ml-1"></small>
            </a>
            <!-- Dropdown - Menus -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="menuDropdown">
                <a class="dropdown-item active" href="{{ route('super-admin.users') }}">
                    <span>Users</span>
                </a>
            </div>
        </li>
    </ul>
    @endif

    <ul class="navbar-nav ml-0">
        <div class="topbar-divider d-sm-block"></div>        
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow {{ $top_menu === 'account_settings' ? 'active' : '' }}"" id="nav-profile">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline">{{ auth()->user()->fname }}</span>
                <img class="img-profile rounded-circle" src="{{ asset('images/default-user.jpg') }}">
                <small class="fas fa-angle-down text-gray-600 ml-1"></small>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('user.account-settings') }}">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Account Settings
                </a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#cb-logout-modal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>

</nav>