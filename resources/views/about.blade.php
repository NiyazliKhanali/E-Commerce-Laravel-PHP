@extends('layouts.app')

@section('title', 'About Us - KoreaCars')

@section('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #60a5fa 100%);
    }
    
    .value-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .value-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.2);
    }
    
    .timeline-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(to bottom, #3b82f6, #60a5fa);
    }
</style>
@endsection

@section('content')
<!-- ===== Page Header ===== -->
<section class="page-header py-20 text-white">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold mb-4">About KoreaCars</h1>
        <p class="text-xl text-blue-100">Your trusted partner in premium automotive excellence</p>
    </div>
</section>

<!-- ===== Company Overview ===== -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-800 mb-6">Who We Are</h2>
                <p class="text-lg text-gray-600 leading-relaxed">
                    KoreaCars is a leading automotive dealership specializing in premium Korean vehicles. 
                    Founded in 2010, we have been connecting customers with their dream cars for over a decade. 
                    Our commitment to quality, transparency, and customer satisfaction has made us one of the 
                    most trusted names in the automotive industry.
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 mb-12">
                <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl p-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Our Mission</h3>
                    <p class="text-gray-600 leading-relaxed">
                        To provide exceptional automotive solutions by offering high-quality Korean vehicles, 
                        transparent pricing, and unparalleled customer service. We strive to make car buying 
                        a seamless and enjoyable experience for every customer.
                    </p>
                </div>

                <div class="bg-gradient-to-br from-purple-50 to-blue-50 rounded-2xl p-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Our Vision</h3>
                    <p class="text-gray-600 leading-relaxed">
                        To be the premier destination for Korean automotive excellence, recognized for our 
                        integrity, expertise, and dedication to customer satisfaction. We envision a future 
                        where every customer finds their perfect vehicle with confidence and ease.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== Core Values ===== -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Our Core Values</h2>
            <p class="text-lg text-gray-600">The principles that guide everything we do</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
            <div class="value-card bg-white rounded-2xl shadow-lg p-6 text-center">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Integrity</h3>
                <p class="text-gray-600">Honest and transparent in all our dealings</p>
            </div>

            <div class="value-card bg-white rounded-2xl shadow-lg p-6 text-center">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Excellence</h3>
                <p class="text-gray-600">Committed to the highest quality standards</p>
            </div>

            <div class="value-card bg-white rounded-2xl shadow-lg p-6 text-center">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Customer Focus</h3>
                <p class="text-gray-600">Your satisfaction is our top priority</p>
            </div>

            <div class="value-card bg-white rounded-2xl shadow-lg p-6 text-center">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Innovation</h3>
                <p class="text-gray-600">Embracing the latest automotive technology</p>
            </div>
        </div>
    </div>
</section>

<!-- ===== Company Timeline ===== -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Our Journey</h2>
            <p class="text-lg text-gray-600">Building trust and excellence since 2010</p>
        </div>

        <div class="max-w-4xl mx-auto">
            <div class="space-y-8">
                <div class="timeline-item relative pl-8 pb-8">
                    <div class="absolute left-0 top-0 w-4 h-4 bg-blue-600 rounded-full transform -translate-x-1"></div>
                    <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl p-6">
                        <div class="text-sm font-semibold text-blue-600 mb-2">2010</div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Company Founded</h3>
                        <p class="text-gray-600">KoreaCars was established with a vision to bring premium Korean vehicles to the market.</p>
                    </div>
                </div>

                <div class="timeline-item relative pl-8 pb-8">
                    <div class="absolute left-0 top-0 w-4 h-4 bg-blue-600 rounded-full transform -translate-x-1"></div>
                    <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl p-6">
                        <div class="text-sm font-semibold text-blue-600 mb-2">2013</div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Expanded Inventory</h3>
                        <p class="text-gray-600">Reached 500+ vehicles in our catalog, becoming a major player in the Korean automotive market.</p>
                    </div>
                </div>

                <div class="timeline-item relative pl-8 pb-8">
                    <div class="absolute left-0 top-0 w-4 h-4 bg-blue-600 rounded-full transform -translate-x-1"></div>
                    <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl p-6">
                        <div class="text-sm font-semibold text-blue-600 mb-2">2017</div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Digital Transformation</h3>
                        <p class="text-gray-600">Launched our online platform, making it easier for customers to browse and purchase vehicles.</p>
                    </div>
                </div>

                <div class="timeline-item relative pl-8">
                    <div class="absolute left-0 top-0 w-4 h-4 bg-blue-600 rounded-full transform -translate-x-1"></div>
                    <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl p-6">
                        <div class="text-sm font-semibold text-blue-600 mb-2">2024</div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Leading the Market</h3>
                        <p class="text-gray-600">Served over 10,000 satisfied customers and continue to grow as a trusted automotive partner.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== Stats Section ===== -->
<section class="py-16 bg-gradient-to-r from-blue-600 to-purple-600 text-white">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-4 gap-8 max-w-5xl mx-auto text-center">
            <div>
                <div class="text-5xl font-bold mb-2">15+</div>
                <div class="text-blue-100">Years Experience</div>
            </div>
            <div>
                <div class="text-5xl font-bold mb-2">10K+</div>
                <div class="text-blue-100">Happy Customers</div>
            </div>
            <div>
                <div class="text-5xl font-bold mb-2">500+</div>
                <div class="text-blue-100">Vehicles Available</div>
            </div>
            <div>
                <div class="text-5xl font-bold mb-2">98%</div>
                <div class="text-blue-100">Satisfaction Rate</div>
            </div>
        </div>
    </div>
</section>

<!-- ===== CTA Section ===== -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold text-gray-800 mb-6">Ready to Find Your Perfect Car?</h2>
        <p class="text-lg text-gray-600 mb-8">Explore our extensive collection of premium Korean vehicles</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('cars') }}" class="px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg font-bold text-lg hover:shadow-lg transform hover:scale-105 transition">
                Browse Vehicles
            </a>
            <a href="{{ route('contact') }}" class="px-8 py-4 bg-gray-100 text-gray-700 rounded-lg font-bold text-lg hover:bg-gray-200 transition">
                Contact Us
            </a>
        </div>
    </div>
</section>
@endsection