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
    </div>
    <table id="users-datatable" class="table table-bordered">
        <tr>
            <th>Full name</th>
            <th>Email</th>
            <th>Federation</th>
            <th>Local Union</th>
            <th>Status</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->fullname }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->federation ? $user->federation->name : '' }}</td>
            <td>{{ $user->localUnion ? $user->localUnion->name : '' }}</td>
            <td>{{ $user->userStatus->description }}</td>
            <td>{{ $user->userRole->description }}</td>
            <td>7</td>
        </tr>
        @endforeach
    </table>
</div>

<!-- Pagination -->
<div>
    <ul class="pagination" id="pagination">
        @php 
            $first_page   = $pagination['first_page'];
            $last_page    = $pagination['last_page'];
            $is_last_max  = $pagination['is_last_max'];
            $is_first_min = $pagination['is_first_min'];
            $current_page = $pagination['current_page'];
            $iPageNumber  = $first_page
        @endphp
        <li class="page-item {{ $is_first_min === 1 ? 'disabled' : ''}}" data-page="{{ $first_page }}">
            <a class="page-link" href="#">Previous</a>
        </li>
        @for (
            $iPageNumber = $first_page;
            $iPageNumber <= $last_page; 
            $iPageNumber++
        )
            <li class="page-item {{ $iPageNumber === $current_page ? 'active' : '' }}" data-page="{{ $iPageNumber }}">
                <a class="page-link">{{ $iPageNumber }}</a>
            </li>
        @endfor
        <li class="page-item {{ $is_first_min === 1 ? 'disabled' : ''}}" data-page="{{ $last_page }}">
            <a class="page-link" href="#">Next</a>
        </li>
    </ul>
</div>
@endsection

@section('javascript')
@vite('resources/js/admin/users.js')
@endsection