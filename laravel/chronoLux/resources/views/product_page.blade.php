@extends('layouts.app')

@section('title', $category_name)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/product_page.css') }}">
@endpush

@section('header-slot')
    <div class="lower-header">
        <h1 class="category-title">{{$category_name}}</h1>
    </div>
@endsection

@section('content')
<main>
    <section class="product-catalog" id="product-catalog">
        <!-- Products header -->
        <div class="product-menu">
            <h4>{{$productCount}} products found</h4>
            <div>
                <button onclick="openSort()">Sort by</button>
                <button onclick="openFilter()">Filter by</button>
            </div>
        </div>

        <!-- MODAL FOR FILTER -->
        @include('partials.filter-modal')
        
        <!-- MODAL FOR SORT -->
        @include('partials.sort-modal')

        <!-- Products -->
        <div class="product-grid">
            @if($productCount == 0)
                <div class="not-found">No products found!</div>
            @endif
            @foreach ($products as $product)
                <x-product-container
                    :url="route('product.detail', ['id' => $product->id])"
                    :image="$product->coverImage->image_path"
                    :title="$product->name"
                    :reviews="'2k reviews'"
                    :price="$product->price"
                />
            @endforeach
        </div>
        
        <!-- Paging -->
        @if ($products->lastPage() > 1)
            <div class="paging">
                {{-- Previous --}}
                @if ($products->onFirstPage())
                    <div class="prev disabled">
                        <x-left-arrow />
                        <span>Previous</span>
                    </div>
                @else
                    <a href="{{ $products->previousPageUrl() }}" class="prev">
                        <x-left-arrow />
                        <span>Previous</span>
                    </a>
                @endif

                {{-- Page numbers --}}
                <div class="page-numbering">
                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                        <a href="{{ $products->url($i) }}">
                            <button class="{{ $products->currentPage() == $i ? 'active' : '' }}">
                                {{ $i }}
                            </button>
                        </a>
                    @endfor
                </div>

                {{-- Next --}}
                @if ($products->hasMorePages())
                    <a href="{{ $products->nextPageUrl() }}" class="next">
                        <span>Next</span>
                        <x-right-arrow />
                    </a>
                @else
                    <div class="next disabled">
                        <span>Next</span>
                        <x-right-arrow />
                    </div>
                @endif
            </div>
        @endif
    </section>
</main>
@endsection
@push('scripts')
    <script src="{{ asset('js/filterSortingModal.js') }}"></script>
@endpush
