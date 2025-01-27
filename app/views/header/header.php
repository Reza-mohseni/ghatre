<?php
require_once '../../core/healper/healper.php';

?>
<link rel="stylesheet" href="<?= asset('header/style/style.css')?>">


<!-- منوی بالا -->
<div class="topbar">
  <div class="topbar-right">
    <div class="user">
      <p> سلام <?= $_SESSION['name']?> عزیز!</p>
    </div>
    <div class="Exit-box">
      <a href="http://localhost/ghatre/logout.php">
        <div class="Exit-icon">
          <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon"
            style="width: 1em; height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;"
            viewBox="0 0 1024 1024" version="1.1">
            <path
              d="M184.552727 768l0-512c0-38.539636 31.278545-69.818182 69.818182-69.818182l302.545455 0L556.916364 139.636364l-325.818182 0c-51.432727 0-93.090909 41.658182-93.090909 93.090909l0 558.545455c0 51.432727 41.658182 93.090909 93.090909 93.090909l325.818182 0 0-46.545455-302.545455 0C215.784727 837.818182 184.552727 806.539636 184.552727 768zM924.113455 495.522909l-164.584727-164.584727c-9.076364-9.076364-23.831273-9.076364-32.907636 0-9.076364 9.076364-9.076364 23.831273 0 32.907636l124.834909 124.834909L394.007273 488.680727c-12.846545 0-23.272727 10.426182-23.272727 23.272727s10.426182 23.272727 23.272727 23.272727l457.448727 0-124.834909 124.834909c-9.076364 9.076364-9.076364 23.831273 0 32.907636 9.076364 9.076364 23.831273 9.076364 32.907636 0l164.584727-164.584727C933.189818 519.354182 933.189818 504.645818 924.113455 495.522909z" />
          </svg>
        </div>
        <div class="Exit-text">
          <p>خروج</p>
        </div>
      </a>
    </div>
  </div>
  <div class="topbar-left">
    <div class="box-icon">
      <span class="icon-menu"><i class="bi bi-list"></i></span>
    </div>
    <div class="switch-box">
      <div class="switch">
        <div class="ligh"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            enable-background="new 0 0 512 512" height="25px" id="Layer_1" version="1.1" viewBox="0 0 512 512"
            width="25px" xml:space="preserve">
            <g>
              <g>
                <path
                  d="M256,144c-61.75,0-112,50.25-112,112s50.25,112,112,112s112-50.25,112-112S317.75,144,256,144z M256,336    c-44.188,0-80-35.812-80-80c0-44.188,35.812-80,80-80c44.188,0,80,35.812,80,80C336,300.188,300.188,336,256,336z M256,112    c8.833,0,16-7.167,16-16V64c0-8.833-7.167-16-16-16s-16,7.167-16,16v32C240,104.833,247.167,112,256,112z M256,400    c-8.833,0-16,7.167-16,16v32c0,8.833,7.167,16,16,16s16-7.167,16-16v-32C272,407.167,264.833,400,256,400z M380.438,154.167    l22.625-22.625c6.25-6.25,6.25-16.375,0-22.625s-16.375-6.25-22.625,0l-22.625,22.625c-6.25,6.25-6.25,16.375,0,22.625    S374.188,160.417,380.438,154.167z M131.562,357.834l-22.625,22.625c-6.25,6.249-6.25,16.374,0,22.624s16.375,6.25,22.625,0    l22.625-22.624c6.25-6.271,6.25-16.376,0-22.625C147.938,351.583,137.812,351.562,131.562,357.834z M112,256    c0-8.833-7.167-16-16-16H64c-8.833,0-16,7.167-16,16s7.167,16,16,16h32C104.833,272,112,264.833,112,256z M448,240h-32    c-8.833,0-16,7.167-16,16s7.167,16,16,16h32c8.833,0,16-7.167,16-16S456.833,240,448,240z M131.541,154.167    c6.251,6.25,16.376,6.25,22.625,0c6.251-6.25,6.251-16.375,0-22.625l-22.625-22.625c-6.25-6.25-16.374-6.25-22.625,0    c-6.25,6.25-6.25,16.375,0,22.625L131.541,154.167z M380.459,357.812c-6.271-6.25-16.376-6.25-22.625,0    c-6.251,6.25-6.271,16.375,0,22.625l22.625,22.625c6.249,6.25,16.374,6.25,22.624,0s6.25-16.375,0-22.625L380.459,357.812z"
                  fill="#ffffff" />
              </g>
            </g>
          </svg></div>
        <div class="flicker"></div>
        <div class="moon"></div>
      </div>
    </div>
  </div>
</div>

<!-- منوی بالا پایان -->
<script src="<?= asset('header/js/script.js') ?>"></script>