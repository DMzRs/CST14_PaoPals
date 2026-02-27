<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Helpers\ActivityLogger;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    // Show inventory page (Stock In + Stock Out)
    public function index()
    {
        $stockIns = StockIn::with('product')->get();
        $stockOuts = StockOut::with('stockin.product')->get();
        $products = Product::all();

        // ✅ Log viewing inventory
        ActivityLogger::log(
            'View Inventory',
            'Admin viewed inventory page'
        );

        return view('adminInventoryPage', compact('stockIns', 'stockOuts', 'products'));
    }

    // Add stock for existing product
    public function storeStock(Request $request)
    {
        $validated = $request->validate([
            'productId' => 'required|exists:product,id',
            'quantity' => 'required|integer|min:1',
            'dateCreated' => 'required|date',
            'expirationDate' => 'required|date|after_or_equal:dateCreated',
        ]);

        $stock = StockIn::create([
            'productId' => $validated['productId'],
            'quantity' => $validated['quantity'],
            'remainingStock' => $validated['quantity'],
            'dateCreated' => $validated['dateCreated'],
            'expirationDate' => $validated['expirationDate'],
            'status' => 0,
        ]);

        // Get product name for log
        $product = Product::find($validated['productId']);

        // ✅ Log stock addition
        ActivityLogger::log(
            'Stock Added',
            'Added ' . $validated['quantity'] . ' stock for product: ' . ($product->productName ?? 'Unknown')
        );

        return redirect()->back()->with('success', 'Stock added successfully.');
    }

    // Add a new product (Add Product modal)
    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'productName' => 'required|string|max:255',
            'productCategory' => 'required|string|max:255',
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

        // Create product
        $product = Product::create([
            'productName' => $validated['productName'],
            'productCategory' => $validated['productCategory'],
            'productPrice' => $validated['productPrice'],
            'productImage' => $validated['productImage'],
        ]);

        // Create initial stock entry
        StockIn::create([
            'productId' => $product->id,
            'quantity' => $validated['quantity'],
            'remainingStock' => $validated['quantity'],
            'dateCreated' => $validated['dateCreated'],
            'expirationDate' => $validated['expirationDate'],
            'status' => 0,
        ]);

        // ✅ Log product creation
        ActivityLogger::log(
            'Product Created',
            'Added new product: ' . $product->productName .
            ' (Category: ' . $product->productCategory .
            ', Initial Stock: ' . $validated['quantity'] . ')'
        );

        return redirect()->back()->with('success', 'Product and initial stock added successfully.');
    }
}