<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class FrontPageController extends Controller
{
    public function index()
    {
        // Get top 3 best-selling products based on stockouts
        $bestSellers = Product::withSum('stockouts', 'quantity')
                              ->orderByDesc('stockouts_sum_quantity')
                              ->take(3)
                              ->get();

        return view('frontPage', compact('bestSellers'));
    }
}
