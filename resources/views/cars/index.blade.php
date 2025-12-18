@extends('layouts.app')

@section('title', 'Browse Vehicles - KoreaCars')

@section('styles')
<style>
    .car-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .car-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.2);
    }
    .car-card img {
        transition: transform 0.4s ease;
    }
    .car-card:hover img {
        transform: scale(1.08);
    }
    .page-header {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #60a5fa 100%);
    }
</style>
@endsection

@section('content')

<!-- ===== Page Header ===== -->
<section class="page-header py-20 text-white">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold mb-4">Premium Vehicle Catalogue</h1>
        <p class="text-xl text-blue-100">Discover your perfect car from our extensive collection</p>
    </div>
</section>

<!-- ===== Filters & Listings ===== -->
<section class="container mx-auto px-4 py-12">

    <!-- 🔵 FILTER FORM START -->
    <form action="{{ route('cars') }}" method="GET" class="flex flex-col lg:flex-row gap-8">

        <!-- Sidebar Filters -->
        <aside class="lg:w-80 flex-shrink-0">
            <div class="bg-white rounded-2xl shadow-lg p-6 lg:sticky lg:top-24">
                <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Filters
                </h3>

                <div class="space-y-6">

                    <!-- Price Range -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Price Range</label>
                        <div class="flex gap-3">
                            <input type="number" name="min_price" placeholder="Min" value="{{ request('min_price') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                            <input type="number" name="max_price" placeholder="Max" value="{{ request('max_price') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        </div>
                    </div>

                    <!-- Brand -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Brand</label>
                        <input type="string" name="brand" placeholder="Brand" value="{{ request('brand') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    </div>

                    <!-- Year -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Year</label>
                        <div class="flex gap-3">
                            <input type="number" name="min_year" placeholder="From" value="{{ request('min_year') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                            <input type="number" name="max_year" placeholder="To" value="{{ request('max_year') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        </div>
                    </div>

                    <!-- Fuel Type -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Fuel Type</label>
                        <div class="space-y-2">
                            @foreach(['Benzin', 'Dizel', 'Elektrik', 'Hybrid'] as $fuel)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="fuel_type[]" value="{{ $fuel }}" {{ is_array(request('fuel_type')) && in_array($fuel, request('fuel_type')) ? 'checked' : '' }} class="w-4 h-4 text-blue-600">
                                <span>{{ $fuel }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Transmission -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Transmission</label>
                        <div class="space-y-2">
                            @foreach(['Avtomat', 'Mexanik'] as $trans)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="transmission" value="{{ $trans }}" {{ request('transmission') == $trans ? 'checked' : '' }} class="w-4 h-4 text-blue-600">
                                <span>{{ $trans }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="space-y-3 pt-4 border-t">
                        <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg font-semibold">
                            Apply Filters
                        </button>
                        <a href="{{ route('cars') }}" class="block w-full px-6 py-3 bg-gray-100 text-gray-700 rounded-lg font-semibold text-center">
                            Reset Filters
                        </a>
                    </div>

                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 min-w-0">

            <!-- Results Header -->
            <div class="space-y-6">
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">

                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Available Vehicles</h2>
                            <p class="text-gray-600">{{ $cars->total() }} cars found</p>
                        </div>

                        <div class="w-full sm:w-auto">
                            <select name="sort" onchange="this.form.submit()" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                                <option value="">Sort by: Featured</option>
                                <option value="price_asc" {{ request('sort')=='price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_desc" {{ request('sort')=='price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                                <option value="year_desc" {{ request('sort')=='year_desc' ? 'selected' : '' }}>Year: Newest First</option>
                                <option value="mileage_asc" {{ request('sort')=='mileage_asc' ? 'selected' : '' }}>Mileage: Low to High</option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>

    </form> <!-- 🔥 FIXED: FILTER FORM ENDS HERE -->

            @if ($cars->count())

            <!-- Car Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach ($cars as $car)
                @php
                    $firstImage = $car->images->isNotEmpty()
                        ? asset('storage/' . $car->images->first()->image_path)
                        : asset('images/default-car.jpg');
                    $isLiked = auth()->check() && auth()->user()->likedCars()->where('car_id', $car->id)->exists();
                @endphp

                <!-- Car card -->
                <div class="car-card bg-white rounded-2xl shadow-lg overflow-hidden group flex flex-col">

                    <div class="relative overflow-hidden">
                        <img src="{{ $firstImage }}" alt="{{ $car->model_name }}" class="w-full h-56 object-cover">

                        <!-- Badges -->
                        <div class="absolute top-4 left-4 right-4 flex justify-between items-start z-20">
                            <span class="px-3 py-1 bg-gradient-to-r from-blue-600 to-purple-600 text-white text-xs font-semibold rounded-full">
                                {{ $car->category ?? 'Premium' }}
                            </span>

                            <div class="flex items-center gap-2">
                                @if($car->year >= 2022)
                                <span class="px-3 py-1 bg-green-500 text-white text-xs font-semibold rounded-full">
                                    New
                                </span>
                                @endif

                                <!-- Like Button -->
                                @auth
                                <button type="button"
                                    onclick="toggleLike({{ $car->id }}, this)"
                                    class="like-btn w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform {{ $isLiked ? 'liked' : '' }}"
                                    data-car-id="{{ $car->id }}">
                                    <svg class="w-5 h-5 transition-colors pointer-events-none {{ $isLiked ? 'text-red-500 fill-current' : 'text-gray-400' }}"
                                        viewBox="0 0 20 20"
                                        fill="{{ $isLiked ? 'currentColor' : 'none' }}"
                                        stroke="currentColor"
                                        stroke-width="1.5">
                                        <path fill-rule="evenodd"
                                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                            clip-rule="evenodd"/>
                                    </svg>
                                </button>
                                @else
                                <a href="{{ route('login') }}"
                                class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path fill-rule="evenodd"
                                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                            clip-rule="evenodd"/>
                                    </svg>
                                </a>
                                @endauth

                            </div>
                        </div>

                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4 z-10 pointer-events-none">
                            <a href="{{ route('cars.show', $car->id) }}" class="w-full px-4 py-2 bg-white text-gray-900 text-center rounded-lg font-semibold pointer-events-auto">
                                Quick View
                            </a>
                        </div>

                    </div>

                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $car->model_name }}</h3>

                        <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                            <span>{{ $car->brand }}</span>
                            <span>•</span>
                            <span>{{ $car->year }}</span>
                        </div>

                        <div class="grid grid-cols-2 gap-2 mb-4 pb-4 border-b">

                            <div class="flex items-center gap-1 text-xs text-gray-600">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                                <span>{{ $car->fuel_type }}</span>
                            </div>

                            <div class="flex items-center gap-1 text-xs text-gray-600">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                                </svg>
                                <span>{{ $car->transmission }}</span>
                            </div>

                            <div class="flex items-center gap-1 text-xs text-gray-600">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>{{ number_format($car->mileage) }} km</span>
                            </div>

                            <div class="flex items-center gap-1 text-xs text-gray-600">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                                </svg>
                                <span>{{ ucfirst($car->color) }}</span>
                            </div>

                        </div>

                        <div class="flex items-center justify-between mt-auto">
                            <div>
                                <div class="text-xs text-gray-500">Starting from</div>
                                <div class="text-xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                    ${{ number_format($car->price) }}
                                </div>
                            </div>

                            <a href="{{ route('cars.show', $car->id) }}" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg font-semibold">
                                Details
                            </a>
                        </div>

                    </div>

                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $cars->links() }}
            </div>

            @else

            <!-- Empty State -->
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">No vehicles found</h3>
                <p class="text-gray-600 mb-6">Try adjusting your filters or search criteria</p>
                <a href="{{ route('cars') }}" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg font-semibold">
                    Clear Filters
                </a>
            </div>

            @endif

        </div> <!-- end flex-1 -->
</section>
@section('scripts')
<script>
function toggleLike(carId, button) {
    fetch(`/user/like/${carId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const svg = button.querySelector('svg');
            
            if (data.liked) {
                button.classList.add('liked');
                svg.classList.add('text-red-500', 'fill-current');
                svg.classList.remove('text-gray-400');
                svg.setAttribute('fill', 'currentColor');
            } else {
                button.classList.remove('liked');
                svg.classList.remove('text-red-500', 'fill-current');
                svg.classList.add('text-gray-400');
                svg.setAttribute('fill', 'none');
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to update like status. Please try again.');
    });
}
</script>
@endsection
@endsection
