<?php

namespace App\Http\Controllers;
use App\Models\User;
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
         $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:8',
    ]);

    // Attempt to log the user in
    if (Auth::attempt($credentials)) {
        // Regenerate session to prevent fixation
        $request->session()->regenerate();

        return redirect()->intended('/'); // redirect to home or intended page
    }

    // Login failed
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');

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
}
