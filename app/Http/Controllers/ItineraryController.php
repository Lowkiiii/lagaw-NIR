<?php

namespace App\Http\Controllers;

use App\Models\Itinerary;
use App\Models\TouristSpot;
use Illuminate\Http\Request;
use App\Models\PredefinedItinerary;
use Illuminate\Support\Facades\Auth;

class ItineraryController extends Controller
{
    public function create($spotId)
    {
        $spot = TouristSpot::findOrFail($spotId);
        return view('itineraries.create', compact('spot'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'visit_date' => 'required|date',
            'visit_time' => 'required',
            'budget_limit' => 'nullable|numeric',
            'notes' => 'nullable|string',
            'tourist_spot_id' => 'required|exists:tourist_spots,id',
        ]);

        $validated['user_id'] = Auth::id();

        Itinerary::create($validated);

        return redirect()->route('itineraries.index')->with('success', 'Itinerary added successfully!');
    }

    public function show($id)
    {
        $itinerary = Itinerary::with('touristSpot')->where('user_id', Auth::id())->findOrFail($id);
        return view('itineraries.show', compact('itinerary'));
    }

    public function edit($id)
    {
        $itinerary = Itinerary::where('user_id', Auth::id())->findOrFail($id);
        return view('itineraries.edit', compact('itinerary'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'visit_date' => 'required|date',
            'visit_time' => 'required',
            'budget_limit' => 'nullable|numeric',
            'notes' => 'nullable|string',
        ]);

        $itinerary = Itinerary::where('user_id', Auth::id())->findOrFail($id);
        $itinerary->update($validated);

        return redirect()->route('itineraries.index')->with('success', 'Itinerary updated successfully!');
    }

    public function destroy($id)
    {
        $itinerary = Itinerary::where('user_id', Auth::id())->findOrFail($id);
        $itinerary->delete();

        return redirect()->route('itineraries.index')->with('success', 'Itinerary deleted successfully!');
    }


    public function index()
    {
        $itineraries = Itinerary::where('user_id', Auth::id())->latest()->get();
        return view('itineraries.index', compact('itineraries'));
    }

    public function suggestItinerary($spotId)
    {
        // Fetch the tourist spot data
        $spot = TouristSpot::findOrFail($spotId);

        // Define some default values (you can enhance this with more complex logic)
        $suggestedItinerary = [
            'title' => "Visit to " . $spot->name,
            'visit_date' => now()->format('Y-m-d'),  // Current date as default
            'visit_time' => '09:00 AM',  // Default visit time
            'budget_limit' => 1000.00,  // Default budget, adjust as per your needs
            'notes' => "Enjoy the sights at " . $spot->name . ". Don't forget to check the opening hours: " . $spot->openinghours,
            'tourist_spot_id' => $spotId,
        ];

        // Optionally, you could send this as a response to an API call, or you could fill the form directly in the view
        return response()->json($suggestedItinerary);
    }


    public function saveFromPredefined(PredefinedItinerary $predefined)
    {
        $itinerary = new Itinerary();
        $itinerary->user_id = Auth::id();
        $itinerary->title = $predefined->title;
        $itinerary->visit_date = $predefined->visit_date;
        $itinerary->visit_time = $predefined->visit_time;
        $itinerary->budget_limit = $predefined->budget_limit;
        $itinerary->tourist_spot_id = $predefined->tourist_spot_id;
        $itinerary->notes = $predefined->description;
        // $itinerary->notes = 'Copied from a suggested itinerary.';

        $itinerary->save();

        return redirect()->route('itineraries.index')->with('success', 'Itinerary saved successfully!');
    }


}