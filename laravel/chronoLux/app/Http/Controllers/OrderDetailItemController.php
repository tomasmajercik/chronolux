<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderDetailItemController extends Controller
{
    public function showOrderDetail($id)
    {
        $order = Order::with('items.variant.product')
            ->where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $items = $order->items->sortBy('id');

        $totalProducts = $items->sum(function ($item) {
            return $item->variant->product->price * $item->quantity;
        });

        $shipping = 3.50; 
        $total = $totalProducts + $shipping;

        return view('order_detail', compact('order', 'items', 'totalProducts', 'shipping', 'total'));
    }
}
