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
                                class="form-control {{ $errors->has('mname') === true ? 'is-invalid' : '' }}" placeholder="Middle Name" autofocus />
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
                                class="form-control  {{ $errors->has('lname') === true ? 'is-invalid' : '' }}" placeholder="Last Name" required autofocus />
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
                                class="form-control {{ $errors->has('email') === true ? 'is-invalid' : '' }}" placeholder="Email" required autofocus />
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