<?php

namespace App\controllers\user;

use App\Models\User\User;

require_once '../../Models/User/User.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $NumberPhone = $_POST['NumberPhone'];
    $Email = $_POST['Email'] ;
    $Password = $_POST['Password'];
    $ConfirmPassword = $_POST['ConfirmPassword'] ;
    $LastName = $_POST['LastName'];
    $name = $_POST['Name'] ;

    $newuser = new User();
    if (strlen($Password) >= 8) {
        if ($ConfirmPassword===$Password){
            if (preg_match("/((0?9)|(\+?989))\d{2}\W?\d{3}\W?\d{4}/", $NumberPhone)) {
                $return = $newuser->createUser($name, $LastName, $Password, $Email, $NumberPhone);
                if ($return=='Success'){
                    echo json_encode(['success' => true, 'message' => 'ثبت نام شما باموفقیت انجام شد.']);
                } elseif($return=='Existing') {
                    echo json_encode(['error' => true, 'message' => 'شما قبلا در سایت ثبت نام کرده اید.']);
                }else{
                    echo json_encode(['error' => true, 'message' => '.با خطا مواجه شدیم لطفا خطا را به مدیر سایت نشان دهید   '.$return]);
                }
            } else {
                echo json_encode(['error' => true, 'message' => 'شماره موبایل وارد شده صحیح نیست']);
            }
        }else{
            echo json_encode(['error' => true, 'message' => 'رمز عبور و تکرار رمز عبور باهم مطابقت ندارد']);
        }
    } else {
        echo json_encode(['error' => true, 'message' => 'رمز عبور شما باید حداقل 8 کاراکتر باشد']);
    }
} else {
    echo json_encode(['success' => true, 'message' => 'درخواست نامعتبر است']);
}

?>
