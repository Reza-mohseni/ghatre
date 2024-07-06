
let menu = document.querySelector(".menu")
let menuBtn = document.querySelector(".icon-menu")
let menuBtnIcon = document.querySelector(".icon-menu i")

menuBtn.addEventListener("click", function () {
  if (menuBtnIcon.classList.contains("bi-list")) {
    menu.style.right = "0"
    menuBtnIcon.classList = "bi bi-x"
  } else {
    menu.style.right = "-210px"
    menuBtnIcon.classList = "bi bi-list"
  }
})  