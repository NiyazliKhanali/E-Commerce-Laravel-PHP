@extends('layouts.app')

@section('title', 'Verify Email')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-purple-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        
        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-8 py-6 text-center">
                <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-white">Verify Your Email</h2>
                <p class="text-blue-100 mt-2">We've sent a 6-digit code to your email</p>
            </div>

            <!-- Body -->
            <div class="px-8 py-8">
                
                <!-- Success Message -->
                @if(session('success'))
                <div class="mb-6 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('success') }}
                </div>
                @endif

                <!-- Error Messages -->
                @if($errors->any())
                <div class="mb-6 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <p class="text-gray-600 text-center mb-6">
                    Enter the verification code below to complete your registration
                </p>

                <!-- Verification Form -->
                <form method="POST" action="{{ route('register.verify') }}">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2 text-center">
                            Verification Code
                        </label>
                        <input 
                            type="text" 
                            name="verification_code" 
                            maxlength="6"
                            pattern="[0-9]{6}"
                            placeholder="000000"
                            required
                            autofocus
                            class="w-full px-4 py-3 text-center text-2xl font-bold tracking-widest border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('verification_code') border-red-500 @enderror"
                        >
                        @error('verification_code')
                            <p class="text-red-500 text-sm mt-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>

                    <button 
                        type="submit" 
                        class="w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg font-semibold hover:shadow-lg transform hover:scale-105 transition"
                    >
                        Verify Email
                    </button>
                </form>

                <!-- Resend Code -->
                <div class="mt-6 text-center">
                    <p class="text-gray-600 mb-3">Didn't receive the code?</p>
                    <form method="POST" action="{{ route('register.resend') }}">
                        @csrf
                        <button 
                            type="submit" 
                            class="text-blue-600 hover:text-blue-700 font-semibold underline"
                        >
                            Resend Verification Code
                        </button>
                    </form>
                </div>

                <!-- Back to Register -->
                <div class="mt-6 text-center">
                    <a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-800 text-sm">
                        ← Back to Registration
                    </a>
                </div>

                <!-- Timer Info -->
                <div class="mt-6 px-4 py-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-yellow-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm text-yellow-800">
                            <strong>Note:</strong> Your verification code will expire in 10 minutes. If it expires, you'll need to request a new one.
                        </p>
                    </div>
                </div>

            </div>
        </div>

        <!-- Help Text -->
        <div class="mt-6 text-center">
            <p class="text-gray-600 text-sm">
                Need help? <a href="{{ route('contact') }}" class="text-blue-600 hover:text-blue-700 font-semibold">Contact Support</a>
            </p>
        </div>

    </div>
</div>

<script>
// Auto-focus and format input
document.addEventListener('DOMContentLoaded', function() {
    const input = document.querySelector('input[name="verification_code"]');
    
    // Only allow numbers
    input.addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    
    // Auto-submit when 6 digits entered (optional)
    input.addEventListener('input', function(e) {
        if (this.value.length === 6) {
            // Optional: auto-submit
            // this.form.submit();
        }
    });
});
</script>
@endsection