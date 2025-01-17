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
                            At least 8 characters, including at least 1 number, both lower and upper case letters, and special characters.
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