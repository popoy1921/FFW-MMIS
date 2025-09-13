@extends('admin.trade-federation-details.layout')

@section('card-content')
<div class="card-header py-3 d-flex justify-content-between">
    <h6 class="d-inline my-auto m-0 font-weight-bold card-title">Table of Key CBA Provisions</h6>
    <div class="d-inline text-right">
        <a class="btn btn-secondary" href="{{ route('admin.trade-federations') }}">Back</a>
    </div>
</div>
<div class="card-body">
    <!-- Filter  -->
    <input name="federation_id" type="hidden" value="{{ $federation->id }}"/>
    <div class="card-header py-3">
        <div class="cb-search-container">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="local_union_id">Local Union</label>
                    <select name="local_union_id" class="form-control live-select">
                        @foreach($local_unions as $local_union)
                            <option value="{{ $local_union->id }}">{{ $local_union->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="provision_type_id">Category</label>
                    <select name="provision_type_id" class="form-control">
                        <option value=''>- Any -</option>
                        @foreach($provision_types as $provision_type)
                            <option value="{{ $provision_type->id }}">{{ $provision_type->description }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4 mt-auto">
                    <div class="btn-group w-100" role="group">
                        <button id="provision-filter-submit" class="btn btn-primary w-50">Search</button>
                        <button type="button" class="btn btn-secondary w-50" onclick="window.location.reload();">Reset</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Table  -->
    <div class="card-body">
        <div class="table-responsive">
            <table id="regional-distribution-datatable" class="table table-bordered table-hover my-3" width="100%" cellspacing="0" reference="{{ route('api.provision.list') }}">
                <thead>
                    <tr>
                        <th>Local Union</th>
                        <th>Category</th>
                        <th>Key CBA Provision</th>
                    </tr>
                </thead>                                    
            </table>
        </div>
    </div>

</div>
@endsection

@section('javascript')
    @vite('resources/js/admin/provisions.js')
@endsection