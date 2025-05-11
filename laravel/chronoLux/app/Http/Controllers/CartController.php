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
                ['address_id' => null, 'email' => Auth::user()->email, 'total_price' => 0, 'delivery_price' => 0, 'delivery_method' => 'unknown', 'created_at' => now(), 'updated_at' => now()]
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

            // Check if the item belongs to the current user
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

            // Check if the item belongs to the current user
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
            session(['cart' => array_values($cart)]); // reset index

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

    public function add_shipping_info(Request $request)
    {
        $validatedData = $request->validate([
            'email' => [
                'required',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|org|net|sk|cz|eu)$/'
            ],
            'name' => 'required|string',
            'surname' => 'required|string',
            'address' => 'required|string',
            'phone_number' => [
                'required',
                'regex:/^(?:\+421\s?\d{3}|\d{4})\s?\d{3}\s?\d{3}$/'
            ],
            'postal_code' => [
                'required',
                'regex:/^\d{3}\s?\d{2}$/'
            ],
            'city' => 'required|string',
            'country' => 'required|string',
            'delivery' => 'required|string',
        ]);

        if (Auth::check()) {
            $userId = Auth::id();
            $order = Order::where('user_id', $userId)->where('status', 'pending')->first();

            if (!$order) {
                if ($request->expectsJson()) {
                    return response()->json(['error' => 'No pending order found.'], 422);
                }
                return redirect()->back()->with('error', 'No pending order found.');
            }

            $existingAddress = Address::where('city', $validatedData['city'])
                ->where('country', $validatedData['country'])
                ->where('address', $validatedData['address'])
                ->where('postal_code', $validatedData['postal_code'])
                ->first();

            $address = $existingAddress?->id ?? Address::create($validatedData)->id;

            $order->update([
                'email' => $validatedData['email'],
                'name' => $validatedData['name'],
                'surname' => $validatedData['surname'],
                'address_id' => $address,
                'phone_number' => $validatedData['phone_number'],
                'delivery_method' => $validatedData['delivery'],
            ]);
        } else {
            session(['shipping_info' => $validatedData]);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => 'Shipping info updated.',
                'redirect' => route('cart.startPayment')
            ]);
        }

        return redirect()->route('cart.startPayment')->with('success', 'Shipping info updated.');
    }


    public function payment()
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

        return view('cart.payment', compact('items', 'totalProducts', 'shipping', 'total'));
    }

    public function pay_now(Request $request)
    {
        $delivery_price = 3.50; // Default delivery price
        if (Auth::check()) {
            $order = Order::where('user_id', Auth::id())->where('status', 'pending')->first();
            if ($order) {
                $order->update([
                    'status' => "Packing",
                    'total_price' => ($order->items->sum(function ($item) {
                        return $item->variant->product->price * $item->quantity;
                    }) + $delivery_price),
                    'delivery_price' => $delivery_price,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'payment_method' => $request->payment_method,
                ]);

            }
        } else {
            // For guests, we need to handle the session data
            $shippingInfo = session('shipping_info');
            $cartItems = session('cart');

            if (!$shippingInfo || !$cartItems) {
                return redirect()->back()->with('error', 'Missing shipping or cart information.');
            }

            // First, check if the address already exists
            $existingAddress = Address::where('city', $shippingInfo['city'])
                ->where('country', $shippingInfo['country'])
                ->where('address', $shippingInfo['address'])
                ->where('postal_code', $shippingInfo['postal_code'])
                ->first();

            if ($existingAddress) {
                $addressId = $existingAddress->id;
            } else {
                $newAddress = new Address();
                $newAddress->city = $shippingInfo['city'];
                $newAddress->country = $shippingInfo['country'];
                $newAddress->address = $shippingInfo['address'];
                $newAddress->postal_code = $shippingInfo['postal_code'];
                $newAddress->save();
                $addressId = $newAddress->id;
            }

            // Create a new order
            $order = new Order();
            $order->email = $shippingInfo['email'];
            $order->name = $shippingInfo['name'];
            $order->surname = $shippingInfo['surname'];
            $order->address_id = $addressId;
            $order->phone_number = $shippingInfo['phone_number'];
            $order->delivery_method = $shippingInfo['delivery'];
            $order->delivery_price = $delivery_price;
            $order->payment_method = $request->payment_method;
            $order->status = "Packing";
            $order->created_at = now();
            $order->updated_at = now();
            $order->save();

            $total = 0;

            // Add items to the order
            foreach ($cartItems as $item) {
                $variantId = $item['product_variant_id'];
                $quantity = $item['quantity'];
                $product = ProductVariant::find($variantId)->product;

                $order->items()->create([
                    'product_variant_id' => $variantId,
                    'quantity' => $quantity,
                ]);

                $total += $product->price * $quantity;
            }

            $order->update([
                'total_price' => $total + $delivery_price,
            ]);

            session()->forget(['cart', 'shipping_info']);
        }

        return redirect()->route('cart.startProceed')->with('success', 'Payment successful. Thank you for your order!');
    }

    public function startCheckout(Request $request)
    {
        session(['proceed_from_cart' => true]);
        return redirect()->route('cart.checkout');
    }
    public function startPayment(Request $request)
    {
        session(['proceed_from_cart' => true]);
        return redirect()->route('cart.payment');
    }
    public function startProceed(Request $request)
    {
        session(['proceed_from_cart' => true]);
        return redirect()->route('cart.proceed');
    }

}
