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


// we may return to this upper code, if it is too hard to implement,
// but for now, lets place here this

// Array of all image sources
const images = [
    'IMGs/watch-tissot.jpg',
    'IMGs/watch-sm.jpg',
    'IMGs/rolex-sm.jpg',
    'IMGs/tudor-sm.jpg',
];

// Current index of the image displayed in the modal
let currentImageIndex = 0;

// Show the larger image in the modal
function showLargeImage(imageSrc, index) {
    currentImageIndex = index; // Set current index based on clicked image
    const modal = document.getElementById('image-modal');
    const modalImg = document.getElementById('modal-img');
    modalImg.src = imageSrc;
    modal.style.display = "flex";  // Show the modal
}

// Change image when the arrow is clicked
// Change image when the arrow is clicked
function changeImage(direction, event) {
    event.stopPropagation();  // Prevent the modal from closing when the arrow is clicked

    currentImageIndex += direction;

    // Ensure the index stays within bounds (looping back if necessary)
    if (currentImageIndex < 0) {
        currentImageIndex = images.length - 1;
    } else if (currentImageIndex >= images.length) {
        currentImageIndex = 0;
    }

    // Update the image in the modal
    const modalImg = document.getElementById('modal-img');
    modalImg.src = images[currentImageIndex];
}


// Close the modal when clicked outside the image
function closeModal() {
    const modal = document.getElementById('image-modal');
    modal.style.display = "none";  // Hide the modal
}


// this code was created by ChatGPT