<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $isFeatured = $request->query('featured');
        $search = $request->query('search');

        $hotels = Hotel::query()
            ->when($isFeatured, fn($q) => $q->where('is_featured', true))
            ->when($search, function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('user.hotels.index', compact('hotels', 'isFeatured', 'search'));
    }


    public function show(Hotel $hotel)
    {
        return view('user.hotels.show', compact('hotel'));
    }

    public function guestIndex(Request $request)
    {
        $query = Hotel::query();

        // Search functionality
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('location', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        // Filter by featured
        if ($request->has('featured') && $request->featured) {
            $query->where('is_featured', true);
        }

        // Get hotels with pagination
        $hotels = $query->latest()->paginate(12);

        return view('user.hotels.index', compact('hotels'));
    }
}
