<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{

    public function index()
    {
        $hotels = Hotel::latest()->paginate(10);
        return view('admin.hotels.index', compact('hotels'));
    }

    public function create()
    {
        return view('admin.hotels.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'img_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stars' => 'nullable|integer|min:1|max:5',
            'price_range' => 'nullable|string|max:255',
            'contact_info' => 'nullable|string|max:255',
            'amenities' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
        ]);

        // Convert comma-separated string to array
        if (!empty($validated['amenities'])) {
            $validated['amenities'] = array_map('trim', explode(',', $validated['amenities']));
        }

        try {
            if ($request->hasFile('img_url')) {
                $path = $request->file('img_url')->store('hotels', 'public');
                $validated['img_url'] = $path;
            }

            Hotel::create($validated);

            return redirect()->route('admin.hotels.index')->with('success', 'Hotel created successfully.');
        } catch (\Exception $e) {
            Log::error('Hotel creation failed: ' . $e->getMessage());
            return back()->withErrors('Failed to create hotel. Please try again.');
        }
    }

    public function show($id)
    {
        $hotel = Hotel::findOrFail($id);
        return view('admin.hotels.show', compact('hotel'));
    }

    public function edit($id)
    {
        $hotel = Hotel::findOrFail($id);
        return view('admin.hotels.edit', compact('hotel'));
    }

    public function update(Request $request, $id)
    {
        $hotel = Hotel::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'img_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stars' => 'nullable|integer|min:1|max:5',
            'price_range' => 'nullable|string|max:255',
            'contact_info' => 'nullable|string|max:255',
            'amenities' => 'nullable|array',
            'is_featured' => 'nullable|boolean',
        ]);

        $data['is_featured'] = $request->boolean('is_featured');

        try {
            if ($request->hasFile('img_url')) {
                // Delete old image if exists
                if ($hotel->img_url && Storage::disk('public')->exists($hotel->img_url)) {
                    Storage::disk('public')->delete($hotel->img_url);
                }
                $path = $request->file('img_url')->store('hotels', 'public');
                $validated['img_url'] = $path;
            }

            $hotel->update($validated);

            return redirect()->route('admin.hotels.index')->with('success', 'Hotel updated successfully.');
        } catch (\Exception $e) {
            Log::error('Hotel update failed: ' . $e->getMessage());
            return back()->withErrors('Failed to update hotel. Please try again.');
        }
    }

    public function destroy(Hotel $hotel)
    {
        try {
            // Delete the image file from storage, if it exists
            if ($hotel->img_url && Storage::disk('public')->exists($hotel->img_url)) {
                Storage::disk('public')->delete($hotel->img_url);
            }

            // Delete the tourist spot from the database
            $hotel->delete();

            return redirect()->route('admin.tourist-spots.index')
                ->with('success', 'Tourist Spot deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error deleting tourist spot: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'An error occurred while deleting the tourist spot.');
        }
    }


}
