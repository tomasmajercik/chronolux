function showLargeImage(imageSrc) 
{
    var modal = document.getElementById('image-modal');
    var modalImg = document.getElementById('modal-img');
    modalImg.src = imageSrc;
    modal.style.display = "flex";
}

function closeModal() 
{
    var modal = document.getElementById('image-modal');
    modal.style.display = "none";  
}
