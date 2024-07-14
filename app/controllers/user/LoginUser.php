<?php
use App\Models\User\User;
header('Content-Type: application/json');

require_once '../../Models/User/User.php';
if(isset($_SESSION["user_name"])){
    redirect('app/views/dashboard/dashboard.php');
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $UserName = $_POST['UserName'];
    $Password = $_POST['Password'];

    $loginuser = new User();
    $loginResult = $loginuser->LoginUser($Password, $UserName);

    if ($loginResult == 2) {
        echo json_encode(['success' => true, 'message' => 'ورود موفق', 'redirect' => 'https://danatm.ir/app/views/dashboard/dashboard.php']);
    } elseif ($loginResult == 0) {
        echo json_encode(['error' => true, 'message' => 'پسورد و یا نام کاربری وارد نشده!']);
    } elseif ($loginResult == 1) {
        echo json_encode(['error' => true, 'message' => 'شما ثبت نام نکرده‌اید']);
    } elseif ($loginResult == 3) {
        echo json_encode(['error' => true, 'message' => 'نام کاربری یا رمز عبور اشتباه است']);
    }

    exit();
}
