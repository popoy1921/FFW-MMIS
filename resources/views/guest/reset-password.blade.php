<x-guest-layout>
<div class="row">
    <div class="col-lg-12">
        <div class="p-5">
            <div class="text-center mb-3">
                <img src="{{ asset('images/company-logo.png') }}" class="company-logo">
            </div>
            <div class="text-center mb-3">
                <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                <p class="mb-4">To continue resetting your password, fill out the fields below</p>
            </div>
            <form class="user public-form" method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                @if ($errors->any())
                    <div class="alert alert-danger text-center" role="alert">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li> 
                        @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Email Address -->
                <div style="display:none">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                </div>

                <!-- Password -->
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="password">Password</label>
                    <div class="col-sm-9">
                        <x-text-input id="password" class="form-control form-control-user" type="password" name="password" required autocomplete="new-password" />
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="form-group row">
                    <label for="password_confirmation" class="col-sm-3 col-form-label">Confirm Password</label>
                    <div class="col-sm-9">
                        <x-text-input id="password_confirmation" class="form-control form-control-user"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
                    </div>
                </div>
                <button class="btn btn-primary btn-user btn-block">
                    Submit
                </button>
            </form>
            <hr>
            <div class="text-center">
                <a href="login.php">Already have an account? Login!</a>
            </div>
        </div>
    </div>
</div>
</x-guest-layout>
