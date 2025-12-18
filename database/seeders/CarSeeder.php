<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car\Car;
use Illuminate\Support\Str;

class CarSeeder extends Seeder
{
    public function run()
    {
        $brands = ['BMW', 'Audi', 'Mercedes', 'Toyota', 'Honda', 'Lexus'];
        $categories = ['Sedan', 'Coupe', 'SUV', 'Hatchback', 'Convertible'];

        for ($i = 0; $i < 20; $i++) {
            Car::create([
                'model_name' => 'Model ' . Str::random(3),
                'brand' => $brands[array_rand($brands)],
                'category' => $categories[array_rand($categories)],
                'price' => rand(10000, 90000),
                'year' => rand(2000, 2024),
                'description' => 'This is a seeded test car description.',
                'engine_type' => 'V' . rand(4, 8),
                'horsepower' => rand(100, 600),
                'transmission' => rand(0, 1) ? 'Automatic' : 'Manual',
                'fuel_type' => rand(0, 1) ? 'Petrol' : 'Diesel',
                'mileage' => rand(10000, 200000),
                'color' => ['Black', 'White', 'Blue', 'Gray'][rand(0, 3)],
                'image_url' => 'https://via.placeholder.com/800x600.png?text=Car+' . ($i + 1),
                'replaced_parts' => 'None',
                'repainted_parts' => 'None',
            ]);
        }
    }
}
