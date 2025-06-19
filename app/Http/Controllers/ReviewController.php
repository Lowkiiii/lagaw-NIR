<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\TouristSpot;
use App\Models\Accommodation;
use App\Models\Cafe;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index($id)
    {
        $spot = TouristSpot::findOrFail($id);
        $reviews = Review::where('entity_type', 'TouristSpot')
                         ->where('entity_id', $id,)
                         ->with('user')
                         ->latest()
                         ->get();

        return view('user.reviews.index', compact('spot', 'reviews'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'entity_type' => 'TouristSpot',
            'entity_id' => $id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'review_date' => now(),
        ]);

        return redirect()->back()->with('success', 'Review submitted successfully.');
    }

    // New methods for hotel reviews
    public function hotelReviews($id)
    {
        $hotel = Hotel::findOrFail($id);
        $reviews = Review::where('entity_type', 'Hotel')
                         ->where('entity_id', $id)
                         ->with('user')
                         ->latest()
                         ->get();

        return view('user.reviews.hotel-reviews', compact('hotel', 'reviews'));
    }

    public function storeHotelReview(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'entity_type' => 'Hotel',
            'entity_id' => $id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'review_date' => now(),
        ]);

        return redirect()->back()->with('success', 'Hotel review submitted successfully.');
    }

    // Methods for restaurant reviews
    public function restaurantReviews($id)
    {
        $restaurant = Restaurant::findOrFail($id);

        $restaurant->makeVisible(['img_url']);

        $reviews = Review::where('entity_type', 'Restaurant')
                         ->where('entity_id', $id)
                         ->with('user')
                         ->latest()
                         ->get();

        return view('user.reviews.restaurant-reviews', compact('restaurant', 'reviews'));
    }

    public function storeRestaurantReview(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'entity_type' => 'Restaurant',
            'entity_id' => $id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'review_date' => now(),
        ]);

        return redirect()->back()->with('success', 'Restaurant review submitted successfully.');
    }

        // Methods for accommodation reviews
    public function accommodationReviews($id)
    {
        $accommodation = Accommodation::findOrFail($id);
        
        // Handle amenities JSON to array conversion
        if ($accommodation->amenities) {
            $accommodation->amenities = json_decode($accommodation->amenities, true);
        }
        
        $reviews = Review::where('entity_type', 'Accommodation')
                         ->where('entity_id', $id)
                         ->with('user')
                         ->latest()
                         ->get();

        return view('user.reviews.accommodation-reviews', compact('accommodation', 'reviews'));
    }

    public function storeAccommodationReview(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'entity_type' => 'Accommodation',
            'entity_id' => $id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'review_date' => now(),
        ]);

        return redirect()->back()->with('success', 'Accommodation review submitted successfully.');
    }

    // Methods for cafe reviews
    public function cafeReviews($id)
    {
        $cafe = Cafe::findOrFail($id);
        $reviews = Review::where('entity_type', 'Cafe')
                        ->where('entity_id', $id)
                        ->with('user')
                        ->latest()
                        ->get();

        return view('user.reviews.cafe-reviews', compact('cafe', 'reviews'));
    }

    public function storeCafeReview(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'entity_type' => 'Cafe',
            'entity_id' => $id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'review_date' => now(),
        ]);

        return redirect()->back()->with('success', 'Cafe review submitted successfully.');
    }

}
