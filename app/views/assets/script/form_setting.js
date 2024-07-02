document.addEventListener("DOMContentLoaded", function() {
    applyFontSettings();
  });
  
  function applyFontSettings() {
    const fontSettings = JSON.parse(localStorage.getItem('fontSettings'));
    if (fontSettings) {
        if (fontSettings.fontname) {
            document.body.style.fontFamily = fontSettings.fontname;
        }
        if (fontSettings.fontsize) {
            const fontSize = parseInt(fontSettings.fontsize, 10);
            document.body.style.fontSize = fontSize + 'px';
  
            // تنظیم سایز فونت تیترها
            const headers = document.querySelectorAll('h1, h2, h3, h4, h5, h6');
            headers.forEach(header => {
                header.style.fontSize = (fontSize + 8) + 'px';
            });
        }
    }
  }
  
  
  
  // حالت شب 
  const switchElement = document.querySelector('.switch');
  
  switchElement.addEventListener('click', function () {
      document.body.classList.toggle('dark');
  
      if (document.body.classList.contains('dark')) {
          localStorage.setItem('theme', 'dark');
      } else {
          localStorage.setItem('theme', 'light');
      }
  });
  
  window.onload = function () {
      let localStorageTheme = localStorage.getItem('theme');
  
      if (localStorageTheme === 'dark') {
          document.body.classList.add('dark');
      }
  };
  document.addEventListener("DOMContentLoaded", function() {
    displayUserNameInElement('displayuser');
  });
  
  function displayUserNameInElement(elementId) {
    const userName = localStorage.getItem('userName');
    if (userName) {
        const element = document.getElementById(elementId);
        element.textContent = `سلام، ${userName}!`;
    }
  }
  
    
  let menu = document.querySelector(".menu")
  let menuBtn = document.querySelector(".icon-menu")
  let menuBtnIcon = document.querySelector(".icon-menu i")
  
  menuBtn.addEventListener("click", function () {
    if (menuBtnIcon.classList.contains("bi-list")) {
      menu.style.right = "0"
      menuBtnIcon.classList = "bi bi-x-circle"
    } else {
      menu.style.right = "-210px"
      menuBtnIcon.classList = "bi bi-list"
    }
  })  