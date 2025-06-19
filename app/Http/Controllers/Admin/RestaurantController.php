<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.restaurants.index', compact('restaurants'));
    }

    public function create()
    {
        return view('admin.restaurants.create');
    }

    public function edit($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        
        // Convert opening_hours JSON to string for the form
        if ($restaurant->opening_hours) {
            $openingHoursArray = json_decode($restaurant->opening_hours, true);
            $formattedHours = [];
            
            if (is_array($openingHoursArray)) {
                foreach ($openingHoursArray as $day => $hours) {
                    $formattedHours[] = "$day: $hours";
                }
                $restaurant->opening_hours_formatted = implode(', ', $formattedHours);
            } else {
                $restaurant->opening_hours_formatted = '';
            }
        } else {
            $restaurant->opening_hours_formatted = '';
        }
        
        return view('admin.restaurants.edit', compact('restaurant'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'img_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cuisine_type' => 'nullable|string|max:255',
            'price_range' => 'nullable|string|max:255',
            'contact_info' => 'nullable|string|max:255',
            'opening_hours' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('img_url')) {
            $imagePath = $request->file('img_url')->store('restaurants', 'public');
            $data['img_url'] = '/storage/' . $imagePath;
        }

        // Handle opening hours - convert from string to JSON
        if ($request->has('opening_hours') && !empty($request->opening_hours)) {
            $openingHoursArray = $this->parseOpeningHours($request->opening_hours);
            $data['opening_hours'] = json_encode($openingHoursArray);
        } else {
            $data['opening_hours'] = null;
        }

        // Set is_featured default if not provided
        $data['is_featured'] = $request->boolean('is_featured');

        Restaurant::create($data);

        return redirect()->route('admin.restaurants.index')
            ->with('success', 'Restaurant created successfully.');
    }

    public function show($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        
        // Format opening hours for display
        if ($restaurant->opening_hours) {
            $openingHoursArray = json_decode($restaurant->opening_hours, true);
            $restaurant->opening_hours_display = is_array($openingHoursArray) ? $openingHoursArray : [];
        } else {
            $restaurant->opening_hours_display = [];
        }

        return view('admin.restaurants.show', compact('restaurant'));
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'img_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cuisine_type' => 'nullable|string|max:255',
            'price_range' => 'nullable|string|max:255',
            'contact_info' => 'nullable|string|max:255',
            'opening_hours' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('img_url')) {
            // Delete old image if exists and is not a default image
            if ($restaurant->img_url && !str_contains($restaurant->img_url, 'default')) {
                $oldImagePath = str_replace('/storage/', '', $restaurant->img_url);
                Storage::disk('public')->delete($oldImagePath);
            }
            
            $imagePath = $request->file('img_url')->store('restaurants', 'public');
            $data['img_url'] = '/storage/' . $imagePath;
        }

        // Handle opening hours - convert from string to JSON
        if ($request->has('opening_hours') && !empty($request->opening_hours)) {
            $openingHoursArray = $this->parseOpeningHours($request->opening_hours);
            $data['opening_hours'] = json_encode($openingHoursArray);
        } else {
            $data['opening_hours'] = null;
        }

        // Set is_featured
        $data['is_featured'] = $request->boolean('is_featured');

        $restaurant->update($data);

        return redirect()->route('admin.restaurants.index')
            ->with('success', 'Restaurant updated successfully.');
    }

    public function destroy(Restaurant $restaurant)
    {
        // Delete associated image if it exists and is not a default image
        if ($restaurant->img_url && !str_contains($restaurant->img_url, 'default')) {
            $imagePath = str_replace('/storage/', '', $restaurant->img_url);
            Storage::disk('public')->delete($imagePath);
        }

        $restaurant->delete();

        return redirect()->route('admin.restaurants.index')
            ->with('success', 'Restaurant deleted successfully.');
    }

    /**
     * Parse opening hours string to array
     * Format expected: "Monday: 9AM-5PM, Tuesday: 9AM-5PM, ..."
     */
    private function parseOpeningHours($openingHoursString)
    {
        $result = [];
        $items = explode(',', $openingHoursString);
        
        foreach ($items as $item) {
            $item = trim($item);
            if (strpos($item, ':') !== false) {
                list($day, $hours) = explode(':', $item, 2);
                $day = trim($day);
                $hours = trim($hours);
                
                if (!empty($day) && !empty($hours)) {
                    $result[$day] = $hours;
                }
            }
        }
        
        return $result;
    }
}