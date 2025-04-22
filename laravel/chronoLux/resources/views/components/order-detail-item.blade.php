<div class="cart-item">
    <div class="item-name-info">
        <img class="cart-item-img" src="{{ $image }}" alt="watch photo" width="100"
            height="100" onclick="window.location.href='{{ route('product.detail', ['id' => $id]) }}'">
        <div class="name-remove-fav">
            <h2><a href="{{ route('product.detail', ['id' => $id]) }}">{{ $title }}</a></h2>
        </div>
    </div>
    <div class="info-holder">
        <h4> {{ $size }}</h4>
        <div class="amount-holder">
            <p class="ammount-indicator">{{ $amount }}</p>
        </div>
        <h4>{{ $price }}</h4>
    </div>
</div>