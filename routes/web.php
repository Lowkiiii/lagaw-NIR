<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\TouristSpotController as UserTouristSpotController;
use App\Http\Controllers\Admin\TouristSpotController as AdminTouristSpotController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\User\EventController as UserEventController;
use App\Http\Controllers\ItineraryController;
use App\Http\Controllers\ItineraryDetailController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\PredefinedItineraryController;
use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\User\HotelController as UserHotelController;

// Guest landing page
Route::get('/', [UserTouristSpotController::class, 'guestIndex'])->name('home');

// In routes/web.php
Route::get('/', [App\Http\Controllers\User\TouristSpotController::class, 'guestIndex'])->name('guest.index');

// Guest restaurant routes
Route::get('/restaurants', [App\Http\Controllers\User\RestaurantController::class, 'guestIndex'])->name('guest.restaurants.index');

// Guest Cafes
Route::get('/cafes', [App\Http\Controllers\User\UserCafeController::class, 'guestIndex'])->name('guest.cafes.index');

// Regular user dashboard
Route::get('/dashboard', function () {
    // If user is admin, redirect to admin dashboard
    if (Auth::check() && Auth::user()->usertype == 0) {
        return redirect('/admin/dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin routes using controller
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Admin tourist spots management
    Route::get('/tourist-spots', [AdminTouristSpotController::class, 'index'])->name('tourist-spots.index');
    Route::get('/tourist-spots/create', [AdminTouristSpotController::class, 'create'])->name('tourist-spots.create');
    Route::post('/tourist-spots', [AdminTouristSpotController::class, 'store'])->name('tourist-spots.store');
    Route::get('/tourist-spots/{touristSpot}', [AdminTouristSpotController::class, 'show'])->name('tourist-spots.show');
    Route::get('/tourist-spots/{touristSpot}/edit', [AdminTouristSpotController::class, 'edit'])->name('tourist-spots.edit');
    Route::put('/tourist-spots/{touristSpot}', [AdminTouristSpotController::class, 'update'])->name('tourist-spots.update');
    Route::delete('/tourist-spots/{touristSpot}', [AdminTouristSpotController::class, 'destroy'])->name('tourist-spots.destroy');

    // Users management
    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');

    // Predefined itineraries
    Route::get('/predefined-itineraries/create/{touristSpot}', [PredefinedItineraryController::class, 'create'])->name('predefined-itineraries.create');
    Route::post('/predefined-itineraries/store', [PredefinedItineraryController::class, 'store'])->name('predefined-itineraries.store');
    Route::get('/tourist-spots/{touristSpot}/predefined-itineraries', [PredefinedItineraryController::class, 'index'])->name('predefined-itineraries.index');
    Route::get('/predefined-itineraries/{predefinedItinerary}/edit', [PredefinedItineraryController::class, 'edit'])->name('predefined-itineraries.edit');
    Route::put('/predefined-itineraries/{predefinedItinerary}', [PredefinedItineraryController::class, 'update'])->name('predefined-itineraries.update');
    Route::get('/predefined-itineraries/{id}', [PredefinedItineraryController::class, 'show'])->name('predefined-itineraries.show');
    Route::delete('/predefined-itineraries/{id}', [PredefinedItineraryController::class, 'destroy'])->name('predefined-itineraries.destroy');

    // Events management
    Route::get('/events', [App\Http\Controllers\Admin\EventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [App\Http\Controllers\Admin\EventController::class, 'create'])->name('events.create');
    Route::post('/events', [App\Http\Controllers\Admin\EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}', [App\Http\Controllers\Admin\EventController::class, 'show'])->name('events.show');
    Route::get('/events/{event}/edit', [App\Http\Controllers\Admin\EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [App\Http\Controllers\Admin\EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [App\Http\Controllers\Admin\EventController::class, 'destroy'])->name('events.destroy');

    // Hotels
    Route::get('hotels/create', [HotelController::class, 'create'])->name('hotels.create');
    Route::post('hotels', [HotelController::class, 'store'])->name('hotels.store');
    Route::get('/hotels/{hotel}', [HotelController::class, 'show'])->name('hotels.show');
    Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
    Route::get('/hotels/{hotel}/edit', [HotelController::class, 'edit'])->name('hotels.edit');
    Route::put('/hotels/{hotel}', [HotelController::class, 'update'])->name('hotels.update');
    Route::delete('/hotels/{hotel}', [HotelController::class, 'destroy'])->name('hotels.destroy');

    // Restaurants management
    Route::get('/restaurants', [App\Http\Controllers\Admin\RestaurantController::class, 'index'])->name('restaurants.index');
    Route::get('/restaurants/create', [App\Http\Controllers\Admin\RestaurantController::class, 'create'])->name('restaurants.create');
    Route::post('/restaurants', [App\Http\Controllers\Admin\RestaurantController::class, 'store'])->name('restaurants.store');
    Route::get('/restaurants/{restaurant}', [App\Http\Controllers\Admin\RestaurantController::class, 'show'])->name('restaurants.show');
    Route::get('/restaurants/{restaurant}/edit', [App\Http\Controllers\Admin\RestaurantController::class, 'edit'])->name('restaurants.edit');
    Route::put('/restaurants/{restaurant}', [App\Http\Controllers\Admin\RestaurantController::class, 'update'])->name('restaurants.update');
    Route::delete('/restaurants/{restaurant}', [App\Http\Controllers\Admin\RestaurantController::class, 'destroy'])->name('restaurants.destroy');

    // Accommodations management
    Route::get('/accommodations', [App\Http\Controllers\Admin\AccommodationController::class, 'index'])->name('accommodations.index');
    Route::get('/accommodations/create', [App\Http\Controllers\Admin\AccommodationController::class, 'create'])->name('accommodations.create');
    Route::post('/accommodations', [App\Http\Controllers\Admin\AccommodationController::class, 'store'])->name('accommodations.store');
    Route::get('/accommodations/{accommodation}', [App\Http\Controllers\Admin\AccommodationController::class, 'show'])->name('accommodations.show');
    Route::get('/accommodations/{accommodation}/edit', [App\Http\Controllers\Admin\AccommodationController::class, 'edit'])->name('accommodations.edit');
    Route::put('/accommodations/{accommodation}', [App\Http\Controllers\Admin\AccommodationController::class, 'update'])->name('accommodations.update');
    Route::delete('/accommodations/{accommodation}', [App\Http\Controllers\Admin\AccommodationController::class, 'destroy'])->name('accommodations.destroy');

    // Cafes management
    Route::get('/cafes', [App\Http\Controllers\Admin\CafeController::class, 'index'])->name('cafes.index');
    Route::get('/cafes/create', [App\Http\Controllers\Admin\CafeController::class, 'create'])->name('cafes.create');
    Route::post('/cafes', [App\Http\Controllers\Admin\CafeController::class, 'store'])->name('cafes.store');
    Route::get('/cafes/{cafe}', [App\Http\Controllers\Admin\CafeController::class, 'show'])->name('cafes.show');
    Route::get('/cafes/{cafe}/edit', [App\Http\Controllers\Admin\CafeController::class, 'edit'])->name('cafes.edit');
    Route::put('/cafes/{cafe}', [App\Http\Controllers\Admin\CafeController::class, 'update'])->name('cafes.update');
    Route::delete('/cafes/{cafe}', [App\Http\Controllers\Admin\CafeController::class, 'destroy'])->name('cafes.destroy');
});

// Common authenticated routes for both user types
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User tourist spots
    Route::get('/tourist-spots', [UserTouristSpotController::class, 'index'])->name('user.tourist-spots.index');
    Route::get('/tourist-spots/{touristSpot}', [UserTouristSpotController::class, 'show'])->name('user.tourist-spots.show');

    // User events
    Route::prefix('events')->name('user.events.')->group(function () {
        Route::get('/', [UserEventController::class, 'index'])->name('index');
        Route::get('/{event}', [UserEventController::class, 'show'])->name('show');
    });

    // User hotels
    Route::get('/hotels', [UserHotelController::class, 'index'])->name('user.hotels.index');
    Route::get('/hotels/{hotel}', [UserHotelController::class, 'show'])->name('user.hotels.show');

    // User restaurants
    Route::prefix('restaurants')->name('user.restaurants.')->group(function () {
        Route::get('/', [App\Http\Controllers\User\RestaurantController::class, 'index'])->name('index');
        Route::get('/{restaurant}', [App\Http\Controllers\User\RestaurantController::class, 'show'])->name('show');
    });

    //user accommodation
    Route::prefix('accommodations')->name('user.accommodations.')->group(function () {
        Route::get('/', [App\Http\Controllers\User\UserAccommodationController::class, 'index'])->name('index');
        Route::get('/{accommodation}', [App\Http\Controllers\User\UserAccommodationController::class, 'show'])->name('show');
    });

    // User cafes
    Route::prefix('cafes')->name('user.cafes.')->group(function () {
        Route::get('/', [App\Http\Controllers\User\UserCafeController::class, 'index'])->name('index');
        Route::get('/{cafe}', [App\Http\Controllers\User\UserCafeController::class, 'show'])->name('show');
    });

    // Itineraries
    Route::get('/itineraries', [ItineraryController::class, 'index'])->name('itineraries.index');
    Route::get('/itineraries/create/{spot}', [ItineraryController::class, 'create'])->name('itineraries.create');
    Route::post('/itineraries', [ItineraryController::class, 'store'])->name('itineraries.store');
    Route::get('/itineraries/{id}', [ItineraryController::class, 'show'])->name('itineraries.show');
    Route::get('/itineraries/{id}/edit', [ItineraryController::class, 'edit'])->name('itineraries.edit');
    Route::put('/itineraries/{id}', [ItineraryController::class, 'update'])->name('itineraries.update');
    Route::delete('/itineraries/{id}', [ItineraryController::class, 'destroy'])->name('itineraries.destroy');
    Route::post('/itineraries/save-from-predefined/{predefined}', [ItineraryController::class, 'saveFromPredefined'])->name('itineraries.saveFromPredefined');
    
    // Itinerary details
    Route::post('/itineraries/{id}/details', [ItineraryDetailController::class, 'store'])->name('itinerary-details.store');
    Route::get('/itineraries/{id}/details/create', [ItineraryDetailController::class, 'create'])->name('itinerary.details.create');

    // Reviews Touist Spot
    Route::get('/tourist-spots/{id}/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::post('/tourist-spots/{id}/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    // Hotel Reviews
    Route::get('/hotels/{id}/reviews', [ReviewController::class, 'hotelReviews'])->name('hotel.reviews.index');
    Route::post('/hotels/{id}/reviews', [ReviewController::class, 'storeHotelReview'])->name('hotel.reviews.store');

    // Restaurant Reviews
    Route::get('/restaurants/{id}/reviews', [ReviewController::class, 'restaurantReviews'])->name('restaurant.reviews.index');
    Route::post('/restaurants/{id}/reviews', [ReviewController::class, 'storeRestaurantReview'])->name('restaurant.reviews.store');
    
     // Accommodation Reviews Routes
    Route::get('accommodation/{id}/reviews', [ReviewController::class, 'accommodationReviews'])->name('accommodation.reviews.index');
    Route::post('accommodation/{id}/reviews', [ReviewController::class, 'storeAccommodationReview'])->name('accommodation.reviews.store');

    // Cafe Reviews Routes
    Route::get('/cafes/{id}/reviews', [ReviewController::class, 'cafeReviews'])->name('cafe.reviews.index');
    Route::post('/cafes/{id}/reviews', [ReviewController::class, 'storeCafeReview'])->name('cafe.reviews.store');
});

// Guest accessible routes
Route::get('/explore', [UserTouristSpotController::class, 'guestIndex'])->name('guest.tourist-spots.index');

// Google OAuth Routes
Route::controller(App\Http\Controllers\Auth\GoogleController::class)->group(function(){
    Route::get('social/google', 'redirect')->name('auth.google');
    Route::get('social/google/callback', 'googleCallback');
});

require __DIR__.'/auth.php';