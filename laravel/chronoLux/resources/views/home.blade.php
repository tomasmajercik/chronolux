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
            <button onclick="window.location.href='product_page.html'">View all products</button>
        </div>
        <div class="category-container">

            <div class="category-card cc1">
                <x-watch-category-preview
                    categoryName="Entry Luxury"
                    description="A perfect blend of elegance and affordability, this watch elevates everyday style with luxury details."
                    link="/product-page"
                />
            </div>

            <div class="category-card cc2">
                <x-watch-category-preview
                    categoryName="Basic Luxury"
                    description="A sophisticated timepiece with exquisite craftsmanship, offering luxury beyond the basics for refined tastes."
                    link="/product-page"
                />
            </div>

            <div class="category-card cc3">
               <x-watch-category-preview
                    categoryName="Ultra Luxury"
                    description="A masterpiece of innovation and precision, this ultra-luxury watch embodies the pinnacle of craftsmanship and design."
                    link="/product-page"
                />
            </div>

        </div>
    </section>
</main>
@endsection