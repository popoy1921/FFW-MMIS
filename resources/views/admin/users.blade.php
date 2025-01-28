@extends('layouts.user')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 page-header">Users</h1>
</div>

<!-- Content  -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="cb-search-container">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="fullname">Full Name</label>
                    <input name="fullname" type="text" class="form-control" value="{{ isset($filters['fullname']) ? $filters['fullname'] : '' }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="email">Email Address</label>
                    <input name="email" type="text" class="form-control" value="{{ isset($filters['email']) ? $filters['email'] : '' }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="federation">Trade/Sectoral Federation</label>
                    <input name="federation" type="text" class="form-control" value="{{ isset($filters['federation']) ? $filters['federation'] : '' }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="local_union">Local Union</label>
                    <input name="local_union" class="form-control" type="text" value="{{ isset($filters['local_union']) ? $filters['local_union'] : '' }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="role_id">Role</label>
                    <select name="role_id" class="form-control">
                        <option value=''>Any</option>
                        @foreach($userRoles as $userRole)
                            @if (isset($filters['role_id']) && (int)$filters['role_id'] === (int)$userRole->id)
                            <option value="{{ $userRole->id }}" selected>{{ $userRole->description }}</option>
                            @else
                            <option value="{{ $userRole->id }}">{{ $userRole->description }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="status_id">Status</label>
                    <select name="status_id" class="form-control">
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
                <div class="form-group col-md-3 mt-auto">
                    <div class="btn-group w-100" role="group">
                        <button id="users-filter-submit" class="btn btn-primary w-50">Search</button>
                        <button type="button" class="btn btn-secondary w-50" onclick="window.location.reload();">Reset</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="users-datatable" class="table table-bordered table-hover my-3" width="100%" cellspacing="0" reference="{{ route('api.user.list') }}">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Email Address</th>
                        <th>Trade/Sectoral Federation</th>
                        <th>Local Union</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>                                    
            </table>
        </div>
    </div>
</div>
@endsection

@section('javascript')
@vite('resources/js/admin/users.js')
@endsection