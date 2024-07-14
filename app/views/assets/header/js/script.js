  // حالت شب 
// انتخاب تمامی عناصر با کلاس .switch
const switchElements = document.querySelectorAll('.switch');

// تعریف رویداد کلیک برای هر کدام از عناصر
switchElements.forEach(function (switchElement) {
    switchElement.addEventListener('click', function () {
        document.body.classList.toggle('dark');

        if (document.body.classList.contains('dark')) {
            localStorage.setItem('theme', 'dark');
        } else {
            localStorage.setItem('theme', 'light');
        }
    });
});
window.onload = function () {
    let localStorageTheme = localStorage.getItem('theme');

    if (localStorageTheme === 'dark') {
        document.body.classList.add('dark');
    }
};

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