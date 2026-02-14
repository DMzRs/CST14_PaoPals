<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        // Get all distinct categories
        $categories = Product::select('productCategory')->distinct()->pluck('productCategory')->toArray();

        // Get current selected category from query string or default to first
        $category = $request->query('category', $categories[0] ?? null);

        // Get products for the selected category
        $products = $category 
            ? Product::where('productCategory', $category)->get() 
            : collect(); // empty collection if no category

        return view('adminProductPage', compact('categories', 'category', 'products'));
    }
}
