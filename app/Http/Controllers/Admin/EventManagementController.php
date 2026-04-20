<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventManagementController extends Controller
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

        $query = Event::with('createdBy');

        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        }

        if ($status) {
            $query->where('status', $status);
        }

        $events = $query->orderBy('event_date', 'desc')->paginate(15);

        return view('admin.events.index', [
            'events' => $events,
            'search' => $search,
            'status' => $status,
        ]);
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'venue' => 'required|string',
            'event_date' => 'required|date|after:today',
            'event_time' => 'required|date_format:H:i',
            'max_attendees' => 'nullable|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
        }

        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'venue' => $request->venue,
            'event_date' => $request->event_date,
            'event_time' => $request->event_time,
            'max_attendees' => $request->max_attendees,
            'image' => $imagePath,
            'status' => 'upcoming',
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event created successfully');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);

        return view('admin.events.edit', [
            'event' => $event,
        ]);
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'venue' => 'required|string',
            'event_date' => 'required|date',
            'event_time' => 'required|date_format:H:i',
            'max_attendees' => 'nullable|integer|min:1',
            'status' => 'required|in:upcoming,ongoing,completed,cancelled',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        $event->update($data);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event updated successfully');
    }

    public function delete($id)
    {
        $event = Event::findOrFail($id);

        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event deleted successfully');
    }

    public function registrations($id)
    {
        $event = Event::findOrFail($id);
        $registrations = $event->registrations()->with('alumni')->paginate(15);

        return view('admin.events.registrations', [
            'event' => $event,
            'registrations' => $registrations,
        ]);
    }
}
