@extends('layouts.app')

@section('title', $car->brand . ' ' . $car->model_name . ' - KoreaCars')

@section('styles')
<style>
    .thumbnail {
        transition: all 0.3s ease;
    }
    
    .thumbnail:hover {
        transform: scale(1.05);
    }
    
    .spec-item {
        transition: all 0.3s ease;
    }
    
    .spec-item:hover {
        background: #f3f4f6;
        transform: translateX(4px);
    }
</style>
@endsection

@section('content')
<div class="bg-gray-50 py-8 md:py-12">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Breadcrumb -->
        <nav class="mb-6 md:mb-8 flex items-center gap-2 text-sm text-gray-600">
            <a href="/" class="hover:text-blue-600 transition">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="{{ route('cars') }}" class="hover:text-blue-600 transition">Catalogue</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-gray-900 font-medium truncate">{{ $car->model_name }}</span>
        </nav>

        <div class="bg-white shadow-2xl rounded-2xl md:rounded-3xl overflow-hidden">
            <div class="grid lg:grid-cols-2 gap-0">

                {{-- Image Gallery Section --}}
                <div class="p-4 md:p-8"
                     x-data="{
                        index: 0,
                        open: false,
                        images: {{ json_encode($car->images->pluck('image_path')->values()) }}
                     }">

                    {{-- Main Image --}}
                    <div class="relative mb-4 md:mb-6 group">
                        <img :src="'/storage/' + images[index]"
                             class="w-full h-64 md:h-96 object-cover rounded-xl md:rounded-2xl cursor-pointer shadow-lg"
                             @click="open = true"
                             alt="Car image">

                        {{-- Image Counter Badge --}}
                        <div class="absolute top-3 md:top-4 right-3 md:right-4 px-3 md:px-4 py-1.5 md:py-2 bg-black/50 backdrop-blur-sm text-white rounded-full text-xs md:text-sm font-semibold">
                            <span x-text="index + 1"></span> / <span x-text="images.length"></span>
                        </div>

                        {{-- Navigation Arrows --}}
                        <button @click="index = (index === 0) ? images.length - 1 : index - 1"
                                class="absolute left-2 md:left-4 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white text-gray-800 p-2 md:p-3 rounded-full shadow-lg transform hover:scale-110 transition">
                            <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>

                        <button @click="index = (index === images.length - 1) ? 0 : index + 1"
                                class="absolute right-2 md:right-4 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white text-gray-800 p-2 md:p-3 rounded-full shadow-lg transform hover:scale-110 transition">
                            <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>

                        {{-- Expand Icon --}}
                        <div class="absolute bottom-3 md:bottom-4 right-3 md:right-4 px-3 md:px-4 py-1.5 md:py-2 bg-white/90 backdrop-blur-sm rounded-full text-gray-800 text-xs md:text-sm font-semibold opacity-0 group-hover:opacity-100 transition flex items-center gap-1">
                            <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                            </svg>
                            <span class="hidden md:inline">Expand</span>
                        </div>
                    </div>

                    {{-- Thumbnails --}}
                    <div class="flex gap-2 md:gap-3 overflow-x-auto pb-2 scrollbar-hide">
                        <template x-for="(img, i) in images" :key="i">
                            <img :src="'/storage/' + img"
                                 class="thumbnail w-20 h-16 md:w-24 md:h-20 rounded-lg md:rounded-xl object-cover cursor-pointer border-2 md:border-3 flex-shrink-0"
                                 :class="i === index ? 'border-blue-600 ring-2 ring-blue-600' : 'border-gray-200'"
                                 @click="index = i"
                                 alt="Thumbnail">
                        </template>
                    </div>

                    {{-- Lightbox --}}
                    <div x-show="open"
                         x-transition
                         class="fixed inset-0 bg-black/95 flex items-center justify-center z-50"
                         @click.self="open = false"
                         @keydown.escape.window="open = false">
                         
                        {{-- Close Button --}}
                        <button @click="open = false"
                                class="absolute top-4 md:top-6 right-4 md:right-6 text-white hover:text-gray-300 transition z-10">
                            <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>

                        {{-- Image Counter --}}
                        <div class="absolute top-4 md:top-6 left-1/2 transform -translate-x-1/2 px-4 md:px-6 py-2 md:py-3 bg-white/10 backdrop-blur-md text-white rounded-full text-base md:text-lg font-semibold z-10">
                            <span x-text="index + 1"></span> / <span x-text="images.length"></span>
                        </div>

                        {{-- Left Arrow --}}
                        <button @click="index = (index === 0) ? images.length - 1 : index - 1"
                                class="absolute left-2 md:left-6 top-1/2 -translate-y-1/2 bg-white/10 backdrop-blur-md hover:bg-white/20 text-white p-3 md:p-4 rounded-full z-10">
                            <svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>

                        <img :src="'/storage/' + images[index]"
                             class="max-h-[85vh] max-w-[90vw] rounded-xl md:rounded-2xl shadow-2xl"
                             alt="Full size image">

                        {{-- Right Arrow --}}
                        <button @click="index = (index === images.length - 1) ? 0 : index + 1"
                                class="absolute right-2 md:right-6 top-1/2 -translate-y-1/2 bg-white/10 backdrop-blur-md hover:bg-white/20 text-white p-3 md:p-4 rounded-full z-10">
                            <svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Details Section --}}
                <div class="p-6 md:p-8 flex flex-col bg-gray-50 lg:bg-white">
                    {{-- Header --}}
                    <div class="mb-4 md:mb-6">
                        <div class="flex flex-wrap items-center gap-2 md:gap-3 mb-3">
                            <span class="px-3 md:px-4 py-1 md:py-1.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white text-xs md:text-sm font-semibold rounded-full">
                                {{ $car->category }}
                            </span>
                            @if($car->year >= 2022)
                            <span class="px-3 md:px-4 py-1 md:py-1.5 bg-green-500 text-white text-xs md:text-sm font-semibold rounded-full">
                                New Arrival
                            </span>
                            @endif
                        </div>
                        
                        <h1 class="text-2xl md:text-4xl font-bold text-gray-900 mb-2">
                            {{ $car->brand }} {{ $car->model_name }}
                        </h1>

                        <div class="flex items-center gap-2 text-sm md:text-base text-gray-600">
                            <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="font-medium">{{ $car->year }}</span>
                        </div>
                    </div>

                    {{-- Price --}}
                    <div class="mb-6 md:mb-8 p-4 md:p-6 bg-gradient-to-br from-blue-50 to-purple-50 rounded-xl md:rounded-2xl">
                        <div class="text-xs md:text-sm text-gray-600 mb-1">Price</div>
                        <div class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                            ${{ number_format($car->price) }}
                        </div>
                    </div>

                    {{-- Key Specifications --}}
                    <div class="mb-6 md:mb-8">
                        <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-3 md:mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            Specifications
                        </h3>
                        <div class="space-y-2 md:space-y-3">
                            <div class="spec-item flex items-center justify-between p-3 md:p-4 bg-white lg:bg-gray-50 rounded-lg md:rounded-xl">
                                <span class="text-sm md:text-base text-gray-600 font-medium">Color</span>
                                <span class="text-sm md:text-base font-semibold text-gray-900">{{ ucfirst($car->color) }}</span>
                            </div>
                            <div class="spec-item flex items-center justify-between p-3 md:p-4 bg-white lg:bg-gray-50 rounded-lg md:rounded-xl">
                                <span class="text-sm md:text-base text-gray-600 font-medium">Engine</span>
                                <span class="text-sm md:text-base font-semibold text-gray-900">{{ $car->engine_type }} ({{ $car->horsepower }} HP)</span>
                            </div>
                            <div class="spec-item flex items-center justify-between p-3 md:p-4 bg-white lg:bg-gray-50 rounded-lg md:rounded-xl">
                                <span class="text-sm md:text-base text-gray-600 font-medium">Transmission</span>
                                <span class="text-sm md:text-base font-semibold text-gray-900">{{ $car->transmission }}</span>
                            </div>
                            <div class="spec-item flex items-center justify-between p-3 md:p-4 bg-white lg:bg-gray-50 rounded-lg md:rounded-xl">
                                <span class="text-sm md:text-base text-gray-600 font-medium">Fuel Type</span>
                                <span class="text-sm md:text-base font-semibold text-gray-900">{{ $car->fuel_type }}</span>
                            </div>
                            <div class="spec-item flex items-center justify-between p-3 md:p-4 bg-white lg:bg-gray-50 rounded-lg md:rounded-xl">
                                <span class="text-sm md:text-base text-gray-600 font-medium">Mileage</span>
                                <span class="text-sm md:text-base font-semibold text-gray-900">{{ number_format($car->mileage) }} km</span>
                            </div>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="mb-6 md:mb-8">
                        <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-2 md:mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                            </svg>
                            Description
                        </h3>
                        <p class="text-sm md:text-base text-gray-600 leading-relaxed">{{ $car->description }}</p>
                    </div>

                    {{-- Replaced Parts --}}
                    @if(!empty($car->replaced_parts))
                        @php $replaced = explode(',', $car->replaced_parts); @endphp
                        <div class="mb-6 md:mb-8">
                            <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-2 md:mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Replaced Parts
                            </h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($replaced as $part)
                                    <span class="px-3 md:px-4 py-1.5 md:py-2 bg-gradient-to-r from-yellow-50 to-orange-50 text-yellow-800 text-xs md:text-sm font-medium rounded-full border border-yellow-200">
                                        {{ ucfirst(trim($part)) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Repainted Parts --}}
                    @if(!empty($car->repainted_parts))
                        @php $repainted = explode(',', $car->repainted_parts); @endphp
                        <div class="mb-6 md:mb-8">
                            <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-2 md:mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                                </svg>
                                Repainted Parts
                            </h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($repainted as $part)
                                    <span class="px-3 md:px-4 py-1.5 md:py-2 bg-gradient-to-r from-blue-50 to-indigo-50 text-blue-800 text-xs md:text-sm font-medium rounded-full border border-blue-200">
                                        {{ ucfirst(trim($part)) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Action Buttons --}}
                    <div class="mt-auto pt-4 md:pt-6 space-y-3">
                        <button class="w-full px-6 py-3 md:py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white text-base md:text-lg rounded-xl font-semibold hover:shadow-xl transform hover:scale-105 transition">
                            Contact Seller
                        </button>
                        <a href="{{ route('cars') }}"
                           class="block w-full px-6 py-3 md:py-4 bg-white lg:bg-gray-100 text-gray-700 text-center text-base md:text-lg rounded-xl font-semibold hover:bg-gray-200 transition border lg:border-0">
                            ← Back to Listings
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection