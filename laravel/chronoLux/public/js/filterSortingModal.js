function openFilter() 
{
    document.getElementById('filter-modal').style.display = 'flex';
}
function closeFilter() 
{
    document.getElementById('filter-modal').style.display = 'none';
}
function updatePriceValue(value) 
{
    document.getElementById('price-value').textContent = "100€ - " + value + "€";
}

// Close the filter and sort modals when clicking outside of them
window.addEventListener('click', function(event) {
    var filterModal = document.getElementById('filter-modal');
    if (event.target === filterModal) {
        closeFilter();
    }

    var sortModal = document.getElementById('sort-modal');
    if (event.target === sortModal) {
        closeSort();
    }
});


function openSort() {
    document.getElementById('sort-modal').style.display = 'flex';
}
function closeSort() {
    document.getElementById('sort-modal').style.display = 'none';
}

function applyFilter() {
    const category = document.getElementById('category').value;
    const brand = document.getElementById('brand').value;
    const priceMin = document.getElementById('min-price').value;
    const priceMax = document.getElementById('max-price').value;

    // Get selected sizes
    const sizes = [];
    document.querySelectorAll('input[name="sizes[]"]:checked').forEach(function(checkbox) {
        sizes.push(checkbox.value);
    });

    // Create a new URLSearchParams object to handle query parameters
    const params = new URLSearchParams(window.location.search);

    // Update the URL path with the selected category
    let url = '/products';  // Default URL
    if (category && category !== 'all') {
        url += '/' + encodeURIComponent(category);  // Append the category as part of the path
    }

    // Add the brand to the query string
    if (brand && brand !== 'all') {
        params.set('brand', brand);
    } else {
        params.delete('brand');
    }

    // Add the selected sizes as an array in the query string (sizes[])
    if (sizes.length > 0) {
        sizes.forEach(function(size) {
            params.append('sizes[]', size); // Append each size as a separate 'sizes[]' parameter
        });
    } else {
        params.delete('sizes[]');
    }

    // Add the price filter to the query string
    if (priceMin) {
        params.set('price_min', priceMin);
    } else {
        params.delete('price_min');
    }

    if (priceMax) {
        params.set('price_max', priceMax);
    } else {
        params.delete('price_max');
    }

    // Update the URL with the new filters
    if (params.toString()) {
        url += '?' + params.toString();  // Append the query string to the URL
    }

    window.location.href = url;  // Navigate to the new URL
}

function applySort() {
    const priceSort = document.getElementById('sort-price').value;
    const nameSort = document.getElementById('sort-name').value;

    const params = new URLSearchParams(window.location.search);

    // Price sorting
    if (priceSort === 'low-to-high') {
        params.set('sort_price', 'low-to-high');
    } else if (priceSort === 'high-to-low') {
        params.set('sort_price', 'high-to-low');
    } else {
        params.delete('sort_price');
    }

    // Name sorting
    if (nameSort === 'a-z') {
        params.set('sort_name', 'a_z');
    } else if (nameSort === 'z-a') {
        params.set('sort_name', 'z_a');
    } else {
        params.delete('sort_name');
    }

    // Go to new URL with params
    window.location.search = params.toString();
}