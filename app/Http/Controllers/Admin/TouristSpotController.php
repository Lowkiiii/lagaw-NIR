<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TouristSpot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TouristSpotController extends Controller
{
    /**
     * Display a listing of the tourist spots.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $touristSpots = TouristSpot::latest()->paginate(10);
        return view('admin.tourist-spots.index', compact('touristSpots'));
    }

    public function guestIndex()
    {
        $featuredTouristSpots = TouristSpot::where('is_featured', true)->latest()->paginate(10);
        return view('user.tourist-spots.guest', compact('featuredTouristSpots'));
    }

    
    /**
     * Show the form for creating a new tourist spot.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.tourist-spots.create');
    }
    
    /**
     * Store a newly created tourist spot in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            // Validate the incoming request
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'location' => 'required|string|max:255',
                'latitude' => 'nullable|numeric|between:-90,90',
                'longitude' => 'nullable|numeric|between:-180,180',
                'openinghours' => 'nullable|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'is_featured' => 'nullable|boolean',
            ]);
            
            // Handle image upload if provided
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('tourist-spots', 'public');
                $validated['img_url'] = $imagePath;

            }
            
            // Create the tourist spot
            TouristSpot::create($validated);
            
            return redirect()->route('admin.tourist-spots.index')
                ->with('success', 'Tourist Spot created successfully!');
                
        } catch (\Exception $e) {
            Log::error('Error creating tourist spot: ' . $e->getMessage());
            return redirect()->back()->withInput()
                ->withErrors(['error' => 'An error occurred while creating the tourist spot.']);
        }
    }

    public function edit(TouristSpot $touristSpot)
    {
        return view('admin.tourist-spots.edit', compact('touristSpot'));
    }

    public function update(Request $request, TouristSpot $touristSpot)
    {
            // Normalize checkbox input
            $request->merge([
                'is_featured' => $request->has('is_featured')
            ]);

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'location' => 'required|string|max:255',
                'latitude' => 'nullable|numeric|between:-90,90',
                'longitude' => 'nullable|numeric|between:-180,180',
                'openinghours' => 'nullable|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'is_featured' => 'required|boolean',
            ]);

            if ($request->hasFile('image')) {
                if ($touristSpot->img_url) {
                    Storage::disk('public')->delete($touristSpot->img_url);
                }
                $validated['img_url'] = $request->file('image')->store('tourist-spots', 'public');
            }

            $validated['is_featured'] = $request->has('is_featured');

            $touristSpot->update($validated);

            return redirect()->route('admin.tourist-spots.index')
                ->with('success', 'Tourist Spot updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating tourist spot: ' . $e->getMessage());
            return redirect()->back()->withInput()
                ->withErrors(['error' => 'An error occurred while updating the tourist spot.']);
        }
    }

    public function show(TouristSpot $touristSpot)
    {
        return view('admin.tourist-spots.show', compact('touristSpot'));
    }

    public function destroy(TouristSpot $touristSpot)
    {
        try {
            // Delete the image file from storage, if it exists
            if ($touristSpot->img_url && Storage::disk('public')->exists($touristSpot->img_url)) {
                Storage::disk('public')->delete($touristSpot->img_url);
            }

            // Delete the tourist spot from the database
            $touristSpot->delete();

            return redirect()->route('admin.tourist-spots.index')
                ->with('success', 'Tourist Spot deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error deleting tourist spot: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'An error occurred while deleting the tourist spot.');
        }
    }

}