<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\Controller;
use App\Models\Car\CarImage;
use Illuminate\Http\Request;

class CarImageController extends Controller
{
    public function index(int $carId)
    {
        $carImages = CarImage::where('car_id', $carId)->orderBy('created_at', 'desc')->paginate(10);
        return view('car_images.index', compact('carImages'));
    }
}
