<div class="order-container">
    <h5>{{ $orderDate }}</h5>
    <div class="order-box">
        <div class="images">
            @foreach ($imageSrcs as $src)
                <img src="{{ asset($src) }}" alt="" width="80" height="80">
            @endforeach
        </div>
        <div class="status {{ strtolower($status) }}">{{ $status }}</div>
        <div class="price"><strong>{{ $price }}€</strong></div>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="31" viewBox="0 0 16 31" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M13.5427 16.4183L6.00008 23.7253L4.11475 21.8989L10.7147 15.5051L4.11475 9.11139L6.00008 7.28497L13.5427 14.5919C13.7927 14.8342 13.9331 15.1626 13.9331 15.5051C13.9331 15.8476 13.7927 16.1761 13.5427 16.4183Z"
                fill="#6A6A6A" />
        </svg>
        <a href="{{ $detailLink }}" class="overlay"></a>
    </div>
</div>