<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockIn;

class InventoryController extends Controller
{
    // Show inventory page (already used in admin view)
    public function index()
    {
        $stockIns = StockIn::with('product')->get();
        return view('adminInventoryPage', compact('stockIns'));
    }

    // Store a new product + stock entry
    public function store(Request $request)
        {
            $validated = $request->validate([
                'productName' => 'required|string|max:255',
                'productCategory' => 'required|string',
                'productPrice' => 'required|numeric|min:0',
                'productImage' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
                'quantity' => 'required|integer|min:1',
                'dateCreated' => 'required|date',
                'expirationDate' => 'required|date|after_or_equal:dateCreated',
            ]);

            // Determine folder based on category
            $folder = match($validated['productCategory']) {
                'Siopao' => 'images/siopao',
                'Drinks' => 'images/drinks',
                'Dessert' => 'images/desserts',
                default => 'images/others',
            };

            // Handle file upload
            if ($request->hasFile('productImage')) {
                $file = $request->file('productImage');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path($folder), $filename);
                $validated['productImage'] = $folder . '/' . $filename;
            }

            // Create product first
            $product = Product::create([
                'productName' => $validated['productName'],
                'productCategory' => $validated['productCategory'],
                'productPrice' => $validated['productPrice'],
                'productImage' => $validated['productImage'],
            ]);

            // Then create stock in
            StockIn::create([
                'productId' => $product->id,
                'quantity' => $validated['quantity'],
                'remainingStock' => $validated['quantity'],
                'dateCreated' => $validated['dateCreated'],
                'expirationDate' => $validated['expirationDate'],
                'status' => 0, // Assuming 0 = Available
            ]);

            return redirect()->back()->with('success', 'Product and stock added successfully.');
        }

}
