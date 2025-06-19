<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\TouristSpot;
use App\Models\PredefinedItinerary;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Accommodation;
use App\Models\Restaurant;
use App\Models\Cafe;

class TouristSpotController extends Controller
{
    public function index(Request $request)
    {
        
        $isFeatured = $request->query('featured');
        $search = $request->query('search');

        $touristSpots = TouristSpot::query()
            ->when($isFeatured, fn($q) => $q->where('is_featured', true))
            ->when($search, function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10);

        return view('user.tourist-spots.index', compact('touristSpots', 'isFeatured', 'search'));
    }

    public function show(TouristSpot $touristSpot)
    {
        $predefinedItineraries = PredefinedItinerary::where('tourist_spot_id', $touristSpot->id)->get();

        return view('user.tourist-spots.show', compact('touristSpot', 'predefinedItineraries'));
    }

    public function guestIndex(Request $request)
    {
        $search = $request->query('search');
        $firstResultType = null;

        $hotels = Hotel::latest()->take(15)->get();

        $restaurants = \App\Models\Restaurant::latest()->take(15)->get();

        $accommodations  = \App\Models\Accommodation::latest()->take(15)->get();

        // Search for tourist spots
        $touristSpots = TouristSpot::query()
            ->when($search, function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(15);

        // Search for hotels
        $hotels = Hotel::query()
            ->when($search, function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->take(15)
            ->get();

        // Search for restaurants
        $restaurants = Restaurant::query()
            ->when($search, function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('cuisine_type', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->take(15)
            ->get();

        // Search for accommodations
        $accommodations = Accommodation::query()
            ->when($search, function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
                    // ->orWhere('accommodation_type', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->take(15)
            ->get();

        // Determine which section has results first (for scrolling)
        if ($search) {
            if ($touristSpots->count() > 0) {
                $firstResultType = 'tourist-spots-section';
            } elseif ($hotels->count() > 0) {
                $firstResultType = 'hotels-section';
            } elseif ($restaurants->count() > 0) {
                $firstResultType = 'restaurants-section';
            }
        }

        // Inside the guestIndex method, add this code alongside your other queries:
        $cafes = Cafe::query()
            ->when($search, function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('specialty', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->take(15)
            ->get();

        // Update your firstResultType logic to include cafes:
        if ($search) {
            if ($touristSpots->count() > 0) {
                $firstResultType = 'tourist-spots-section';
            } elseif ($hotels->count() > 0) {
                $firstResultType = 'hotels-section';
            } elseif ($restaurants->count() > 0) {
                $firstResultType = 'restaurants-section';
            } elseif ($cafes->count() > 0) {
                $firstResultType = 'cafes-section';
            }
        }

        return view('user.tourist-spots.guest', compact('touristSpots', 'search', 'hotels', 'restaurants', 'accommodations', 'cafes'));
    }
}
