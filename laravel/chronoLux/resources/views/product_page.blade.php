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
            {{-- @for ($i = 0; $i < 12; $i++)
            <x-product-container
                url="/product-detail"
                image="IMGs/tissot-sm.jpg"
                title="Tissot Tradition Silver"
                reviews="2k reviews"
                price="545.99"
            />
            @endfor --}}
            @foreach ($products as $product)
                <x-product-container
                    :url="'/product-detail'"
                    :image="$product->coverImage->image_path"
                    :title="$product->name"
                    :reviews="'2k reviews'"
                    :price="'545.99'"
                />
            @endforeach
        </div>
        
        <!-- Paging -->
        @if($productCount != 0)
            <div class="paging">
                <div class="prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <g clip-path="url(#clip0_39_1172)">
                            <path
                                d="M3.63605 11.2929C3.44858 11.4804 3.34326 11.7347 3.34326 11.9999C3.34326 12.2651 3.44858 12.5194 3.63605 12.7069L9.29305 18.3639C9.3853 18.4594 9.49564 18.5356 9.61764 18.588C9.73965 18.6404 9.87087 18.668 10.0036 18.6692C10.1364 18.6703 10.2681 18.645 10.391 18.5947C10.5139 18.5444 10.6256 18.4702 10.7194 18.3763C10.8133 18.2824 10.8876 18.1708 10.9379 18.0479C10.9882 17.925 11.0135 17.7933 11.0123 17.6605C11.0111 17.5277 10.9836 17.3965 10.9311 17.2745C10.8787 17.1525 10.8026 17.0421 10.707 16.9499L6.75705 12.9999H20C20.2653 12.9999 20.5196 12.8945 20.7072 12.707C20.8947 12.5195 21 12.2651 21 11.9999C21 11.7347 20.8947 11.4803 20.7072 11.2928C20.5196 11.1053 20.2653 10.9999 20 10.9999H6.75705L10.707 7.0499C10.8892 6.8613 10.99 6.6087 10.9877 6.3465C10.9854 6.0843 10.8803 5.83349 10.6949 5.64808C10.5095 5.46268 10.2586 5.3575 9.99645 5.35523C9.73425 5.35295 9.48165 5.45374 9.29305 5.6359L3.63605 11.2929Z"
                                fill="black" />
                        </g>
                        <defs>
                            <clipPath id="clip0_39_1172">
                                <rect width="24" height="24" fill="white" transform="matrix(0 -1 1 0 0 24)" />
                            </clipPath>
                        </defs>
                    </svg><span>Previous</span>
                </div>
                <div class="page-numbering">
                    <button>1</button>
                    <button>2</button>
                    <button>3</button>
                    <button>4</button>
                    <button>5</button>
                </div>
                <div class="next">Next<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <g clip-path="url(#clip0_39_1168)">
                            <path
                                d="M20.364 12.7071C20.5514 12.5196 20.6567 12.2653 20.6567 12.0001C20.6567 11.7349 20.5514 11.4806 20.364 11.2931L14.707 5.6361C14.6147 5.54059 14.5044 5.46441 14.3824 5.412C14.2604 5.35959 14.1291 5.332 13.9964 5.33085C13.8636 5.32969 13.7319 5.355 13.609 5.40528C13.4861 5.45556 13.3744 5.52981 13.2806 5.6237C13.1867 5.7176 13.1124 5.82925 13.0621 5.95214C13.0118 6.07504 12.9865 6.20672 12.9877 6.3395C12.9889 6.47228 13.0164 6.6035 13.0689 6.7255C13.1213 6.84751 13.1974 6.95785 13.293 7.0501L17.243 11.0001H3.99995C3.73474 11.0001 3.48038 11.1055 3.29284 11.293C3.10531 11.4805 2.99995 11.7349 2.99995 12.0001C2.99995 12.2653 3.10531 12.5197 3.29284 12.7072C3.48038 12.8947 3.73474 13.0001 3.99995 13.0001H17.243L13.293 16.9501C13.1108 17.1387 13.01 17.3913 13.0123 17.6535C13.0146 17.9157 13.1197 18.1665 13.3051 18.3519C13.4905 18.5373 13.7414 18.6425 14.0036 18.6448C14.2657 18.6471 14.5183 18.5463 14.707 18.3641L20.364 12.7071Z"
                                fill="black" />
                        </g>
                        <defs>
                            <clipPath id="clip0_39_1168">
                                <rect width="24" height="24" fill="white" transform="matrix(0 1 -1 0 24 0)" />
                            </clipPath>
                        </defs>
                    </svg>
                </div>
            </div>
        @endif
    </section>
</main>
@endsection
@push('scripts')
    <script src="{{ asset('js/filterSortingModal.js') }}"></script>
@endpush
