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
                <div class="cart-header">
                    <h3>Product</h3>
                    <div class="inline">
                        <h4>Size</h4>
                        <h4>Amount</h4>
                        <h4>Price</h4>
                    </div>
                </div>

                <x-cart-item
                    title="Tissot chrono XL"
                    image="./IMGs/watch-tissot.jpg"
                    price="1070.00"
                    size="43mm"
                    amount="1"
                />
                <x-cart-item
                    title="OMEGA Seamaster"
                    image="./IMGs/rolex-sm.jpg"
                    price="7540.00"
                    size="43mm"
                    amount="1"
                />

            </div>
            <!-- Summary -->
            <x-cart-summary 
                button-message="Checkout" 
                button-url="/checkout" 
            />


        </div>
    </section>
</main>
@endsection