<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'location' => 'required|string|max:255',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'latitude' => 'nullable|numeric|between:-90,90',
                'longitude' => 'nullable|numeric|between:-180,180',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($request->hasFile('image')) {
                $validated['img_url'] = $request->file('image')->store('events', 'public');
            }

            Event::create($validated);

            return redirect()->route('admin.events.index')->with('success', 'Event created successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating event: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'An error occurred while creating the event.']);
        }
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'location' => 'required|string|max:255',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'latitude' => 'nullable|numeric|between:-90,90',
                'longitude' => 'nullable|numeric|between:-180,180',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($request->hasFile('image')) {
                if ($event->img_url && Storage::disk('public')->exists($event->img_url)) {
                    Storage::disk('public')->delete($event->img_url);
                }

                $validated['img_url'] = $request->file('image')->store('events', 'public');
            }

            $event->update($validated);

            return redirect()->route('admin.events.index')->with('success', 'Event updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating event: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'An error occurred while updating the event.']);
        }
    }

    public function show(Event $event)
    {
        return view('admin.events.show', compact('event'));
    }

    public function destroy(Event $event)
    {
        try {
            if ($event->img_url && Storage::disk('public')->exists($event->img_url)) {
                Storage::disk('public')->delete($event->img_url);
            }

            $event->delete();

            return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error deleting event: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while deleting the event.');
        }
    }
}
