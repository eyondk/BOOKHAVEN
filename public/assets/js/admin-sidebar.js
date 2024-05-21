const logo = document.querySelector(".toggle-btn");

logo.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
});