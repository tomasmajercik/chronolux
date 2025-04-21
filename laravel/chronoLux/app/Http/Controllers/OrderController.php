<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $orders = $user->orders()
        ->with('orderItems.product.coverImage', 'address')
        ->latest()
        ->get()
        ->map(function ($order) {
            return [
                'id' => $order->id,
                'date' => $order->created_at->format('d.m.Y'),
                'price' => number_format($order->total_price, 2, '.', ' ') . '€',
                'address' => optional($order->address)->full_address ?? '',
                'images' => $order->orderItems->map(function ($item) {
                        return $item->productVariant?->product?->coverImage?->image_path;
                    })->filter()->unique()->values()->toArray(),
            ];
        });

        return view('orders', compact('orders'));
        // return view('orders', [
        //     'user' => $user,
        //     'orders' => $orders,
        // ]);
    }

}
