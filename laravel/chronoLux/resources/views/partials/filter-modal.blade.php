<div id="filter-modal" class="filter-modal">
    <div class="filter-content">
        <span class="close-btn" onclick="closeFilter()">&times;</span>
        <h3>Filter Products</h3>
        <div class="selects">
            <div class="filter-modal-holder">
                <label for="category">Category:</label>
                <select id="category" name="category">
                    <option value="all">All</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->category_name }}" 
                            {{ request('category') == $category->category_name || $category->category_name == $category_name ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="filter-modal-holder">
                <label for="brand">Brand:</label>
                <select id="brand" name="brand">
                    <option value="all">All</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->brand_name }}" 
                            {{ request('brand') == $brand->brand_name ? 'selected' : '' }}>
                            {{ $brand->brand_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <label id="label-size">Size:</label>
        <div class="size-options">
            @foreach(['42mm', '43mm', '44mm', '45mm', '46mm'] as $size)
                <input type="checkbox" id="size-{{ $size }}" name="sizes[]" value="{{ $size }}" 
                    {{ in_array($size, request('sizes', [])) ? 'checked' : '' }}>
                <label for="size-{{ $size }}">{{ $size }}</label>
            @endforeach
        </div>

        <div class="price-range">
            <label for="min-price">Min Price (€):</label>
            <input type="number" id="min-price" name="price_min" min="0" value="{{ request('price_min') }}" />

            <label for="max-price">Max Price (€):</label>
            <input type="number" id="max-price" name="price_max" min="0" value="{{ request('price_max') }}" />
        </div>

        <button class="apply-filter" onclick="applyFilter()">Apply Filter</button>
    </div>
</div>