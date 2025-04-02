@extends('layouts.user')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 id="trade-federation-name" class="h3 mb-0 page-header">{{ $federation->name }}</h1>
</div>

<!-- Content  -->
<div class="row flex-xl-nowrap">
    @include('admin.trade-federation-details.menu')
    
    <div class="card d-xl-block col-lg-10 col-sm-12 shadow px-0 mb-4">
        @yield('card-content')
    </div>
</div>
@endsection