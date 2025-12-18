<?php

namespace App\Models\Car;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'model_name',
        'brand',
        'category',
        'price',
        'year',
        'description',
        'engine_type',
        'horsepower',
        'transmission',
        'fuel_type',
        'mileage',
        'color',
        'replaced_parts',
        'repainted_parts'
    ];

    public function images()
    {
        return $this->hasMany(CarImage::class);
    }

    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }

}
