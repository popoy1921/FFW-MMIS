@extends('layouts.user')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 page-header">{{ $federation->name }}</h1>
</div>

<!-- Content  -->
<div class="row flex-xl-nowrap">
    @include('admin.trade-federation-details.menu')
    
    <!-- <div class="card-header text-right py-3">
        <a class="btn btn-secondary" href="{{ route('admin.trade-federations') }}">Back</a>
    </div> -->
    <div class="card d-xl-block col-lg-10 col-sm-12 shadow px-0 mb-4">
        @yield('card-content')
    </div>
</div>
@endsection

@section('javascript')
    @include('admin.activate-federation-modal')
    @include('admin.deactivate-federation-modal')
@endsection