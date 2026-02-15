<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class AdminFeedbackController extends Controller
{
    public function index()
    {
        // Get all feedback messages with user info (if available)
        $feedbacks = Feedback::with('user')->orderBy('createdAt', 'desc')->get();

        return view('adminFeedbackPage', compact('feedbacks'));
    }
}
