<?php
require_once '../../core/healper/healper.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تنظیمات</title>
  <link rel="stylesheet" href="<?= asset('setting\css\settings.css')?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

<!-- منوی راست -->

<?php require_once '../menu/menu.php'; ?>
    <!-- منوی راست -->
    <!-- هدر -->
    <?php require_once '../header/header.php'; ?>
    <!--هدر پایان -->
    <!-- فرم تنظیمات -->
    </select>
    <section class="form">
      <!-- فرم تنظیمات فونت -->
      <div class="form-conteyner" id="setting_site">
        <form id="fontForm" method="post">
          <label for="fontname" class="label-select">نام فونت</label>
          <div class="select-conteyner">
            <select name="fontname" id="fontname" class="select">
              <option value="iransans">ایران سنس</option>
              <option value="vazir">وزیر</option>
              <option value="yekan">یکان</option>
              <option value="Bnazanin">بی نازنین</option>
            </select>
          </div>

          <label for="fontsize" class="label-select">سایز فونت</label>
          <div class="select-conteyner">
            <select name="fontsize" id="fontsize" class="select">
              <option value="14">14</option>
              <option value="16">16</option>
              <option value="18">18</option>
              <option value="20">20</option>
              <option value="22">22</option>
              <option value="24">24</option>
              <option value="26">26</option>
              <option value="28">28</option>
            </select>
          </div>
          <div><button type="submit" id="saveFontButton" class="btn btn-Update">به روزرسانی</button></div>
              </div>
        
        </form>

      </div>

    </section>
  </div>

  </div>
  <!-- فرم تنظیمات پایان -->
  <?php require_once '../footer/footer.php';?>


<script src="../assets/setting/js/setting.js"></script>
<script src="<?= asset('script\form_setting.js')?>"></script>

</body>

</html>