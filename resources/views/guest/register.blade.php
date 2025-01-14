<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        
        <!-- SHOPWIRED_API_KEY -->
        <div class="mt-4">
            <x-input-label for="api_key" value="API Key" />

            <x-text-input id="api_key" class="block mt-1 w-full"
                            type="password"
                            name="api_key"/>

            <x-input-error :messages="$errors->get('api_key')" class="mt-2" />
        </div>

        <!-- SHOPWIRED_API_SECRET -->
        <div class="mt-4">
            <x-input-label for="api_secret" value="API Secret" />

            <x-text-input id="api_secret" class="block mt-1 w-full"
                            type="password"
                            name="api_secret"/>

            <x-input-error :messages="$errors->get('api_secret')" class="mt-2" />
        </div>

        <!-- SHOPWIRED_WEBHOOK_SECRET -->
        <div class="mt-4">
            <x-input-label for="webhook_secret" value="Webhook Secret" />

            <x-text-input id="webhook_secret" class="block mt-1 w-full"
                            type="password"
                            name="webhook_secret"/>

            <x-input-error :messages="$errors->get('webhook_secret')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
