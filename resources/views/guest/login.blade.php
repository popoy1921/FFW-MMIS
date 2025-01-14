<x-guest-layout>
    <div class="p-5">
        <div class="text-center mb-3">
            <img src="{{ asset('images/company-logo.png') }}" class="company-logo">
        </div>
        @if(session('success'))
            <div class="alert alert-success text-center ">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger text-center" role="alert">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif
        <form class="user public-form" method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                    <input id="email" class="form-control form-control-user" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-9">
                    <input id="password" class="form-control form-control-user" type="password" name="password" required autocomplete="current-password" />
                </div>
            </div>
            <button class="btn btn-primary btn-user btn-block">
                Login
            </button>
        </form>
        <hr>
        <div class="text-center">
            <a href="{{ route('password.request') }}">Forgot Password?</a>
        </div>
    </div>
</x-guest-layout>
