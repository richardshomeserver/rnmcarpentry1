AOS.init();
const lightbox = GLightbox({ selector: ".glightbox" });
document.addEventListener("DOMContentLoaded", () => {
  GLightbox({ selector: ".glightbox", loop: !0, zoomable: !0 }),
    AOS.init({ duration: 500, once: !0 });
}),
  document.addEventListener("lazyloaded", function () {
    AOS.refresh();
  });
