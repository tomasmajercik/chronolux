<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ProductVariant;
use App\Models\OrderItem;
use App\Models\Address;
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
            if ($order) {
                $items = $order->items->sortBy('id');  
            } else {
                $items = collect();
            }
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
    public function update(Request $request, $order_item_id)
    {
        if (Auth::check()) {
            $item = OrderItem::findOrFail($order_item_id);

            // Uistíme sa, že položka patrí aktuálnemu používateľovi
            if ($item->order->user_id !== Auth::id()) {
                abort(403, 'Unauthorized action.');
            }

            if ($request->action === 'increase') {
                $item->quantity += 1;
            } elseif ($request->action === 'decrease') {
                $item->quantity = max(1, $item->quantity - 1); 
            }

            $item->save();

            return back()->with('success', 'The amount was changed successfully.');
        } else {
            $cart = session('cart', []);
            foreach ($cart as $key => $cartItem) {
                if ($cartItem['product_variant_id'] == $order_item_id) {
                    if ($request->input('action') === 'increase') {
                        $cart[$key]['quantity'] += 1;
                    } elseif ($request->input('action') === 'decrease') {
                        $cart[$key]['quantity'] = max(1, $cart[$key]['quantity'] - 1);
                    }
                }
            }
            session(['cart' => $cart]);

            return back()->with('success', 'The amount was changed successfully.');
        }
    }

    public function remove(Request $request, $order_item_id)
    {
        if (Auth::check()) {
            $item = OrderItem::findOrFail($order_item_id);

            // Overenie, či položka patrí aktuálnemu používateľovi
            if ($item->order->user_id !== Auth::id()) {
                abort(403, 'Unauthorized action.');
            }

            $item->delete();
            return back()->with('success', 'The product has been removed.');
        } else {
            $cart = session('cart', []);
            $cart = array_filter($cart, function ($item) use ($order_item_id) {
                return $item['product_variant_id'] != $order_item_id;
            });
            session(['cart' => array_values($cart)]); // reset indexov

            return back()->with('success', 'The product has been removed.');
        }
    }

    public function transferSessionCart()
    {
        if (!Auth::check()) return;

        $cart = session('cart', []);
        if (empty($cart)) return;

        $user = Auth::user();

        $order = Order::firstOrCreate(
            ['user_id' => $user->id, 'status' => 'pending'],
            ['address_id' => null, 'email' => $user->email, 'total_price' => 0, 'delivery_price' => 0, 'delivery_method' => 'unknown']
        );

        foreach ($cart as $item) {
            $existing = OrderItem::firstOrNew([
                'order_id' => $order->id,
                'product_variant_id' => $item['product_variant_id']
            ]);

            $existing->quantity += $item['quantity'];
            $existing->save();
        }

        session()->forget('cart');
    }

    public function checkout()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $order = Order::where('user_id', Auth::id())->where('status', 'pending')->with('items.variant.product')->first();
            if ($order) {
                $items = $order->items;
            } else {
                $items = collect();
            }
            $fullName = $user->name ?? '';
            $nameParts = explode(' ', $fullName, 2);
            $prefill = [
                'email' => $user->email ?? '',
                'phone' => $user->phone_number ?? '',
                'name' => $nameParts[0] ?? '',
                'surname' => $nameParts[1] ?? '',
                'address' => $user->address->address ?? '', 
                'postal_code' => $user->address->postal_code ?? '',
                'city' => $user->address->city ?? '',
                'state' => $user->address->country ?? '',
            ];
        } else {
            $cart = session('cart', []);
            $items = collect($cart)->map(function ($item) {
                $variant = ProductVariant::with('product')->find($item['product_variant_id']);
                return (object)[
                    'variant' => $variant,
                    'quantity' => $item['quantity'],
                ];
            });
            $prefill = []; // Empty for guests
        }

        $totalProducts = $items->sum(function ($item) {
            return $item->variant->product->price * $item->quantity;
        });

        $shipping = 3.50;
        $total = $totalProducts + $shipping;

        return view('cart.checkout', compact('totalProducts', 'shipping', 'total', 'items', 'prefill'));
    }

    public function add_shipping_info(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|email',
            'name' => 'required|string',
            'surname' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'postal_code' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'delivery' => 'required|string',
        ]);

        // Získa aktuálneho prihláseného používateľa
        $userId = Auth::id();

        // Nájde jeho pending objednávku
        $order = Order::where('user_id', $userId)
                    ->where('status', 'pending')
                    ->first();
        
        if (!$order) {
            return redirect()->back()->with('error', 'No pending order found.');
        }

        $existingAddress = Address::where('city', $validatedData['city'])
        ->where('country', $validatedData['country'])
        ->where('address', $validatedData['address'])
        ->where('postal_code', $validatedData['postal_code'])
        ->first();

        if ($existingAddress) {
            $address = $existingAddress->id;
        } 
        else { // Create a new address if it doesn't exist
            $newAddress = new Address();
            $newAddress->city = $validatedData['city'];
            $newAddress->country = $validatedData['country'];
            $newAddress->address = $validatedData['address'];
            $newAddress->postal_code = $validatedData['postal_code'];
            $newAddress->save();
            $address = $newAddress->id;
        }

        $order->update([
            'email' => $validatedData['email'],
            'name' => $validatedData['name'],
            'surname' => $validatedData['surname'],
            'address_id' => $address,
            'phone_number' => $validatedData['phone_number'],
            'delivery_method' => $validatedData['delivery'],
        ]);

        

        return redirect()->route('cart.payment')->with('success', 'Shipping info updated.');
    }
}
