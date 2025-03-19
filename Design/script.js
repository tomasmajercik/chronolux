const container = document.getElementById('container');
const createBtn = document.getElementById('createAccountBtn');
const signInBtn = document.getElementById('signInBtn');

if (container && createBtn && signInBtn) {
  createBtn.addEventListener('click', () => {
    container.classList.add('slide-active');
  });

  signInBtn.addEventListener('click', () => {
    container.classList.remove('slide-active');
  });
}