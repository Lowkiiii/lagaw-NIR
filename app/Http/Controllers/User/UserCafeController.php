<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cafe;
use Illuminate\Http\Request;

class UserCafeController extends Controller
{
    public function index(Request $request)
    {
        $query = Cafe::query();

        // Search functionality
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('location', 'like', "%{$searchTerm}%")
                  ->orWhere('specialty', 'like', "%{$searchTerm}%");
            });
        }

        // Filter by featured
        if ($request->has('featured')) {
            $query->where('is_featured', true);
        }

        $cafes = $query->paginate(12);

        return view('user.cafes.index', compact('cafes'));
    }

    public function show(Cafe $cafe)
    {
        return view('user.cafes.show', compact('cafe'));
    }


    public function guestIndex(Request $request)
    {
        $query = Cafe::query();

        // Search functionality
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('location', 'like', "%{$searchTerm}%")
                  ->orWhere('specialty', 'like', "%{$searchTerm}%");
            });
        }

        // Filter by featured
        if ($request->has('featured')) {
            $query->where('is_featured', true);
        }

        $cafes = $query->paginate(12);

        return view('guest.cafes.index', compact('cafes'));
    }
}