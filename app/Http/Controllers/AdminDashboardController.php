<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Sales;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // block normal users from accessing admin dashboard
        if (!$user || !$user->is_admin) {
            abort(403);
        }

        // Total revenue from sales
        $totalRevenue = Sales::sum('totalRevenue');

        // Total number of orders
        $orderCount = Order::count();

        // Total number of customers
        $customerCount = User::where('is_admin', 0)->count();

        // Most popular products (by quantity sold)
        $popularItems = OrderItem::select('productId', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('productId')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->with('product') // eager load product details
            ->get();

        return view('adminDashboard', compact(
            'totalRevenue',
            'orderCount',
            'customerCount',
            'popularItems'
        ));
    }
}
