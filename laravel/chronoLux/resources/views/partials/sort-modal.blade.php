<div id="sort-modal" class="sort-modal">
    <div class="sort-content">
        <span class="close-btn" onclick="closeSort()">&times;</span>
        <h3>Sort Products</h3>

        <div class="sort-modal-holder">
            <label for="sort-price">Sort by Price:</label>
            <select id="sort-price">
                <option value="none" {{ request('sort_price') === null ? 'selected' : '' }}>-- Select --</option>
                <option value="low-to-high" {{ request('sort_price') === 'low-to-high' ? 'selected' : '' }}>Low to High</option>
                <option value="high-to-low" {{ request('sort_price') === 'high-to-low' ? 'selected' : '' }}>High to Low</option>
            </select>
        </div>

        <div class="sort-modal-holder">
            <label for="sort-name">Sort by Name:</label>
            <select id="sort-name">
                <option value="none" {{ request('sort_name') === null ? 'selected' : '' }}>-- Select --</option>
                <option value="a-z" {{ request('sort_name') === 'a_z' ? 'selected' : '' }}>A - Z</option>
                <option value="z-a" {{ request('sort_name') === 'z_a' ? 'selected' : '' }}>Z - A</option>
            </select>
        </div>

        <button class="apply-sort" onclick="applySort()">Apply Sort</button>
    </div>
</div>