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



function openSort() {
    document.getElementById('sort-modal').style.display = 'flex';
}
function closeSort() {
    document.getElementById('sort-modal').style.display = 'none';
}