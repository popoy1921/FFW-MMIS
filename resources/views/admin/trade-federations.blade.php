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
                    <label for="fullname">Trade Federation Name</label>
                    <input name="fullname" type="text" class="form-control" value="{{ isset($filters['fullname']) ? $filters['fullname'] : '' }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="email">Category</label>
                    <input name="email" type="text" class="form-control" value="{{ isset($filters['email']) ? $filters['email'] : '' }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="federation">Region</label>
                    <input name="federation" type="text" class="form-control" value="{{ isset($filters['federation']) ? $filters['federation'] : '' }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="role_id">Role</label>
                    <select name="role_id" class="form-control">
                        <option value=''>Any</option>                        
                    </select>
                </div>
            </div>
            <div class="form-row">
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
            <table id="trade-federations-datatable" class="table table-bordered table-hover my-3" width="100%" cellspacing="0" reference="{{ route('api.federation.list') }}">
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
@vite('resources/js/admin/trade-federations.js')
@endsection