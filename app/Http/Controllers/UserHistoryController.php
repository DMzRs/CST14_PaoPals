<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserHistoryController extends Controller
{
    public function orderHistory()
    {
        $userId = Auth::id();

        // Load all orders of the current user with items and products
        $orders = Order::with(['orderItems.product'])
                        ->where('userId', $userId)
                        ->orderBy('orderDate', 'desc')
                        ->get();

        return view('userHistory', compact('orders'));
    }
}
