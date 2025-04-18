@extends('layouts.app')

@section('title', 'Ultra Luxury')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('header-slot')
    <div class="lower-header">
        <p>
            Your style is a powerful form of communication, make it matter.
        </p>
        <button onclick="location.href='#watch-category'">View More</button>
    </div>
@endsection

@section('content')
<main>
    <!-- Watch Categories -->
    <section class="watch-category" id="watch-category">
        <div class="category-heading">
            <h2>Watch categories</h2>
            <button onclick="window.location.href='/products#product-catalog'">View all products</button>
        </div>
        <div class="category-container">

            <div class="category-card cc1">
                <x-watch-category-preview
                    categoryName="Entry Luxury"
                    description="A perfect blend of elegance and affordability, this watch elevates everyday style with luxury details."
                    link="{{ route('products.byCategory', ['category_name' => 'Entry Luxury']) }}#product-catalog"
                />
            </div>

            <div class="category-card cc2">
                <x-watch-category-preview
                    categoryName="Basic Luxury"
                    description="A sophisticated timepiece with exquisite craftsmanship, offering luxury beyond the basics for refined tastes."
                    link="{{ route('products.byCategory', ['category_name' => 'Basic Luxury']) }}#product-catalog"
                />
            </div>

            <div class="category-card cc3">
               <x-watch-category-preview
                    categoryName="Ultra Luxury"
                    description="A masterpiece of innovation and precision, this ultra-luxury watch embodies the pinnacle of craftsmanship and design."
                    link="{{ route('products.byCategory', ['category_name' => 'Ultra Luxury']) }}#product-catalog"
                />
            </div>
        </div>
    </section>
    <!-- Static design reccomendations -->
    <section class="web-reviews">
        <div class="reviews-container">

            <x-reviews-homepage
                text="Fantastic shopping experience! The selection is incredible, and the prices are competitive. My watch arrived quickly, beautifully packaged, and exactly as described. Highly recommend this store!"
                stars="5"
                fullName="Tomáš Majerčík"
            />
            <x-reviews-homepage
                text="Decent prices and good selection, but customer service response time could be improved. My watch arrived in good condition, but some updates were unclear"
                stars="3"
                fullName="Zdenko Kanoš"
            />
            <x-reviews-homepage
                text="Great variety of watches and smooth checkout process. Shipping took a bit longer than expected, but the watch was authentic and well-packaged"
                stars="4"
                fullName="Tom Hanks"
            />

        </div>
    </section>
    <!-- Recommended -->
        <section class="recommended">
            <h1>Recommended</h1>
            <div class="recommended-container">
                
                @foreach($recommendedProducts as $product)
                    <x-product-container
                        :url="route('product.detail', ['id' => $product->id])"
                        :image="$product->coverImage->image_path"
                        :title="$product->name"
                        :reviews="'2k reviews'"
                        :price="$product->price"
                    />
                @endforeach

            </div>
        </section>
</main>
@endsection