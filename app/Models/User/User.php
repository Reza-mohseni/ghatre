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
                        'created_at'  => date('Y-m-d H:i:s'),
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
                // انتقال به HTTPS در صورت نیاز
                if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
                    header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
                    exit;
                }
                // شروع session با تنظیمات امنیتی
                session_start([
                    'cookie_lifetime' => 86400,
                    'cookie_secure' => true,
                    'cookie_httponly' => true,
                    'use_strict_mode' => true
                ]);

                // تنظیم اطلاعات کاربر در session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['Name'];
                $_SESSION['last_name'] = $user['LastName'];
                $_SESSION['email'] = $user['Email'];
                $_SESSION['phone_number']=$user['PhoneNumber'];

                // بازتولید شناسه session
                session_regenerate_id(true);
                header('Location: /dashboard.php');


                exit();
            } else {
                return 'نام کاربر ی یا رمز عبور اشتباه است';
            }

        }

}



?>



