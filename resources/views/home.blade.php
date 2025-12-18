@extends('layouts.app')

@section('title', 'Home - Premium Korean Vehicles')

@section('styles')
<style>
    .hero-overlay {
        background: linear-gradient(135deg, rgba(30, 58, 138, 0.9) 0%, rgba(59, 130, 246, 0.85) 50%, rgba(96, 165, 250, 0.8) 100%);
    }
    
    .search-container {
        animation: slideUp 0.6s ease-out;
    }
    
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .car-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .car-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    
    .car-card img {
        transition: transform 0.4s ease;
    }
    
    .car-card:hover img {
        transform: scale(1.05);
    }
    
    .badge {
        backdrop-filter: blur(8px);
        background: rgba(255, 255, 255, 0.2);
    }
</style>
@endsection

@section('content')
<!-- ===== Enhanced Hero Section ===== -->
<section class="relative h-[600px] flex items-center justify-center overflow-hidden">
    <img 
        src="https://images.unsplash.com/photo-1503376780353-7e6692767b70"
        alt="Luxury Car"
        class="absolute inset-0 w-full h-full object-cover"
    >
    <div class="absolute inset-0 hero-overlay"></div>

    <div class="relative z-10 max-w-4xl px-4 text-center">
        <div class="inline-block mb-4 px-4 py-2 badge text-white rounded-full text-sm font-semibold">
            🚗 Premium Korean Vehicles
        </div>
        <h1 class="text-5xl md:text-6xl font-bold mb-6 text-white leading-tight">
            Find Your Perfect <br>
            <span class="bg-gradient-to-r from-yellow-300 to-orange-400 bg-clip-text text-transparent">Dream Car</span>
        </h1>
        <p class="text-xl md:text-2xl mb-8 text-blue-50 max-w-2xl mx-auto">
            Explore premium Korean vehicles with exceptional quality and competitive prices
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/cars" 
               class="px-8 py-4 bg-white text-blue-600 rounded-full font-semibold hover:shadow-2xl transform hover:scale-105 transition inline-flex items-center justify-center gap-2">
                Browse Inventory
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
            <a href="/contact" 
               class="px-8 py-4 bg-transparent border-2 border-white text-white rounded-full font-semibold hover:bg-white hover:text-blue-600 transition inline-flex items-center justify-center gap-2">
                Contact Us
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </a>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-10">
        <div class="animate-bounce">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    </div>
</section>

<!-- ===== Enhanced Search Bar ===== -->
<div class="container mx-auto -mt-12 relative z-20 px-4 search-container">
    <div class="bg-white shadow-2xl rounded-2xl p-6 max-w-4xl mx-auto">
        <form action="/cars" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1 flex items-center gap-3 px-4 py-3 bg-gray-50 rounded-xl">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text"
                       name="search"
                       placeholder="Search by brand, model, or type..."
                       class="flex-1 bg-transparent focus:outline-none text-gray-700"
                >
            </div>
            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-semibold hover:shadow-lg transform hover:scale-105 transition">
                Search Cars
            </button>
        </form>
    </div>
</div>

<!-- ===== Stats Section ===== -->
<section class="container mx-auto px-4 py-16">
    <div class="grid md:grid-cols-4 gap-6">
        <div class="text-center p-6 bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl">
            <div class="text-4xl font-bold text-blue-600 mb-2">500+</div>
            <div class="text-gray-600 font-medium">Premium Vehicles</div>
        </div>
        <div class="text-center p-6 bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl">
            <div class="text-4xl font-bold text-purple-600 mb-2">98%</div>
            <div class="text-gray-600 font-medium">Satisfied Customers</div>
        </div>
        <div class="text-center p-6 bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl">
            <div class="text-4xl font-bold text-green-600 mb-2">24/7</div>
            <div class="text-gray-600 font-medium">Customer Support</div>
        </div>
        <div class="text-center p-6 bg-gradient-to-br from-orange-50 to-red-50 rounded-2xl">
            <div class="text-4xl font-bold text-orange-600 mb-2">15+</div>
            <div class="text-gray-600 font-medium">Years Experience</div>
        </div>
    </div>
</section>

<!-- ===== Featured Cars ===== -->
<section class="container mx-auto px-4 py-16">
    <div class="text-center mb-12">
        <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Featured Vehicles</h2>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">Handpicked premium vehicles with exceptional quality and performance</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ([
            ['img' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70', 'name' => 'Porsche Panamera', 'type' => 'Electric', 'year' => 2022, 'price' => '85,000', 'badge' => 'Premium'],
            ['img' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e', 'name' => 'BMW M3 Competition', 'type' => 'Gasoline', 'year' => 2021, 'price' => '68,000', 'badge' => 'Popular'],
            ['img' => 'https://images.unsplash.com/photo-1619767886558-efdc259cde1a', 'name' => 'Hyundai Elantra', 'type' => 'Hybrid', 'year' => 2020, 'price' => '59,000', 'badge' => 'Eco-Friendly'],
        ] as $car)
        <div class="car-card bg-white rounded-2xl shadow-lg overflow-hidden group">
            <div class="relative overflow-hidden">
                <img src="{{ $car['img'] }}" alt="{{ $car['name'] }}" class="w-full h-64 object-cover">
                <div class="absolute top-4 left-4">
                    <span class="px-3 py-1 bg-gradient-to-r from-blue-600 to-purple-600 text-white text-sm font-semibold rounded-full">
                        {{ $car['badge'] }}
                    </span>
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition"></div>
            </div>
            <div class="p-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $car['name'] }}</h3>
                <div class="flex items-center gap-2 text-gray-500 mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    <span>{{ $car['type'] }}</span>
                    <span class="mx-2">•</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>{{ $car['year'] }}</span>
                </div>
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="text-sm text-gray-500">Starting from</div>
                        <div class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                            ${{ $car['price'] }}
                        </div>
                    </div>
                </div>
                <button class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 rounded-xl font-semibold hover:shadow-lg transform hover:scale-105 transition">
                    View Details
                </button>
            </div>
        </div>
        @endforeach
    </div>

    <div class="text-center mt-12">
        <a href="/cars" class="inline-flex items-center gap-2 px-8 py-4 bg-gray-900 text-white rounded-full font-semibold hover:bg-gray-800 transition">
            View All Vehicles
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</section>

<!-- ===== Why Choose Us ===== -->
<section class="bg-gradient-to-br from-gray-50 to-blue-50 py-16">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Why Choose KoreaCars?</h2>
            <p class="text-xl text-gray-600">Experience excellence in every aspect of your car buying journey</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-3">Quality Assured</h3>
                <p class="text-gray-600 leading-relaxed">Every vehicle undergoes comprehensive inspection and comes with detailed service history and warranty options.</p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-3">Competitive Pricing</h3>
                <p class="text-gray-600 leading-relaxed">Best market prices with transparent pricing, flexible financing options, and no hidden fees.</p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-3">Expert Support</h3>
                <p class="text-gray-600 leading-relaxed">Dedicated team of automotive experts ready to assist you throughout your entire buying journey.</p>
            </div>
        </div>
    </div>
</section>

<!-- ===== CTA Section ===== -->
<section class="container mx-auto px-4 py-16">
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl p-12 text-center text-white shadow-2xl">
        <h2 class="text-4xl font-bold mb-4">Ready to Find Your Dream Car?</h2>
        <p class="text-xl mb-8 text-blue-50">Browse our extensive collection of premium vehicles today</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/cars" class="px-8 py-4 bg-white text-blue-600 rounded-full font-semibold hover:shadow-2xl transform hover:scale-105 transition">
                Browse Inventory
            </a>
            <a href="/contact" class="px-8 py-4 bg-transparent border-2 border-white text-white rounded-full font-semibold hover:bg-white hover:text-blue-600 transition">
                Contact Us
            </a>
        </div>
    </div>
</section>
@endsection