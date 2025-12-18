@extends('layouts.app')

@section('title', 'My Liked Cars')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12">
    <div class="container mx-auto px-4 lg:px-8">
        
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-3 mb-4">
                <h1 class="text-4xl font-bold text-gray-800">My Liked Cars</h1>
            </div>
            <p class="text-gray-600">Your favorite Korean vehicles collection</p>
        </div>

        <!-- Cars Grid -->
        @if(isset($cars) && $cars->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
                @foreach($cars as $car)
                <div class="card-hover bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <!-- Car Image -->
                    <div class="relative">
                        @php
                        $img = $car->images->first()
                            ? asset('storage/' . $car->images->first()->image_path)
                            : '/placeholder-car.jpg';
                        @endphp
                        <img src="{{ $img }}" alt="{{ $car->name }}" class="w-full h-56 object-cover">
                        
                        <!-- Like Button -->
                        <button type="button"
                            onclick="toggleLike({{ $car->id }}, this)"
                            class="absolute top-4 right-4 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition"
                            data-car-id="{{ $car->id }}">
                            <svg class="w-6 h-6 text-red-500 fill-current" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                            </svg>
                        </button>

                        <!-- Price Badge -->
                        <div class="absolute bottom-4 left-4">
                            <span class="px-4 py-2 bg-white/95 backdrop-blur-sm rounded-full font-bold text-lg bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                ${{ number_format($car->price, 2) }}
                            </span>
                        </div>
                    </div>

                    <!-- Car Details -->
                    <div class="p-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $car->model_name }}</h2>
                        <p class="text-gray-600 mb-4">{{ $car->brand }} • {{ $car->year }}</p>

                        <!-- Specifications -->
                        <div class="flex flex-wrap gap-2 mb-6">
                            <span class="px-3 py-1.5 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                                <span>{{ $car->fuel_type ?? 'Gasoline' }}</span>
                            </span>
                            <span class="px-3 py-1.5 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>{{ $car->mileage ?? '0' }} km</span>
                            </span>
                            <span class="px-3 py-1.5 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span>{{ $car->transmission ?? 'Automatic' }}</span>
                            </span>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-3">
                            <a href="{{ route('cars.show', $car->id) }}" class="flex-1 px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white text-center rounded-full font-semibold hover:shadow-lg transform hover:scale-105 transition">
                                View Details
                            </a>
                            <a href="{{ route('contact') }}" class="px-4 py-2.5 border-2 border-gray-300 text-gray-700 rounded-full font-semibold hover:border-gray-400 transition flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if(method_exists($cars, 'links'))
            <div class="mt-8">
                {{ $cars->links() }}
            </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center border border-gray-100">
                <div class="w-24 h-24 bg-gradient-to-r from-pink-500 to-red-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">No Liked Cars Yet</h2>
                <p class="text-gray-600 mb-6">You haven't liked any cars yet. Start exploring our amazing collection of Korean vehicles!</p>
                <a href="{{ route('cars') }}" class="inline-block px-8 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-full font-semibold hover:shadow-lg transform hover:scale-105 transition">
                    Browse Our Catalogue
                </a>
            </div>
        @endif

    </div>
</div>
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