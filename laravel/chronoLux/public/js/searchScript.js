let input = document.getElementById("finder-input")

function showSearch()
{
    input.classList.toggle("finder-input-show");
    input.focus();
}

function handleSearchInput(inputElement) {
    inputElement.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            const query = inputElement.value.trim();
            if (query !== '') {
                const params = new URLSearchParams(window.location.search);
                params.set('search', query);
                window.location.href = '/products?' + params.toString();
            }
        }
    });
}

const inputFindDesktop = document.getElementById("finder-input");
const inputFindMobile = document.getElementById("finder-input-mobile");

if (inputFindDesktop) handleSearchInput(inputFindDesktop);
if (inputFindMobile) handleSearchInput(inputFindMobile);

function clearSearch() {
    const params = new URLSearchParams(window.location.search);
    params.delete('search');
    window.location.search = params.toString();
}