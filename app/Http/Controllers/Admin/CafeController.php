<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cafe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CafeController extends Controller
{

    public function index()
    {
        $cafes = Cafe::paginate(10);
        return view('admin.cafes.index', compact('cafes'));
    }


    public function create()
    {
        return view('admin.cafes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'specialty' => 'nullable|string|max:255',
            'price_range' => 'required|string|max:255',
            'contact_info' => 'required|string|max:255',
            'opening_hours' => 'required|string',
            'img_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
        ]);

        // Format opening hours
        $opening_hours = $this->formatOpeningHours($request->opening_hours);
        
        // Handle image upload
        if ($request->hasFile('img_url')) {
            $path = $request->file('img_url')->store('cafes', 'public');
            $validated['img_url'] = '/storage/' . $path;
        }

        // Create cafe with opening hours
        $cafe = Cafe::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            // 'specialty' => $validated['specialty'],
            'price_range' => $validated['price_range'],
            'contact_info' => $validated['contact_info'],
            'opening_hours' => $opening_hours,
            'img_url' => $validated['img_url'] ?? null,
            'is_featured' => $request->has('is_featured'),
        ]);

        return redirect()->route('admin.cafes.index')
            ->with('success', 'Cafe created successfully.');
    }


    public function show(Cafe $cafe)
    {
        // Add formatted opening hours for display
        $cafe->opening_hours_display = $this->formatOpeningHoursForDisplay($cafe->opening_hours);
        
        return view('admin.cafes.show', compact('cafe'));
    }

    public function edit(Cafe $cafe)
    {
        // Format opening hours for the form
        $cafe->opening_hours_formatted = $this->formatOpeningHoursForForm($cafe->opening_hours);
        
        return view('admin.cafes.edit', compact('cafe'));
    }

    public function update(Request $request, Cafe $cafe)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'specialty' => 'nullable|string|max:255',
            'price_range' => 'required|string|max:255',
            'contact_info' => 'required|string|max:255',
            'opening_hours' => 'required|string',
            'img_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
        ]);

        $data = $request->except(['img_url', '_token', '_method']);

        // Format opening hours
        $data['opening_hours'] = $this->formatOpeningHours($request->opening_hours);

        // Handle image upload
        if ($request->hasFile('img_url')) {
            // Delete old image if exists
            if ($cafe->img_url && Storage::exists('public/' . str_replace(asset('storage/'), '', $cafe->img_url))) {
                Storage::delete('public/' . str_replace(asset('storage/'), '', $cafe->img_url));
            }

            $imagePath = $request->file('img_url')->store('cafes', 'public');
            $data['img_url'] = asset('storage/' . $imagePath);
        }

        // Set is_featured value properly
        $data['is_featured'] = $request->boolean('is_featured');

        $cafe->update($data);

        return redirect()->route('admin.cafes.index')
                        ->with('success', 'Cafe updated successfully.');
    }



    public function destroy(Cafe $cafe)
    {
        // Delete image if exists
        if ($cafe->img_url && Storage::exists('public/' . str_replace('/storage/', '', $cafe->img_url))) {
            Storage::delete('public/' . str_replace('/storage/', '', $cafe->img_url));
        }

        $cafe->delete();

        return redirect()->route('admin.cafes.index')
            ->with('success', 'Cafe deleted successfully.');
    }


    private function formatOpeningHours($openingHoursString)
    {
        $result = [];
        $days = explode(',', $openingHoursString);
        
        foreach ($days as $day) {
            $day = trim($day);
            if (empty($day)) continue;
            
            $parts = explode(':', $day, 2);
            if (count($parts) === 2) {
                $dayName = trim($parts[0]);
                $hours = trim($parts[1]);
                $result[$dayName] = $hours;
            }
        }
        
        return $result;
    }


    private function formatOpeningHoursForDisplay($openingHours)
    {
        if (empty($openingHours) || !is_array($openingHours)) {
            return [];
        }
        
        return $openingHours;
    }


    private function formatOpeningHoursForForm($openingHours)
    {
        if (empty($openingHours) || !is_array($openingHours)) {
            return '';
        }
        
        $formatted = [];
        foreach ($openingHours as $day => $hours) {
            $formatted[] = "$day: $hours";
        }
        
        return implode(', ', $formatted);
    }
}