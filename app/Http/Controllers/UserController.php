<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // SHOW LOGIN FORM
    public function showLoginForm()
    {
        return view('userLogin');
    }

    // HANDLE LOGIN
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::where('email', $request->email)->first();

        // Check credentials WITHOUT logging in
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Invalid credentials.']);
        }

        // Generate OTP
        $otp = rand(100000, 999999);

        $user->update([
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        // Send email
        Mail::raw("Your PaoPals OTP code is: $otp (valid for 5 minutes)", function ($msg) use ($user) {
            $msg->to($user->email)
                ->subject('Your Login OTP Code');
        });

        // Store user ID ONLY (not logged in yet)
        session(['2fa_user_id' => $user->id]);

        return response()->json([
            'success' => true
        ]);
    }

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
            return response()->json(['error' => 'Invalid OTP'], 422);
        }

        if (now()->greaterThan($user->otp_expires_at)) {
            return response()->json(['error' => 'OTP expired'], 422);
        }

        // Clear OTP
        $user->update([
            'otp' => null,
            'otp_expires_at' => null,
        ]);

        // NOW log the user in
        Auth::login($user);

        session()->forget('2fa_user_id');

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

        return response()->json(['success' => true]);
    }

    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

     // show registration form
    public function showRegistrationForm()
    {
        return view('userRegister');
    }

    // handle user registration
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
        $validated['is_admin'] = false; // default to normal user

        User::create($validated);

        return redirect('/login');
    }

    // show user profile
    public function showProfile()
    {
        $user = Auth::user();

        // block admins from accessing user pages
        if (!$user || $user->is_admin) {
            abort(403);
        }

        return view('userProfilePage', compact('user'));
    }

    // update user profile
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // block admins from updating user profile
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

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }
}