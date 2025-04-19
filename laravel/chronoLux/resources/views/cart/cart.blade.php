@extends('layouts.app')


@section('title', 'Shopping Cart')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endpush

@section('content')
<main>
    <section class="cart-section">
        <h1 class="title">My Cart</h1>
        <div class="cart-wrapper">
            
            

            <!-- Cart header -->
            <div class="cart-overview-container">
                @forelse ($items as $item)
                    @php
                        $itemId = Auth::check() ? $item->id : $item->variant->id;
                    @endphp
                    <x-cart-item
                        title="{{ $item->variant->product->name }}"
                        image="{{ asset($item->variant->product->coverImage->image_path) }}"
                        price="{{ number_format($item->variant->product->price, 2) }}"
                        size="{{ $item->variant->size }}"
                        amount="{{ $item->quantity }}"
                        itemId="{{ $itemId }}"
                    />
                @empty
                    <div class="empty">
                        <p>Your shopping cart is empty.</p>
                        <a href="{{ route('products.byCategory') }}" class="button">Start Shopping</a>
                    </div>
                @endforelse

            </div>

            <!-- Summary -->
            @if (count($items) > 0)
                <x-cart-summary 
                    button_message="Checkout" 
                    button_url="/checkout" 
                    :total_products="$totalProducts"
                    :shipping="$shipping"
                    :total="$total"
                />
            @endif

        </div>
    </section>
</main>
@endsection