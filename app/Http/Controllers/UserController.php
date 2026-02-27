<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Helpers\ActivityLogger; // ⭐ ADD THIS

class UserController extends Controller
{
    // SHOW LOGIN FORM
    public function showLoginForm()
    {
        return view('userLogin');
    }

    // HANDLE LOGIN (Step 1 — Password check)
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {

            ActivityLogger::log(
                'Login Failed',
                'Invalid credentials attempt for email: ' . $request->email
            );

            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'Invalid email or password'
                ], 401);
            }

            return back()->withErrors(['email' => 'Invalid credentials.']);
        }

        // Generate OTP
        $otp = rand(100000, 999999);

        $user->update([
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        Mail::raw("Your PaoPals OTP code is: $otp (valid for 5 minutes)", function ($msg) use ($user) {
            $msg->to($user->email)
                ->subject('Your Login OTP Code');
        });

        session(['2fa_user_id' => $user->id]);

        ActivityLogger::log(
            'OTP Sent',
            'OTP sent to user: ' . $user->email
        );

        return response()->json([
            'success' => true
        ]);
    }

    // VERIFY OTP (Step 2 — Actual Login)
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6'
        ]);

        $user = User::find(session('2fa_user_id'));

        if (!$user) {
            return response()->json(['error' => 'Session expired'], 401);
        }

        if ($user->otp !== $request->otp) {

            ActivityLogger::log(
                'OTP Failed',
                'Invalid OTP attempt for user: ' . $user->email
            );

            return response()->json(['error' => 'Invalid OTP'], 422);
        }

        if (now()->greaterThan($user->otp_expires_at)) {

            ActivityLogger::log(
                'OTP Expired',
                'Expired OTP used by user: ' . $user->email
            );

            return response()->json(['error' => 'OTP expired'], 422);
        }

        // Clear OTP
        $user->update([
            'otp' => null,
            'otp_expires_at' => null,
        ]);

        // LOGIN USER
        Auth::login($user);
        session()->forget('2fa_user_id');

        ActivityLogger::log(
            'User Login',
            'User logged in successfully: ' . $user->email
        );

        return response()->json([
            'redirect' => $user->is_admin ? '/adminDashboard' : '/'
        ]);
    }

    // RESEND OTP
    public function resendOtp()
    {
        $user = User::find(session('2fa_user_id'));

        if (!$user) {
            return response()->json(['error' => 'Session expired'], 401);
        }

        $otp = rand(100000, 999999);

        $user->update([
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        Mail::raw("Your new OTP code is: $otp", function ($msg) use ($user) {
            $msg->to($user->email)
                ->subject('New OTP Code');
        });

        ActivityLogger::log(
            'OTP Resent',
            'OTP resent to user: ' . $user->email
        );

        return response()->json(['success' => true]);
    }

    // LOGOUT
    public function logout(Request $request)
    {
        ActivityLogger::log(
            'User Logout',
            'User logged out'
        );

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // SHOW REGISTRATION FORM
    public function showRegistrationForm()
    {
        return view('userRegister');
    }

    // REGISTER USER
    public function register(Request $request)
    {
        $validated = $request->validate([
            'firstName' => 'sometimes|required|string|max:50',
            'lastName' => 'sometimes|required|string|max:50',
            'email' => 'sometimes|required|email|unique:users,email',
            'contactNumber' => 'sometimes|required|string|max:11',
            'address' => 'sometimes|required|string|max:500',
            'password' => 'sometimes|required|min:8',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['is_admin'] = false;

        $user = User::create($validated);

        ActivityLogger::log(
            'User Registered',
            'New user registered: ' . $user->email
        );

        return redirect('/login');
    }

    // SHOW PROFILE
    public function showProfile()
    {
        $user = Auth::user();

        if (!$user || $user->is_admin) {
            abort(403);
        }

        return view('userProfilePage', compact('user'));
    }

    // UPDATE PROFILE
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        if (!$user || $user->is_admin) {
            abort(403);
        }

        $validated = $request->validate([
            'firstName' => 'sometimes|required|string|max:50',
            'lastName' => 'sometimes|required|string|max:50',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'contactNumber' => 'sometimes|required|string|max:11',
            'address' => 'sometimes|required|string|max:500',
            'oldPassword' => 'sometimes|nullable|min:8',
            'newPassword' => 'sometimes|nullable|min:8',
        ]);

        if (!empty($validated['newPassword'])) {
            $validated['password'] = Hash::make($validated['newPassword']);
            unset($validated['newPassword']);
        }

        $user->update($validated);

        ActivityLogger::log(
            'Profile Updated',
            'User updated profile: ' . $user->email
        );

        return redirect()->route('profile')
            ->with('success', 'Profile updated successfully.');
    }
}