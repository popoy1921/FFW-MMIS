@extends('layouts.user')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 page-header">Account Settings</h1>
</div>

<!-- Content  -->
<div class="row">
    @include('user.partials.update-profile-form')
    @include('user.partials.update-password-form')
</div>
@endsection