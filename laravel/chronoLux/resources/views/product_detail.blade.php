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
                <li>
                    <a href="{{ route('products.byCategory', ['category_name' => $product->category->category_name]) }}">{{ $product->category->category_name }}</a>
                </li>
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
                    @foreach($product->variants->sortBy('size') as $variant)
                        <button type="button" 
                                class="size-btn" 
                                data-id="{{ $variant->id }}">
                            {{ $variant->size }}
                        </button>
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
                    <form action="{{ route('cart.add') }}" method="POST" id="add-to-cart-form">
                        @csrf
                        <input type="hidden" name="quantity" id="product-quantity" value="1">
                        <input type="hidden" name="variant_id" id="selected-variant-id" value="{{ $product->variants->first()->id }}">
                        <button type="submit">Add to Cart</button>
                    </form>
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
    @if (session('success'))
        <div id="success-modal" class="modal-message">
            <div class="modal-content">
                <span class="close-btn" onclick="closeSuccessModal()">&times;</span>
                <p>{{ session('success') }}</p>
                <a href="{{ route('cart.show') }}" class="view-cart-btn">View Cart</a>
            </div>
        </div>
    @endif
</main>
@endsection
@push('scripts')
<script>
    let quantity = 1;

    function changeQuantity(amount) {
        quantity += amount;
        if (quantity < 1) quantity = 1;
        document.getElementById('quantity').textContent = quantity;
        document.getElementById('product-quantity').value = quantity; // Update the hidden input
    }
</script>
<script src="{{ asset('js/imageModal.js') }}"></script>
@endpush