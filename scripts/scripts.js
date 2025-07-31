AOS.init();
const lightbox = GLightbox({ selector: ".glightbox" });
document.addEventListener("DOMContentLoaded", () => {
  GLightbox({ selector: ".glightbox", loop: !0, zoomable: !0 }),
    AOS.init({ duration: 500, once: !0 });
}),
  document.addEventListener("lazyloaded", function () {
    AOS.refresh();
  });

  document.addEventListener("DOMContentLoaded", () => {
  // Height of your fixed navbar (adjust if needed)
  const navbarHeight = document.querySelector('nav').offsetHeight || 70;

  // Function to offset scroll
  function offsetAnchor() {
    if (window.location.hash.length > 0) {
      const id = window.location.hash.substring(1);
      const target = document.getElementById(id);
      if (target) {
        const elementPosition = target.getBoundingClientRect().top + window.pageYOffset;
        window.scrollTo({
          top: elementPosition - navbarHeight - 10, // 10px extra padding
          behavior: 'smooth'
        });
      }
    }
  }

  // Offset when page loads with a hash
  offsetAnchor();

  // Offset when clicking internal links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', e => {
      e.preventDefault();
      const href = anchor.getAttribute('href');
      const id = href.substring(1);
      const target = document.getElementById(id);
      if (target) {
        const elementPosition = target.getBoundingClientRect().top + window.pageYOffset;
        window.history.pushState(null, null, href);
        window.scrollTo({
          top: elementPosition - navbarHeight - 10,
          behavior: 'smooth'
        });
      }
    });
  });
});
