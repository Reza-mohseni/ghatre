document.addEventListener("DOMContentLoaded", () => {
    const itemsPerPage = 10;
    const mailContainer = document.getElementById('mail-container');
    const mailItems = mailContainer.children;
    const totalPages = Math.ceil(mailItems.length / itemsPerPage);
    let currentPage = 1;

    const showPage = (page) => {
      Array.from(mailItems).forEach((item, index) => {
        item.classList.remove('active');
        if (index >= (page - 1) * itemsPerPage && index < page * itemsPerPage) {
          item.classList.add('active');
        }
      });
    }

    const createPaginationButtons = () => {
      const paginationContainer = document.getElementById('pagination-container');
      paginationContainer.innerHTML = '';

      for (let i = 1; i <= totalPages; i++) {
        const button = document.createElement('button');
        button.textContent = i;
        button.classList.add('page-btn');
        if (i === currentPage) {
          button.classList.add('active');
        }
        button.addEventListener('click', () => {
          currentPage = i;
          showPage(currentPage);
          updatePaginationButtons();
        });
        paginationContainer.appendChild(button);
      }
    }

    const updatePaginationButtons = () => {
      const buttons = document.querySelectorAll('.page-btn');
      buttons.forEach(button => {
        button.classList.remove('active');
        if (parseInt(button.textContent) === currentPage) {
          button.classList.add('active');
        }
      });
    }

    // نمایش صفحه اول به طور پیش‌فرض
    showPage(currentPage);
    createPaginationButtons();
  });

  function showpopup(boxId) {
    var box = document.getElementById(boxId);
    var overlay = document.getElementById("popupOverlay");
    if (boxId === 'popup-box') {
      overlay.style.display = "block";
      box.style.display = "flex";
      box.classList.add("show");
    }
  }
  
  function closepopup(boxId) {
    var box = document.getElementById(boxId);
    var overlay = document.getElementById("popupOverlay");
    if (boxId === 'popup-box') {
      overlay.style.display = "none";
      box.classList.remove("show");
    }
  }