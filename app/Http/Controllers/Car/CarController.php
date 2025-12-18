<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car\Car;
use App\Models\Car\CarImage;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::with('images');

        // PRICE FILTERS
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // BRAND FILTER
        if ($request->filled('brand')) {
            $brand = strtolower($request->brand);
            $query->whereRAW('LOWER(brand) = ?', [$brand]);
        }

        // YEAR FILTERS
        if ($request->filled('min_year')) {
            $query->where('year', '>=', $request->min_year);
        }

        if ($request->filled('max_year')) {
            $query->where('year', '<=', $request->max_year);
        }

        // FUEL TYPE FILTER (checkbox → array)
        if ($request->filled('fuel_type')) {
            $query->whereIn('fuel_type', (array)$request->fuel_type);
        }

        // TRANSMISSION FILTER
        if ($request->filled('transmission')) {
            $query->where('transmission', $request->transmission);
        }

        // SORTING
        switch ($request->sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'year_desc':
                $query->orderBy('year', 'desc');
                break;
            case 'mileage_asc':
                $query->orderBy('mileage', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        // SEARCH
        if ($request->filled('search')) {
            $search = strtolower($request->search);

            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(model_name) LIKE ?', ["%$search%"])
                  ->orWhereRaw('LOWER(brand) LIKE ?', ["%$search%"])
                  ->orWhereRaw('CAST(year AS TEXT) LIKE ?', ["%$search%"]);
            });
        }

        $cars = $query->paginate(6)->withQueryString();

        return view('cars.index', compact('cars'));
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store(Request $request)
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

        // SAVE IMAGES
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('cars', 'public');

                CarImage::create([
                    'car_id' => $car->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('cars.index')
            ->with('success', 'Car created successfully!');

            $transmission = $request->transmission;
    
    //Save new transmission type if provided
    if ($transmission === 'Custom' && $request->filled('transmission_custom')) {
        $transmission = $request->transmission_custom;
    }

    $car->transmission = $transmission;
    $car->save();
    }


    public function show($id)
    {
        $car = Car::with('images')->findOrFail($id);
        return view('cars.show', compact('car'));
    }

    
}
