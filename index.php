<?php
require_once 'app/core/healper/healper.php';

if(isset($_SESSION["name"])){
    redirect('app/views/dashboard/dashboard.php');
}else{
    redirect('app/views/Login&SinUp/login.php');
}