@extends('layouts.user')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 page-header">User Details</h1>
</div>

<!-- Content  -->
<div class="row">
    <div class="col-md-6">
        <div class="card shadow h-100">
            <div class="card-header text-right py-3">
                <a class="btn btn-secondary" href="{{ route('admin.users') }}">Back</a>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fullname">FullName</label>
                            <input name="fullname" type="text" class="form-control-plaintext" value="{{ $user->fullname ?? ''}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email Address</label>
                            <input name="email" type="text" class="form-control-plaintext" value="{{ $user->email ?? ''}}" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        @if ((int)$user->role_id === 3 || (int)$user->role_id === 4)
                        <div class="form-group col-md-6">
                            <label for="federation">Trade/Sectoral Federation</label>
                            <input type="text" class="form-control-plaintext" value="{{ $user->federation->name }}" readonly>
                        </div>
                        @else                        
                        <div class="form-group col-md-6 d-none">
                            <label for="federation">Trade/Sectoral Federation</label>
                            <input type="text" class="form-control-plaintext" value="" readonly>
                        </div>
                        @endif
                        @if ((int)$user->role_id === 4)
                        <div class="form-group col-md-6 local-union-div">
                            <label for="staticUnion">Local Union</label>
                            <input type="text" class="form-control-plaintext" id="staticUnion" value="{{ $user->localUnion->name }}" readonly>
                        </div>
                        @else                        
                        <div class="form-group col-md-6 local-union-div d-none">
                            <label for="staticUnion">Local Union</label>
                            <input type="text" class="form-control-plaintext" id="staticUnion" value="" readonly>
                        </div>
                        @endif
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="staticRole">Role</label>
                            <input type="text" class="form-control-plaintext" id="staticRole" value="{{ $user->userRole->description ?? ''}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="staticStatus">Status</label>
                            <input type="text" class="form-control-plaintext" id="staticStatus" value="{{ $user->userStatus->description ?? ''}}" readonly>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection