<?php

namespace App\Http\Controllers;

use App\Models\Product;

class MenuController extends Controller
{
    public function all() {
        $products = Product::all();
        return view('userMenu.all', compact('products'));
    }

    public function siopao() {
        $products = Product::where('productCategory', 'Siopao')->get();
        return view('userMenu.siopao', compact('products'));
    }

    public function drinks() {
        $products = Product::where('productCategory', 'Drinks')->get();
        return view('userMenu.drinks', compact('products'));
    }

    public function desserts() {
        $products = Product::where('productCategory', 'Dessert')->get();
        return view('userMenu.desserts', compact('products'));
    }
}
