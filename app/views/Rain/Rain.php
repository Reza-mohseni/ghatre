<?php
require_once '../../core/healper/healper.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= asset('Rain\css\Rain.css')?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <title>باران ها</title>
</head>

<body>


    <!-- منوی راست -->
    <?php require_once '../menu/menu.php'; ?>
    <!-- منوی راست پایان -->
    <!--  هدر -->
    <?php require_once '../header/header.php'; ?>
    <!--  هدر  -->
    <div class="tabels-conteyner">
    <div id="tables"></div>
    <div class="pagination" id="pagination-container"></div>
    </div>
    <!-- جدول بارش و آبیاری پایان -->
  <?php require_once '../footer/footer.php';?>
  <script src="<?= asset('script\form_setting.js')?>"></script>
  <script src="../assets/Rain/js/Rain.js"></script>
  
</body>

</html>