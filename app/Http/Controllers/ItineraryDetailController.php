<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Itinerary;
use App\Models\ItineraryDetail;
use Illuminate\Support\Facades\Http;
use App\Services\OpenAIService;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\RequestException;

class ItineraryDetailController extends Controller
{

    public function create($itineraryId)
    {
        $itinerary = Itinerary::findOrFail($itineraryId);
        return view('itinerary_details.create', compact('itinerary'));
    }

    public function store(Request $request, $itineraryId)
    {
        $data = $request->validate([
            'details' => 'required|string',
        ]);
        ItineraryDetail::create([
            'itinerary_id' => $itineraryId,
            'details'      => $data['details'],
        ]);
        return redirect()
            ->route('itineraries.show', $itineraryId)
            ->with('success', 'Note added!');
    }

}
