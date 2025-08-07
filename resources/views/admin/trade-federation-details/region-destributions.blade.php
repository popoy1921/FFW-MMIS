@extends('admin.trade-federation-details.layout')

@section('card-content')
<div class="card-header py-3 d-flex justify-content-between">
    <h6 class="d-inline my-auto m-0 font-weight-bold card-title">Region Distribution</h6>
    <div class="d-inline text-right">
        <a class="btn btn-secondary" href="{{ route('admin.trade-federations') }}">Back</a>
    </div>
</div>
<div class="card-body">
    <!-- Table -->
    <div class="card-body">
        <!-- Hidden Inputs -->
        <input type="hidden" name="federation_id" value='{{ $federation->id }}'>

        <input class="deactivate-id" type="hidden" name="id">
        <div class="table-responsive">
            <table id="regional-distribution-datatable" class="table table-bordered table-hover my-3"
                width="100%" cellspacing="0" 
                reference="{{ route('api.regional-distribution.list') }}">
                <thead>
                    <tr>
                        <th>Island Group</th>
                        <th>Region Name</th>
                        <th># of Local Unions </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    @vite('resources/js/admin/region-distributions.js')
@endsection