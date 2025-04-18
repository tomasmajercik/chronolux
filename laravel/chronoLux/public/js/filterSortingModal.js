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
    var form = document.createElement('form');
    form.method = 'GET';

    // Get the current category from the URL (from the select dropdown)
    var category = document.getElementById('category').value;
    var url = '/products';  // Default to '/products'

    // If category is selected, append it to the URL
    if (category && category !== 'all') {
        url += '/' + encodeURIComponent(category);
    }

    form.action = url;

    // Add the brand, and price filters to the form
    var brand = document.getElementById('brand').value;
    var priceMin = document.getElementById('min-price').value;
    var priceMax = document.getElementById('max-price').value;

    // Append values to the form as hidden inputs
    if (brand && brand !== 'all') {
        var brandInput = document.createElement('input');
        brandInput.type = 'hidden';
        brandInput.name = 'brand';
        brandInput.value = brand;
        form.appendChild(brandInput);
    }

    // Append sizes as an array
    document.querySelectorAll('input[name="sizes[]"]:checked').forEach(function(checkbox) {
        var sizeInput = document.createElement('input');
        sizeInput.type = 'hidden';
        sizeInput.name = 'sizes[]'; // Laravel spracuje ako pole
        sizeInput.value = checkbox.value;
        form.appendChild(sizeInput);
    });


    if (priceMin) {
        var priceMinInput = document.createElement('input');
        priceMinInput.type = 'hidden';
        priceMinInput.name = 'price_min';
        priceMinInput.value = priceMin;
        form.appendChild(priceMinInput);
    }

    if (priceMax) {
        var priceMaxInput = document.createElement('input');
        priceMaxInput.type = 'hidden';
        priceMaxInput.name = 'price_max';
        priceMaxInput.value = priceMax;
        form.appendChild(priceMaxInput);
    }
    // Submit the form
    document.body.appendChild(form);
    form.submit();
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