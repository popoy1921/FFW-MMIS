<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('guest.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', Password::min(8)->mixedCase()->numbers()->symbols(), 'confirmed'],
        ]);

        $user = User::create([
            'email'                 => $request->email,
            'password'              => Hash::make($request->password),
            'fname'                 => $request->name,
            'mname'                 => '1',
            'lname'                 => '1',
            'photo'                 => '1',
            'status_id'             => '1',
            'role_id'               => $request->role_id,
            'trade_federation_id'   => '1',
            'local_union_id'        => '1',
        ]);

        event(new Registered($user));

        Auth::login($user);

        if ((int)auth()->user()->role_id === 1) {
            return redirect()->route('super-admin.users');
        }
        if ((int)auth()->user()->role_id === 2) {
            return redirect()->route('admin.local-unions');
        }
        if ((int)auth()->user()->role_id === 3) {
            return redirect()->route('federation-point-person.profile');
        }
        if ((int)auth()->user()->role_id === 4) {
            return redirect()->route('union-point-person.profile');
        }
    }
}
