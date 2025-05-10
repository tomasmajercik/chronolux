@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/add_product.css') }}">
@endpush

@section('title', 'Add Product')

@section('content')
<main>
    <x-adminSidebar :active="'addProduct'" />
    <div class="profile-content">
            <div class="profile-info">
                <!-- MAIN CONTENT -->
                <div class="main-content">
                    <h2>Add product</h2>
                    <form id="product-form" action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="product-form">
                        @method('PUT')
                        @csrf

                        <div class="product-text-info">
                            <div class="row">
                                <label for="product-name">Product name</label>
                                <input type="text" id="product-name" name="name" value="{{ old('name', $product->name) }}" placeholder="Watch name and type" required>
                            </div>

                            <div class="row">
                                <label for="product-price">Price</label>
                                <input type="number" step="0.01" id="product-price" name="price" value="{{ old('price', $product->price) }}" placeholder="5799.98" required>
                            </div>
                        </div>

                        <div class="product-sizes">
                            <h4>Sizes</h4>
                            <div class="product-sizes-container">
                                @php
                                    $variantSizes = $product->variants->pluck('size')->toArray();
                                @endphp

                                @foreach(['42mm', '43mm', '44mm', '45mm', '46mm'] as $size)
                                    <label class="custom-checkbox">
                                        <input type="checkbox" name="sizes[]" value="{{ $size }}"
                                            {{ in_array($size, old('sizes', $variantSizes)) ? 'checked' : '' }}>
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
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="product-category">
                            <h4>Brand</h4>
                            <select id="watch-brand" name="brand_id" class="dropdown" required>
                                <option value="" disabled selected>Choose brand</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                        {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->brand_name }}
                                    </option>
                                @endforeach
                                <option value="__new__">+ Add new brand...</option>
                            </select>

                            <input type="text" id="new-brand-input" name="new_brand" placeholder="Enter new brand name"/>
                        </div>


                        {{-- <div class="upload-images">
                            <h4>Upload images</h4>
                            <div class="upload-images-container" id="preview-container">
                                <!-- Image previews will appear here -->
                                <label class="add-img" for="image-upload">
                                    <p>+</p>
                                </label>
                                <input type="file" id="image-upload" accept="image/*" multiple class="hidden">
                            </div>
                            <p id="upload-status" style="margin-top: 8px; font-size: 14px; color: #555;"></p> <!-- status line -->
                        </div> --}}
                        <div class="upload-images">
                            <h4>Upload images</h4>
                            <div class="upload-images-container" id="preview-container">
                                <!-- Image previews will appear here -->
                                <label class="add-img" for="image-upload">
                                    <p>+</p>
                                </label>
                                <input type="file" id="image-upload" accept="image/*" multiple class="hidden">
                            </div>
                            <p id="upload-status" style="margin-top: 8px; font-size: 14px; color: #555;"></p> <!-- status line -->
                        </div>




                        <div class="product-description">
                            <h4>Product description</h4>
                            <textarea id="text-area" name="description" class="text-input"
                                placeholder="Lorem ipsum dolor sit amet..." required>{{ old('description', $product->description) }}</textarea>
                        </div>
                        
                        <div class="button-area">
                            <button class="upload-button" type="submit">Confirm edit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
</main>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    const uploadInput = document.getElementById('image-upload');
    const previewContainer = document.getElementById('preview-container');
    let selectedFiles = [];

    window.addEventListener('DOMContentLoaded', async () => {
        const existingImagePaths = @json(
            collect([
                $product->coverImage?->image_path,
                ...$product->images->pluck('image_path')->toArray()
            ])->filter()->map(fn($path) => asset($path))->values()
        );

        for (const url of existingImagePaths) {
            const response = await fetch(url);
            const blob = await response.blob();
            const filename = url.split('/').pop();
            const file = new File([blob], filename, { type: blob.type });
            selectedFiles.push(file);
        }

        renderPreviews();
        updateUploadStatus();
    });



    function renderPreviews() {
        previewContainer.querySelectorAll('.product-img').forEach(el => el.remove());

        selectedFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const div = document.createElement('div');
                div.classList.add('product-img');
                div.setAttribute('data-index', index);

                div.innerHTML = `
                    <img src="${e.target.result}" alt="img-preview">
                    <button type="button" class="trash-can" data-index="${index}">
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
                previewContainer.insertBefore(div, previewContainer.querySelector('.add-img'));
            };
            reader.readAsDataURL(file);
        });
    }

    uploadInput.addEventListener('change', function () {
        const newFiles = Array.from(uploadInput.files);
        const maxSizePerFile = 2 * 1024 * 1024; // 2MB in bytes
        const oversizedFiles = newFiles.filter(file => file.size > maxSizePerFile);

        if (oversizedFiles.length > 0) {
            alert(`The following file(s) are too large (max 2MB):\n\n${oversizedFiles.map(f => f.name).join('\n')}`);
            uploadInput.value = ''; // Reset the input
            return;
        }

        selectedFiles.push(...newFiles);
        renderPreviews();
        updateUploadStatus();
    });

    previewContainer.addEventListener('click', function (e) {
        const trashBtn = e.target.closest('.trash-can');
        if (trashBtn) {
            const indexToRemove = parseInt(trashBtn.getAttribute('data-index'));
            if (!isNaN(indexToRemove)) {
                selectedFiles.splice(indexToRemove, 1);
                renderPreviews();
                updateUploadStatus();
            }
        }
    });

    const form = document.getElementById('product-form');
    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        const checkedSizes = document.querySelectorAll('input[name="sizes[]"]:checked');
        const uploadedImages = document.querySelectorAll('.product-img img');

        if (checkedSizes.length === 0) {
            alert("Please select at least one size.");
            return;
        }

        if (uploadedImages.length < 2) {
            alert("Please upload at least two images.");
            return;
        }

        const priceValue = parseFloat(document.getElementById('product-price').value);
        if (isNaN(priceValue) || priceValue <= 0) {
            alert("Please enter a valid price greater than 0.");
            return;
        }

        const totalSizeBytes = selectedFiles.reduce((sum, file) => sum + file.size, 0);
        const maxBytes = maxUploadSizeMB * 1024 * 1024;
        if (totalSizeBytes > maxBytes) {
            alert(`Total image upload size exceeds ${formatBytes(maxBytes)}. Please reduce the number or size of images.`);
            return;
        }

        const formData = new FormData(form);

        // Append image files manually
        for (const file of selectedFiles) {
            formData.append('images[]', file);
        }

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json'
                },
                body: formData
            });

            const result = await response.json();

            if (response.ok) {
                alert(result.message || "Product uploaded successfully!");
                form.reset();
                selectedFiles = [];
                document.querySelectorAll('.product-img').forEach(el => el.remove());
            } else {
                alert(result.message || "Something went wrong.");
            }
        } catch (error) {
            alert("Upload failed. Please try again.");
            console.error(error);
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

    const maxUploadSizeMB = 8; // Match your PHP config post_max_size or lower
    const uploadStatus = document.getElementById('upload-status');

    function formatBytes(bytes) {
        return (bytes / (1024 * 1024)).toFixed(2) + 'MB';
    }

    function updateUploadStatus() {
        const totalSizeBytes = selectedFiles.reduce((sum, file) => sum + file.size, 0);
        const maxBytes = maxUploadSizeMB * 1024 * 1024;
        uploadStatus.textContent = `Uploaded: ${formatBytes(totalSizeBytes)} / Max: ${formatBytes(maxBytes)}`;

        if (totalSizeBytes > maxBytes) {
            uploadStatus.style.color = 'red';
        } else {
            uploadStatus.style.color = '#555';
        }
    }

    const sortable = new Sortable(previewContainer, {
    animation: 150,
    handle: 'img',
    draggable: '.product-img',
    onEnd: function () {
        // Rebuild selectedFiles based on new order in DOM
        const orderedFiles = [];
        previewContainer.querySelectorAll('.product-img').forEach(preview => {
            const index = parseInt(preview.getAttribute('data-index'));
            if (!isNaN(index)) {
                orderedFiles.push(selectedFiles[index]);
            }
        });
        selectedFiles = orderedFiles;
        renderPreviews(); // re-render to update indexes
        updateUploadStatus();
    }
});
</script>
@endpush

