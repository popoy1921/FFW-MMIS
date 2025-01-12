<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Logo -->
    <div class="company-logo my-3 text-center">
		<a href="{{ route('federation-point-person.profile') }}">
            <img src="{{ asset('images/company-logo.png') }}" />
        </a>
	</div>    

    <!-- Trade Federation Details Header -->
    <div class="sidebar-heading">
        Trade Federation Details
    </div>

    <li class="nav-item{{ $page === 'federation_profile' ? ' active' : ''}}" id="nav-local-union-details">
        <a class="nav-link" href="{{ route('federation-point-person.profile') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Details</span>
        </a>
    </li>

    <li class="nav-item" id="nav-local-union-details">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Point Persons</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider mt-0 mb-3">

    <!-- Local Unions Header --> 
    <div class="sidebar-heading">
        Local Unions
    </div>

    <li class="nav-item" id="nav-local-union-details">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Local Unions</span>
        </a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline" id="sidebarToggleDiv">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>