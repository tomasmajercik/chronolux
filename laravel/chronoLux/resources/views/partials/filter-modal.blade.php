<div id="filter-modal" class="filter-modal">
    <div class="filter-content">
        <span class="close-btn" onclick="closeFilter()">&times;</span>
        <h3>Filter Products</h3>
        <div class="selects">
            <div class="filter-modal-holder">
                <label for="category">Category:</label>
                <select id="category">
                    <option value="all">All</option>
                    <option value="watches">Entry Luxury</option>
                    <option value="smartwatch">Basic Luxuruy</option>
                    <option value="luxury">Ultra Luxury</option>
                </select>
            </div>

            <div class="filter-modal-holder">
                <label for="brand">Brand:</label>
                <select id="brand">
                    <option value="all">All</option>
                    <option value="rolex">Rolex</option>
                    <option value="tissot">Tissot</option>
                    <option value="tudor">Tudor</option>
                </select>
            </div>
        </div>

        <label id="label-size">Size:</label>
        <div class="size-options">
            <input type="checkbox" id="size-42" value="42mm"> <label for="size-42">42mm</label>
            <input type="checkbox" id="size-43" value="43mm"> <label for="size-42">43mm</label>
            <input type="checkbox" id="size-44" value="44mm"> <label for="size-44">44mm</label>
            <input type="checkbox" id="size-45" value="45mm"> <label for="size-45">45mm</label>
            <input type="checkbox" id="size-46" value="46mm"> <label for="size-46">46mm</label>
        </div>

        <div class="price-range">
            <input type="range" id="price" min="100" max="10000" step="50"
                oninput="updatePriceValue(this.value)">
            <span id="price-value">100€ - 10000€</span>
        </div>

        <button class="apply-filter" onclick="applyFilter()">Apply Filter</button>
    </div>
</div>