<?php
session_start();

session_destroy();

header('Location: http://danatm.ir');
exit();
?>
