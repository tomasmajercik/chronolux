// Header MENU

function toggleMenu() {
  document.querySelector(".mobile-menu").classList.toggle("active");
  document.querySelector(".menu-icon").classList.toggle("active");
  document.querySelector(".close-icon").classList.toggle("active");
  document.querySelector("body").classList.toggle("no-scroll");
}


// PAYMENT
function toggleCardInfo() {
  document.querySelector(".card-info").classList.toggle("active");
}

// SIDEBAR
function openSidebar() {
  // document.querySelector(".sidebar").classList.toggle("active");
  document.getElementById("sidebar").classList.toggle("active");

  if (sidebar.classList.contains("active")) {
      console.log("Sidebar is now HIDDEN");
      document.body.style.overflow = "hidden";
    } else {
      console.log("Sidebar is now VISIBLE");
      document.body.style.overflow = "auto";
  }
}

// PROCEED
let thanks = document.getElementById("thanks");
let orderInfo = document.getElementById("order-info")
let profile = document.getElementById("profile-redirect")

setTimeout(() => {
    thanks.classList.add("show")
}, 500)

setTimeout(() => {
    orderInfo.classList.add("show")
}, 1000)

setTimeout(() => {
    profile.classList.add("show")
}, 1500)

//LOGIN
// Code built with help of Chat GPT to ensure proper functionality of animations on desktop and mobile
const container = document.getElementById('container');
const createBtn = document.getElementById('createAccountBtn');
const signInBtn = document.getElementById('signInBtn');

let isSignUpActive = container?.classList.contains('slide-active') || false;

if (container && createBtn && signInBtn) {
  createBtn.addEventListener('click', () => {
    container.classList.add('slide-active');
    isSignUpActive = true;
  });

  signInBtn.addEventListener('click', () => {
    container.classList.remove('slide-active');
    isSignUpActive = false;
  });

  window.addEventListener('resize', () => {
    if (isSignUpActive) {
      container.classList.add('slide-active');
    } else {
      container.classList.remove('slide-active');
    }
  });

  if (isSignUpActive) {
    container.classList.add('slide-active');
  } else {
    container.classList.remove('slide-active');
  }
}

function toggleLink() {
  container.classList.toggle('slide-active');
  isSignUpActive = container.classList.contains('slide-active');
}

// end of code built with help of Chat GPT

// Success Modal
function closeSuccessModal() {
  const modal = document.getElementById('success-modal');
  if (modal) {
      modal.style.display = 'none';
  }
}

// Optional auto-close after 3 seconds
setTimeout(() => {
  closeSuccessModal();
}, 3000);

// Handle size selection
document.querySelectorAll('.size-btn').forEach(button => {
    button.addEventListener('click', function () {
        // Remove active class from all
        document.querySelectorAll('.size-btn').forEach(btn => btn.classList.remove('selected'));
        // Add active class to clicked one
        this.classList.add('selected');
        // Update hidden input value
        document.getElementById('selected-variant-id').value = this.dataset.id;
    });
});

// Set default selected button (first one)
const firstSizeBtn = document.querySelector('.size-btn');
if (firstSizeBtn) {
    firstSizeBtn.classList.add('selected');
    document.getElementById('selected-variant-id').value = firstSizeBtn.dataset.id;
} // This ensures that the first button is selected by default and also behaves like clicked
