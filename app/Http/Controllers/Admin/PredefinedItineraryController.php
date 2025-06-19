<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PredefinedItinerary;
use App\Models\TouristSpot;
use Illuminate\Http\Request;

class PredefinedItineraryController extends Controller
{
    public function create(TouristSpot $touristSpot)
    {
        return view('admin.predefined-itineraries.create', compact('touristSpot'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tourist_spot_id' => 'required|exists:tourist_spots,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'visit_date' => 'required|date',
            'visit_time' => 'required',
            'budget_limit' => 'nullable|numeric',
        ]);

        PredefinedItinerary::create($data);

        return redirect()
            ->route('admin.tourist-spots.show', $data['tourist_spot_id'])
            ->with('success', 'Predefined itinerary created successfully.');
    }

    public function index($touristSpotId)
    {
        $touristSpot = TouristSpot::findOrFail($touristSpotId);

        // Get predefined itineraries for this tourist spot
        $predefinedItineraries = PredefinedItinerary::where('tourist_spot_id', $touristSpotId)->get();

        return view('admin.predefined-itineraries.index', compact('touristSpot', 'predefinedItineraries'));
    }
    
    public function edit(PredefinedItinerary $predefinedItinerary)
    {
        // Load the associated tourist spot for display
        $touristSpot = $predefinedItinerary->touristSpot;

        return view('admin.predefined-itineraries.edit', compact('predefinedItinerary', 'touristSpot'));
    }

    public function update(Request $request, PredefinedItinerary $predefinedItinerary)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'visit_date' => 'nullable|date',
            'visit_time' => 'nullable',
            'budget_limit' => 'nullable|numeric',
        ]);

        $predefinedItinerary->update($data);

        return redirect()
            ->route('admin.predefined-itineraries.index', $predefinedItinerary->tourist_spot_id)
            ->with('success', 'Itinerary updated successfully.');
    }

    public function show($id)
    {
        $itinerary = PredefinedItinerary::findOrFail($id);
        return view('admin.predefined-itineraries.show', compact('itinerary'));
    }

    public function destroy($id)
    {
        try {
            $itinerary = PredefinedItinerary::findOrFail($id);
            $touristSpotId = $itinerary->tourist_spot_id;
            $itinerary->delete();

            return redirect()
                ->route('admin.predefined-itineraries.index', $touristSpotId)
                ->with('success', 'Predefined itinerary deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete the itinerary.');
        }
    }


}

