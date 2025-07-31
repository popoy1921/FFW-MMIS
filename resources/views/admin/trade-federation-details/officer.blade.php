@extends('admin.trade-federation-details.layout')

@section('card-content')
@if($newly_created === true)
    <span id="iztoast" 
        data-title="Success"
        data-message="Officer added successfully!">
@endif

<div class="card-header py-3 d-flex justify-content-between">
    <h6 class="d-inline my-auto m-0 font-weight-bold card-title">{{ $form_title }}</h6>
    <div class="d-inline text-right">
        <a class="btn btn-secondary" href="{{ route('admin.federation-officers') }}?guid={{ $federation_guid }}">Back</a>
    </div>
</div>

<!-- Content  -->
<div class="row">
    <div class="card-body">
        <form id="create-federation-officer-form" method="POST" class="ajax-{{ $form_type }}-form" action="{{ $form_action }}" data-redirect="{{ route('admin.federation-officer') }}">
            @csrf
            @if (is_null($federation_officer) === false)
            <input name="id" type="hidden" value="{{ $federation_officer->id }}"/>
            @method('patch')
            @endif
            <input name="federation_id" type="hidden" value="{{ $federation_id }}"/>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input name="name" type="text"
                        class="form-control" placeholder="Name" 
                        value="{{ is_null($federation_officer) === false ? $federation_officer->name : '' }}" required autofocus />
                </div>
                <div class="form-group col-md-6">
                    <label for="mname">Position <span class="text-danger">*</span></label>
                    <select name="position_id" class="form-control">
                        <option value="" selected>- Select -</option>
                        @foreach($federation_officer_positions as $federation_officer_position)
                            @if (is_null($federation_officer) || (int)$federation_officer->position_id !== (int)$federation_officer_position->id)
                            <option value="{{ $federation_officer_position->id }}">{{ $federation_officer_position->description }}</option>
                            @else
                            <option value="{{ $federation_officer_position->id }}" selected>{{ $federation_officer_position->description }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="federation_id">Federation<span class="text-danger">*</label>
                    <select name="federation_id" class="form-control" disabled>
                        @foreach($federations as $federation)
                            @if ($federation_id === $federation->id)
                                <option value="{{ $federation->id }}" selected>{{ $federation->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="local_union_id">Local Union<span class="text-danger">*</label>
                    <select name="local_union_id" class="form-control">
                        <option value="" selected>- Select -</option>
                        @foreach($local_unions as $local_union)
                            @if (is_null($federation_officer) || (int)$federation_officer->local_union_id !== (int)$local_union->id)
                            <option value="{{ $local_union->id }}">{{ $local_union->name }}</option>
                            @else
                            <option value="{{ $local_union->id }}" selected>{{ $local_union->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="gender_id">Gender <span class="text-danger">*</label>
                    <select name="gender_id" class="form-control">
                        <option value="" selected>- Select -</option>
                        @foreach($federation_officer_genders as $federation_officer_gender)
                            @if (is_null($federation_officer) || $federation_officer->gender_id !== $federation_officer_gender->id)
                            <option value="{{ $federation_officer_gender->id }}">{{ $federation_officer_gender->description }}</option>
                            @else
                            <option value="{{ $federation_officer_gender->id }}" selected>{{ $federation_officer_gender->description }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="age">Age <span class="text-danger">*</span></label>
                    <input name="age" type="number"
                        class="form-control"
                        value="{{ is_null($federation_officer) === false ? $federation_officer->age : '' }}" required autofocus />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    @if ($form_type === 'create')
                    <button type="submit" class="btn btn-primary btn-block"
                        onclick="callModal('create-federation-officer-form',
                            {
                                title          : 'Create Trade Federation Officer',
                                content        : 'Are you sure you want to proceed in the creating this Officer for this Trade Federation?',
                                confirm_button : 'Save',
                                cancel_button  : 'Cancel',
                                success_msg    : 'Officer added successfully!'
                            },
                        );"
                    >Save</button>
                    @else
                    <button type="submit" class="btn btn-primary btn-block"
                        onclick="callModal('create-federation-officer-form',
                            {
                                title          : 'Update Trade Federation Officer',
                                content        : 'Are you sure you want to proceed in the updating this Officer for this Trade Federation?',
                                confirm_button : 'Save',
                                cancel_button  : 'Cancel',
                                success_msg    : 'Officer details updated successfully!'
                            },
                        );"
                    >Save</button>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <button type="button" class="btn btn-secondary btn-block" onclick="window.location.reload();">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection