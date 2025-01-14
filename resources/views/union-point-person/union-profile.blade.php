@extends('layouts.user')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 page-header">Local Union Details</h1>
</div>

<!-- Content  -->
<div class="row flex-xl-nowrap">
    <!-- Menus (Visible only on large screens) -->
    <div class="list-group d-none d-lg-inline col-lg-2 col-sm-12" id="local-union-details-list">
        <a class="list-group-item list-group-item-action {{ $page === 'union_profile' ? 'active' : '' }}" href=" {{ union-point-person.profile }} ">Union Profile</a>
        <a class="list-group-item list-group-item-action" href="#">Company Profile</a>
        <a class="list-group-item list-group-item-action" href="#">Product Mapping</a>
        <a class="list-group-item list-group-item-action" href="#">Workplace Mapping</a>
        <a class="list-group-item list-group-item-action" href="#">Wages and Benefits</a>
        <a class="list-group-item list-group-item-action" href="#">Workplace Issues and Working Conditions</a>
        <a class="list-group-item list-group-item-action" href="#">Educational Institutions</a>
        <a class="list-group-item list-group-item-action" href="#">Members</a>
        <a class="list-group-item list-group-item-action" href="#">Point Persons</a>
    </div>

    <!-- Menus (Visible only on small screens) -->
    <div class="dropdown no-arrow mb-4 col-sm-12 d-block d-lg-none">
        <button class="btn btn-primary dropdown-toggle w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span>Menus</span>
            <i class="fas fa-angle-down text-gray-600 ml-1"></i>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
            <a class="dropdown-item active" href="local-union-details.php">Union Profile</a>
            <a class="dropdown-item" href="#">Company Profile</a>
            <a class="dropdown-item" href="#">Product Mapping</a>
            <a class="dropdown-item" href="#">Workplace Mapping</a>
            <a class="dropdown-item" href="#">Wages and Benefits</a>
            <a class="dropdown-item" href="#">Workplace Issues and Working Conditions</a>
            <a class="dropdown-item" href="#">Educational Institutions</a>
            <a class="dropdown-item" href="#">Members</a>
            <a class="dropdown-item" href="#">Point Persons</a>
        </div>
    </div>

    <div class="card d-xl-block col-lg-10 col-sm-12 shadow px-0 mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold card-title">Union Profile</h6>
        </div>
        <div class="card-body">
            Content for Union Profile
        </div>
    </div>

</div>
@endsection