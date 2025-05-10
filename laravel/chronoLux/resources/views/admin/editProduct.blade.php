@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/edit.css') }}">
@endpush

@section('title', 'Profile')

@section('content')
<main>
    <x-adminSidebar :active="'editProduct'" />
    

    <div class="profile-content">
        <div class="profile-info">
            <div class="center">
                <img src="../IMGs/person.jpeg" alt="Profile Picture" class="profile-pic">
                <h3 class="profile-name">František Hraško</h3>
                <h6>Administrator</h6>
            </div>

            <!-- MAIN CONTENT -->
            <div class="main-content">
                <h2>Products</h2>
                <h3 class="advice-msg">Please, use desktop for this action for better experience</h3>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Sizes</th>
                                <th>Price</th>
                                <th>Images</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->category_name ?? '—' }}</td>
                                    <td>
                                        @foreach ($product->variants as $variant)
                                            {{ $variant->size }}{{ !$loop->last ? ',' : '' }}
                                        @endforeach
                                    </td>
                                    <td>{{ number_format($product->price, 2) }}€</td>
                                    <td>{{ $product->images->count() + ($product->coverImage ? 1 : 0) }}</td>
                                    <td>{{ Str::limit($product->description, 150) }}</td>
                                    <td>
                                        {{-- eye --}}
                                        <button class="action-btn"
                                            onclick='window.location.href="{{ route('product.detail', $product->id) }}"'
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                                viewBox="0 0 19 19" fill="none">
                                                <path
                                                    d="M9.49984 7.125C8.86995 7.125 8.26586 7.37522 7.82046 7.82062C7.37506 8.26602 7.12484 8.87011 7.12484 9.5C7.12484 10.1299 7.37506 10.734 7.82046 11.1794C8.26586 11.6248 8.86995 11.875 9.49984 11.875C10.1297 11.875 10.7338 11.6248 11.1792 11.1794C11.6246 10.734 11.8748 10.1299 11.8748 9.5C11.8748 8.87011 11.6246 8.26602 11.1792 7.82062C10.7338 7.37522 10.1297 7.125 9.49984 7.125ZM9.49984 13.4583C8.45002 13.4583 7.44321 13.0413 6.70087 12.299C5.95854 11.5566 5.5415 10.5498 5.5415 9.5C5.5415 8.45018 5.95854 7.44337 6.70087 6.70104C7.44321 5.9587 8.45002 5.54167 9.49984 5.54167C10.5497 5.54167 11.5565 5.9587 12.2988 6.70104C13.0411 7.44337 13.4582 8.45018 13.4582 9.5C13.4582 10.5498 13.0411 11.5566 12.2988 12.299C11.5565 13.0413 10.5497 13.4583 9.49984 13.4583ZM9.49984 3.5625C5.5415 3.5625 2.16109 6.02458 0.791504 9.5C2.16109 12.9754 5.5415 15.4375 9.49984 15.4375C13.4582 15.4375 16.8386 12.9754 18.2082 9.5C16.8386 6.02458 13.4582 3.5625 9.49984 3.5625Z"
                                                    fill="black" />
                                            </svg>
                                        </button>
                                        {{-- edit icon --}}
                                        <button class="action-btn"
                                            onclick='window.location.href="{{ route('admin.product.edit', $product->id) }}"'
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                viewBox="0 0 30 30" fill="none">
                                                <path
                                                    d="M3.75 21.5625V26.25H8.4375L22.2625 12.425L17.575 7.7375L3.75 21.5625ZM25.8875 8.8C26.0034 8.68436 26.0953 8.547 26.158 8.39578C26.2208 8.24457 26.2531 8.08246 26.2531 7.91875C26.2531 7.75504 26.2208 7.59294 26.158 7.44172C26.0953 7.29051 26.0034 7.15315 25.8875 7.0375L22.9625 4.1125C22.8469 3.99662 22.7095 3.90469 22.5583 3.84196C22.4071 3.77924 22.245 3.74695 22.0813 3.74695C21.9175 3.74695 21.7554 3.77924 21.6042 3.84196C21.453 3.90469 21.3156 3.99662 21.2 4.1125L18.9125 6.4L23.6 11.0875L25.8875 8.8Z"
                                                    fill="black" />
                                            </svg>
                                        </button>
                                        {{-- trash can --}}
                                        <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="action-btn" onclick="return confirm('Are you sure you want to delete this product?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                                    viewBox="0 0 19 19" fill="none">
                                                    <path
                                                        d="M4.15625 4.15625L4.89844 16.0312C4.93369 16.7174 5.43281 17.2188 6.08594 17.2188H12.9141C13.5698 17.2188 14.0596 16.7174 14.1016 16.0312L14.8438 4.15625"
                                                        stroke="black" stroke-width="0.75" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M2.96875 4.15625H16.0312H2.96875Z" fill="black" />
                                                    <path d="M2.96875 4.15625H16.0312" stroke="black" stroke-width="0.75"
                                                        stroke-miterlimit="10" stroke-linecap="round" />
                                                    <path
                                                        d="M7.125 4.15625V2.67188C7.12466 2.55482 7.14746 2.43886 7.1921 2.33065C7.23673 2.22244 7.30232 2.12412 7.38509 2.04135C7.46786 1.95858 7.56618 1.89299 7.67439 1.84835C7.7826 1.80371 7.89857 1.78091 8.01562 1.78125H10.9844C11.1014 1.78091 11.2174 1.80371 11.3256 1.84835C11.4338 1.89299 11.5321 1.95858 11.6149 2.04135C11.6977 2.12412 11.7633 2.22244 11.8079 2.33065C11.8525 2.43886 11.8753 2.55482 11.875 2.67188V4.15625M9.5 6.53125V14.8438M6.82812 6.53125L7.125 14.8438M12.1719 6.53125L11.875 14.8438"
                                                        stroke="black" stroke-width="0.75" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
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

                </div>
            </div>

        </div>
    </div>

</main>
@endsection
@push('scripts')

@endpush
