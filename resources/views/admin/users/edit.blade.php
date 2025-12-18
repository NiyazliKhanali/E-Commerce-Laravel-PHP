@extends('layouts.app')

@section('title', 'Edit User - Admin')

@section('content')
<div class="container mx-auto px-4 py-12">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-2">
            Edit User
        </h1>
        <p class="text-gray-600">Update user information and permissions</p>
    </div>

    <!-- Edit Form -->
    <div class="bg-white rounded-xl shadow-lg p-8 max-w-2xl">
        <form method="POST" action="{{ route('admin.users.edit', $user->id) }}">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Name</label>
                <input type="text" 
                       name="name" 
                       value="{{ old('name', $user->name) }}" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Email</label>
                <input type="email" 
                       name="email" 
                       value="{{ old('email', $user->email) }}" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Phone</label>
                <input type="text" 
                       name="phone" 
                       value="{{ old('phone', $user->phone) }}" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Password</label>
                <input type="password" 
                       name="password" 
                       placeholder="Leave blank to keep current password"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="text-gray-500 text-sm mt-1">Only fill if you want to change the password</p>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Admin Status -->
            <div class="mb-6">
                <label class="flex items-center space-x-3 cursor-pointer">
                    <input type="checkbox" 
                           name="is_admin" 
                           value="1"
                           {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}
                           class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <span class="text-gray-700 font-semibold">Admin User</span>
                </label>
            </div>

            <!-- Buttons -->
            <div class="flex items-center space-x-4">
                <button type="submit" 
                        class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg font-semibold hover:shadow-lg transform hover:scale-105 transition">
                    Update User
                </button>
                <a href="{{ route('admin.dashboard') }}" 
                   class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection