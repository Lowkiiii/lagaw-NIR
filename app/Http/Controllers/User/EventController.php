<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(10);
        return view('user.events.index', compact('events'));
    }

    public function show(Event $event)
    {
        return view('user.events.show', compact('event'));
    }
}

