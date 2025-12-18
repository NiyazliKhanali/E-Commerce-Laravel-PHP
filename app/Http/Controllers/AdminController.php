<?php

namespace App\Http\Controllers;

use App\Models\Car\Car;
use App\Models\User;
use App\Models\Car\CarImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalCars = Car::count();
        $totalUsers = User::count();
        $pendingInquiries = 0;
        $todayViews = 0;
        $recentCars = Car::with('images')->latest()->take(5)->get();
        $recentUsers = User::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalCars',
            'totalUsers',
            'pendingInquiries',
            'todayViews',
            'recentCars',
            'recentUsers'
        ));
    }

    // Cars Management
    public function carsIndex(Request $request)
    {
        $query = Car::with('images');
        
        if ($request->filled('search')) {
            $search = strtolower($request->search);

            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(model_name) LIKE ?', ["%$search%"])
                  ->orWhereRaw('LOWER(brand) LIKE ?', ["%$search%"])
                  ->orWhereRaw('CAST(year AS TEXT) LIKE ?', ["%$search%"]);
            });
        }
        
        $cars = $query->latest()->paginate(10);
        
        return view('admin.cars.index', compact('cars'));
    }

    public function carsCreate()
    {
        return view('admin.cars.create');
    }

    public function carsStore(Request $request)
    {
        $validated = $request->validate([
            'model_name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric',
            'year' => 'required|integer',
            'description' => 'nullable|string',
            'engine_type' => 'nullable|string',
            'horsepower' => 'nullable|integer',
            'transmission' => 'nullable|string',
            'fuel_type' => 'nullable|string',
            'mileage' => 'nullable|numeric',
            'color' => 'nullable|string',
            'replaced_parts' => 'nullable|string',
            'repainted_parts' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $car = Car::create($validated);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('cars', 'public');
                CarImage::create([
                    'car_id' => $car->id,
                    'image_path' => $path
                ]);
            }
        }

        return redirect()->route('admin.cars.index')->with('success', 'Vehicle added successfully!');
    }

    public function carsEdit($id)
    {
        $car = Car::with('images')->findOrFail($id);
        return view('admin.cars.edit', compact('car'));
    }

    public function carsUpdate(Request $request, $id)
    {
        $car = Car::findOrFail($id);
        
        $validated = $request->validate([
            'model_name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric',
            'year' => 'required|integer',
            'description' => 'nullable|string',
            'engine_type' => 'nullable|string',
            'horsepower' => 'nullable|integer',
            'transmission' => 'nullable|string',
            'fuel_type' => 'nullable|string',
            'mileage' => 'nullable|numeric',
            'color' => 'nullable|string',
            'replaced_parts' => 'nullable|string',
            'repainted_parts' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $car->update($validated);

        // Handle new image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('cars', 'public');
                CarImage::create([
                    'car_id' => $car->id,
                    'image_path' => $path
                ]);
            }
        }

        return redirect()->route('admin.cars.index')->with('success', 'Vehicle updated successfully!');
    }

    public function carsDestroy($id)
    {
        $car = Car::findOrFail($id);
        
        // Delete all images
        foreach ($car->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }
        
        $car->delete();
        
        return redirect()->route('admin.cars.index')->with('success', 'Vehicle deleted successfully!');
    }

    public function deleteImage($id)
    {
        $image = CarImage::findOrFail($id);
        Storage::disk('public')->delete($image->image_path);
        $image->delete();
        
        return response()->json(['success' => true]);
    }

    // Users Management
    public function usersIndex(Request $request)
    {
        $query = User::query();
        
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        $users = $query->latest()->paginate(10);
        
        return view('admin.users.index', compact('users'));
    }

    public function usersEdit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function usersDestroy($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')->with('error', 'You cannot delete your own account!');
        }
        
        $user->delete();
        
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    }

    // Settings
    public function settings()
    {
        return view('admin.settings');
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
        ]);

        auth()->user()->update($validated);

        return redirect()->route('admin.settings')->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        auth()->user()->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->route('admin.settings')->with('success', 'Password updated successfully!');
    }

    public function updateSite(Request $request)
    {
        // You can store these in a settings table or config file
        // For now, just redirect back with success
        return redirect()->route('admin.settings')->with('success', 'Site settings updated successfully!');
    }

    public function updateNotifications(Request $request)
    {
        // Store notification preferences for the user
        return redirect()->route('admin.settings')->with('success', 'Notification preferences updated successfully!');
    }
}