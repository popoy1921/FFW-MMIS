@extends('admin.trade-federation-details.layout')

@section('card-content')
<div class="card-header py-3 d-flex justify-content-between">
    <h6 class="d-inline my-auto m-0 font-weight-bold card-title">MMIS Point Persons</h6>
    <div class="d-inline text-right">
        <a class="btn btn-secondary" href="{{ route('admin.trade-federations') }}">Back</a>
    </div>
</div>
<div class="card-body">
    <!-- Filter -->
    <div class="card-header py-3">
        <div class="cb-search-container">
            <input name="federation" type="hidden" value="{{$federation->name}}">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="fullname">Name</label>
                    <input name="fullname" type="text" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label for="email">Email Address</label>
                    <input name="email" type="text" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label for="email">Status</label>
                    <select name="status_id" class="form-control">
                        <option value='' selected>- Any -</option>
                        @foreach($userStatuses as $userStatus)
                            <option value="{{ $userStatus->id }}">{{ $userStatus->description }}</option>
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

    <!-- Table -->
    <div class="card-body">
        <div class="text-right">
            <a class="btn btn-primary" href="{{ route('admin.add-federation-point-person') }}?guid={{ $federation_guid }}">Add MMIS Point Person</a>    
        </div>
        <div class="table-responsive">
            <table id="federation-point-person-datatable" class="table table-bordered table-hover my-3" width="100%" cellspacing="0" reference="{{ route('api.user.list') }}">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Templates -->

<a class="btn btn-sm btn-success update-status deactivate template" title="Update Status" href="#">
    <i class="fa fa-pencil" aria-hidden="true"></i>
</a>

<a class="btn btn-sm btn-success update-status activate template" title="Update Status" href="#">
    <i class="fa fa-pencil" aria-hidden="true"></i>
</a>

<!-- End of -Templates -->
@endsection

@section('javascript')
    @include('admin.activate-user-form')
    @include('admin.deactivate-user-form')
    @vite('resources/js/admin/federation-point-persons.js')
@endsection