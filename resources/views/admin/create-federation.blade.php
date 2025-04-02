@extends('layouts.user')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 page-header">Add Trade Federation</h1>
</div>

<!-- Content  -->
<div class="row">
    <div class="card-body">
        <form id="create-trade-federation" method="POST" class="ajax-create-form" action="{{ route('admin.create-federation') }}" data-redirect="{{ route('admin.trade-federation-details') }}">
            @csrf
            <div class="form-group">
                <label for="name">Trade Federation Name <span class="text-danger">*</span></label>
                <input name="name" type="text" value="{{ old('name') }}" 
                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Trade Federation Name" required autofocus />
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
            <div class="form-group">
                <label for="category_id">Category <span class="text-danger">*</span></label>
                <select name="category_id" class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}">
                    @foreach($federationCategories as $federationCategory)
                        @if ( (int)old('category_id') === (int)$federationCategory->id)
                        <option value="{{ $federationCategory->id }}" selected>{{ $federationCategory->description }}</option>
                        @else
                        <option value="{{ $federationCategory->id }}">{{ $federationCategory->description }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="status_id">Status <span class="text-danger">*</span></label>
                <select name="status_id" class="form-control {{ $errors->has('status_id') ? 'is-invalid' : '' }}">
                    @foreach($federationStatuses as $federationStatus)
                        @if ( (int)old('status_id') === (int)$federationStatus->id)
                        <option value="{{ $federationStatus->id }}" selected>{{ $federationStatus->description }}</option>
                        @else
                        <option value="{{ $federationStatus->id }}">{{ $federationStatus->description }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <button type="submit" class="btn btn-primary btn-block"
                onclick="callModal('create-trade-federation',
                    {
                        title          : 'Create Trade Federation',
                        content        : 'Are you sure you want to proceed in the creating this Trade Federation?',
                        confirm_button : 'Save',
                        cancel_button  : 'Cancel',
                        success_msg    : 'You have successfully created the Trade Federation.'
                    }
                    );">Save</button>
                </div>
                <div class="form-group col-md-6">
                    <a type="button" class="btn btn-secondary btn-block" href="{{ route('admin.trade-federations') }}">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection