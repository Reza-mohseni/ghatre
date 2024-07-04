document.addEventListener("DOMContentLoaded", function() {

  loadUserData();
  loadFontSettings();


  document.getElementById('userForm').addEventListener('submit', function(event) {
      event.preventDefault();
      saveUserData();
  });

  // Save font settings on form submit
  document.getElementById('fontForm').addEventListener('submit', function(event) {
      event.preventDefault();
      saveFontSettings();
  });
});

function saveUserData() {
  const userData = {
      name: document.getElementById('name').value,
      lasname: document.getElementById('lastname').value,
      phone: document.getElementById('phone').value,
      email: document.getElementById('email').value,
  };
  localStorage.setItem('userData', JSON.stringify(userData));
  alert("اطلاعات کاربر ذخیره شد");
}

function loadUserData() {
  const userData = JSON.parse(localStorage.getItem('userData'));
  if (userData) {
    document.getElementById('name').value = userData.name;
    document.getElementById('lastname').value = userData.lastname;
    document.getElementById('phone').value = userData.phone;
    document.getElementById('email').value = userData.email;
  }
}

function saveFontSettings() {
  const fontSettings = {
      fontname: document.getElementById('fontname').value,
      fontsize: document.getElementById('fontsize').value
  };
  localStorage.setItem('fontSettings', JSON.stringify(fontSettings));
  alert("تنظیمات فونت ذخیره شد");
  window.location.reload();
}

function loadFontSettings() {
  const fontSettings = JSON.parse(localStorage.getItem('fontSettings'));
  if (fontSettings) {
      document.getElementById('fontname').value = fontSettings.fontname;
      document.getElementById('fontsize').value = fontSettings.fontsize;
  }
}

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
function applyFontSettings() {
  const fontSettings = JSON.parse(localStorage.getItem('fontSettings'));
  if (fontSettings) {
      if (fontSettings.fontname) {
          document.body.style.fontFamily = fontSettings.fontname;
          // تنظیم فونت برای اینپوت‌ها
          const inputs = document.querySelectorAll('input, select, textarea,button');
          inputs.forEach(input => {
              input.style.fontFamily = fontSettings.fontname;
          });
      }
      if (fontSettings.fontsize) {
          const fontSize = parseInt(fontSettings.fontsize, 10);
          document.body.style.fontSize = fontSize + 'px';
          // تنظیم سایز فونت برای اینپوت‌ها
          const inputs = document.querySelectorAll('input, select, textarea');
          inputs.forEach(input => {
              input.style.fontSize = fontSize + 'px';
          });
        }
      }}

      function showBox(boxId) {
        // همه باکس‌ها را مخفی کن
        document.querySelectorAll('.form-conteyner').forEach(function (box) {
          box.style.display = 'none';
        });
        // باکس انتخاب شده را نمایش بده
        document.getElementById(boxId).style.display = 'block';
      }
      
const switchElement = document.querySelector('.switch');

switchElement.addEventListener('click', function () {
    document.body.classList.toggle('dark');

    if (document.body.classList.contains('dark')) {
        localStorage.setItem('theme', 'dark');
    } else {
        localStorage.setItem('theme', 'light');
    }
});

function saveUserData() {
  const userData = {
      name: document.getElementById('name').value,
      lastname: document.getElementById('lastname').value,
      phone: document.getElementById('phone').value,
      email: document.getElementById('email').value
  };
  localStorage.setItem('userData', JSON.stringify(userData));

  // ذخیره نام کاربر به صورت جداگانه در localStorage
  localStorage.setItem('userName', userData.name);
  localStorage.setItem('userlastName', userData.lasname);
  localStorage.setItem('userphone', userData.phone);
  localStorage.setItem('useremail', userData.email);

  // window.location.reload();
}
window.onload = function () {
    let localStorageTheme = localStorage.getItem('theme');

    if (localStorageTheme === 'dark') {
        document.body.classList.add('dark');
    }
};

// پاپ اپ

function showBoxpass(boxId) {
  var box = document.getElementById(boxId);
  if (boxId === 'password') {
      document.getElementById("popupOverlay").style.display = "block";
  }
  if (box) {
      box.style.display = "block";
  }
}

function closeBox(boxId) {
  var box = document.getElementById(boxId);
  if (boxId === 'password') {
      document.getElementById("popupOverlay").style.display = "none";
  }
  if (box) {
      box.style.display = "none";
  }
}

function savePassworduser() {
  var newPassword = document.getElementById("newPassword").value;
  localStorage.setItem("password", newPassword);
  alert("گذرواژه با موفقیت ذخیره شد.");
  closeBox("password");
}


document.getElementById("fontForm").addEventListener("submit", function(event) {
  event.preventDefaults();
  // alert("تنظیمات فونت با موفقیت ذخیره شد.");
});


// swet alert


document.getElementById('userForm').addEventListener('submit', function(event) {
  event.preventDefault();
  const formData = new FormData(this);

  fetch('../../../app/controllers/user/GET_NewUser.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
      Swal.fire({
          title: data.success ? 'موفقیت' : 'خطا',
          text: data.message,
          icon: data.success ? 'success' : 'error',
          confirmButtonText: 'باشه'
      });
  })
  .catch(error => {
      Swal.fire({
          title: 'خطا',
          text: 'مشکلی در ارتباط با سرور به وجود آمده است',
          icon: 'error',
          confirmButtonText: 'باشه'
      });
  });
});

function savePassword() {
  const formData = new FormData();
  formData.append('username', 'exampleUser'); // مقدارهای مناسب را اضافه کنید
  formData.append('password', 'examplePassword');

  fetch('../../../app/controllers/user/UPDATE_Password.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
      Swal.fire({
          title: data.success ? 'موفقیت' : 'خطا',
          text: data.message,
          icon: data.success ? 'success' : 'error',
          confirmButtonText: 'باشه'
      });
  })
  .catch(error => {
      Swal.fire({
          title: 'خطا',
          text: 'مشکلی در ارتباط با سرور به وجود آمده است',
          icon: 'error',
          confirmButtonText: 'باشه'
      });
  });
}