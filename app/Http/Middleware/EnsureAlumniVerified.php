<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureAlumniVerified
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->role === 'alumni' && !$user->is_verified) {
            return redirect()
                ->route('alumni.profile')
                ->with('error', 'Your account is pending verification. Please upload verification documents to continue.');
        }

        return $next($request);
    }
}
