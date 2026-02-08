<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // show login form
    public function showLoginForm()
    {
        return view('userLogin');
    }

    // handle login for both users and admins
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            // redirect based on role
            if ($user->is_admin) {
                return redirect('/adminDashboard');
            }

            return redirect('/');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    // handle logout (both admin and user)
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
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

    // show registration form
    public function showRegistrationForm()
    {
        return view('userRegister');
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

    // show admin dashboard
    public function showAdminDashboard()
    {
        $user = Auth::user();

        // block normal users from accessing admin dashboard
        if (!$user || !$user->is_admin) {
            abort(403);
        }

        return view('adminDashboard', compact('user'));
    }
}
