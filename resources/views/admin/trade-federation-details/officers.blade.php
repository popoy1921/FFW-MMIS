@extends('admin.trade-federation-details.layout')

@section('card-content')
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold card-title">Officers</h6>
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