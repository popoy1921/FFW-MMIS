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
                <form>
                    <input name="guid" type="hidden" value="{{ $guid }}" required autofocus />
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fname">First Name*</label>
                            <input name="fname" type="text" value="{{ old('fname', auth()->user()->fname) }}" 
                                class="form-control" placeholder="First Name" required autofocus />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mname">Middle Name</label>
                            <input name="mname" type="text" value="{{ old('mname', auth()->user()->mname) }}" 
                                class="form-control" autofocus />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="lname">Last Name</label>
                            <input name="lname" type="text" value="{{ old('lname', auth()->user()->lname) }}" 
                                class="form-control" required autofocus />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input name="email" type="email" value="{{ old('email', auth()->user()->email) }}"
                                class="form-control" required autofocus />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="role_description">Role</label>
                            <input name="role_description" value="{{ $role }}" type="text" class="form-control-plaintext" id="staticRole" value="Admin" readonly>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
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
                <form>
                    <div class="form-group">
                        <label for="inputCurrentPassword">Current Password*</label>
                        <input type="password" class="form-control" id="inputCurrentPassword" placeholder="Current Password">
                    </div>
                    <div class="form-group">
                        <label for="inputNewPassword">New Password*</label>
                        <input type="password" class="form-control" id="inputNewPassword" placeholder="New Password" aria-describedby="passwordHelpBlock">
                        <small id="passwordHelpBlock" class="form-text text-muted">
                            At least 8 characters, including at least 1 number and both lower and upper case letters.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="inputConfirmPassword">Confirm new Password*</label>
                        <input type="password" class="form-control" id="inputConfirmPassword" placeholder="Confirm new Password">
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection