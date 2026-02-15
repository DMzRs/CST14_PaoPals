<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Sales;
use App\Models\StockIn;
use App\Models\StockOut;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    //add to cart
    public function add(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to add products to your cart.');
        }

        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        $availableStock = $product->stockIns()->sum('remainingStock');
        $currentQty = $cart[$product->id]['quantity'] ?? 0;

        if ($currentQty + 1 > $availableStock) {
            return redirect()->route('cart.index')->with('error', 'Not enough stock available.');
        }

        $cart[$product->id] = [
            'productId' => $product->id, 
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

    public function processCheckout(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->back();
        }

        $totalCost = 0;
        $orderItemsSummary = [];

        DB::transaction(function () use (
            $cart,
            $request,
            &$totalCost,
            &$orderItemsSummary
        ) {

            //1. Create Order
            $order = Order::create([
                'userId' => Auth::id(),
                'orderDate' => now(),
                'orderStatus' => 'Completed',
            ]);

            foreach ($cart as $item) {

                $qtyNeeded = $item['quantity'];
                $subTotal = $item['price'] * $qtyNeeded;
                $totalCost += $subTotal;

                //2. Create OrderItem
                OrderItem::create([
                    'orderId' => $order->id,
                    'productId' => $item['productId'],
                    'quantity' => $qtyNeeded,
                    'unitPrice' => $item['price'],
                ]);

                // Save summary for success page
                $orderItemsSummary[] = [
                    'productName' => $item['name'],
                    'productImage' => $item['image'],
                    'quantity' => $qtyNeeded,
                    'subTotal' => $subTotal
                ];

                //3. Deduct Stock (FIFO)
                $stocks = StockIn::where('productId', $item['productId'])
                    ->where('remainingStock', '>', 0)
                    ->orderBy('expirationDate')
                    ->get();

                foreach ($stocks as $stock) {

                    if ($qtyNeeded <= 0) break;

                    $deduct = min($stock->remainingStock, $qtyNeeded);

                    $stock->remainingStock -= $deduct;
                    $stock->save();

                    // 4. Create StockOut record
                    StockOut::create([
                        'stockinId' => $stock->id,
                        'quantity' => $deduct,
                        'dateUsed' => now(),
                        'cause' => 'Customer Purchase'
                    ]);

                    $qtyNeeded -= $deduct;
                }
            }

            //5. Create Payment
            $payment = Payment::create([
                'orderId' => $order->id,
                'userId' => Auth::id(),
                'paymentDate' => now(),
                'paymentMethod' => $request->paymentMethod,
                'paymentTotalCost' => $totalCost,
            ]);

            // 6. Create Sale record
            Sales::create([
                'orderId' => $order->id,
                'paymentId' => $payment->id,
                'userId' => Auth::id(),
                'saleDate' => now(),
                'totalRevenue' => $totalCost,
            ]);
        });

        // Send data to success page
        session()->put('orderItems', $orderItemsSummary);
        session()->put('totalCost', $totalCost);

        session()->forget('cart');

        return redirect()->route('checkout.orderSuccess');
    }

    public function orderSuccess()
    {
        $orderItems = session('orderItems', []);
        $totalCost = session('totalCost', 0);

        return view('userOrderSuccess', compact('orderItems', 'totalCost'));
    }

}
