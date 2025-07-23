// Optional: Load external HTML into sections
document.addEventListener("DOMContentLoaded", function () {
  fetch("partials/header.html")
    .then(res => res.text())
    .then(data => document.getElementById("header").innerHTML = data);

  fetch("partials/footer.html")
    .then(res => res.text())
    .then(data => document.getElementById("footer").innerHTML = data);
});
