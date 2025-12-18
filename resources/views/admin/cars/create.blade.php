@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10">
    <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6 text-center">Create New Car Listing</h1>

        <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Car Basic Info --}}
            <div>
                <h2 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-1">Basic Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-600 mb-1">Model Name</label>
                        <input type="text" name="model_name" class="w-full border border-gray-300 rounded-lg p-2.5" required>
                    </div>

                    <div>
                        <label class="block text-gray-600 mb-1">Price ($)</label>
                        <input type="number" name="price" class="w-full border border-gray-300 rounded-lg p-2.5" required>
                    </div>

                    <div>
                        <label class="block text-gray-600 mb-1">Year</label>
                        <input type="number" name="year" class="w-full border border-gray-300 rounded-lg p-2.5" required>
                    </div>

                    <div>
                        <label class="block text-gray-600 mb-1">Mileage (km)</label>
                        <input type="number" name="mileage" class="w-full border border-gray-300 rounded-lg p-2.5" required>
                    </div>
                </div>
            </div>

            {{-- Brand & Category --}}
            <div>
                <h2 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-1">Brand & Category</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-600 mb-1">Brand</label>
                        <input type="text" name="brand" placeholder="BMW, Mercedes, Audi..." class="w-full border border-gray-300 rounded-lg p-2.5" required>
                    </div>

                    <div>
                        <label class="block text-gray-600 mb-1">Category</label>
                        <input type="text" name="category" placeholder="Sedan, SUV, Coupe..." class="w-full border border-gray-300 rounded-lg p-2.5" required>
                    </div>
                </div>
            </div>

            {{-- Technical Details --}}
            <div>
                <h2 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-1">Technical Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-600 mb-1">Engine Type</label>
                        <input type="text" name="engine_type" class="w-full border border-gray-300 rounded-lg p-2.5" required>
                    </div>

                    <div>
                        <label class="block text-gray-600 mb-1">Horsepower</label>
                        <input type="number" name="horsepower" class="w-full border border-gray-300 rounded-lg p-2.5">
                    </div>

                    <div>
                        <label class="block text-gray-600 mb-1">Transmission</label>
                        <input type="text" name="transmission" class="w-full border border-gray-300 rounded-lg p-2.5">
                    </div>

                    <div>
                        <label class="block text-gray-600 mb-1">Fuel Type</label>
                        <input type="text" name="fuel_type" class="w-full border border-gray-300 rounded-lg p-2.5">
                    </div>

                    <div>
                        <label class="block text-gray-600 mb-1">Color</label>
                        <input type="text" name="color" class="w-full border border-gray-300 rounded-lg p-2.5">
                    </div>
                </div>
            </div>

            {{-- Condition Info --}}
            <div>
                <h2 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-1">Condition Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-600 mb-1">Repainted Parts</label>
                        <input type="text" name="repainted_parts" class="w-full border border-gray-300 rounded-lg p-2.5">
                    </div>

                    <div>
                        <label class="block text-gray-600 mb-1">Replaced Parts</label>
                        <input type="text" name="replaced_parts" class="w-full border border-gray-300 rounded-lg p-2.5">
                    </div>
                </div>
            </div>

            {{-- Description --}}
            <div>
                <label class="block text-gray-600 mb-1">Description</label>
                <textarea name="description" rows="4" class="w-full border border-gray-300 rounded-lg p-2.5" required></textarea>
            </div>

            {{-- Images --}}
            <div>
                <h2 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-1">Images</h2>
                <input type="file" name="images[]"class="w-full border border-gray-300 rounded-lg p-2.5" multiple>
                <p class="text-sm text-gray-500 mt-1">Upload a main image of the car.</p>
            </div>

            {{-- Submit --}}
            <div class="text-center">
                <button type="submit" class="bg-blue-600 text-white font-semibold px-8 py-3 rounded-lg hover:bg-blue-700 transition">
                    Create Listing
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
