<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\Accommodation;
use App\Models\Cafe;
use App\Models\TouristSpot;
use App\Models\Event;

class DashboardController extends Controller
{
    public function index()
    {
        $hotels = Hotel::latest()->take(8)->get();
        $restaurants = Restaurant::latest()->take(8)->get();
        $accommodations = Accommodation::latest()->take(8)->get();
        $cafes = Cafe::latest()->take(8)->get();
        $touristSpots = TouristSpot::latest()->take(8)->get();
        $events = Event::latest()->take(8)->get();

        return view('dashboard', compact(
            'hotels', 'restaurants', 'accommodations', 'cafes', 'touristSpots', 'events'
        ));
    }
}
