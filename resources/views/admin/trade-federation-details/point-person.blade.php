@extends('admin.trade-federation-details.layout')

@section('card-content')
<div class="card-header py-3 d-flex justify-content-between">
    <h6 class="d-inline my-auto m-0 font-weight-bold card-title">MMIS Point Person</h6>
    <div class="d-inline text-right">
        <a class="btn btn-secondary" href="{{ route('admin.federation-point-persons') }}?guid={{ $federation_guid }}">Back</a>
    </div>
</div>

<!-- Content  -->
<div class="row">
    <div class="card-body">
        <form id="create-user-form" method="POST" class="ajax-create-form" action="{{ route('user.create') }}" data-redirect="{{ route('admin.federation-point-persons') }}">
            @csrf
            <input name="id" type="hidden" value="0"/>
            <input name="role_id" type="hidden" value="3">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fname">First Name <span class="text-danger">*</span></label>
                    <input name="fname" type="text" value="{{ $user->fname }}"
                        class="form-control" placeholder="First Name" required autofocus />
                </div>
                <div class="form-group col-md-6">
                    <label for="mname">Middle Name</label>
                    <input name="mname" type="text" value="{{ $user->mname }}"
                        class="form-control" placeholder="Middle Name" autofocus />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="lname">Last Name <span class="text-danger">*</label>
                    <input name="lname" type="text" value="{{ $user->lname }}"
                        class="form-control" placeholder="Last Name" required autofocus />
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Email <span class="text-danger">*</label>
                    <input name="email" type="text" value="{{ $user->email }}"
                        class="form-control" placeholder="Email" required autofocus />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="status_id">Status <span class="text-danger">*</span></label>
                    <select name="status_id" class="form-control">
                        <option value="" selected>- Select -</option>
                        @foreach($userStatuses as $userStatus)
                            @if ( (int)$user->status_id === (int)$userStatus->id)
                            <option value="{{ $userStatus->id }}" selected>{{ $userStatus->description }}</option>
                            @else
                            <option value="{{ $userStatus->id }}">{{ $userStatus->description }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                <label for="federation_guid">Federation <span class="text-danger">*</span></label>
                    <select name="federation_guid" class="form-control {{ $errors->has('status_id') ? 'is-invalid' : '' }}">
                        <option value="" selected>- Select -</option>
                        @foreach($federations as $federation)
                            @if ( $user->federation_id === (int)$federation->id)
                            <option value="{{ $federation->guid }}" selected>{{ $federation->name }}</option>
                            @else
                            <option value="{{ $federation->guid }}">{{ $federation->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <button type="submit" class="btn btn-primary btn-block"
                        onclick="callModal('create-user-form',
                            {
                                title          : 'Create MMIS Point Person',
                                content        : 'Are you sure you want to proceed in the creating this Point Person for this Trade Federation?',
                                confirm_button : 'Save',
                                cancel_button  : 'Cancel',
                                success_msg    : 'MMIS Point Person added successfully! An email has been sent with instructions to set the password..'
                            },
                        );"
                    >Save</button>
                </div>
                <div class="form-group col-md-6">
                    <button type="button" class="btn btn-secondary btn-block" onclick="window.location.reload();">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection