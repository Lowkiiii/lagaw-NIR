<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AccommodationController extends Controller
{
    /**
     * Display a listing of accommodations.
     */
    public function index()
    {
        $accommodations = Accommodation::latest()->paginate(10);
        return view('admin.accommodations.index', compact('accommodations'));
    }

    /**
     * Show the form for creating a new accommodation.
     */
    public function create()
    {
        return view('admin.accommodations.create');
    }

    /**
     * Store a newly created accommodation in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'img_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|string|max:255',
            'price_range' => 'required|string|max:255',
            'contact_info' => 'required|string|max:255',
            'amenities' => 'nullable|array',
            'is_featured' => 'boolean',
        ]);

        $data = $request->except(['img_url']);
        
        // Handle file upload
        if ($request->hasFile('img_url')) {
            $imagePath = $request->file('img_url')->store('accommodations', 'public');
            $data['img_url'] = asset('storage/' . $imagePath);
        }
        
        // Convert amenities to JSON
        if (!empty($request->input('amenities'))) {
            $data['amenities'] = implode(',', $request->input('amenities'));
        }
        
        // Set is_featured default value if not provided
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;

        Accommodation::create($data);

        return redirect()->route('admin.accommodations.index')
                        ->with('success', 'Accommodation created successfully.');
    }

    /**
     * Display the specified accommodation.
     */
    public function show(Accommodation $accommodation)
    {
        return view('admin.accommodations.show', compact('accommodation'));
    }

    /**
     * Show the form for editing the specified accommodation.
     */
    public function edit(Accommodation $accommodation)
    {
        return view('admin.accommodations.edit', compact('accommodation'));
    }

    /**
     * Update the specified accommodation in storage.
     */
    public function update(Request $request, Accommodation $accommodation)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'img_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|string|max:255',
            'price_range' => 'required|string|max:255',
            'contact_info' => 'required|string|max:255',
            'amenities' => 'nullable|array',
            'is_featured' => 'boolean',
        ]);

        $data = $request->except(['img_url', '_token', '_method']);

        // Handle file upload
        if ($request->hasFile('img_url')) {
            // Delete old image if exists
            if ($accommodation->img_url && Storage::exists('public/' . str_replace(asset('storage/'), '', $accommodation->img_url))) {
                Storage::delete('public/' . str_replace(asset('storage/'), '', $accommodation->img_url));
            }
            
            $imagePath = $request->file('img_url')->store('accommodations', 'public');
            $data['img_url'] = asset('storage/' . $imagePath);
        }

        // Convert amenities to JSON
        if (!empty($request->input('amenities'))) {
            $data['amenities'] = implode(',', $request->input('amenities'));
        }


        // Set is_featured value
        $data['is_featured'] = $request->boolean('is_featured');

        $accommodation->update($data);

        return redirect()->route('admin.accommodations.index')
                        ->with('success', 'Accommodation updated successfully.');
    }

    /**
     * Remove the specified accommodation from storage.
     */
    public function destroy(Accommodation $accommodation)
    {
        // Delete image if exists
        if ($accommodation->img_url && Storage::exists('public/' . str_replace(asset('storage/'), '', $accommodation->img_url))) {
            Storage::delete('public/' . str_replace(asset('storage/'), '', $accommodation->img_url));
        }
        
        $accommodation->delete();

        return redirect()->route('admin.accommodations.index')
                        ->with('success', 'Accommodation deleted successfully.');
    }
}