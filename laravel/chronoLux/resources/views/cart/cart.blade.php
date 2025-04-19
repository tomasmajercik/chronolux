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
                    <x-cart-item
                        title="{{ $item->variant->product->name }}"
                        image="{{ asset($item->variant->product->coverImage->image_path) }}"
                        price="{{ number_format($item->variant->product->price, 2) }}"
                        size="{{ $item->variant->size }}"
                        amount="{{ $item->quantity }}"
                    />
                @empty
                    <p>Your cart is empty.</p>
                @endforelse

            </div>

            <!-- Summary -->
            <x-cart-summary 
                button_message="Checkout" 
                button_url="/checkout" 
                :total_products="$totalProducts"
                :shipping="$shipping"
                :total="$total"
            />


        </div>
    </section>
</main>
@endsection
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const decreaseButtons = document.querySelectorAll('.decrease-btn');
    const increaseButtons = document.querySelectorAll('.increase-btn');

    decreaseButtons.forEach(button => {
        button.addEventListener('click', function() {
            const cartItem = button.closest('.cart-item');
            const amountIndicator = cartItem.querySelector('.amount-indicator');
            let amount = parseInt(amountIndicator.textContent);
            if (amount > 1) {
                amount--;
                amountIndicator.textContent = amount;
                updateItemPrice(cartItem, amount);
                updateCart(cartItem.getAttribute('data-id'), amount); // Pass product ID and quantity
            }
        });
    });

    increaseButtons.forEach(button => {
        button.addEventListener('click', function() {
            const cartItem = button.closest('.cart-item');
            const amountIndicator = cartItem.querySelector('.amount-indicator');
            let amount = parseInt(amountIndicator.textContent);
            amount++;
            amountIndicator.textContent = amount;
            updateItemPrice(cartItem, amount);
            updateCart(cartItem.getAttribute('data-id'), amount); // Pass product ID and quantity
        });
    });

    function updateItemPrice(cartItem, amount) {
        const price = parseFloat(cartItem.getAttribute('data-price'));
        const itemPrice = cartItem.querySelector('.item-price');
        const newPrice = price * amount;
        itemPrice.textContent = `${newPrice.toFixed(2)}€`;
    }

    // AJAX function to update the cart on the server
    function updateCart(itemId, quantity) {
        fetch('/cart/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                id: itemId,
                quantity: quantity,
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Optionally, update the UI with the new quantity and price
                console.log('Cart updated successfully');
            } else {
                console.error('Error updating cart');
            }
        })
        .catch(error => console.error('Error:', error));
    }
});
</script>
@endpush