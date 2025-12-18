<?php

namespace Database\Factories\Car;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Car\Brand;
use App\Models\Car\Category;

class CarFactory extends Factory
{
    public function definition(): array
    {
        $replacableParts = ['front bumper', 'rear bumper', 'left door', 'right door', 'hood', 'trunk', 'mirror', 'headlight'];
        $paintableParts = ['hood', 'roof', 'door', 'fender', 'trunk', 'bumper'];

        return [
            'car_id' => \App\Models\Car\Car::factory(),
            'brand' => $this->faker->word(),          // changed from brand_id
            'category' => $this->faker->word(),       // changed from category_id
            'model_name' => $this->faker->word(),
            'price' => $this->faker->numberBetween(8000, 80000),
            'year' => $this->faker->year(),
            'description' => $this->faker->paragraph(),
            'engine_type' => $this->faker->randomElement(['Petrol', 'Diesel', 'Hybrid', 'Electric']),
            'horsepower' => $this->faker->numberBetween(100, 500),
            'transmission' => $this->faker->randomElement(['Automatic', 'Manual']),
            'fuel_type' => $this->faker->randomElement(['Petrol', 'Diesel', 'Hybrid', 'Electric']),
            'mileage' => $this->faker->numberBetween(1000, 150000),
            'color' => $this->faker->safeColorName(),
            'image_url' => $this->faker->imageUrl(800, 600, 'cars', true, 'Car'),
            'replaced_parts' => $this->faker->randomElements($replacableParts, rand(0, 3)),
            'repainted_parts' => $this->faker->randomElements($paintableParts, rand(0, 3)),
        ];
    }
}
