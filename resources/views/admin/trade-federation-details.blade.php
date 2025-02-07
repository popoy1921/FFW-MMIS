@extends('layouts.user')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 page-header">Trade Federation Details</h1>
</div>

<!-- Content  -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
    @if(session('federation-update'))
        <div class="alert alert-success text-center">
            {{ session('federation-update') }}
        </div>
    @endif
    <div class="card-body">
        <form method="POST" action="{{ route('admin.trade-federation-update') }}">
            @csrf
            @method('patch')
            <input type="hidden" name="guid" value="{{ $federation->guid }}">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">Trade Federation Name <span class="text-danger">*</span></label>
                    <input name="name" type="text" value="{{ old('name', $federation->name) }}" 
                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Name" required autofocus />
                    @if($errors->has('fname'))
                    <div class="invalid-feedback d-block">
                        @foreach($errors->get('name') as $error)
                            {{ $error }}
                            @if (!$loop->last)
                                <br />
                            @endif
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="category_id">Category <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}">
                        <option value='' disabled>- Select an option -</option>
                        @foreach($federationCategories as $federationCategory)
                            @if ((int)old('category_id', $federation->category_id) === (int)$federationCategory->id)
                            <option value="{{ $federationCategory->id }}" selected>{{ $federationCategory->description }}</option>
                            @else
                            <option value="{{ $federationCategory->id }}">{{ $federationCategory->description }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="status_id">Category <span class="text-danger">*</span></label>
                    <select name="status_id" class="form-control {{ $errors->has('status_id') ? 'is-invalid' : '' }}">
                        <option value='' disabled>- Select an option -</option>
                        @foreach($federationStatuses as $federationStatus)
                            @if ((int)old('status_id', $federation->status_id) === (int)$federationStatus->id)
                            <option value="{{ $federationStatus->id }}" selected>{{ $federationStatus->description }}</option>
                            @else
                            <option value="{{ $federationStatus->id }}">{{ $federationStatus->description }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                </div>
                <div class="form-group col-md-3">
                    <button type="button" class="btn btn-secondary btn-block" onclick="window.location.reload();">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('javascript')
@include('admin.activate-federation-modal')
@include('admin.deactivate-federation-modal')
@vite('resources/js/admin/trade-federations.js')
@endsection