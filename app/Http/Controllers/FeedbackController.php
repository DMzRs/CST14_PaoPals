<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        Feedback::create([
            'userId' => Auth::id() ?? null, // optional: null for guest
            'message' => $validated['message'],
            'createdAt' => now(),
        ]);

        return redirect()->back()->with('success', 'Thank you for your feedback!');
    }
}
