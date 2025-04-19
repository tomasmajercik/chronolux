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
    <button class="checkoutBTN" onclick="window.location.href='{{ $buttonUrl }}'">
        {{ $buttonMessage }}
    </button>
</div>