@extends('layouts.user')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 page-header">Trade Federations</h1>
</div>

<!-- Content  -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="cb-search-container">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="category_id">Category</label>
                    <select name="category_id" class="form-control">
                        <option value=''>- Any -</option>
                        @foreach($federationCategories as $federationCategory)
                            @if (isset($filters['category_id']) && (int)$filters['category_id'] === (int)$federationCategory->id)
                            <option value="{{ $federationCategory->id }}" selected>{{ $federationCategory->description }}</option>
                            @else
                            <option value="{{ $federationCategory->id }}">{{ $federationCategory->description }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="id">Trade Federation Name</label>
                    <select name="id" class="form-control">
                        <option value=''>- Any -</option>
                        @foreach($federations as $federation)
                            @if (isset($filters['id']) && (int)$filters['id'] === (int)$federation->id)
                            <option value="{{ $federation->id }}" selected>{{ $federation->name }}</option>
                            @else
                            <option value="{{ $federation->id }}">{{ $federation->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="region_id">Region</label>
                    <select name="region_id" class="form-control multi-select" multiple="multiple">
                        @foreach($regions as $region)
                            @if (isset($filters['region_id']) && (int)$filters['region_id'] === (int)$region->id)
                            <option value="{{ $region->id }}" selected>{{ $region->description }}</option>
                            @else
                            <option value="{{ $region->id }}">{{ $region->description }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="status_id">Status</label>
                    <select name="status_id" class="form-control">
                        <option value=''>- Any -</option>
                        @foreach($federationStatuses as $federationStatus)
                            @if (isset($filters['status_id']) && (int)$filters['status_id'] === (int)$federationStatus->id)
                            <option value="{{ $federationStatus->id }}" selected>{{ $federationStatus->description }}</option>
                            @else
                            <option value="{{ $federationStatus->id }}">{{ $federationStatus->description }}</option>
                            @endif
                        @endforeach
                    </select>
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
    @if(session('federation-update-status'))
        <div class="alert alert-success timed-alert text-center w-25 mx-auto mt-3">
            {{ session('federation-update-status') }}
        </div>
    @endif
    <div class="card-body">
        <div class="text-right">
            <a class="btn btn-primary">Add Trade Federation</a>    
        </div>
        <div class="table-responsive">
            <table id="trade-federations-datatable" class="table table-bordered table-hover my-3" width="100%" cellspacing="0" reference="{{ route('api.federation.list') }}">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Trade Federation Name</th>
                        <th>Region</th>
                        <th>Total Number of Local Unions</th>
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
    @include('admin.activate-federation-modal')
    @include('admin.deactivate-federation-modal')
    @vite('resources/js/admin/trade-federations.js')
@endsection