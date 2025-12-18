<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\VerificationCodeMail;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Show the registration form
     */
    public function showRegistrationForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.register');
    }

    /**
     * Handle registration request - Step 1: Send verification code
     */
    public function register(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|min:6|confirmed',
        ]);

        // Generate 6-digit verification code
        $verificationCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Create user but don't verify yet
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'verification_code' => $verificationCode,
            'verification_code_expires_at' => now()->addMinutes(10),
            'is_verified' => false,
        ]);

        // Send verification email
        try {
            Mail::to($user->email)->send(new VerificationCodeMail($verificationCode, $user->name));
        } catch (\Exception $e) {
            // If email fails, delete the user and show error
            $user->delete();
            return back()->withErrors(['email' => 'Mail error: ' . $e->getMessage()])
                        ->withInput();
        }

        // Store user ID in session for verification
        session(['verification_user_id' => $user->id]);

        return redirect()->route('register.verify.show')
                        ->with('success', 'Registration successful! Please check your email for the verification code.');
    }

    /**
     * Show verification code form
     */
    public function showVerificationForm()
    {
        if (!session('verification_user_id')) {
            return redirect()->route('register')->withErrors(['error' => 'Please register first.']);
        }

        return view('auth.verify');
    }

    /**
     * Verify the code
     */
    public function verifyCode(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|string|size:6',
        ]);

        $userId = session('verification_user_id');
        
        if (!$userId) {
            return redirect()->route('register')->withErrors(['error' => 'Session expired. Please register again.']);
        }

        $user = User::find($userId);

        if (!$user) {
            return back()->withErrors(['verification_code' => 'User not found. Please register again.']);
        }

        // Check if code is expired
        if ($user->verification_code_expires_at < now()) {
            return back()->withErrors(['verification_code' => 'Verification code has expired. Please request a new one.']);
        }

        // Check if code matches
        if ($user->verification_code !== $request->verification_code) {
            return back()->withErrors(['verification_code' => 'Invalid verification code. Please try again.']);
        }

        // Verify user
        $user->update([
            'is_verified' => true,
            'verification_code' => null,
            'verification_code_expires_at' => null,
            'email_verified_at' => now(),
        ]);

        // Clear session
        session()->forget('verification_user_id');

        // Log user in
        Auth::login($user);

        return redirect()->route('home')->with('success', 'Email verified successfully! Welcome, ' . $user->name . '!');
    }

    /**
     * Resend verification code
     */
    public function resendCode()
    {
        $userId = session('verification_user_id');

        if (!$userId) {
            return redirect()->route('register')->withErrors(['error' => 'Session expired. Please register again.']);
        }

        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('register')->withErrors(['error' => 'User not found. Please register again.']);
        }

        // Generate new code
        $verificationCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $user->update([
            'verification_code' => $verificationCode,
            'verification_code_expires_at' => now()->addMinutes(10),
        ]);

        // Send new email
        try {
            Mail::to($user->email)->send(new VerificationCodeMail($verificationCode, $user->name));
            return back()->with('success', 'Verification code resent! Please check your email.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to resend email. Please try again.']);
        }
    }
}