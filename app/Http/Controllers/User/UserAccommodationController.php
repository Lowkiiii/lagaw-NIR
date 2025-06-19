<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use Illuminate\Http\Request;

class UserAccommodationController extends Controller
{
    /**
     * Display a listing of accommodations for users.
     */
    public function index(Request $request)
    {
        $query = Accommodation::query();
        
        // Handle search functionality
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        // Handle featured filter
        if ($request->has('featured') && $request->featured) {
            $query->where('is_featured', 1);
        }
        
        // Get paginated results
        $accommodations = $query->latest()->paginate(12);
        
        return view('user.accommodations.index', compact('accommodations'));
    }

    /**
     * Display the specified accommodation.
     */
    public function show(Accommodation $accommodation)
    {
        // Decode amenities JSON to array
        if ($accommodation->amenities) {
            $accommodation->amenities = json_decode($accommodation->amenities, true);
        }
        
        return view('user.accommodations.show', compact('accommodation'));
    }
}