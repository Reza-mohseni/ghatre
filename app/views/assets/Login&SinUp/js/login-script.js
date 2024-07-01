const loginText = document.querySelector(".title-text .login");
const loginForm = document.querySelector("form.login");
const loginBtn = document.querySelector("label.login");
const signupBtn = document.querySelector("label.signup");
const signupLink = document.querySelector("form .signup-link a");
signupBtn.onclick = () => {
  loginForm.style.marginLeft = "-50%";
  loginText.style.marginLeft = "-50%";
};
loginBtn.onclick = () => {
  loginForm.style.marginLeft = "0%";
  loginText.style.marginLeft = "0%";
};
signupLink.onclick = () => {
  signupBtn.click();
  return false;
};

const togglePassword1 = document.querySelector('#togglePassword1');
const password1 = document.querySelector('#password1');

togglePassword1.addEventListener('click', function (e) {
    const type = password1.getAttribute('type') === 'password' ? 'text' : 'password';
    password1.setAttribute('type', type);
    
    this.classList.toggle('bi-eye');
    this.classList.toggle('bi-eye-slash');
});

const togglePassword2 = document.querySelector('#togglePassword2');
const password2 = document.querySelector('#password2');

togglePassword2.addEventListener('click', function (e) {
    const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
    password2.setAttribute('type', type);
    
    this.classList.toggle('bi-eye');
    this.classList.toggle('bi-eye-slash');
});

const togglePassword3 = document.querySelector('#togglePassword3');
const password3 = document.querySelector('#password3');

togglePassword3.addEventListener('click', function (e) {
    const type = password3.getAttribute('type') === 'password' ? 'text' : 'password';
    password3.setAttribute('type', type);
    
    this.classList.toggle('bi-eye');
    this.classList.toggle('bi-eye-slash');
});
