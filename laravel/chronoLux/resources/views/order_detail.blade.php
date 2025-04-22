@extends('layouts.app')


@section('title', 'Shopping Cart')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile/order_detail.css') }}">
@endpush

@section('content')
<main>
    <div class="main-content">
        <!-- Cart header -->
        <div class="cart-overview-container">
            <div class="cart-header">
                <h3>Product</h3>
                <div class="inline">
                    <h4>Size</h4>
                    <h4>Amount</h4>
                    <h4>Price</h4>
                </div>
            </div>

            @foreach($items as $item)
                <x-order-detail-item
                    :title="$item->variant->product->name"
                    image="{{ asset($item->variant->product->coverImage->image_path) }}"
                    :size="$item->variant->size"
                    :amount="$item->quantity"
                    price="{{ number_format($item->variant->product->price, 2) }}"
                />
            @endforeach

        </div>
        <!-- Summary -->
        <div class="cart-summary-container">
            <h2>Summary</h2>

            <div class="total-products">
                <div>
                    <h5>Total products:</h5>
                    <p>{{ number_format($totalProducts, 2, ',', ' ') }}€</p>
                </div>
                <div>
                    <h5>Shipping:</h5>
                    <p>{{ number_format($shipping, 2, ',', ' ') }}€</p>
                </div>
            </div>

            <div class="total-total-price">
                <h3>Total:</h3>
                <p>{{ number_format($total, 2, ',', ' ') }}€</p>
            </div>
        </div>
    </div>


</main>
@endsection