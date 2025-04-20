function openAddressEditModal()
{
    document.getElementById('address-edit-modal').style.display = 'flex';
}
function openContactEditModal()
{
    document.getElementById('contact-edit-modal').style.display = 'flex';
}
document.addEventListener('DOMContentLoaded', function() { // to close the modal when clicking outside of it 
    const modal = document.getElementById('address-edit-modal');

    if (modal) {
        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.style.display = 'none'; 
            }
        });
    }
});
document.addEventListener('DOMContentLoaded', function() { // to close the modal when clicking outside of it 
    const modal = document.getElementById('contact-edit-modal');

    if (modal) {
        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.style.display = 'none'; 
            }
        });
    }
});