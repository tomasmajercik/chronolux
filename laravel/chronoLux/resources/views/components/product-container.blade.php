<div class="product-container">
    <a href="{{ $url }}" class="clickable-overlay"></a>
    <div class="product-image">
        <img class="img-product" src="{{ $image }}" alt="{{ $title }}" width="330" height="330">
    </div>
    <div class="product-info">
        <h2>{{ $title }}</h2>
        <div class="reviews">
            <span class="star">★</span>
            <span class="review-count">{{ $reviews }}</span>
        </div>
        <span class="price">{{ number_format($price, 2) }}€</span>
        <button class="add-to-cart">Add to cart</button>
    </div>
</div>