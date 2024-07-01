<?php


namespace App\Models\User;

use App\Models\ORM\BaseModel;

require_once '../../Models/ORM/BaseModel.php';
class User extends BaseModel
{
protected $table = 'users';
        public function createUser($Name, $LastName, $Password, $Email, $NumberPhone)
        {
            if (!empty($Name) && !empty($LastName) && !empty($Email) && !empty($NumberPhone) && !empty($Password)) {
                if ($this->Find($NumberPhone, $Email) === false) {
                    // رمز عبور را هش کنید
                    $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

                    // آرایه اطلاعات کاربر را تعریف کنید
                    $userData = [
                        'Name' => $Name,
                        'LastName' => $LastName,
                        'Email' => $Email,
                        'PhoneNumber' => $NumberPhone,
                        'Password' => $hashedPassword,
                    ];
                    return $this->save($userData);
                } else {
                    return 'Existing';
                }
            }
            return false; // در صورت خالی بودن هر یک از ورودی‌ها
        }
        public function LoginUser($Password, $UserName){
            if (empty($Password) || (empty($UserName) )) {
                return 'پسورد و یا نام کاربری وارد نشده!';
            }

            // پیدا کردن کاربر با استفاده از ایمیل یا شماره تلفن
            $user = $this->Find($UserName,$UserName);
            if (!$user) {
                return 'شما ثبت نام نکرده اید';
            }

            // بررسی رمز عبور
            if (password_verify($Password, $user['Password'])) {
                // موفقیت در ورود
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['Name'];

                // ریدایرکت به صفحه مورد نظر
                header('Location: /dashboard.php');
                exit();
            } else {
                return 'نام کاربر ی یا رمز عبور اشتباه است';
            }

        }
}



?>



