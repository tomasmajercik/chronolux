let currentImageIndex = 0;
let galleryImages = [];

document.addEventListener('DOMContentLoaded', function () {
    const mainImg = document.querySelector('.main-img');
    const thumbnails = Array.from(document.querySelectorAll('.product-gallery img'));

    // first image is the main image
    galleryImages = [mainImg, ...thumbnails];

    // add click event to main image
    galleryImages.forEach((img, index) => {
        img.addEventListener('click', () => {
            showLargeImage(img.src, index);
        });
    });
});

function showLargeImage(imageSrc, index) {
    currentImageIndex = index;

    const modal = document.getElementById('image-modal');
    const modalImg = document.getElementById('modal-img');

    modalImg.src = imageSrc;
    modal.style.display = "flex";
}

function changeImage(direction, event) {
    event.stopPropagation();

    currentImageIndex += direction;

    if (currentImageIndex < 0) {
        currentImageIndex = galleryImages.length - 1;
    } else if (currentImageIndex >= galleryImages.length) {
        currentImageIndex = 0;
    }

    const modalImg = document.getElementById('modal-img');
    modalImg.src = galleryImages[currentImageIndex].src;
}

function closeModal() {
    const modal = document.getElementById('image-modal');
    modal.style.display = "none";
}

// this code was created by ChatGPT