@extends('layouts.user')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 page-header">Account Settings</h1>
</div>

<!-- Content  -->
<div class="row">
    <div class="col-md-6">
        <div class="card shadow h-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold card-title">Update Profile</h6>
            </div>
            <div class="card-body">
                @if(session('user-update'))
                    <div class="alert alert-success text-center ">
                        {{ session('user-update') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('user.update') }}">
                    @csrf
                    @method('patch')
                    <input name="guid" type="hidden" value="{{ $guid }}" required autofocus />
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fname">First Name <span class="text-danger">*</span></label>
                            <input name="fname" type="text" value="{{ old('fname', auth()->user()->fname) }}" 
                                class="form-control {{ $errors->has('fname') ? 'is-invalid' : '' }}" placeholder="First Name" required autofocus />
                            @if($errors->has('fname'))
                            <div class="invalid-feedback d-block">
                                @foreach($errors->get('fname') as $error)
                                    {{ $error }}
                                    @if (!$loop->last)
                                        <br />
                                    @endif
                                @endforeach
                            </div>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mname">Middle Name</label>
                            <input name="mname" type="text" value="{{ old('mname', auth()->user()->mname) }}" 
                                class="form-control {{ $errors->has('mname') === true ? 'is-invalid' : '' }}" autofocus />
                            @if($errors->has('mname'))
                            <div class="invalid-feedback d-block">
                                @foreach($errors->get('mname') as $error)
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
                            <label for="lname">Last Name <span class="text-danger">*</label>
                            <input name="lname" type="text" value="{{ old('lname', auth()->user()->lname) }}" 
                                class="form-control  {{ $errors->has('lname') === true ? 'is-invalid' : '' }}" required autofocus />
                            @if($errors->has('lname'))
                            <div class="invalid-feedback d-block">
                                @foreach($errors->get('lname') as $error)
                                    {{ $error }}
                                    @if (!$loop->last)
                                        <br />
                                    @endif
                                @endforeach
                            </div>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email <span class="text-danger">*</label>
                            <input name="email" type="text" value="{{ old('email', auth()->user()->email) }}"
                                class="form-control {{ $errors->has('email') === true ? 'is-invalid' : '' }}" required autofocus />
                            @if($errors->has('email'))
                            <div class="invalid-feedback d-block">
                                @foreach($errors->get('email') as $error)
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
                            <label for="role_description">Role</label>
                            <input name="role_description" value="{{ $role }}" type="text" class="form-control-plaintext" id="staticRole" value="Admin" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                        </div>
                        <div class="form-group col-md-6">
                            <button type="button" class="btn btn-secondary btn-block" onclick="window.location.reload();">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow h-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold card-title">Update Password</h6>
            </div>
            <div class="card-body">
                @if(session('password-reset'))
                    <div class="alert alert-success text-center ">
                        {{ session('password-reset') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('user.update-password') }}">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="current_password">Current Password <span class="text-danger">*</label>
                        <div class="input-group mb-3">
                            <input name="current_password" id="current_password" type="password" class="form-control {{ $errors->has('current_password') === true ? 'is-invalid' : '' }}" placeholder="Current Password" required>
                            <div class="input-group-append">
                                <span class="input-group-text toggle-password-button" onclick="loginTogglePassword('current_password')"><i id="current_password"class="fa fa-eye-slash" aria-hidden="true"></i></span>
                            </div>
                        </div>
                        @if($errors->has('current_password'))
                        <div class="invalid-feedback d-block">
                            {{ $errors->get('current_password')[0] }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password">New Password <span class="text-danger">*</label>
                        <div class="input-group mb-3">
                            <input name="password" id="password" type="password" class="form-control {{ $errors->has('password') === true ? 'is-invalid' : '' }}" placeholder="Password" aria-label="Password" aria-describedby="Password" required>
                            <div class="input-group-append">
                                <span class="input-group-text toggle-password-button" onclick="loginTogglePassword('password')"><i id="password"class="fa fa-eye-slash" aria-hidden="true"></i></span>
                            </div>
                        </div>
                        <small id="passwordHelpBlock" class="form-text text-muted">
                            At least 8 characters, including at least 1 number and both lower and upper case letters.
                        </small>
                        @if($errors->has('password'))
                        <div class="invalid-feedback d-block">
                            {{ $errors->get('password')[0] }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm new Password <span class="text-danger">*</label>
                        <div class="input-group mb-3">
                            <input name="password_confirmation" id="password_confirmation" type="password" class="form-control {{ session('confirmation_error') === true ? 'is-invalid' : '' }}" placeholder="Confirm Password" aria-label="Confirm Password" aria-describedby="Confirm Password" required>
                            <div class="input-group-append">
                                <span class="input-group-text toggle-password-button" onclick="loginTogglePassword('password_confirmation')"><i id="password_confirmation"class="fa fa-eye-slash" aria-hidden="true"></i></span>
                            </div>
                        </div>
                        @if(session('confirmation_error'))
                        <div class="invalid-feedback d-block">
                            {{ session('confirmation_error') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                        </div>
                        <div class="form-group col-md-6">
                            <button type="button" class="btn btn-secondary btn-block" onclick="window.location.reload();">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection