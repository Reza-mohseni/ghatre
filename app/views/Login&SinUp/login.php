<?php
require_once '../../core/healper/healper.php';

session_start();
if(isset($_SESSION["name"])){
    redirect('app/views/dashboard/dashboard.php');
}
?>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ورود/ثبت نام</title>
  <link rel="stylesheet" href="<?= asset('Login&SinUp/css/login-style.css')?>">
  <!-- کتابخانه SweetAlert را در فایل HTML خود اضافه کنید -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="wrapper">
  <div class="title-text">
    <div class="title login">ورود</div>
    <div class="title signup">ثبت نام</div>
  </div>
  <div class="form-container">
    <div class="slide-controls">
      <input type="radio" name="slide" id="login" checked>
      <input type="radio" name="slide" id="signup">
      <label for="login" class="slide login">ورود</label>
      <label for="signup" class="slide signup">ثبت نام</label>
      <div class="slider-tab"></div>
    </div>
    <div class="form-inner">
      <form id="loginForm" class="login margin">
        <div class="field">
          <input type="text" name="UserName" placeholder="ایمیل یا تلفن" required>
        </div>
        <div class="field password-container">
          <input type="password" name="Password" placeholder="گذرواژه" required id="password1">
          <i id="togglePassword1" class="bi bi-eye"></i>
        </div>
        <div class="field btn">
          <div class="btn-layer"></div>
          <input type="submit" value="ورود" class="submit">
        </div>
        <div class="signup-link">حسابی ندارید؟<a href="#">ثبت نام کنید</a></div>
      </form>
      <form id="registerForm" method="post" class="signup">
        <div class="field">
          <input type="text" name="Name" placeholder="نام" required >
        </div>
        <div class="field">
          <input type="text" name="LastName" placeholder="نام خانوادگی" required >
        </div>
        <div class="field">
          <input type="number" name="NumberPhone" placeholder="شماره تلفن" required value="09">
        </div>
        <div class="field">
          <input type="email" name="Email" placeholder="ایمیل" required >
        </div>
        <div class="field password-container">
          <input type="password" name="Password" placeholder="گذرواژه" required  id="password2">
          <i id="togglePassword2" class="bi bi-eye"></i>
        </div>
        <div class="field password-container">
          <input type="password" name="ConfirmPassword" placeholder="تکرار گذرواژه" required id="password3">
          <i id="togglePassword3" class="bi bi-eye"></i>
        </div>
        <div class="field btn">
          <div class="btn-layer"></div>
          <input type="submit" value="ثبت نام">
        </div>
      </form>
    </div>
  </div>
</div>

<script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);

        fetch('../../../app/controllers/user/LoginUser.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                console.log('Response text:', data);
                try {
                    const jsonData = JSON.parse(data);
                    console.log('Parsed JSON:', jsonData);
                    Swal.fire({
                        title: jsonData.success ? 'موفقیت' : 'خطا',
                        text: jsonData.message,
                        icon: jsonData.success ? 'success' : 'error',
                        confirmButtonText: 'باشه'
                    }).then(() => {
                        if (jsonData.success && jsonData.redirect) {
                            window.location.href = jsonData.redirect;
                        }
                    });
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                    Swal.fire({
                        title: 'خطا',
                        text: 'پاسخ سرور معتبر نیست',
                        icon: 'error',
                        confirmButtonText: 'باشه'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'خطا',
                    text: 'مشکلی در ارتباط با سرور به وجود آمده است',
                    icon: 'error',
                    confirmButtonText: 'باشه'
                });
            });
    });





    document.getElementById('registerForm').addEventListener('submit', function(event) {
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
</script>
<script  src="../assets/Login&SinUp/js/login-script.js"></script>
</body>
</html>
