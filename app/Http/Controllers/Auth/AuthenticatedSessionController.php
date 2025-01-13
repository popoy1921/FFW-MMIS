<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('guest.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        if (auth()->user()->status_id === 0) {
            $request->session()->flush();
            throw ValidationException::withMessages([
                'email' => 'Your account is currently inactive. Please contact Admin for assistance in reactivating your account.',
            ]);
        }

        if (auth()->user()->role_id === 1) {
            return redirect()->route('super-admin.users');
        }
        if (auth()->user()->role_id === 2) {
            return redirect()->route('admin.local-unions');
        }
        if (auth()->user()->role_id === 3) {
            return redirect()->route('federation-point-person.profile');
        }
        if (auth()->user()->role_id === 4) {
            return redirect()->route('union-point-person.profile');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
