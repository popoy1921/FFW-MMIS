<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Logo -->
    <div class="company-logo my-3 text-center">
		<a href="{{ route('union-point-person.profile') }}">
            <img src="{{ asset('images/company-logo.png') }}" />
        </a>
	</div>    

    <li class="nav-item{{ $page === 'union_profile' ? ' active' : ''}}" id="nav-local-union-details">
        <a class="nav-link" href="{{ route('union-point-person.profile') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Union Profile</span>
        </a>
    </li>

    <li class="nav-item" id="nav-local-union-details">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Company Profile</span>
        </a>
    </li>

    <li class="nav-item" id="nav-blank">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-cog"></i>
            <span>Product Mapping</span>
        </a>
    </li>

    <li class="nav-item" id="nav-blank">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-cog"></i>
            <span>Workplace Mapping</span>
        </a>
    </li>

    <li class="nav-item" id="nav-blank">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-cog"></i>
            <span>Wage and Benefits</span>
        </a>
    </li>

    <li class="nav-item" id="nav-blank">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-cog"></i>
            <span>Workplace Issues and Working Conditions</span>
        </a>
    </li>

    <li class="nav-item" id="nav-blank">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-cog"></i>
            <span>Educational Institutions</span>
        </a>
    </li>

    <li class="nav-item" id="nav-blank">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-cog"></i>
            <span>Members</span>
        </a>
    </li>

    <li class="nav-item" id="nav-blank">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-cog"></i>
            <span>Point Persons</span>
        </a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline" id="sidebarToggleDiv">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>