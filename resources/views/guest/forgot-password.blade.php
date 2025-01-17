<x-guest-layout>
    <div class="p-5">
        <div class="text-center mb-3">
            <img src="{{ asset('images/company-logo.png') }}" class="company-logo">
        </div>
        <div class="text-center mb-3">
            <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
            <p class="mb-4">Just enter your email address below
                and we'll send you a link to reset your password!</p>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger text-center" role="alert">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif
        <form class="user public-form" method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                    <input id="email" class="form-control form-control-user" type="email" name="email" placeholder="Email" :value="old('email')" required autofocus />
                </div>
            </div>
            <button class="btn btn-primary btn-user btn-block">
                Get new password
            </button>
        </form>
        
        <hr>
        <div class="text-center">
            <a href="{{ route('login') }}">Already have an account? Login!</a>
        </div>
    </div>
</x-guest-layout>