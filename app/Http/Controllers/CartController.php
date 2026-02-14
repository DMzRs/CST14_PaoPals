<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Add to cart
    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        $availableStock = $product->stockIns()->sum('remainingStock');
        $currentQty = $cart[$product->id]['quantity'] ?? 0;

        if ($currentQty + 1 > $availableStock) {
            return redirect()->route('cart.index')->with('error', 'Not enough stock available.');
        }

        $cart[$product->id] = [
            'name' => $product->productName,
            'price' => $product->productPrice,
            'image' => $product->productImage,
            'quantity' => $currentQty + 1,
            'maxStock' => $availableStock,
        ];

        session()->put('cart', $cart);

        return redirect()->route('cart.index');
    }

    // Show cart page
    public function index()
    {
        $cart = session('cart', []);

        foreach ($cart as $id => &$item) {
            $product = Product::find($id);

            if ($product) {
                $item['maxStock'] = $product->stockIns()->sum('remainingStock');
            } else {
                $item['maxStock'] = 0;
            }
        }

        // Put updated cart back in session
        session()->put('cart', $cart);

        return view('userCartPage', compact('cart'));
    }


    // Increase quantity in cart
    public function increase($id)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return redirect()->route('cart.index');
        }

        $product = Product::findOrFail($id);
        $availableStock = $product->stockIns()->sum('remainingStock');
        $currentQty = $cart[$id]['quantity'];

        if ($currentQty >= $availableStock) {
            return redirect()->route('cart.index')->with('stock_error', true);
        }

        $cart[$id]['quantity']++;
        $cart[$id]['maxStock'] = $availableStock;
        session()->put('cart', $cart);

        return redirect()->route('cart.index'); // always redirect to cart
    }

    public function decrease($id)
    {
        $cart = session()->get('cart');

        if(isset($cart[$id])) {
            if($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            } else {
                unset($cart[$id]);
            }

            session()->put('cart', $cart);
        }

        return redirect()->back();
    }

    public function remove($id)
    {
        $cart = session()->get('cart');

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back();
    }
}
