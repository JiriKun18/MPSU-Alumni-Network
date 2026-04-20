<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminLoginController extends Controller
{
    /**
     * Show admin login form
     */
    public function showAdminLogin(): View
    {
        return view('auth.admin-login');
    }

    /**
     * Handle admin login
     */
    public function handleAdminLogin(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Check if user exists and is an admin
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // Check if user is admin
            if ($user->role !== 'admin') {
                Auth::logout();
                return back()->with('error', 'Invalid admin credentials. This account is not an administrator.');
            }

            $request->session()->regenerate();

            // Fire auth event with guard name to satisfy signature requirements
            $guard = Auth::getDefaultDriver();
            event(new Authenticated($guard, $user));
            
            return redirect()->route('admin.dashboard')->with('success', 'Welcome back, Administrator!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our admin records.',
        ])->onlyInput('email');
    }
}
