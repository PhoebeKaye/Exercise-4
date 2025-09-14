script.js
// Feedback Form Toggle
const feedbackButton = document.querySelector('.feedback-button');
const feedbackFormContainer = document.querySelector('.feedback-form-container');

feedbackButton.addEventListener('click', () => {
  feedbackFormContainer.classList.toggle('visible');
});

// Close feedback form when clicking outside
document.addEventListener('click', (e) => {
  if (!feedbackFormContainer.contains(e.target) && !feedbackButton.contains(e.target)) {
    feedbackFormContainer.classList.remove('visible');
  }
});


const backToTopBtn = document.getElementById('backToTop');
window.addEventListener('scroll', () => {
  if (window.scrollY > 300) {
    backToTopBtn.style.display = 'block';
  } else {
    backToTopBtn.style.display = 'none';
  }
});

backToTopBtn.addEventListener('click', () => {
  window.scrollTo({ top: 0, behavior: 'smooth' });
});


const heartMenu = document.querySelector('.heart-menu');
heartMenu.addEventListener('click', () => {
  heartMenu.classList.toggle('open');
});

// Fade-in Animation on Scroll
const faders = document.querySelectorAll('.fade-in');
const appearOptions = { threshold: 0.2, rootMargin: "0px 0px -50px 0px" };

const appearOnScroll = new IntersectionObserver(function(entries, observer) {
  entries.forEach(entry => {
    if (!entry.isIntersecting) return;
    entry.target.classList.add('visible');
    observer.unobserve(entry.target);
  });
}, appearOptions);

faders.forEach(fader => { appearOnScroll.observe(fader); });
