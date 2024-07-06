<?php
namespace App\controllers\user;

use App\Models\User\User;

require_once '../../Models/User/User.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $UserName = $_POST['UserName'];
    $Password = $_POST['Password'];
    $loginuser = new User();
    echo json_encode(['error' => true, 'message' => $loginuser->LoginUser($Password,$UserName)]);
}
