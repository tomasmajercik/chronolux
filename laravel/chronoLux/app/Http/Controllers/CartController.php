<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ProductVariant;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $quantity = $request->input('quantity', 1);
        $variantId = $request->input('variant_id');

        if (Auth::check()) {
            $order = Order::firstOrCreate(
                ['user_id' => Auth::id(), 'status' => 'pending'],
                ['address_id' => null, 'email' => Auth::user()->email, 'total_price' => 0, 'delivery_price' => 0, 'delivery_method' => 'unknown']
            );

            $item = OrderItem::firstOrNew([
                'order_id' => $order->id,
                'product_variant_id' => $variantId,
            ]);

            $item->quantity += $quantity;
            $item->save();
        } else {
            $cart = session('cart', []);
            $found = false;

            foreach ($cart as &$item) {
                if ($item['product_variant_id'] == $variantId) {
                    $item['quantity'] += $quantity;
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $cart[] = ['product_variant_id' => $variantId, 'quantity' => $quantity];
            }

            session(['cart' => $cart]);
        }

        return back()->with('success', 'The product has been added to the cart.');
    }
    public function show()
    {
        if (Auth::check()) {
            $order = Order::where('user_id', Auth::id())->where('status', 'pending')->with('items.variant.product')->first();
            $items = $order ? $order->items : collect();
        } else {
            $cart = session('cart', []);
            $items = collect($cart)->map(function ($item) {
                $variant = ProductVariant::with('product')->find($item['product_variant_id']);
                return (object)[
                    'variant' => $variant,
                    'quantity' => $item['quantity'],
                ];
            });
        }

        $totalProducts = $items->sum(function ($item) {
            return $item->variant->product->price * $item->quantity;
        });

        $shipping = 3.50; 
        $total = $totalProducts + $shipping;

        return view('cart.cart', compact('items', 'totalProducts', 'shipping', 'total'));
    }
    public function update(Request $request)
    {
        if (Auth::check()) {
            $item = OrderItem::findOrFail($request->id);

            // Uistíme sa, že položka patrí aktuálnemu používateľovi
            if ($item->order->user_id !== Auth::id()) {
                abort(403, 'Unauthorized action.');
            }

            $item->quantity = max(1, $request->quantity);
            $item->save();

            return response()->json([
                'success' => true,
                'new_quantity' => $item->quantity,
                'total_price' => number_format($item->variant->product->price * $item->quantity, 2)
            ]);
        } else {
            $cart = session('cart', []);
            foreach ($cart as &$cartItem) {
                if ($cartItem['product_variant_id'] == $request->id) {
                    $cartItem['quantity'] = max(1, $request->quantity);
                    break;
                }
            }
            session(['cart' => $cart]);

            return response()->json([
                'success' => true,
                'new_quantity' => $request->quantity,
            ]);
        }
    }

    public function remove(Request $request)
    {
        if (Auth::check()) {
            $item = OrderItem::findOrFail($request->id);

            // Skontrolujeme, či daná položka patrí aktuálnemu používateľovi
            if ($item->order->user_id !== Auth::id()) {
                abort(403, 'Unauthorized action.');
            }

            $item->delete();
            return response()->json(['success' => true]);
        } else {
            $cart = session('cart', []);
            $cart = array_filter($cart, function ($item) use ($request) {
                return $item['product_variant_id'] != $request->id;
            });
            session(['cart' => array_values($cart)]); // reset indexov

            return response()->json(['success' => true]);
        }
    }
}
