<?php
require_once '../../core/healper/healper.php';
if (!isset($_SESSION['name'])){
    redirect('app/views/Login&SinUp/login.php');
}
