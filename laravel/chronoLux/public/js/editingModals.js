function openAddressEditModal()
{
    const modal = document.getElementById('address-edit-modal');
    modal.style.display = 'flex';
    
    const input = modal.querySelector('input[name="city"]');
    input.focus()
}
function openContactEditModal()
{
    const modal = document.getElementById('contact-edit-modal');
    modal.style.display = 'flex';

    const input = modal.querySelector('input[name="phone-number"]');
    input.focus()
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