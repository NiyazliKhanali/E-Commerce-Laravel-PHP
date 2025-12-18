@extends('layouts.app')

@section('title', 'Manage Users - Admin')

@section('styles')
<style>
    .user-row {
        transition: all 0.3s ease;
    }
    
    .user-row:hover {
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
                    <h1 class="text-4xl font-bold">Manage Users</h1>
                </div>
                <p class="text-blue-100">View and manage all registered users</p>
            </div>
        </div>
    </div>
</section>

<!-- ===== Search ===== -->
<section class="py-8 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <form action="{{ route('admin.users.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Search by name or email..." 
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
                <a href="{{ route('admin.users.index') }}" class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition">
                    Clear
                </a>
                @endif
            </form>
        </div>
    </div>
</section>

<!-- ===== Users List ===== -->
<section class="py-8 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <!-- Stats Header -->
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-purple-50">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">All Users</h2>
                        <p class="text-gray-600">{{ $users->total() }} users registered</p>
                    </div>
                    <div class="flex gap-2">
                        <span class="px-4 py-2 bg-purple-100 text-purple-700 rounded-lg font-semibold text-sm">
                            Admins: {{ $users->where('role', 'admin')->count() }}
                        </span>
                        <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg font-semibold text-sm">
                            Users: {{ $users->where('role', 'user')->count() }}
                        </span>
                    </div>
                </div>
            </div>

            @if($users->count())
            <!-- Table for larger screens -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">User</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Joined</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($users as $user)
                        <tr class="user-row">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800">{{ $user->name }}</h3>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-gray-700">{{ $user->email }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $user->role == 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                    {{ ucfirst($user->role ?? 'user') }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-600">{{ $user->created_at->format('M d, Y') }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" 
                                       class="action-btn p-2 text-green-600 hover:bg-green-50 rounded-lg transition"
                                       title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this user?')">
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
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Cards for mobile screens -->
            <div class="lg:hidden divide-y divide-gray-200">
                @foreach($users as $user)
                <div class="p-6 hover:bg-gray-50 transition">
                    <div class="flex gap-4 mb-4">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xl flex-shrink-0">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-gray-800 text-lg mb-1">{{ $user->name }}</h3>
                            <p class="text-sm text-gray-600 mb-2">{{ $user->email }}</p>
                            <div class="flex items-center gap-2">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $user->role == 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                    {{ ucfirst($user->role ?? 'user') }}
                                </span>
                                <span class="text-xs text-gray-500">Joined {{ $user->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-2 pt-4 border-t border-gray-200">
                        <a href="{{ route('admin.users.edit', $user->id) }}" 
                           class="flex-1 px-4 py-2 bg-green-50 text-green-600 rounded-lg font-semibold text-center hover:bg-green-100 transition">
                            Edit
                        </a>
                        @if($user->id !== auth()->id())
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this user?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full px-4 py-2 bg-red-50 text-red-600 rounded-lg font-semibold hover:bg-red-100 transition">
                                Delete
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="p-6 border-t border-gray-200">
                {{ $users->links() }}
            </div>

            @else
            <!-- Empty State -->
            <div class="p-12 text-center">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">No users found</h3>
                <p class="text-gray-600 mb-6">
                    @if(request('search'))
                        No users match your search criteria
                    @else
                        No users registered yet
                    @endif
                </p>
                @if(request('search'))
                <a href="{{ route('admin.users.index') }}" class="inline-block px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg font-semibold hover:shadow-lg transition">
                    Clear Search
                </a>
                @endif
            </div>
            @endif
        </div>
    </div>
</section>
@endsection