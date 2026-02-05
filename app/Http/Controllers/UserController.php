<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function showLoginForm()
    {
        return view('userLogin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Check if admin
        $admin = Admin::where('email', $request->email)->first();
        if ($admin && Hash::check($request->password, $admin->password)) {
            Auth::guard('admin')->login($admin);
            return redirect('/adminDashboard');
        }

        // Otherwise, check normal user
        if (Auth::attempt($request->only('email','password'))) {
            return redirect('/');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

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

        User::create($validated);
        return redirect('/login');
    }

    public function showRegistrationForm()
    {
        return view('userRegister');
    }

    public function showProfile()
    {
        $user = Auth::user();
        return view('userProfilePage', compact('user'));
    }
    
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'firstName' => 'sometimes|required|string|max:50',
            'lastName' => 'sometimes|required|string|max:50',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'contactNumber' => 'sometimes|required|string|max:11',
            'address' => 'sometimes|required|string|max:500',
            'oldPassword' => 'sometimes|nullable|min:8',
            'newPassword' => 'sometimes|nullable|min:8|different:password',
        ]);

        if (isset($validated['newPassword'])) {
            $validated['password'] = bcrypt($validated['newPassword']);
            unset($validated['newPassword']);
        }

        $user->update($validated);

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }



    // Additional methods for admin functionalities can be added here
    public function showAdminDashboard()
    {
        $admin = Auth::guard('admin')->user(); // gets currently logged-in admin
        return view('adminDashboard', compact('admin'));
    }

    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
