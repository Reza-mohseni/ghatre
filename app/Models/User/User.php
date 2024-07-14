<?php


namespace App\Models\User;

use App\Models\ORM\BaseModel;
require_once '../../core/healper/healper.php';
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
                        'role' => 0,
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

            if (empty($Password) || empty($UserName) ) {
                return 0;
            }

            $user = $this->Find($UserName,$UserName);
            if (!$user) {
                return 1;
            }

            if (password_verify($Password, $user['Password'])) {
                $params = session_get_cookie_params();
                $params['lifetime'] = 86600;
                $params['secure'] = true;
                $params['httponly'] = true;

                session_set_cookie_params($params['lifetime'], $params['path'], $params['domain'], $params['secure'], $params['httponly']);
                ini_set('session.cookie_samesite', 'Strict');
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['Name'];
                $_SESSION['last_name'] = $user['LastName'];
                $_SESSION['email'] = $user['Email'];
                $_SESSION['phone_number'] = $user['PhoneNumber'];


                return 2;
            } else {
                return 3;
            }

        }




}



?>



