@extends('layouts.app')

@section('title', $category_name)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/product_page.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product-detail-modal.css') }}">
@endpush

@section('header-slot')
    <div class="lower-header">
        <h1 class="category-title">{{$category_name}}</h1>
        @if(request()->has('search'))
            <div class="search-query">
                Results for "<strong>{{ request('search') }}</strong>"
                <button onclick="clearSearch()" class="clear-search" title="Clear search">✕</button>
            </div>
        @endif
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
                    :product="$product"
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
                    <a href="{{ $products->appends(request()->query())->previousPageUrl() }}" class="prev">
                        <x-left-arrow />
                        <span>Previous</span>
                    </a>
                @endif

                {{-- Page numbers --}}
                <div class="page-numbering">
                    @php
                        $start = max(1, $products->currentPage() - 1);
                        $end = min($products->lastPage(), $products->currentPage() + 2);
                    @endphp

                    <!-- Always show first page -->
                    @if ($start > 1)
                        <a href="{{ $products->appends(request()->query())->url(1) }}">
                            <button class="{{ $products->currentPage() == 1 ? 'active' : '' }}">1</button>
                        </a>
                        @if ($start > 2)
                            <span class="dots">...</span>
                        @endif
                    @endif

                    <!-- Page range -->
                    @for ($i = $start; $i <= $end; $i++)
                        <a href="{{ $products->appends(request()->query())->url($i) }}">
                            <button class="{{ $products->currentPage() == $i ? 'active' : '' }}">{{ $i }}</button>
                        </a>
                    @endfor

                    <!-- Always show last page -->
                    @if ($end < $products->lastPage())
                        @if ($end < $products->lastPage() - 1)
                            <span class="dots">...</span>
                        @endif
                        <a href="{{ $products->appends(request()->query())->url($products->lastPage()) }}">
                            <button class="{{ $products->currentPage() == $products->lastPage() ? 'active' : '' }}">{{ $products->lastPage() }}</button>
                        </a>
                    @endif
                </div>

                {{-- Next --}}
                @if ($products->hasMorePages())
                    <a href="{{ $products->appends(request()->query())->nextPageUrl() }}" class="next">
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
