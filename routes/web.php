<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Car\CarController;
use App\Http\Controllers\Car\CarImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Models\User;

// ============================================
// PUBLIC ROUTES
// ============================================

// Home
Route::get('/', function () {
    return view('home');
})->name('home');

// Car Catalogue
Route::resource('cars', CarController::class)->names([
    'index' => 'cars',
    'show' => 'cars.show',
]);

// Car Images
Route::get('/cars/{carId}/images', [CarImageController::class, 'index'])->name('car_images.index');

// About Us
Route::get('/about', function () {
    return view('about');
})->name('about');

// Contact
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// ============================================
// AUTHENTICATION ROUTES
// ============================================

Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    
    // Register
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    
    // Verification
    Route::get('/register/verify', [RegisterController::class, 'showVerificationForm'])->name('register.verify.show');
    Route::post('/register/verify', [RegisterController::class, 'verifyCode'])->name('register.verify');
    Route::post('/register/resend', [RegisterController::class, 'resendCode'])->name('register.resend');
});

// Logout (requires authentication)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// ============================================
// USER ROUTES
// ============================================

Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('/liked', [UserController::class, 'liked'])->name('liked');
    Route::post('/like/{carId}', [UserController::class, 'toggleLike'])->name('like');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('updateProfile');
    Route::put('/password/update', [UserController::class, 'updatePassword'])->name('updatePassword');
});

// ============================================
// ADMIN ROUTES
// ============================================

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Cars Management
    Route::get('/cars', [AdminController::class, 'carsIndex'])->name('cars.index');
    Route::get('/cars/create', [AdminController::class, 'carsCreate'])->name('cars.create');
    Route::post('/cars', [AdminController::class, 'carsStore'])->name('cars.store');
    Route::get('/cars/{id}/edit', [AdminController::class, 'carsEdit'])->name('cars.edit');
    Route::put('/cars/{id}', [AdminController::class, 'carsUpdate'])->name('cars.update');
    Route::delete('/cars/{id}', [AdminController::class, 'carsDestroy'])->name('cars.destroy');
    Route::delete('/cars/images/{id}', [AdminController::class, 'deleteImage'])->name('cars.images.destroy');
    
    // Users Management
    Route::get('/users', [AdminController::class, 'usersIndex'])->name('users.index');
    Route::get('/users/{id}/edit', [AdminController::class, 'usersEdit'])->name('users.edit');
    Route::delete('/users/{id}', [AdminController::class, 'usersDestroy'])->name('users.destroy');
    Route::get('/users/{id}/edit', [AdminController::class, 'usersEdit'])->name('users.edit');
    
    // Settings
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::put('/settings/profile', [AdminController::class, 'updateProfile'])->name('settings.profile');
    Route::put('/settings/password', [AdminController::class, 'updatePassword'])->name('settings.password');
    Route::put('/settings/site', [AdminController::class, 'updateSite'])->name('settings.site');
    Route::put('/settings/notifications', [AdminController::class, 'updateNotifications'])->name('settings.notifications');
});

Route::get('/test-mail', function () {
    try {
        Mail::raw('Test email working!', function ($message) {
            $message->to('your_gmail@gmail.com')->subject('Test');
        });
        return 'Mail sent';
    } catch (\Exception $e) {
        return $e->getMessage();
    }
});
