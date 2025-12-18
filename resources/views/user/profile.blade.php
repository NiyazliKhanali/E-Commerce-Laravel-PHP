@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12">
    <div class="container mx-auto px-4 lg:px-8 max-w-4xl">
        
        <!-- Success Message -->
        @if(session('success'))
        <div class="mb-6 px-6 py-4 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            {{ session('success') }}
        </div>
        @endif

        <!-- Error Messages -->
        @if($errors->any())
        <div class="mb-6 px-6 py-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
            <div class="flex items-start">
                <svg class="w-5 h-5 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <p class="font-semibold mb-1">Please fix the following errors:</p>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif
        <!-- Profile Header -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6">
            <div class="h-32 bg-gradient-to-r from-blue-600 to-purple-600"></div>
            <div class="px-8 pb-8">
                <div class="flex flex-col items-center -mt-16">
                    <!-- Avatar -->
                    <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center shadow-xl border-4 border-white">
                        <div class="w-28 h-28 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                            <span class="text-4xl font-bold text-white">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                        </div>
                    </div>
                    
                    <h1 class="text-3xl font-bold text-gray-800 mt-4">{{ $user->name }}</h1>
                    <p class="text-gray-600">{{ $user->email }}</p>
                    <div class="mt-4 flex items-center space-x-2 text-sm text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Member since {{ $user->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            
            <!-- Profile Information -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Profile Information</h2>
                    <button onclick="toggleEdit('profile')" class="text-blue-600 hover:text-blue-700 font-semibold text-sm">
                        Edit
                    </button>
                </div>

                <!-- View Mode -->
                <div id="profileView" class="space-y-4">
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Full Name</label>
                        <p class="text-gray-800 text-lg">{{ $user->name }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Email Address</label>
                        <p class="text-gray-800 text-lg">{{ $user->email }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Phone Number</label>
                        <p class="text-gray-800 text-lg">{{ $user->phone ?? 'Not provided' }}</p>
                    </div>
                </div>

                <!-- Edit Mode -->
                <form id="profileEdit" action="{{ route('user.updateProfile') }}" method="POST" class="hidden space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                        <input type="text" name="name" value="{{ $user->name }}" required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                        <input type="email" name="email" value="{{ $user->email }}" required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                        <input type="text" name="phone" value="{{ $user->phone }}" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button type="submit" class="flex-1 px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg font-semibold hover:shadow-lg transition">
                            Save Changes
                        </button>
                        <button type="button" onclick="toggleEdit('profile')" class="px-6 py-2.5 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>

            <!-- Change Password -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Change Password</h2>
                    <button onclick="toggleEdit('password')" class="text-blue-600 hover:text-blue-700 font-semibold text-sm">
                        Change
                    </button>
                </div>

                <!-- View Mode -->
                <div id="passwordView" class="space-y-4">
                    <div class="flex items-center space-x-3 text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <div>
                            <p class="font-semibold">Password</p>
                            <p class="text-sm text-gray-500">••••••••••</p>
                        </div>
                    </div>
                </div>

                <!-- Edit Mode -->
                <form id="passwordEdit" action="{{ route('user.updatePassword') }}" method="POST" class="hidden space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Current Password</label>
                        <input type="password" name="current_password" required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('current_password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">New Password</label>
                        <input type="password" name="password" required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Confirm New Password</label>
                        <input type="password" name="password_confirmation" required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button type="submit" class="flex-1 px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg font-semibold hover:shadow-lg transition">
                            Update Password
                        </button>
                        <button type="button" onclick="toggleEdit('password')" class="px-6 py-2.5 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>

        </div>

        <!-- Quick Actions -->
        <div class="grid md:grid-cols-3 gap-6 mt-6">
            <a href="{{ route('user.liked') }}" class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition group">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-red-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800">Liked Cars</h3>
                        <p class="text-sm text-gray-600">View favorites</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('cars') }}" class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition group">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                            <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800">Browse Cars</h3>
                        <p class="text-sm text-gray-600">View catalogue</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('contact') }}" class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition group">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-teal-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800">Contact Us</h3>
                        <p class="text-sm text-gray-600">Get support</p>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>

<script>
    function toggleEdit(section) {
        if (section === 'profile') {
            document.getElementById('profileView').classList.toggle('hidden');
            document.getElementById('profileEdit').classList.toggle('hidden');
        } else if (section === 'password') {
            document.getElementById('passwordView').classList.toggle('hidden');
            document.getElementById('passwordEdit').classList.toggle('hidden');
        }
    }

    // Keep password form open if there are password errors
    @if($errors->has('current_password') || $errors->has('password'))
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('passwordView').classList.add('hidden');
            document.getElementById('passwordEdit').classList.remove('hidden');
        });
    @endif

    // Keep profile form open if there are profile errors
    @if($errors->has('name') || $errors->has('email') || $errors->has('phone'))
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('profileView').classList.add('hidden');
            document.getElementById('profileEdit').classList.remove('hidden');
        });
    @endif
</script>
@endsection