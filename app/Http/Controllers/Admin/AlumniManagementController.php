<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlumniManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role !== 'admin') {
                return redirect('/')->with('error', 'Unauthorized access');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $search = request('search');
        $status = request('status');

        $query = User::where('role', 'alumni');

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        if ($status === 'verified') {
            $query->where('is_verified', true);
        } elseif ($status === 'unverified') {
            $query->where('is_verified', false);
        } elseif ($status === 'inactive') {
            $query->where('is_active', false);
        }

        $alumni = $query->with('alumniProfile')->paginate(15);

        return view('admin.alumni.index', [
            'alumni' => $alumni,
            'search' => $search,
            'status' => $status,
        ]);
    }

    public function show($id)
    {
        $user = User::where('role', 'alumni')->findOrFail($id);

        return view('admin.alumni.show', [
            'user' => $user,
            'profile' => $user->alumniProfile,
        ]);
    }

    public function verify($id)
    {
        $user = User::where('role', 'alumni')->findOrFail($id);
        $user->update(['is_verified' => true]);

        return redirect()->route('admin.alumni.index')
            ->with('success', 'Alumni verified successfully');
    }

    public function deactivate($id)
    {
        $user = User::where('role', 'alumni')->findOrFail($id);
        $user->update(['is_active' => false]);

        return redirect()->route('admin.alumni.index')
            ->with('success', 'Alumni deactivated successfully');
    }

    public function activate($id)
    {
        $user = User::where('role', 'alumni')->findOrFail($id);
        $user->update(['is_active' => true]);

        return redirect()->route('admin.alumni.index')
            ->with('success', 'Alumni activated successfully');
    }

    public function delete($id)
    {
        $user = User::where('role', 'alumni')->findOrFail($id);
        $user->delete();

        return redirect()->route('admin.alumni.index')
            ->with('success', 'Alumni account deleted successfully');
    }
}
