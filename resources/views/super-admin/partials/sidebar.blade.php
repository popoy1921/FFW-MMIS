<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Logo -->
    <div class="company-logo my-3 text-center">
		<a href="{{ route('super-admin') }}">
            <img src="{{ asset('images/company-logo.png') }}" />
        </a>
	</div>

    <li class="nav-item" id="nav-local-union-details">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Local Union Details</span>
        </a>
    </li>

    <li class="nav-item active" id="nav-blank">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-cog"></i>
            <span>Blank Page</span>
        </a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline" id="sidebarToggleDiv">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>