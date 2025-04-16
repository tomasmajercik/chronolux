@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/product_detail.css') }}">
@endpush

@section('content')

{{-- Toto pude brec --}}
@php
    $productName = 'Tissot Tradition Silver';
    $productPrice = 545.99;
    $productDescription = 'Elegantný a nadčasový dizajn hodiniek Tissot Tradition so strieborným ciferníkom. Kombinuje klasiku s modernou technológiou.';
    $mainImage = 'IMGs/watch-tissot.jpg';
    $galleryImages = [
        'IMGs/watch-sm.jpg',
        'IMGs/rolex-sm.jpg',
        'IMGs/tudor-sm.jpg',
    ];
    $sizes = ['42mm', '43mm', '45mm'];
@endphp

@section('title', $productName ?? 'Product Detail')

<main>
    <section class="product-section">
        <!-- Navigation -->
        <nav class="categorization">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/product-page">Product Category</a></li>
                <li><a href="/product-detail">{{ $productName }}</a></li>
            </ul>
        </nav>

        <!-- Product -->
        <div class="product">
            <div class="product-img">
                <img class="main-img" src="{{ asset($mainImage) }}" alt="Product Image" width="440" height="440"
                    onclick="showLargeImage('{{ asset($mainImage) }}', 0)">

                <div class="product-gallery">
                    @foreach($galleryImages as $index => $img)
                        <img src="{{ asset($img) }}" alt="Product Image {{ $index + 2 }}"
                            onclick="showLargeImage('{{ asset($img) }}', {{ $index + 1 }})">
                    @endforeach
                </div>
            </div>

            <div class="product-info">
                <h2>{{ $productName }}</h2>

                <div class="product-sizes">
                    <h5>Sizes</h5>
                    @foreach($sizes as $size)
                        <button>{{ $size }}</button>
                    @endforeach
                </div>

                <div class="product-description">
                    <h5>Description</h5>
                    <p>{{ $productDescription }}</p>
                </div>

                <div class="product-price">
                    <h5>Price</h5>
                    <h2>{{ number_format($productPrice, 2) }}€</h2>
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
            <img id="modal-img" src="{{ asset($mainImage) }}" alt="Large Product Image">
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