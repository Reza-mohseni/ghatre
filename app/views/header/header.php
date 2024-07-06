<?php
require_once '../../core/healper/healper.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= asset('header/style/style.css') ?>">
</head>
<body>
        <!-- منوی بالا -->
        <div class="topbar">
            <div class="topbar-r">
              <div class="user">
                <p id="displayuser"></p>
              </div>
            </div>
            <span class="icon-menu"><i class="bi bi-list"></i></span>
          </div>
      
          <!-- منوی بالا پایان -->
           <script src="<?= asset('header/js/script.js') ?>"></script>

</body>
</html>