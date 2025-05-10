@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/add_product.css') }}">
@endpush

@section('title', 'Profile')

@section('content')
<main>
    <x-adminSidebar :active="'addProduct'" />
    <div class="profile-content">
            <div class="profile-info">
                <div class="center">
                    <img src="../IMGs/person.jpeg" alt="Profile Picture" class="profile-pic">
                    <h3 class="profile-name">František Hraško</h3>
                    <h6>Administrator</h6>
                </div>

                <!-- MAIN CONTENT -->
                <div class="main-content">
                    <h2>Add product</h2>
                    <form id="product-form" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="product-form">
                        @csrf

                        <div class="product-text-info">
                            <div class="row">
                                <label for="product-name">Product name</label>
                                <input type="text" id="product-name" name="name" placeholder="Watch name and type" required>
                            </div>

                            <div class="row">
                                <label for="product-price">Price</label>
                                <input type="number" step="0.01" id="product-price" name="price" placeholder="5799.98" required>
                            </div>
                        </div>

                        <div class="product-sizes">
                            <h4>Sizes</h4>
                            <div class="product-sizes-container">
                                @foreach(['42mm', '43mm', '44mm', '45mm', '46mm'] as $size)
                                    <label class="custom-checkbox">
                                        <input type="checkbox" name="sizes[]" value="{{ $size }}">
                                        <span class="checkmark"></span>
                                        {{ $size }}
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="product-category">
                            <h4>Category</h4>
                            <select id="watch-category" name="category_id" class="dropdown" required>
                                <option value="" disabled selected>Choose category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="product-category">
                            <h4>Brand</h4>
                            <select id="watch-brand" name="brand_id" class="dropdown" required>
                                <option value="" disabled selected>Choose brand</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                @endforeach
                                <option value="__new__">+ Add new brand...</option>
                            </select>

                            <input type="text" id="new-brand-input" name="new_brand" placeholder="Enter new brand name"/>
                        </div>


                       <div class="upload-images">
                            <h4>Upload images</h4>
                            <div class="upload-images-container" id="preview-container">
                                <!-- Image previews will appear here -->
                                <label class="add-img" for="image-upload">
                                    <p>+</p>
                                </label>
                                <input type="file" id="image-upload" name="images[]" accept="image/*" multiple style="display: none;">
                            </div>
                        </div>


                        <div class="product-description">
                            <h4>Product description</h4>
                            <textarea id="text-area" name="description" class="text-input"
                                placeholder="Lorem ipsum dolor sit amet..." required></textarea>
                        </div>
                        
                        <div class="button-area">
                            <button class="upload-button" type="submit">Upload Product</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
</main>
@endsection
@push('scripts')
<script>
    @if (session('success'))
        alert("{{ session('success') }}");
    @endif
    @if (session('error'))
        alert("{{ session('error') }}");
    @endif
    const uploadInput = document.getElementById('image-upload');
    const previewContainer = document.getElementById('preview-container');

    // Store selected files in this array
    let selectedFiles = [];

    uploadInput.addEventListener('change', function () {
        const newFiles = Array.from(uploadInput.files);

        newFiles.forEach(file => {
            selectedFiles.push(file); // Add to our array

            const reader = new FileReader();
            reader.onload = function (e) {
                const div = document.createElement('div');
                div.classList.add('product-img');
                div.innerHTML = `
                    <img src="${e.target.result}" alt="img-preview">
                    <button type="button" class="trash-can" onclick="this.closest('.product-img').remove();">
                        <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none">
                            <path d="M1.96875 1.96875L2.32031 7.59375C2.33701 7.91877 2.57344 8.15625 2.88281 8.15625H6.11719C6.42779 8.15625 6.65982 7.91877 6.67969 7.59375L7.03125 1.96875"
                                stroke="black" stroke-width="0.75" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M1.40625 1.96875H7.59375" stroke="black" stroke-width="0.75"
                                stroke-linecap="round" />
                            <path d="M3.375 1.96875V1.26563C3.375 0.96875 3.625 0.75 3.79688 0.75H5.20312C5.375 0.75 5.625 0.96875 5.625 1.26563V1.96875"
                                stroke="black" stroke-width="0.75" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M4.5 3.09375V7.03125M3.23438 3.09375L3.375 7.03125M5.76562 3.09375L5.625 7.03125"
                                stroke="black" stroke-width="0.75" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                `;
                previewContainer.insertBefore(div, document.querySelector('.add-img'));
            };
            reader.readAsDataURL(file);
        });
    });

    // Prevent form submission if there are no sizes selected
    document.getElementById('product-form').addEventListener('submit', function (e) {
        const checkedSizes = document.querySelectorAll('input[name="sizes[]"]:checked');
        if (checkedSizes.length === 0) {
            e.preventDefault();
            alert("Please select at least one size.");
        }
    });

    // Prevent form submission if less than 2 images are selected
    document.getElementById('product-form').addEventListener('submit', function (e) {
        const checkedSizes = document.querySelectorAll('input[name="sizes[]"]:checked');
        const uploadedImages = document.querySelectorAll('.product-img img');

        if (checkedSizes.length === 0) {
            e.preventDefault();
            alert("Please select at least one size.");
            return;
        }

        if (uploadedImages.length < 2) {
            e.preventDefault();
            alert("Please upload at least two images.");
            return;
        }
    });

    const brandSelect = document.getElementById('watch-brand');
    const newBrandInput = document.getElementById('new-brand-input');

    brandSelect.addEventListener('change', function () {
        if (this.value === '__new__') {
            newBrandInput.style.display = 'block';
            newBrandInput.required = true;
            brandSelect.required = false;
        } else {
            newBrandInput.style.display = 'none';
            newBrandInput.required = false;
            brandSelect.required = true;
        }
    });

</script>
@endpush

