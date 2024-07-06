<?php
if (!isset($_SESSION['name'])){
    redirect('app/views/Login&SinUp/login.php');
}
