@extends('layouts.app')

@section('title', 'Admin Dashboard - KoreaCars')

@section('styles')
<style>
    .stat-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px -8px rgba(0, 0, 0, 0.15);
    }
    
    .action-btn {
        transition: all 0.3s ease;
    }
    
    .action-btn:hover {
        transform: scale(1.05);
    }
</style>
@endsection

@section('content')
<!-- ===== Header ===== -->
<section class="bg-gradient-to-r from-blue-600 to-purple-600 py-12 text-white">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-4xl font-bold mb-2">Admin Dashboard</h1>
                <p class="text-blue-100">Welcome back, Admin</p>
            </div>
            <div class="text-sm">
                <div class="bg-white/20 rounded-lg px-4 py-2">
                    <span class="font-semibold">Last Login:</span> {{ now()->format('M d, Y - H:i') }}
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== Statistics Cards ===== -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <!-- Total Vehicles -->
            <div class="stat-card bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-green-600 bg-green-100 px-2 py-1 rounded-full">Active</span>
                </div>
                <h3 class="text-gray-600 text-sm font-medium mb-1">Total Vehicles</h3>
                <p class="text-3xl font-bold text-gray-800">{{ $totalCars ?? 0 }}</p>
            </div>

            <!-- Total Users -->
            <div class="stat-card bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-blue-600 bg-blue-100 px-2 py-1 rounded-full">Users</span>
                </div>
                <h3 class="text-gray-600 text-sm font-medium mb-1">Total Users</h3>
                <p class="text-3xl font-bold text-gray-800">{{ $totalUsers ?? 0 }}</p>
            </div>

            <!-- Pending Inquiries -->
            <div class="stat-card bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-orange-600 bg-orange-100 px-2 py-1 rounded-full">Pending</span>
                </div>
                <h3 class="text-gray-600 text-sm font-medium mb-1">Inquiries</h3>
                <p class="text-3xl font-bold text-gray-800">{{ $pendingInquiries ?? 0 }}</p>
            </div>

            <!-- Recent Activity -->
            <div class="stat-card bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-gray-600 bg-gray-100 px-2 py-1 rounded-full">Today</span>
                </div>
                <h3 class="text-gray-600 text-sm font-medium mb-1">Views Today</h3>
                <p class="text-3xl font-bold text-gray-800">{{ $todayViews ?? 0 }}</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('admin.cars.create') }}" class="action-btn bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl p-6 text-center hover:shadow-lg">
                    <svg class="w-8 h-8 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <div class="font-semibold">Add New Vehicle</div>
                </a>

                <a href="{{ route('admin.cars.index') }}" class="action-btn bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-xl p-6 text-center hover:shadow-lg">
                    <svg class="w-8 h-8 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                    </svg>
                    <div class="font-semibold">Manage Vehicles</div>
                </a>

                <a href="{{ route('admin.users.index') }}" class="action-btn bg-gradient-to-r from-green-600 to-teal-600 text-white rounded-xl p-6 text-center hover:shadow-lg">
                    <svg class="w-8 h-8 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <div class="font-semibold">Manage Users</div>
                </a>

                <a href="{{ route('admin.settings') }}" class="action-btn bg-gradient-to-r from-orange-600 to-red-600 text-white rounded-xl p-6 text-center hover:shadow-lg">
                    <svg class="w-8 h-8 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <div class="font-semibold">Settings</div>
                </a>
            </div>
        </div>

        <!-- Recent Activity & Quick Stats -->
        <div class="grid lg:grid-cols-2 gap-8">
            <!-- Recent Vehicles -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Recent Vehicles</h2>
                    <a href="{{ route('admin.cars.index') }}" class="text-blue-600 hover:text-blue-700 font-semibold text-sm">View All →</a>
                </div>
                <div class="space-y-4">
                    @forelse($recentCars ?? [] as $car)
                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                        <img src="{{ asset('storage/' . ($car->images->first()->image_path ?? 'default-car.jpg')) }}" 
                             alt="{{ $car->model_name }}" 
                             class="w-16 h-16 object-cover rounded-lg">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800">{{ $car->model_name }}</h3>
                            <p class="text-sm text-gray-600">{{ $car->brand }} - {{ $car->year }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-blue-600">${{ number_format($car->price) }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8 text-gray-500">
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                        <p>No recent vehicles</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Recent Users -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Recent Users</h2>
                    <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:text-blue-700 font-semibold text-sm">View All →</a>
                </div>
                <div class="space-y-4">
                    @forelse($recentUsers ?? [] as $user)
                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800">{{ $user->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $user->email }}</p>
                        </div>
                        <div class="text-right">
                            <span class="text-xs px-2 py-1 bg-{{ $user->role == 'admin' ? 'purple' : 'blue' }}-100 text-{{ $user->role == 'admin' ? 'purple' : 'blue' }}-600 rounded-full font-semibold">
                                {{ ucfirst($user->role ?? 'user') }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8 text-gray-500">
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <p>No recent users</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
@endsection