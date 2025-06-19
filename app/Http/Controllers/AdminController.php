<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Remove the constructor with middleware
    
    public function dashboard()
    {
        // Check if user is admin
        if (Auth::user()->usertype != 0) {
            return redirect('/dashboard')->with('error', 'Access denied. You are not an administrator.');
        }
        
        return view('admin.dashboard');
    }
    
    // Add other admin functions here
}