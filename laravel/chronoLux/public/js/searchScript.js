let input = document.getElementById("finder-input")

function showSearch()
{
    input.classList.toggle("finder-input-show");
    input.focus();
}

const inputFind = document.getElementById("finder-input");

inputFind.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        const query = inputFind.value.trim();

        if (query !== '') {
            const currentPath = window.location.pathname;
            const params = new URLSearchParams(window.location.search);
            params.set('search', query);

            window.location.href = '/products?' + params.toString();
        }
    }
});

function clearSearch() {
    const params = new URLSearchParams(window.location.search);
    params.delete('search');
    window.location.search = params.toString();
}