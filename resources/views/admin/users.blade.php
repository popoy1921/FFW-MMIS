@extends('layouts.user')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 page-header">Users</h1>
</div>

<!-- Content  -->
<div class="row flex-xl-nowrap">
    <div id="users-filter-form">
        <label for="fullname">Full Name:</label><br />
        <input name="fullname" type="text" value="{{ isset($filters['fullname']) ? $filters['fullname'] : '' }}">
        <br />
        <label for="email">Email:</label><br />
        <input name="email" type="text" value="{{ isset($filters['email']) ? $filters['email'] : '' }}">
        <br />
        <label for="Federation">Federation:</label><br />
        <input name="federation" type="text" value="{{ isset($filters['federation']) ? $filters['federation'] : '' }}">
        <br />
        <label for="Local Union">Local Union:</label><br />
        <input name="local_union" type="text" value="{{ isset($filters['local_union']) ? $filters['local_union'] : '' }}">
        <br /><br />
        <label for="role_id">Role:</label><br />
        <select name="role_id">
            <option value=''>Any</option>
            @foreach($userRoles as $userRole)
                @if (isset($filters['role_id']) && (int)$filters['role_id'] === (int)$userRole->id)
                <option value="{{ $userRole->id }}" selected>{{ $userRole->description }}</option>
                @else
                <option value="{{ $userRole->id }}">{{ $userRole->description }}</option>
                @endif
            @endforeach
        </select>
        <br /><br />
        <label for="status_id">Status:</label><br />
        <select name="status_id">
            <option value=''>Any</option>
            @foreach($userStatuses as $userStatus)
            @if (isset($filters['status_id']) && (int)$filters['status_id'] === (int)$userStatus->id)
                <option value="{{ $userStatus->id }}" selected>{{ $userStatus->description }}</option>
                @else
                <option value="{{ $userStatus->id }}">{{ $userStatus->description }}</option>
                @endif
            @endforeach
        </select>
        <button id="users-filter-submit">Search</button>
    </div>
    <table id="users-datatable" class="table table-bordered" reference="{{ route('api.user.list') }}">
        <thead>
            <tr>
                <th>Full name</th>
                <th>Email</th>
                <th>Federation</th>
                <th>Local Union</th>
                <th>Status</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@section('javascript')
@vite('resources/js/admin/users.js')
@endsection