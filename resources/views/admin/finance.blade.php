@extends('layouts.user')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 page-header">List of Monthly Remittances</h1>
</div>

<!-- Content  -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="cb-search-container">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="federation_id">Trade Federation</label>
                    <select name="federation_id" class="form-control">
                        <option value=''>- Any -</option>
                        @foreach($federations as $federation)
                            <option value="{{ $federation->id }}">{{ $federation->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="local_union_id">Local Union</label>
                    <select name="local_union_id" class="form-control">
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="from_date">From</label>
                    <input name="from_date" class="form-control date-picker">
                </div>
                <div class="form-group col-md-3 mt-auto">
                    <div class="btn-group w-100" role="group">
                        <button id="federation-filter-submit" class="btn btn-primary w-50">Search</button>
                        <button type="button" class="btn btn-secondary w-50" onclick="window.location.reload();">Reset</button>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3 mt-auto">
                    <div class="btn-group w-100" role="group">
                        <button id="federation-filter-submit" class="btn btn-primary w-50">Search</button>
                        <button type="button" class="btn btn-secondary w-50" onclick="window.location.reload();">Reset</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <!-- <div class="text-right">
            <a class="btn btn-primary" href="{{ route('admin.add-federations') }}">Add Trade Federation</a>    
        </div>
        <div class="table-responsive">
            <table id="trade-federations-datatable" class="table table-bordered table-hover my-3" width="100%" cellspacing="0" reference="{{ route('api.federation.list') }}">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Trade Federation Name</th>
                        <th>Total Number of Local Unions</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>                                    
            </table>
        </div> -->
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
    @include('admin.activate-federation-form')
    @include('admin.deactivate-federation-form')
    @vite('resources/js/admin/trade-federations.js')
@endsection