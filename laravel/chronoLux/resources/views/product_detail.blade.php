@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/product_detail.css') }}">
@endpush

@section('title', $product->name ?? 'Product Detail')

@section('content')
<main>
    <section class="product-section">
        <!-- Navigation -->
        <nav class="categorization">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/product-page">Product Category</a></li>
                <li><a href="{{ url()->current() }}">{{ $product->name }}</a></li>
            </ul>
        </nav>

        <!-- Product -->
        <div class="product">
            <div class="product-img">
                <img class="main-img"
                    src="{{ asset($product->coverImage->image_path) }}"
                    alt="Product Image"
                    width="440"
                    height="440"
                    onclick="showLargeImage('{{ asset($product->coverImage->image_path) }}', 0)">

                <div class="product-gallery">
                    @foreach($product->images as $index => $img)
                        <img src="{{ asset($img->image_path) }}" alt="Product Image {{ $index + 1 }}"
                            onclick="showLargeImage('{{ asset($img->image_path) }}', {{ $index + 1 }})">
                    @endforeach
                </div>
            </div>

            <div class="product-info">
                <h2>{{ $product->name }}</h2>

                <div class="product-sizes">
                    <h5>Sizes</h5>
                    @foreach($product->variants as $variant)
                        <button>{{ $variant->size }}</button>
                    @endforeach
                </div>

                <div class="product-description">
                    <h5>Description</h5>
                    <p>{{ $product->description }}</p>
                </div>

                <div class="product-price">
                    <h5>Price</h5>
                    <h2>{{ number_format($product->price, 2) }}€</h2>
                </div>

                <div class="product-quantity">
                    <button onclick="changeQuantity(-1)">-</button>
                    <span id="quantity">1</span>
                    <button onclick="changeQuantity(1)">+</button>
                </div>

                <div class="product-buttons">
                    <button>Add to Cart</button>
                </div>
            </div>
        </div>

        <!-- big photo modal div -->
        <div id="image-modal" class="modal" onclick="closeModal()">
            <span class="prev" onclick="changeImage(-1, event)">&#10094;</span>
            <img id="modal-img" src="{{ asset($product->coverImage->image_path) }}" alt="Large Product Image">
            <span class="next" onclick="changeImage(1, event)">&#10095;</span>
        </div>
    </section>
</main>
@endsection
@push('scripts')
<script>
    let quantity = 1;

    function changeQuantity(amount) {
        quantity += amount;
        if (quantity < 1) quantity = 1;
        document.getElementById('quantity').textContent = quantity;
    }
</script>
<script src="{{ asset('js/imageModal.js') }}"></script>
@endpush