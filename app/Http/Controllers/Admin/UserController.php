<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch users from the database with pagination
        $users = User::select('id', 'name', 'email', 'contact_number')
                      ->paginate(10);
        
        return view('admin.users.index', compact('users'));
    }
    
    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }
    
    /**
     * Update the specified user in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$id,
            'contact_number' => 'nullable|string|max:255',
        ]);
        
        // Update the user
        $user->name = $request->name;
        $user->email = $request->email;
        $user->contact_number = $request->contact_number;
        $user->save();
        
        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified user from the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    /**
     * Remove the specified user from the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            
            // Prevent deleting your own account
            if (Auth::id() == $user->id) {
                Log::warning("Attempt to delete own account. User ID: " . Auth::id());
                return redirect()->route('admin.users.index')
                    ->with('error', 'You cannot delete your own account!');
            }
            
            $user->delete();
            
            return redirect()->route('admin.users.index')
                ->with('success', 'User deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            return redirect()->route('admin.users.index')
                ->withErrors(['error' => 'An error occurred while deleting the user.']);
        }
    }
}