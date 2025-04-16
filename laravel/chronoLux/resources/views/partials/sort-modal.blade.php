<div id="sort-modal" class="sort-modal">
    <div class="sort-content">
        <span class="close-btn" onclick="closeSort()">&times;</span>
        <h3>Sort Products</h3>

        <div class="sort-modal-holder">
            <label for="sort-price">Sort by Price:</label>
            <select id="sort-price">
                <option value="none">-- Select --</option>
                <option value="low-to-high">Low to High</option>
                <option value="high-to-low">High to Low</option>
            </select>
        </div>

        <div class="sort-modal-holder">
            <label for="sort-brand">Sort by Brand:</label>
            <select id="sort-brand">
                <option value="none">-- Select --</option>
                <option value="a-z">A - Z</option>
                <option value="z-a">Z - A</option>
            </select>
        </div>

        <button class="apply-sort" onclick="applySort()">Apply Sort</button>
    </div>
</div>