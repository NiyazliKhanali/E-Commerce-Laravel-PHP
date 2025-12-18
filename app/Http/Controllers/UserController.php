<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Car\Car;
use App\Models\User;

/**
 * @method void middleware($middleware, array $options = [])
 */
class UserController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the user's orders/liked page.
     */
    public function liked()
    {
        $user = Auth::user();

        $cars = $user->likedCars()->paginate(12);

        return view('user.liked', compact('cars'));
    }

    /**
     * Toggle like/unlike a car.
     */
    public function toggleLike($carId)
    {
        $user = Auth::user();

        $liked = $user->likedCars()->where('car_id', $carId)->exists();

        if ($liked) {
        // Unlike
            $user->likedCars()->detach($carId);
        } else {
            // Like
            $user->likedCars()->attach($carId);
        }

        return response()->json([
            'success' => true,
            'liked' => !$liked
        ]);
    }


    /**
     * Show user profile.
     */
    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    /**
     * Update user profile (optional).
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);
        
        $user->update($validated);
        
        return redirect()->route('user.profile')
            ->with('success', 'Profile updated successfully!');
    }

    /**
     * Update user password.
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        
        $user = Auth::user();
        
        // Check if current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.'])
                        ->withInput();
        }
        
        // Update password
        $user->update([
            'password' => Hash::make($request->password)
        ]);
        
        return redirect()->route('user.profile')
            ->with('success', 'Password updated successfully!');
    }
}