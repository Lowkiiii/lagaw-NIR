<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of restaurants for users.
     */
    public function index(Request $request)
    {
        $isFeatured = $request->query('featured');
        $search = $request->query('search');
        $cuisine = $request->query('cuisine');
        $price = $request->query('price');

        $restaurants = Restaurant::query()
            ->when($isFeatured, fn($q) => $q->where('is_featured', true))
            ->when($search, function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
                });
            })
            ->when($cuisine, fn($q) => $q->where('cuisine_type', $cuisine))
            ->when($price, fn($q) => $q->where('price_range', $price))
            ->orderBy('name')
            ->paginate(9)
            ->withQueryString();

        return view('user.restaurants.index', compact('restaurants', 'isFeatured', 'search', 'cuisine', 'price'));
    }


    /**
     * For guest users to view restaurants without authentication
     */
    public function guestIndex()
    {
        $featuredRestaurants = Restaurant::where('is_featured', true)->take(6)->get();
        $restaurants = Restaurant::orderBy('created_at', 'desc')->paginate(9);
        return view('user.restaurants.guest-index', compact('restaurants', 'featuredRestaurants'));
    }

    /**
     * Display the specified restaurant.
     */
    public function show($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return view('user.restaurants.show', compact('restaurant'));
    }
}