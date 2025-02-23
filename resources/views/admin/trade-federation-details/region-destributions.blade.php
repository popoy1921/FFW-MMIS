@extends('admin.trade-federation-details.layout')

@section('card-content')
<div class="card-header py-3 d-flex justify-content-between">
    <h6 class="d-inline my-auto m-0 font-weight-bold card-title">Region Distribution</h6>
    <div class="d-inline text-right">
        <a class="btn btn-secondary" href="{{ route('admin.trade-federations') }}">Back</a>
    </div>
</div>
<div class="card-body">
    @if(session('federation-update'))
        <div class="alert alert-success text-center">
            {{ session('federation-update') }}
        </div>
    @endif
    <form method="POST" action="{{ route('admin.trade-federation-update') }}">
    </form>
</div>
@endsection