@extends('layouts.app')

@section('title', 'Manage Vehicles - Admin')

@section('styles')
<style>
    .car-row {
        transition: all 0.3s ease;
    }
    
    .car-row:hover {
        background-color: #f9fafb;
        transform: translateX(4px);
    }
    
    .action-btn {
        transition: all 0.2s ease;
    }
    
    .action-btn:hover {
        transform: scale(1.1);
    }
</style>
@endsection

@section('content')
<!-- ===== Header ===== -->
<section class="bg-gradient-to-r from-blue-600 to-purple-600 py-12 text-white">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <a href="{{ route('admin.dashboard') }}" class="text-blue-100 hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                    </a>
                    <h1 class="text-4xl font-bold">Manage Vehicles</h1>
                </div>
                <p class="text-blue-100">View and manage all vehicles in your inventory</p>
            </div>
            <a href="{{ route('admin.cars.create') }}" class="px-6 py-3 bg-white text-blue-600 rounded-lg font-bold hover:shadow-lg transform hover:scale-105 transition">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add New Vehicle
                </div>
            </a>
        </div>
    </div>
</section>

<!-- ===== Filters & Search ===== -->
<section class="py-8 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <form action="{{ route('admin.cars.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Search by model, brand, or year..." 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg font-semibold hover:shadow-lg transition">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Search
                    </div>
                </button>
                @if(request('search'))
                <a href="{{ route('admin.cars.index') }}" class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition">
                    Clear
                </a>
                @endif
            </form>
        </div>
    </div>
</section>

<!-- ===== Cars List ===== -->
<section class="py-8 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <!-- Stats Header -->
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-purple-50">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">All Vehicles</h2>
                        <p class="text-gray-600">{{ $cars->total() }} vehicles found</p>
                    </div>
                    <div class="flex gap-2">
                        <span class="px-4 py-2 bg-green-100 text-green-700 rounded-lg font-semibold text-sm">
                            Active: {{ $cars->where('status', 'active')->count() }}
                        </span>
                        <span class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-semibold text-sm">
                            Total: {{ $cars->total() }}
                        </span>
                    </div>
                </div>
            </div>

            @if($cars->count())
            <!-- Table for larger screens -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Vehicle</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Details</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Price</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($cars as $car)
                        <tr class="car-row">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    @php
                                        $firstImage = $car->images->isNotEmpty()
                                            ? asset('storage/' . $car->images->first()->image_path)
                                            : asset('images/default-car.jpg');
                                    @endphp
                                    <img src="{{ $firstImage }}" 
                                         alt="{{ $car->model_name }}" 
                                         class="w-20 h-20 object-cover rounded-lg">
                                    <div>
                                        <h3 class="font-semibold text-gray-800">{{ $car->model_name }}</h3>
                                        <p class="text-sm text-gray-600">{{ $car->brand ?? 'Unknown' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm">
                                    <p class="text-gray-800"><span class="font-medium">Year:</span> {{ $car->year }}</p>
                                    <p class="text-gray-800"><span class="font-medium">Fuel:</span> {{ $car->fuel_type }}</p>
                                    <p class="text-gray-800"><span class="font-medium">Mileage:</span> {{ number_format($car->mileage ?? 0) }} km</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-lg font-bold text-blue-600">${{ number_format($car->price) }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $car->status == 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                    {{ ucfirst($car->status ?? 'active') }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('cars.show', $car->id) }}" 
                                       class="action-btn p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition"
                                       title="View">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.cars.edit', $car->id) }}" 
                                       class="action-btn p-2 text-green-600 hover:bg-green-50 rounded-lg transition"
                                       title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.cars.destroy', $car->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this vehicle?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="action-btn p-2 text-red-600 hover:bg-red-50 rounded-lg transition"
                                                title="Delete">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Cards for mobile screens -->
            <div class="lg:hidden divide-y divide-gray-200">
                @foreach($cars as $car)
                <div class="p-6 hover:bg-gray-50 transition">
                    <div class="flex gap-4 mb-4">
                        @php
                            $firstImage = $car->images->isNotEmpty()
                                ? asset('storage/' . $car->images->first()->image_path)
                                : asset('images/default-car.jpg');
                        @endphp
                        <img src="{{ $firstImage }}" 
                             alt="{{ $car->model_name }}" 
                             class="w-24 h-24 object-cover rounded-lg">
                        <div class="flex-1">
                            <h3 class="font-bold text-gray-800 text-lg mb-1">{{ $car->model_name }}</h3>
                            <p class="text-sm text-gray-600 mb-2">{{ $car->brand ?? 'Unknown' }} • {{ $car->year }}</p>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $car->status == 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                {{ ucfirst($car->status ?? 'active') }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-4 text-sm">
                        <div>
                            <span class="text-gray-600">Fuel:</span>
                            <span class="font-medium text-gray-800 ml-1">{{ $car->fuel_type }}</span>
                        </div>
                        <div>
                            <span class="text-gray-600">Mileage:</span>
                            <span class="font-medium text-gray-800 ml-1">{{ number_format($car->mileage ?? 0) }} km</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                        <p class="text-xl font-bold text-blue-600">${{ number_format($car->price) }}</p>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('cars.show', $car->id) }}" 
                               class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            <a href="{{ route('admin.cars.edit', $car->id) }}" 
                               class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form action="{{ route('admin.cars.destroy', $car->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this vehicle?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="p-6 border-t border-gray-200">
                {{ $cars->links() }}
            </div>

            @else
            <!-- Empty State -->
            <div class="p-12 text-center">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">No vehicles found</h3>
                <p class="text-gray-600 mb-6">
                    @if(request('search'))
                        No vehicles match your search criteria
                    @else
                        Get started by adding your first vehicle
                    @endif
                </p>
                @if(request('search'))
                <a href="{{ route('admin.cars.index') }}" class="inline-block px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg font-semibold hover:shadow-lg transition">
                    Clear Search
                </a>
                @else
                <a href="{{ route('admin.cars.create') }}" class="inline-block px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg font-semibold hover:shadow-lg transition">
                    Add New Vehicle
                </a>
                @endif
            </div>
            @endif
        </div>
    </div>
</section>
@endsection