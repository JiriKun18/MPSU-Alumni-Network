<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function upcoming()
    {
        return redirect()->route('events.index', ['status' => 'upcoming']);
    }

    public function index()
    {
        $status = request('status', 'upcoming');
        $search = request('search');

        $query = Event::where('status', $status)->orderBy('event_date', 'asc');

        if ($search) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        $events = $query->paginate(10);

        $recentEvents = Event::where('event_date', '<', now())
            ->orderBy('event_date', 'desc')
            ->take(5)
            ->get();

        $upcomingEvents = Event::where('event_date', '>=', now())
            ->orderBy('event_date', 'asc')
            ->take(5)
            ->get();

        return view('events.index', [
            'events' => $events,
            'status' => $status,
            'search' => $search,
            'recentEvents' => $recentEvents,
            'upcomingEvents' => $upcomingEvents,
        ]);
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        $isRegistered = false;
        $registrationCount = $event->registrationCount();
        $user = Auth::user();

        if ($user instanceof User && $user->isAlumni()) {
            $isRegistered = EventRegistration::where('alumni_id', $user->id)
                ->where('event_id', $id)
                ->whereIn('status', ['registered', 'attended'])
                ->exists();
        }

        return view('events.show', [
            'event' => $event,
            'isRegistered' => $isRegistered,
            'registrationCount' => $registrationCount,
        ]);
    }

    public function register(Request $request, $id)
    {
        $user = Auth::user();
        if (!($user instanceof User) || !$user->isAlumni()) {
            return redirect()->route('login');
        }

        $event = Event::findOrFail($id);

        $existing = EventRegistration::where('alumni_id', $user->id)
            ->where('event_id', $id)
            ->whereIn('status', ['registered', 'attended'])
            ->first();

        if ($existing) {
            return back()->with('error', 'You are already registered for this event');
        }

        if ($event->isFull()) {
            return back()->with('error', 'This event has reached maximum capacity');
        }

        EventRegistration::create([
            'alumni_id' => $user->id,
            'event_id' => $id,
            'status' => 'registered',
        ]);

        return redirect()->route('events.show', $id)
            ->with('success', 'You have been registered for this event');
    }

    public function unregister($id)
    {
        $user = Auth::user();
        if (!($user instanceof User) || !$user->isAlumni()) {
            return redirect()->route('login');
        }

        $registration = EventRegistration::where('alumni_id', $user->id)
            ->where('event_id', $id)
            ->first();

        if ($registration) {
            $registration->update(['status' => 'cancelled']);
        }

        return redirect()->route('events.show', $id)
            ->with('success', 'You have been unregistered from this event');
    }
}
