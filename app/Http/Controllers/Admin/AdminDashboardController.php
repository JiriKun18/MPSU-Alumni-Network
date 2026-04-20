<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\AlumniProfile;
use App\Models\JobPosting;
use App\Models\Event;
use App\Models\News;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
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
        $totalAlumni = User::where('role', 'alumni')->count();
        $verifiedAlumni = User::where('role', 'alumni')->where('is_verified', true)->count();
        $totalJobs = JobPosting::where('is_active', true)->count();
        $totalEvents = Event::count();
        $totalNews = News::where('is_published', true)->count();

        $recentAlumni = User::where('role', 'alumni')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $upcomingEvents = Event::where('status', 'upcoming')
            ->orderBy('event_date', 'asc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', [
            'totalAlumni' => $totalAlumni,
            'verifiedAlumni' => $verifiedAlumni,
            'totalJobs' => $totalJobs,
            'totalEvents' => $totalEvents,
            'totalNews' => $totalNews,
            'recentAlumni' => $recentAlumni,
            'upcomingEvents' => $upcomingEvents,
        ]);
    }
}
