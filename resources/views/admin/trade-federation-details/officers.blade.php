@extends('admin.trade-federation-details.layout')

@section('card-content')
<div class="card-header py-3 d-flex justify-content-between">
    <h6 class="d-inline my-auto m-0 font-weight-bold card-title">Officers</h6>
    <div class="d-inline text-right">
        <a class="btn btn-secondary" href="{{ route('admin.trade-federations') }}">Back</a>
    </div>
</div>
<div class="card-body">
    <!-- Filter -->
    <input name="federation_id" type="hidden" value="{{ $federation->id }}">

    <!-- Table -->
    <div class="card-body">
        <div class="text-right">
            <a class="btn btn-primary" href="{{ route('admin.add-federation-officers') }}?federation_guid={{ $federation->guid }}">Add Officer</a>    
        </div>
        <div class="table-responsive">
            <table id="federation-officers-datatable" class="table table-bordered table-hover my-3" width="100%" cellspacing="0" reference="{{ route('api.federation-officers.list') }}">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Local Union</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    @include('admin.remove-officer-form')
    @vite('resources/js/admin/federation-officers.js')
@endsection