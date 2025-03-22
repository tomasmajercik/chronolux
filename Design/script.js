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